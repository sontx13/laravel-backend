<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonVi;
use App\Models\NhandanBanVaQuyetdinhTructiep;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class XemNhanDanBanVaQuyetDinhTrucTiepController extends VoyagerBaseController
{
    //-------------Nhân dân bàn và quyết định trực tiếp---------------
    public function NhanDanBanVaQuyetDinhTrucTiep(Request $request) {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsNhanDanBanVaQuyetDinhs = [];
        $queryFinal = NhandanBanVaQuyetdinhTructiep::query();
        $donviIdAlls = [];
        if ($request->donvicha == 0) {
            $lsDonViCons = DonVi::select(['id'])->get();
            foreach ($lsDonViCons as $donviConItem) {
                array_push($donviIdAlls, $donviConItem->id);
            }
            $queryFinal->whereIn('donvi_id', $donviIdAlls);
        } else {
            if ($request->donvi != 0) {
                $jDonVi = DonVi::find($request->donvi);
                if ($jDonVi->cap_donvi == 1) {
                    //donothing
                } else if ($jDonVi->cap_donvi == 2) {
                    $lsDonViCons = DonVi::where('id_donvi_cha', $jDonVi->id)->select(['id'])->get();
                    foreach ($lsDonViCons as $donviConItem) {
                        array_push($donviIdAlls, $donviConItem->id);
                    }

                    $queryFinal->whereIn('donvi_id', $donviIdAlls);
                } else {
                    $queryFinal->where('donvi_id', $request->donvi);
                }
            } else {
                $lsDonViCons = DonVi::where('id_donvi_cha', $request->donvicha)->select(['id'])->get();
                foreach ($lsDonViCons as $donviConItem) {
                    array_push($donviIdAlls, $donviConItem->id);
                }

                $queryFinal->whereIn('donvi_id', $donviIdAlls);
            }
        }

        if ($request->quarter != 0) {
            $queryFinal = $queryFinal->where('quarter', $request->quarter);
        }

        $queryFinal = $queryFinal->where('year', $request->year);
            $lsNhanDanBanVaQuyetDinhs = $queryFinal->get();

        $view = 'voyager::xem-nhaplieu-baocao-webview.partials.nhandan-ban-va-quyetdinh-tructiep.danh-sach';
        return Voyager::view($view, compact('lsNhanDanBanVaQuyetDinhs'));
    }



    public function ValidateNhanDanBanVaQuyetDinhTrucTiep($request) {
        $tenxaphuong = $request->tenxaphuong;
        $noidungcongviec = $request->noidungcongviec;
        $coquanchutri = $request->coquanchutri;
        $hinhthucban = $request->hinhthucban;
        $sophuongan = $request->sophuongan;
        $ketquabieuquyet = $request->ketquabieuquyet;
        $donviid = Auth::user()->donvi_id;
        if ($donviid == null || $donviid == 0) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Đơn vị của người dùng trống, xin vui lòng liên hệ quản trị để thiết lập đơn vị'
            ], 200);
        }
        if ($tenxaphuong == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Tên xã phường, thị trấn không được để trống'
            ], 200);
        }
        if ($noidungcongviec == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Nội dung công việc không được để trống'
            ], 200);
        }
        if ($coquanchutri == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Cơ quan chủ trì không được để trống'
            ], 200);
        }
        if ($hinhthucban == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Hình thức bàn không được để trống'
            ], 200);
        }
        if ($sophuongan == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Số phương án không được để trống'
            ], 200);
        }
        if ($ketquabieuquyet == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Kết quả biểu quyết không được để trống'
            ], 200);
        }
    }
    //-------------End Nhân dân bàn và quyết định trực tiếp---------------
}
