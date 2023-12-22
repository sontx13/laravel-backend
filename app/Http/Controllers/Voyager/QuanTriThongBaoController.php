<?php

namespace App\Http\Controllers\Voyager;

use App\Enums\TrangThaiDocThongBaoEnum;
use App\Enums\TrangThaiThongBaoEnum;
use App\Helpers\FireBaseHelper;
use App\Models\ThongBao;
use App\Models\User;
use App\Models\UserDeviceToken;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Role;

class QuanTriThongBaoController extends VoyagerBaseController
{
    // View index quản trị thông báo
    public function Index(Request $request)
    {
        $this->authorize('browse_thong-bao');
        $view = 'voyager::quantri-thongbao.index';
        $lsRoles = Role::get();
        $lsUsers = User::get();
        return Voyager::view($view, compact('lsRoles', 'lsUsers'));
    }

    public function PartialViewDsThongBaos(Request $request) {
        $trangthai = $request->trangthai;
        $lsThongBaos = ThongBao::where(function($query) use($trangthai) {
                                        if ($trangthai != -1) {
                                            $query->where('trang_thai', $trangthai);
                                        }
                                    })
                                ->orderBy('created_at', 'DESC')
                                ->get();
        foreach ($lsThongBaos as $item) {
            $dsNguoiNhanHienThis = [];
            $dsNhomNhanHienThis = [];
            if ($item->nguoi_nhan != null && $item->nguoi_nhan != "") {
                $nguoinhans = explode(",", $item->nguoi_nhan);
                foreach ($nguoinhans as $nguoinhan) {
                    $user = User::find($nguoinhan);
                    if ($user != null ) {
                        array_push($dsNguoiNhanHienThis, $user->name);
                    } else {
                        array_push($dsNguoiNhanHienThis, $nguoinhan);
                    }
                }
            }
            $item->dsNguoiNhanHienThis = $dsNguoiNhanHienThis;
            if ($item->nhom_nhan != null && $item->nhom_nhan != "") {
                $nhomnhans = explode(",", $item->nhom_nhan);
                foreach ($nhomnhans as $nhomnhan) {
                    $role = Role::where('name', $nhomnhan)->first();
                    if ($role != null ) {
                        // dd($role);
                        array_push($dsNhomNhanHienThis, $role['display_name']);
                    } else {
                        array_push($dsNhomNhanHienThis, $nhomnhan);
                    }
                }
            }
            $item->dsNhomNhanHienThis = $dsNhomNhanHienThis;
        }
        $view = 'voyager::quantri-thongbao.partials.danh-sach';
        return Voyager::view($view, compact('lsThongBaos'));
    }

    public function ThemMoiThongBao(Request $request) {
        $this->authorize('add_thong-bao');
        $tieude = $request->tieude;
        $noidung = $request->noidung;
        $dulieu = $request->dulieu;
        $nguoinhan = $request->nguoinhan;
        $nhomnhan = $request->nhomnhan;
        $check = $this->ValidateThongBao($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('thong_bao')->insert([
                'id' => 0,
                'tieu_de' => $tieude,
                'noi_dung' => $noidung,
                'nguoi_nhan' => $nguoinhan,
                'nhom_nhan' => $nhomnhan,
                'trang_thai' => TrangThaiThongBaoEnum::ChuaGui,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => null,
                'created_by' => $currentUserId,
                'updated_by' => null,
                'ngay_gui' => null,
                'nguoi_gui' => null,
                'ket_qua' => null,
                'du_lieu' => $dulieu
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

    public function ValidateThongBao($request) {
        $tieude = $request->tieude;
        $noidung = $request->noidung;
        $nguoinhan = $request->nguoinhan;
        $nhomnhan = $request->nhomnhan;
        if ($tieude == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Tiêu đề không được để trống'
            ], 200);
        }
        if ($noidung == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Nội dung không được để trống'
            ], 200);
        }
        if (($nguoinhan == null || $nguoinhan == "") && ($nhomnhan == null || $nhomnhan == "")) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Người nhận và nhóm nhận không được cùng để trống'
            ], 200);
        }
    }

    public function ShowModalSuaThongBao(Request $request) {
        $id = $request->id;
        $item = ThongBao::find($id);
        $dsNguoiNhan = explode(",", $item->nguoi_nhan);
        $dsNhomNhan = explode(",", $item->nhom_nhan);
        $lsRoles = Role::get();
        $lsUsers = User::get();
        $view = 'voyager::quantri-thongbao.partials.modal-sua';
        return Voyager::view($view, compact('item', 'dsNguoiNhan', 'dsNhomNhan', 'lsRoles', 'lsUsers'));
    }

    public function CapNhatThongBao(Request $request) {
        $this->authorize('edit_thong-bao');
        $id = $request->id;
        $tieude = $request->tieude;
        $noidung = $request->noidung;
        $dulieu = $request->dulieu;
        $nguoinhan = $request->nguoinhan;
        $nhomnhan = $request->nhomnhan;
        $item = ThongBao::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateThongBao($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('thong_bao')
                ->where('id', $id)
                ->update([
                    'tieu_de' => $tieude,
                    'noi_dung' => $noidung,
                    'du_lieu' => $dulieu,
                    'nguoi_nhan' => $nguoinhan,
                    'nhom_nhan' => $nhomnhan,
                    'updated_by' => $currentUserId,
                    'updated_at' => date("Y-m-d H:i:s")
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

    public function XoaThongBao(Request $request) {
        $this->authorize('delete_thong-bao');
        $id = $request->id;
        $item = ThongBao::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        DB::beginTransaction();
        try {
            DB::table('thong_bao')
                ->where('id', $id)
                ->delete();
            DB::commit();
            return response()->json([
                'error_code' => 0,
                'message' => 'Xóa thành công'
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error_code' => 1,
                'message' => 'Xóa không thành công',
                'data' => json_encode($e)
            ], 200);
        }
    }

    public function GuiThongBao(Request $request) {
        $this->authorize('send_thong-bao');
        $id = $request->id;
        $item = ThongBao::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            // Thực hiện gửi FCM
            $dsNhomNhans = [];
            $dsNguoiNhans = [];
            $dsDevices = [];
            if ($item->nhom_nhan != null && $item->nhom_nhan != "") {
                $dsNhomNhans = explode(",", $item->nhom_nhan);
            }
            if ($item->nguoi_nhan != null && $item->nguoi_nhan) {
                $dsNguoiNhanTemp = explode(",", $item->nguoi_nhan);
                foreach ($dsNguoiNhanTemp as $nguoinhan) {
                    $user = User::find($nguoinhan);
                    if ($user != null) {
                        $userHasAnyRole = false;
                        foreach ($dsNhomNhans as $nhomnhan) {
                            if ($user->hasRole($nhomnhan)) {
                                $userHasAnyRole = true;
                                break;
                            }
                        }
                        if (!$userHasAnyRole) {
                            array_push($dsNguoiNhans, $nguoinhan);
                        }
                    }
                }
            }
            if (count($dsNguoiNhans) > 0) {
                foreach ($dsNguoiNhans as $nguoinhan) {
                    $lsDevices = UserDeviceToken::where('user_id', $nguoinhan)->get();
                    foreach ($lsDevices as $device) {
                        array_push($dsDevices, $device->token);
                    }
                }
            }

            // Thực hiện gửi lên FCM
            $result = "";
            if (count($dsNhomNhans) > 1) {
                $messageDsNhomNhans = FireBaseHelper::SendMessageByTopics($dsNhomNhans, $item->tieu_de, $item->noi_dung, $item->du_lieu);
                $result .= $messageDsNhomNhans;
            }
            else if (count($dsNhomNhans) == 1) {
                $messageNhomNhan = FireBaseHelper::SendMessageByTopic($dsNhomNhans[0], $item->tieu_de, $item->noi_dung, $item->du_lieu);
                $result .= $messageNhomNhan;
            }

            if (count($dsDevices) > 1) {
                $messageDsDevices = FireBaseHelper::SendMessageByDevices($dsDevices, $item->tieu_de, $item->noi_dung, $item->du_lieu);
                $result .= $messageDsDevices;
            }
            else if (count($dsDevices) == 1) {
                $messageDevice = FireBaseHelper::SendMessageByDevice($dsDevices[0], $item->tieu_de, $item->noi_dung, $item->du_lieu);
                $result .= $messageDevice;
            }

            if ($result != "") {
                DB::table('thong_bao')
                ->where('id', $id)
                ->update([
                    'trang_thai' => TrangThaiThongBaoEnum::GuiLoi,
                    'ngay_gui' => date("Y-m-d H:i:s"),
                    'nguoi_gui' => $currentUserId,
                    'ket_qua' => $result,
                    'updated_by' => $currentUserId,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                DB::commit();
                return response()->json([
                    'error_code' => 1,
                    'message' => 'Gửi không thành công'
                ], 200);
            } else {
                DB::table('thong_bao')
                ->where('id', $id)
                ->update([
                    'trang_thai' => TrangThaiThongBaoEnum::GuiThanhCong,
                    'ngay_gui' => date("Y-m-d H:i:s"),
                    'nguoi_gui' => $currentUserId,
                    'ket_qua' => $result,
                    'updated_by' => $currentUserId,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
                $lsUserIds = $this->GetDsUserNameNhanThongBaos($item->nhom_nhan, $item->nguoi_nhan);
                foreach ($lsUserIds as $userid) {
                    $this->InsertLichSuThongBao($userid, $item->id);
                }
                DB::commit();
                return response()->json([
                    'error_code' => 0,
                    'message' => 'Gửi thành công'
                ], 200);
            }

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'error_code' => 1,
                'message' => 'Gửi không thành công',
                'data' => $e->getMessage()
            ], 200);
        }
    }
    private function InsertLichSuThongBao($userid, $thongbaoid) {
        DB::table('lichsu_thongbao')
        ->insert([
            'id' => 0,
            'thongbao_id' => $thongbaoid,
            'user_id' => $userid,
            'created_at' => date("Y-m-d H:i:s"),
            'trang_thai' => TrangThaiDocThongBaoEnum::ChuaDoc,
            'viewed_at' => null
        ]);
    }
    private function GetDsUserNameNhanThongBaos($nhomnhan, $nguoinhan) {
        $dsUserIds = [];
        if ($nguoinhan != null && $nguoinhan != "") {
            $dsUserIds = explode(",", $nguoinhan);
        }
        if ($nhomnhan != null && $nhomnhan != "") {
            $dsNhomNhans = explode(",", $nhomnhan);
            foreach ($dsNhomNhans as $role) {
                $lsUsers = $this->GetDsUserByRole($role);
                foreach($lsUsers as $user) {
                    if (!in_array(strval($user->id), $dsUserIds)) {
                        array_push($dsUserIds, strval($user->id));
                    }
                }
            }
        }
        return $dsUserIds;
    }
    private function GetDsUserByRole($role) {
        $users = [];
        $role = Role::where('name', $role)->first();
        if ($role != null) {
            $query =
            "SELECT
                DISTINCT
                a.id
            FROM(
                SELECT
                    id
                FROM app_qcdc.users
                WHERE role_id = ?
                UNION
                SELECT
                    user_id as id
                FROM app_qcdc.user_roles
                WHERE
                    role_id = ?) a;
                ";
                $users = DB::select($query, [$role->id, $role->id]);
            }
        return $users;

    }
    public static function GetDisplayTT($trangthai) {
        $result = "";
        switch($trangthai) {
            case 0:
                $result = "Chưa gửi";
                break;
            case 1:
                $result = "Gửi thành công";
                break;
            case 2:
                $result = "Gửi lỗi";
                break;
        }
        return $result;
    }

    public static function GetClassTT($trangthai) {
        $class = "";
        switch($trangthai) {
            case 0:
                $result = "tt-chuagui";
                break;
            case 1:
                $result = "tt-guithanhcong";
                break;
            case 2:
                $result = "tt-guiloi";
                break;
        }
        return $result;
    }
    protected function guard()
    {
        return Auth::guard(app('VoyagerGuard'));
    }
}
