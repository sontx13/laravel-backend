<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonVi;
use App\Models\KetquaHuydongvonXaydungHatangcoso;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KetQuaHuyDongVonXayDungHaTangCoSoController extends VoyagerBaseController
{
    //-------------Kết quả huy động vốn xây dựng hậ tầng cơ sở---------------
    public function KetQuaHuyDongVonXayDungHaTangCoSo(Request $request)
    {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsKetQuaHuyDongVons = [];
        $queryFinal = KetquaHuydongvonXaydungHatangcoso::query();
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
            $lsKetQuaHuyDongVons = $queryFinal->get();

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
        $view = 'voyager::nhaplieu-baocao.partials.ketqua-huydongvon-xaydung-hatangcoso.danh-sach';
        $isxembaocao = $request->isxembaocao;
        return Voyager::view($view, compact('lsKetQuaHuyDongVons', 'isxembaocao','tenHuyen'));
    }

    public function ThemMoiKetQuaHuyDongVonXayDungHaTangCoSo(Request $request)
    {
        $this->authorize('add_nhaplieu-baocao');
        $tenxaphuong = $request->tenxaphuong;
        $tencongtrinh = $request->tencongtrinh;
        $tonggiatri = $request->tonggiatri;
        $nhandandonggop = $request->nhandandonggop;
        $nhanuochotro = $request->nhanuochotro;
        $ghichu = $request->ghichu;
        $donviid = $request->donvi;
        $check = $this->ValidateKetQuaHuyDongVonXayDungHaTangCoSo($request);
        if ($check != null) {
            return $check;
        }
        $currentUser = Auth::user();
        DB::beginTransaction();
        try {
            DB::table('ketqua_huydongvon_xaydung_hatangcoso')->insert([
                'id' => 0,
                'ten_xaphuong' => $tenxaphuong,
                'ten_congtrinh' => $tencongtrinh,
                'tong_giatri' => str_replace(',', '', $tonggiatri),
                'nhandan_donggop' => str_replace(',', '', $nhandandonggop),
                'nhanuoc_hotro' => str_replace(',', '', $nhanuochotro),
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

    public function ValidateKetQuaHuyDongVonXayDungHaTangCoSo($request)
    {
        $tenxaphuong = $request->tenxaphuong;
        $tencongtrinh = $request->tencongtrinh;
        $tonggiatri = $request->tonggiatri;
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
        if ($tencongtrinh == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Tên công trình (cuộc vận động) không được để trống'
            ], 200);
        }
        if ($tonggiatri == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Tổng giá trị không được để trống'
            ], 200);
        }
    }

    public function ShowModalSuaKetQuaHuyDongVonXayDungHaTangCoSo(Request $request)
    {
        $id = $request->id;
        $item = KetquaHuydongvonXaydungHatangcoso::find($id);
        $view = 'voyager::nhaplieu-baocao.partials.ketqua-huydongvon-xaydung-hatangcoso.modal-sua';
        return Voyager::view($view, compact('item'));
    }

    public function CapNhatKetQuaHuyDongVonXayDungHaTangCoSo(Request $request)
    {
        $this->authorize('edit_nhaplieu-baocao');
        $id = $request->id;
        $tenxaphuong = $request->tenxaphuong;
        $tencongtrinh = $request->tencongtrinh;
        $tonggiatri = $request->tonggiatri;
        $nhandandonggop = $request->nhandandonggop;
        $nhanuochotro = $request->nhanuochotro;
        $ghichu = $request->ghichu;
        $item = KetquaHuydongvonXaydungHatangcoso::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateKetQuaHuyDongVonXayDungHaTangCoSo($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('ketqua_huydongvon_xaydung_hatangcoso')
                ->where('id', $id)
                ->update([
                    'ten_xaphuong' => $tenxaphuong,
                    'ten_congtrinh' => $tencongtrinh,
                    'tong_giatri' => $tonggiatri,
                    'nhandan_donggop' => $nhandandonggop,
                    'nhanuoc_hotro' => $nhanuochotro,
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

    public function XoaKetQuaHuyDongVonXayDungHaTangCoSo(Request $request)
    {
        $this->authorize('delete_nhaplieu-baocao');
        $id = $request->id;
        $item = KetquaHuydongvonXaydungHatangcoso::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('ketqua_huydongvon_xaydung_hatangcoso')
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
    //-------------End Nhân dân bàn và quyết định trực tiếp---------------
}
