<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonVi;
use App\Models\KetquaThuchienCongkhai;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class XemKetQuaThucHienCongKhaiController extends VoyagerBaseController
{
    //-------------Kết quả thực hiện công khai---------------
    public function KetQuaThucHienCongKhai(Request $request)
    {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsKetQuaThucHiens = [];
        $queryFinal = KetquaThuchienCongkhai::query();
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

        $lsKetQuaThucHiens = $queryFinal->get();
        $view = 'voyager::xem-nhaplieu-baocao-webview.partials.ketqua-thuchien-congkhai.danh-sach';
        return Voyager::view($view, compact('lsKetQuaThucHiens'));
    }


    public function ValidateKetQuaThucHienCongKhai($request)
    {
        $tenxaphuong = $request->tenxaphuong;
        $noidungcongkhai = $request->noidungcongkhai;
        $coquanthuchiencongkhai = $request->coquanthuchiencongkhai;
        $hinhthuccongkhai = $request->hinhthuccongkhai;
        $congkhaitheosokehoach = $request->congkhaitheosokehoach;
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
        if ($noidungcongkhai == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Nội dung công khai không được để trống'
            ], 200);
        }
        if ($coquanthuchiencongkhai == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Cơ quan thực hiện công khai không được để trống'
            ], 200);
        }
        if ($hinhthuccongkhai == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Hình thức công khai không được để trống'
            ], 200);
        }
        if ($congkhaitheosokehoach == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Số kế hoạch công khai không được để trống'
            ], 200);
        }
        if ($congkhaitheosokehoach == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Số kế hoạch công khai không được để trống'
            ], 200);
        }
    }
    //-------------End Kết quả thực hiện công khai---------------
}
