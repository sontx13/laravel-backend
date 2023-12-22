<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonVi;
use App\Models\KetquaHoatdongCuabanthanhtraNhandan;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class XemKetQuaHoatDongCuaBanThanhTraNhanDanController extends VoyagerBaseController
{
    //-------------Kết quả hoạt động của ban thanh tra nhân dân---------------
    public function KetQuaHoatDongCuaBanThanhTraNhanDan(Request $request) {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsKetQuaHoatDongs = [];

        $queryFinal = KetquaHoatdongCuabanthanhtraNhandan::query();
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

            $lsKetQuaHoatDongs = $queryFinal->get();

        $view = 'voyager::xem-nhaplieu-baocao-webview.partials.ketqua-hoatdong-cuabanthanhtra-nhandan.danh-sach';
        return Voyager::view($view, compact('lsKetQuaHoatDongs',));
    }

    public function ThemMoiKetQuaHoatDongCuaBanThanhTraNhanDan(Request $request) {
        // $this->authorize('add_bieu-quyet');
        $tenxaphuong = $request->tenxaphuong;
        $socuocgiamsat = $request->socuocgiamsat;
        $phathiensosaipham = $request->phathiensosaipham;
        $sovuvieckiennghi = $request->sovuvieckiennghi;
        $thuhoitien = $request->thuhoitien;
        $xulykhacvetien = $request->xulykhacvetien;
        $thuhoidat = $request->thuhoidat;
        $xulykhacvedat = $request->xulykhacvedat;
        $kiennghixulybatcap = $request->kiennghixulybatcap;
        $donviid = $request->donvi;
        $check = $this->ValidateKetQuaHoatDongCuaBanThanhTraNhanDan($request);
        if ($check != null) {
            return $check;
        }
        $currentUser = Auth::user();
        DB::beginTransaction();
        try {
            DB::table('ketqua_hoatdong_cuabanthanhtra_nhandan')->insert([
                'id' => 0,
                'ten_xaphuong' => $tenxaphuong,
                'socuoc_giamsat' => $socuocgiamsat,
                'phathien_sosaipham' => $phathiensosaipham,
                'sovuviec_kiennghi' => $sovuvieckiennghi,
                'thuhoi_tien' => $thuhoitien,
                'xulykhac_vetien' => $xulykhacvetien,
                'thuhoi_dat' => $thuhoidat,
                'xulykhac_vedat' => $xulykhacvedat,
                'kiennghi_xulybatcap' => $kiennghixulybatcap,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => null,
                'deleted_at' => null,
                'created_by' => $currentUser->id,
                'updated_by' => null,
                'deleted_by' => null,
                'donvi_id' => $donviid && $donviid != "0" && $donviid != 0 ? $donviid : $currentUser->donvi_id
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

    public function ValidateKetQuaHoatDongCuaBanThanhTraNhanDan($request) {
        $tenxaphuong = $request->tenxaphuong;
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
    }

    public function ShowModalSuaKetQuaHoatDongCuaBanThanhTraNhanDan(Request $request) {
        $id = $request->id;
        $item = KetquaHoatdongCuabanthanhtraNhandan::find($id);
        $view = 'voyager::nhaplieu-baocao.partials.ketqua-hoatdong-cuabanthanhtra-nhandan.modal-sua';
        return Voyager::view($view, compact('item'));
    }

    public function CapNhatKetQuaHoatDongCuaBanThanhTraNhanDan(Request $request) {
        $id = $request->id;
        $tenxaphuong = $request->tenxaphuong;
        $socuocgiamsat = $request->socuocgiamsat;
        $phathiensosaipham = $request->phathiensosaipham;
        $sovuvieckiennghi = $request->sovuvieckiennghi;
        $thuhoitien = $request->thuhoitien;
        $xulykhacvetien = $request->xulykhacvetien;
        $thuhoidat = $request->thuhoidat;
        $xulykhacvedat = $request->xulykhacvedat;
        $kiennghixulybatcap = $request->kiennghixulybatcap;
        $item = KetquaHoatdongCuabanthanhtraNhandan::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateKetQuaHoatDongCuaBanThanhTraNhanDan($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('ketqua_hoatdong_cuabanthanhtra_nhandan')
                ->where('id', $id)
                ->update([
                    'ten_xaphuong' => $tenxaphuong,
                    'socuoc_giamsat' => $socuocgiamsat,
                    'phathien_sosaipham' => $phathiensosaipham,
                    'sovuviec_kiennghi' => $sovuvieckiennghi,
                    'thuhoi_tien' => $thuhoitien,
                    'xulykhac_vetien' => $xulykhacvetien,
                    'thuhoi_dat' => $thuhoidat,
                    'xulykhac_vedat' => $xulykhacvedat,
                    'kiennghi_xulybatcap' => $kiennghixulybatcap,
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

    public function XoaKetQuaHoatDongCuaBanThanhTraNhanDan(Request $request) {
        $id = $request->id;
        $item = KetquaHoatdongCuabanthanhtraNhandan::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('ketqua_hoatdong_cuabanthanhtra_nhandan')
                ->where('id', $id)
                ->update([
                    'deleted_by' => $currentUserId,
                    'deleted_at' => date("Y-m-d H:i:s")
            ]);
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
    //-------------End Kết quả hoạt động của ban thanh tra nhân dân---------------
}
