<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonVi;
use App\Models\NhandanKiemtraGiamsat;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NhanDanKiemTraGiamSatController extends VoyagerBaseController
{
    //-------------Nhân dân kiểm tra, giám sát---------------
    public function NhanDanKiemTraGiamSat(Request $request)
    {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsNhanDanKiemTraGiamSats = [];
        $queryFinal = NhandanKiemtraGiamsat::query();
        $donviIdAlls = [];
        if ($request->donvicha != null && $request->donvicha == 0) {
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
            $lsNhanDanKiemTraGiamSats = $queryFinal->get();

        $donVi = DonVi::find($request->donvi);
        $tenHuyen = '';
        if ($donVi != null) {
            if ($donVi->cap_donvi == 3) {
                $donViCha = DonVi::find($donVi->id_donvi_cha);
                if ($donViCha != null) {
                    $tenHuyen = $donViCha->ten_donvi;
                }
            }else{
                $tenHuyen = $donVi->ten_donvi;
            }
        }
        $view = 'voyager::nhaplieu-baocao.partials.nhandan-kiemtra-giamsat.danh-sach';
        $isxembaocao = $request->isxembaocao;
        return Voyager::view($view, compact('lsNhanDanKiemTraGiamSats', 'isxembaocao','tenHuyen'));
    }

    public function ThemMoiNhanDanKiemTraGiamSat(Request $request)
    {
        $this->authorize('add_nhaplieu-baocao');
        $noidunggiamsat = $request->noidunggiamsat;
        $coquanthuchien = $request->coquanthuchien;
        $soykiencapuy = $request->soykiencapuy;
        $soykienchinhquyen = $request->soykienchinhquyen;
        $soykienkhac = $request->soykienkhac;
        $ghichu = $request->ghichu;
        $donviid = $request->donvi;
        $check = $this->ValidateNhanDanKiemTraGiamSat($request);
        if ($check != null) {
            return $check;
        }
        $currentUser = Auth::user();
        DB::beginTransaction();
        try {
            DB::table('nhandan_kiemtra_giamsat')->insert([
                'id' => 0,
                'noidung_giamsat' => $noidunggiamsat,
                'coquan_thuchien' => $coquanthuchien,
                'soykien_capuy' => $soykiencapuy,
                'soykien_chinhquyen' => $soykienchinhquyen,
                'soykien_khac' => $soykienkhac,
                'ghi_chu' => $ghichu,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => null,
                'deleted_at' => null,
                'created_by' => $currentUser->id,
                'updated_by' => null,
                'deleted_by' => null,
                'donvi_id' => $donviid && $donviid != "0" && $donviid != 0 ? $donviid : $currentUser->donvi_id,
                'quarter' => $request->quarter,
                'year' => $request->year
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

    public function ValidateNhanDanKiemTraGiamSat($request)
    {
        $noidunggiamsat = $request->noidunggiamsat;
        $coquanthuchien = $request->coquanthuchien;
        $donviid = Auth::user()->donvi_id;
        if ($donviid == null || $donviid == 0) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Đơn vị của người dùng trống, xin vui lòng liên hệ quản trị để thiết lập đơn vị'
            ], 200);
        }
        if ($noidunggiamsat == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Nội dung giám sát không được để trống'
            ], 200);
        }
        if ($coquanthuchien == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Cơ quan thực hiện không được để trống'
            ], 200);
        }
    }

    public function ShowModalSuaNhanDanKiemTraGiamSat(Request $request)
    {
        $id = $request->id;
        $item = NhandanKiemtraGiamsat::find($id);
        $lsCoQuanThucHiens = [
            0 => "Ban thanh tra nhân dân",
            1 => "Ban giám sát đầu tư của cộng đồng",
            2 => "Khác"
        ];
        $view = 'voyager::nhaplieu-baocao.partials.nhandan-kiemtra-giamsat.modal-sua';
        return Voyager::view($view, compact('item', 'lsCoQuanThucHiens'));
    }

    public function CapNhatNhanDanKiemTraGiamSat(Request $request)
    {
        $this->authorize('edit_nhaplieu-baocao');
        $id = $request->id;
        $noidunggiamsat = $request->noidunggiamsat;
        $coquanthuchien = $request->coquanthuchien;
        $soykiencapuy = $request->soykiencapuy;
        $soykienchinhquyen = $request->soykienchinhquyen;
        $soykienkhac = $request->soykienkhac;
        $ghichu = $request->ghichu;
        $item = NhandanKiemtraGiamsat::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateNhanDanKiemTraGiamSat($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('nhandan_kiemtra_giamsat')
                ->where('id', $id)
                ->update([
                    'noidung_giamsat' => $noidunggiamsat,
                    'coquan_thuchien' => $coquanthuchien,
                    'soykien_capuy' => $soykiencapuy,
                    'soykien_chinhquyen' => $soykienchinhquyen,
                    'soykien_khac' => $soykienkhac,
                    'ghi_chu' => $ghichu,
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

    public function XoaNhanDanKiemTraGiamSat(Request $request)
    {
        $this->authorize('delete_nhaplieu-baocao');
        $id = $request->id;
        $item = NhandanKiemtraGiamsat::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('nhandan_kiemtra_giamsat')
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
    //-------------End Nhân dân kiểm tra giám sát---------------
}
