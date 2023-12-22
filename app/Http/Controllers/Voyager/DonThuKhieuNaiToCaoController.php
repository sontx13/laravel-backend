<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonthuKhieunaiTocao;
use App\Models\DonVi;
use App\Models\TiepNhanPakn;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonThuKhieuNaiToCaoController extends VoyagerBaseController
{
    //-------------Đơn thư khiếu nại tố cáo---------------
    public function DonThuKhieuNaiToCao(Request $request)
    {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsDonThuKhieuNais = [];
        $queryFinal = DonthuKhieunaiTocao::query();
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

        $lsDonThuKhieuNais = $queryFinal->get();

        $donVi = DonVi::find($request->donvi);
        $tenHuyen = '';
        if ($donVi != null) {
            if ($donVi->cap_donvi == 3) {
                $donViCha = DonVi::find($donVi->id_donvi_cha);
                if ($donViCha != null) {
                    $tenHuyen = $donViCha->ten_donvi;
                }
            } else {
                $tenHuyen = $donVi->ten_donvi;
            }
        }
        $view = 'voyager::nhaplieu-baocao.partials.donthu-khieunai-tocao.danh-sach';
        $isxembaocao = $request->isxembaocao;
        return Voyager::view($view, compact('lsDonThuKhieuNais', 'isxembaocao', 'tenHuyen'));
    }

    public function ThemMoiDonThuKhieuNaiToCao(Request $request)
    {
        $this->authorize('add_nhaplieu-baocao');
        $tenxaphuong = $request->tenxaphuong;
        $sodonthudatiepnhantrongkybaocao = $request->sodonthudatiepnhantrongkybaocao;
        $sodonthudatiepnhantinhtudaunam = $request->sodonthudatiepnhantinhtudaunam;
        $sodonthudagiaiquyettrongkybaocao = $request->sodonthudagiaiquyettrongkybaocao;
        $sodonthudagiaiquyettinhtudaunam = $request->sodonthudagiaiquyettinhtudaunam;
        $tongsodonthuchuagiaiquyet = $request->tongsodonthuchuagiaiquyet;
        $ghichu = $request->ghichu;
        $donviid = $request->donvi;
        $check = $this->ValidateDonThuKhieuNaiToCao($request);
        if ($check != null) {
            return $check;
        }
        $currentUser = Auth::user();
        DB::beginTransaction();
        try {
            DB::table('donthu_khieunai_tocao')->insert([
                'ten_xaphuong' => $tenxaphuong,
                'sodonthu_datiepnhan_trongkybaocao' => $sodonthudatiepnhantrongkybaocao,
                'sodonthu_datiepnhan_tinhtudaunam' => $sodonthudatiepnhantinhtudaunam,
                'sodonthu_dagiaiquyet_trongkybaocao' => $sodonthudagiaiquyettrongkybaocao,
                'sodonthu_dagiaiquyet_tinhtudaunam' => $sodonthudagiaiquyettinhtudaunam,
                'tongso_donthu_chuagiaiquyet' => $tongsodonthuchuagiaiquyet,
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

    public function ValidateDonThuKhieuNaiToCao($request)
    {
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

    public function ShowModalSuaDonThuKhieuNaiToCao(Request $request)
    {
        $id = $request->id;
        $item = DonThuKhieuNaiToCao::find($id);
        $view = 'voyager::nhaplieu-baocao.partials.donthu-khieunai-tocao.modal-sua';
        return Voyager::view($view, compact('item'));
    }

    public function CapNhatDonThuKhieuNaiToCao(Request $request)
    {
        $this->authorize('edit_nhaplieu-baocao');
        $id = $request->id;
        $tenxaphuong = $request->tenxaphuong;
        $sodonthudatiepnhantrongkybaocao = $request->sodonthudatiepnhantrongkybaocao;
        $sodonthudatiepnhantinhtudaunam = $request->sodonthudatiepnhantinhtudaunam;
        $sodonthudagiaiquyettrongkybaocao = $request->sodonthudagiaiquyettrongkybaocao;
        $sodonthudagiaiquyettinhtudaunam = $request->sodonthudagiaiquyettinhtudaunam;
        $tongsodonthuchuagiaiquyet = $request->tongsodonthuchuagiaiquyet;
        $ghichu = $request->ghichu;
        $item = DonThuKhieuNaiToCao::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateDonThuKhieuNaiToCao($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('donthu_khieunai_tocao')
                ->where('id', $id)
                ->update([
                    'ten_xaphuong' => $tenxaphuong,
                    'sodonthu_datiepnhan_trongkybaocao' => $sodonthudatiepnhantrongkybaocao,
                    'sodonthu_datiepnhan_tinhtudaunam' => $sodonthudatiepnhantinhtudaunam,
                    'sodonthu_dagiaiquyet_trongkybaocao' => $sodonthudagiaiquyettrongkybaocao,
                    'sodonthu_dagiaiquyet_tinhtudaunam' => $sodonthudagiaiquyettinhtudaunam,
                    'tongso_donthu_chuagiaiquyet' => $tongsodonthuchuagiaiquyet,
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

    public function XoaDonThuKhieuNaiToCao(Request $request)
    {
        $this->authorize('delete_nhaplieu-baocao');
        $id = $request->id;
        $item = DonThuKhieuNaiToCao::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('donthu_khieunai_tocao')
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
    //-------------End Đơn thư khiếu nại, tố cáo---------------
}
