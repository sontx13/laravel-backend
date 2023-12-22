<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonVi;
use App\Models\KetquaTochuchopThonbanTodanpho;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class XemKetQuaToChucHopThonBanToDanPhoController extends VoyagerBaseController
{
    //-------------Kết quả tổ chức họp thôn bản tổ dân phố---------------
    public function KetQuaToChucHopThonBanToDanPho(Request $request)
    {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsKetQuaToChucHops = [];
        $queryFinal = KetquaTochuchopThonbanTodanpho::query();
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

        $lsKetQuaToChucHops = $queryFinal->get();


        $view = 'voyager::xem-nhaplieu-baocao-webview.partials.ketqua-tochuchop-thonban-todanpho.danh-sach';
        return Voyager::view($view, compact('lsKetQuaToChucHops'));
    }

    public function ThemMoiKetQuaToChucHopThonBanToDanPho(Request $request)
    {
        // $this->authorize('add_bieu-quyet');
        $tenxaphuong = $request->tenxaphuong;
        $tongsothonban = $request->tongsothonban;
        $sothonbanhop1nam1lan = $request->sothonbanhop1nam1lan;
        $sothonbanhop1nam2lan = $request->sothonbanhop1nam2lan;
        $sothonbanhopkhac = $request->sothonbanhopkhac;
        $ghichu = $request->ghichu;
        $donviid = $request->donvi;
        $check = $this->ValidateKetQuaToChucHopThonBanToDanPho($request);
        if ($check != null) {
            return $check;
        }
        $currentUser = Auth::user();
        DB::beginTransaction();
        try {
            DB::table('ketqua_tochuchop_thonban_todanpho')->insert([
                'id' => 0,
                'ten_xaphuong' => $tenxaphuong,
                'tongso_thonban' => $tongsothonban,
                'sothonban_hop1nam1lan' => $sothonbanhop1nam1lan,
                'sothonban_hop1nam2lan' => $sothonbanhop1nam2lan,
                'sothonban_hopkhac' => $sothonbanhopkhac,
                'ghi_chu' => $ghichu,
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

    public function ValidateKetQuaToChucHopThonBanToDanPho($request)
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

    public function ShowModalSuaKetQuaToChucHopThonBanToDanPho(Request $request)
    {
        $id = $request->id;
        $item = KetquaTochuchopThonbanTodanpho::find($id);
        $view = 'voyager::nhaplieu-baocao.partials.ketqua-tochuchop-thonban-todanpho.modal-sua';
        return Voyager::view($view, compact('item'));
    }

    public function CapNhatKetQuaToChucHopThonBanToDanPho(Request $request)
    {
        $id = $request->id;
        $tenxaphuong = $request->tenxaphuong;
        $tongsothonban = $request->tongsothonban;
        $sothonbanhop1nam1lan = $request->sothonbanhop1nam1lan;
        $sothonbanhop1nam2lan = $request->sothonbanhop1nam2lan;
        $sothonbanhopkhac = $request->sothonbanhopkhac;
        $ghichu = $request->ghichu;
        $item = KetquaTochuchopThonbanTodanpho::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateKetQuaToChucHopThonBanToDanPho($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('ketqua_tochuchop_thonban_todanpho')
                ->where('id', $id)
                ->update([
                    'ten_xaphuong' => $tenxaphuong,
                    'ten_xaphuong' => $tenxaphuong,
                    'tongso_thonban' => $tongsothonban,
                    'sothonban_hop1nam1lan' => $sothonbanhop1nam1lan,
                    'sothonban_hop1nam2lan' => $sothonbanhop1nam2lan,
                    'sothonban_hopkhac' => $sothonbanhopkhac,
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

    public function XoaKetQuaToChucHopThonBanToDanPho(Request $request)
    {
        $id = $request->id;
        $item = KetquaTochuchopThonbanTodanpho::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('ketqua_tochuchop_thonban_todanpho')
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
    //-------------End Kết quả tổ chức họp thôn, bản, tổ dân phố---------------
}
