<?php

namespace App\Http\Controllers\Voyager;

use App\Enums\TrangThaiThongBaoEnum;
use App\Helpers\FireBaseHelper;
use App\Models\KhaoSat;
use App\Models\ThongBao;
use App\Models\User;
use App\Models\UserDeviceToken;
use DateTime;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Role;

class QuanTriKhaoSatController extends VoyagerBaseController
{
    // View index quản trị khảo sát
    public function Index(Request $request)
    {
        $this->authorize('browse_khao-sat');
        $view = 'voyager::quantri-khaosat.index';
        return Voyager::view($view);
    }

    public function PartialViewDsKhaoSats(Request $request) {
        $lsKhaoSats = KhaoSat::get();
        $view = 'voyager::quantri-khaosat.partials.danh-sach';
        return Voyager::view($view, compact('lsKhaoSats'));
    }

    public function ShowModalSuaKhaoSat(Request $request) {
        $id = $request->id;
        $item = KhaoSat::find($id);
        $item->ngay_batdaustr =  $item->ngay_batdau != null ? DateTime::createFromFormat('Y-m-d H:i:s', $item->ngay_batdau)->format('Y-m-d\TH:i:s') : "";
        $item->ngay_ketthucstr = $item->ngay_ketthuc != null ? DateTime::createFromFormat('Y-m-d H:i:s', $item->ngay_ketthuc)->format('Y-m-d\TH:i:s') : "";
        $view = 'voyager::quantri-khaosat.partials.modal-sua';
        return Voyager::view($view, compact('item'));
    }

    public function CapNhatKhaoSat(Request $request) {
        $this->authorize('edit_khao-sat');
        $id = $request->id;
        $trangthai = $request->trangthai;
        $ngaybatdau = $request->ngaybatdau;
        $ngayketthuc = $request->ngayketthuc;
        $item = KhaoSat::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        DB::beginTransaction();
        try {
            DB::table('khao_sat')
                ->where('id', $id)
                ->update([
                    'trang_thai' => $trangthai,
                    'ngay_batdau' => $ngaybatdau ?? null,
                    'ngay_ketthuc' => $ngayketthuc ?? null
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

    public static function GetDisplayTT($trangthai) {
        $result = "";
        switch($trangthai) {
            case 0:
                $result = "Không Hoạt Động";
                break;
            case 1:
                $result = "Hoạt Động";
                break;
        }
        return $result;
    }

    public static function GetClassTT($trangthai) {
        $class = "";
        switch($trangthai) {
            case 0:
                $class = "tt-khonghoatdong";
                break;
            case 1:
                $class = "tt-hoatdong";
                break;
        }
        return $class;
    }
    protected function guard()
    {
        return Auth::guard(app('VoyagerGuard'));
    }
}
