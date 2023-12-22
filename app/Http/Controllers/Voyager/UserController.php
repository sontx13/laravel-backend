<?php

namespace App\Http\Controllers\Voyager;

use App\Enums\TrangThaiHoatDongEnum;
use App\Helpers\FileHelper;
use App\Models\ChucVu;
use App\Models\DanToc;
use App\Models\DonVi;
use App\Models\User;
use DateTime;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use TCG\Voyager\Models\Role;

class UserController extends VoyagerBaseController
{
    // View Ds user
    public function Index(Request $request)
    {
        $donviid = $request->donviid;
        $keyword = $request->keyword;

        $currentUser = Auth::user();
        $donvis = [];
        if ($currentUser->is_admin) {
            $donvis = DonVi::get();
        } else {
            $donviIdAlls = $this->GetDonviIdOfUsers();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $roles = Role::get();


        $lsUsers = User::query();

        if (!empty($keyword)) {
            $lsUsers->where('name', 'LIKE', '%' . trim($keyword) . '%');
        }

        if ($donviid != 0) {
            $lsUsers->where('donvi_id', '=', $donviid);
        }

        $lsUsers->where('is_admin', '!=', 1);

        $lsUsers = $lsUsers->orderBy('id', 'asc')
            ->Paginate(10);

        $lsUsers->appends([
            'donviid' => $request->donviid,
            'keyword' => $request->keyword
        ]);

        $view = 'voyager::users.index';

        return Voyager::view($view, compact([
                'donvis',
                'roles',
                'lsUsers',
                'donviid',
                'keyword'
            ])
        );
    }

    private function GetDonviIdOfUsers()
    {
        $donviIdAlls = [];
        $donviphu_ids = Auth::user()->donviphu_ids;
        if ($donviphu_ids != null) {
            $donviIdAlls = explode(",", $donviphu_ids);
        }
        $donviid = Auth::user()->donvi_id;
        if ($donviid != null) {
            if (!in_array($donviid, $donviIdAlls)) {
                array_push($donviIdAlls, $donviid);
            }
        }
        return $donviIdAlls;
    }

    // Partial view danh sách user
    public function PartialViewDsUser(Request $request)
    {
        $donviid = $request->donviid;
        $keyword = $request->keyword;

        $lsUsers = User::query();

        if (!empty($keyword)) {
            $lsUsers->where('name', 'LIKE', '%' . trim($keyword) . '%');
        }

        if ($donviid != 0) {
            $lsUsers->where('donvi_id', '=', $donviid);
        }

        $lsUsers->where('is_admin', '!=', 1);

        $lsUsers = $lsUsers->orderBy('id', 'desc')
            ->simplePaginate(10);

        $lsUsers->appends([
            'donviid' => $request->donviid,
            'keyword' => $request->keyword
        ]);

        $view = 'voyager::users.partials.danh-sach';

        return Voyager::view($view, compact('lsUsers'));
    }

    public function CreateUser(Request $request)
    {
        $hoten = $request->hoten;
        $tendangnhap = $request->tendangnhap;
        $donvi = $request->donvi;
        $donviphu = $request->donviphu;
        $vaitro = $request->vaitro;
        $vaitrophu = $request->vaitrophu;
        $donviphuids = "";
        $iscanbo = $request->iscanbo;
        $diachi = $request->diachi;
        if ($tendangnhap == null || $tendangnhap == "") {
            return response()->json([
                'error_code' => 1,
                'message' => 'Tên đăng nhập không được để trống'
            ], 200);
        }
        if ($donvi == null || $donvi == "") {
            return response()->json([
                'error_code' => 1,
                'message' => 'Đơn vị không được để trống'
            ], 200);
        }
        if ($vaitro == null || $vaitro == "") {
            return response()->json([
                'error_code' => 1,
                'message' => 'Vai trò không được để trống'
            ], 200);
        }
        if ($donviphu != null && count($donviphu) > 0) {
            $donviphuids = implode(",", $donviphu);
        }
        $currentUser = Auth::user();
        $existUserUserName = User::where('username', $tendangnhap)->first();
        if ($existUserUserName != null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Đã tồn tại người dùng với tên đăng nhập ' . $tendangnhap
            ], 200);
        } else {
            DB::beginTransaction();
            try {
                $idUser = DB::table('users')
                    ->insertGetId([
                        'id' => 0,
                        'role_id' => $vaitro,
                        'name' => $hoten,
                        'email' => $tendangnhap,
                        'avatar' => NULL,
                        'email_verified_at' => null,
                        'password' => Hash::make("dv123456"),
                        'remember_token' => null,
                        'settings' => '{"locale":"vi"}',
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => null,
                        'created_by' => $currentUser->id,
                        'updated_by' => null,
                        'username' => $tendangnhap,
                        'status' => TrangThaiHoatDongEnum::DaKichHoat,
                        'donviphu_ids' => $donviphuids,
                        'is_admin' => 0,
                        'donvi_id' => $donvi,
                        'dia_chi' => $diachi,
                        'is_canbo' => $iscanbo
                    ]);
                if ($vaitrophu != null && count($vaitrophu) > 0) {
                    foreach ($vaitrophu as $roleid) {
                        DB::table('user_roles')
                            ->insert([
                                'user_id' => $idUser,
                                'role_id' => $roleid
                            ]);
                    }
                }
                DB::commit();
                return response()->json([
                    'error_code' => 0,
                    'message' => 'Lưu thành công'
                ], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'error_code' => 1,
                    'message' => 'Lưu không thành công',
                    'data' => json_encode($e)
                ], 200);
            }
        }
    }

    public function UpdateUser(Request $request)
    {
        $userid = $request->userid;
        $hoten = $request->hoten;
        $tendangnhap = $request->tendangnhap;
        $donvi = $request->donvi;
        $donviphu = $request->donviphu;
        $vaitro = $request->vaitro;
        $vaitrophu = $request->vaitrophu;
        $donviphuids = "";
        $iscanbo = $request->iscanbo;
        $diachi = $request->diachi;
        $currentUser = Auth::user();
        if ($tendangnhap == null || $tendangnhap == "") {
            return response()->json([
                'error_code' => 1,
                'message' => 'Tên đăng nhập không được để trống'
            ], 200);
        }
        if ($donvi == null || $donvi == "") {
            return response()->json([
                'error_code' => 1,
                'message' => 'Đơn vị không được để trống'
            ], 200);
        }
        if ($vaitro == null || $vaitro == "") {
            return response()->json([
                'error_code' => 1,
                'message' => 'Vai trò không được để trống'
            ], 200);
        }
        if ($donviphu != null && count($donviphu) > 0) {
            $donviphuids = implode(",", $donviphu);
        }
        $existUserUserName = User::where('id', '!=', $userid)
            ->where('username', $tendangnhap)->first();
        $user = User::find($userid);
        if ($user == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Người dùng không tồn tại'
            ], 200);
        }
        if ($existUserUserName != null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Đã tồn tại người dùng với tên đăng nhập ' . $tendangnhap
            ], 200);
        } else {
            DB::beginTransaction();
            try {
                DB::table('users')
                    ->where('id', $userid)
                    ->update([
                        'role_id' => $vaitro,
                        'name' => $hoten,
                        'email' => $tendangnhap,
                        'updated_at' => date("Y-m-d H:i:s"),
                        'updated_by' => $currentUser->id,
                        'username' => $tendangnhap,
                        'status' => TrangThaiHoatDongEnum::DaKichHoat,
                        'donviphu_ids' => $donviphuids,
                        'donvi_id' => $donvi,
                        'dia_chi' => $diachi,
                        'is_canbo' => $iscanbo
                    ]);
                if ($vaitrophu != null && count($vaitrophu) > 0) {
                    DB::table('user_roles')
                        ->where('user_id', $userid)
                        ->delete();
                    foreach ($vaitrophu as $roleid) {
                        DB::table('user_roles')
                            ->insert([
                                'user_id' => $userid,
                                'role_id' => $roleid
                            ]);
                    }
                }
                DB::commit();
                return response()->json([
                    'error_code' => 0,
                    'message' => 'Lưu thành công'
                ], 200);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'error_code' => 1,
                    'message' => 'Lưu không thành công',
                    'data' => json_encode($e)
                ], 200);
            }
        }
    }

    public function PartialViewEditUserModal(Request $request)
    {
        $currentUser = Auth::user();
        $userid = $request->userid;
        $user = User::find($userid);
        $currentUser = Auth::user();
        $donvis = [];
        if ($currentUser->is_admin) {
            $donvis = DonVi::get();
        } else {
            $donviIdAlls = $this->GetDonviIdOfUsers();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $roles = Role::get();
        $view = 'voyager::users.partials.sua-user-modal';
        $donviphu_ids = $user->donviphu_ids;
        $donviphus = explode(",", $donviphu_ids);
        $vaitrophus = $this->GetVaiTroPhus($userid);
        return Voyager::view($view, compact('donvis', 'roles', 'user', 'donviphus', 'vaitrophus'));
    }

    public function UpdateTrangThaiUser(Request $request)
    {
        $userid = $request->userid;
        $user = User::find($userid);
        if ($user == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Người dùng không tồn tại'
            ], 200);
        }
        $currentUser = Auth::user();
        $status = $user->status;
        switch ($user->status) {
            case TrangThaiHoatDongEnum::ChuaKichHoat:
                $status = TrangThaiHoatDongEnum::DaKichHoat;
                break;
            case TrangThaiHoatDongEnum::DaKichHoat:
                $status = TrangThaiHoatDongEnum::DaKhoa;
                break;
            case TrangThaiHoatDongEnum::DaKhoa:
                $status = TrangThaiHoatDongEnum::ChuaKichHoat;
                break;
        }
        DB::beginTransaction();
        try {
            DB::table('users')
                ->where('id', $userid)
                ->update([
                    'status' => $status,
                    'updated_at' => date("Y-m-d H:i:s"),
                    'updated_by' => $currentUser->id
                ]);
            DB::commit();
            return response()->json([
                'error_code' => 0,
                'message' => 'Lưu thành công'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error_code' => 1,
                'message' => 'Lưu không thành công',
                'data' => json_encode($e)
            ], 200);
        }
    }

    public function DeleteUser(Request $request)
    {
        $userid = $request->userid;
        $user = User::find($userid);
        if ($user == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Người dùng không tồn tại'
            ], 200);
        }
        $currentUser = Auth::user();
        DB::beginTransaction();
        try {
            DB::table('users')
                ->where('id', $userid)
                ->delete();
            DB::commit();
            return response()->json([
                'error_code' => 0,
                'message' => 'Lưu thành công'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error_code' => 1,
                'message' => 'Lưu không thành công',
                'data' => json_encode($e)
            ], 200);
        }
    }

    public function ResetPassword(Request $request)
    {
        $userid = $request->userid;
        $user = User::find($userid);
        if ($user == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Người dùng không tồn tại'
            ], 200);
        }
        $currentUser = Auth::user();
        DB::beginTransaction();
        try {
            DB::table('users')
                ->where('id', $userid)
                ->update([
                    'password' => Hash::make("dv123456"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'updated_by' => $currentUser->id
                ]);
            DB::commit();
            return response()->json([
                'error_code' => 0,
                'message' => 'Lưu thành công'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error_code' => 1,
                'message' => 'Lưu không thành công',
                'data' => json_encode($e)
            ], 200);
        }
    }

    public static function GetDisplayTTNguoiDung($trangthai)
    {
        $result = "";
        switch ($trangthai) {
            case TrangThaiHoatDongEnum::ChuaKichHoat:
                $result = "Chưa Kích Hoạt";
                break;
            case TrangThaiHoatDongEnum::DaKichHoat:
                $result = "Đã Kích Hoạt";
                break;
            case TrangThaiHoatDongEnum::DaKhoa:
                $result = "Đã Khóa";
                break;
        }
        return $result;
    }

    public static function GetClassTTNguoiDung($trangthai)
    {
        $class = "";
        switch ($trangthai) {
            case TrangThaiHoatDongEnum::ChuaKichHoat:
                $class = "tt-chuakichhoat";
                break;
            case TrangThaiHoatDongEnum::DaKichHoat:
                $class = "tt-dakichhoat";
                break;
            case TrangThaiHoatDongEnum::DaKhoa:
                $class = "tt-dakhoa";
                break;
        }
        return $class;
    }

    private function GetVaiTroPhus($userid)
    {
        $query =
            "SELECT
            DISTINCT
            role_id
        FROM app_qcdc.user_roles
        WHERE user_id = ?";
        $lsRoles = DB::select($query, [$userid]);
        return array_map(function ($value) {
            return $value->role_id;
        }, $lsRoles);
    }
}
