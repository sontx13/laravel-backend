<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonVi;
use App\Models\NhandanBanVaQuyetdinhTructiep;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NhanDanBanVaQuyetDinhTrucTiepController extends VoyagerBaseController
{
    //-------------Nhân dân bàn và quyết định trực tiếp---------------
    public function NhanDanBanVaQuyetDinhTrucTiep(Request $request)
    {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsNhanDanBanVaQuyetDinhs = [];
        $queryFinal = NhandanBanVaQuyetdinhTructiep::query();
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
        $lsNhanDanBanVaQuyetDinhs = $queryFinal->get();

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

        $view = 'voyager::nhaplieu-baocao.partials.nhandan-ban-va-quyetdinh-tructiep.danh-sach';
        $isxembaocao = $request->isxembaocao;
        return Voyager::view($view, compact('lsNhanDanBanVaQuyetDinhs', 'isxembaocao', 'tenHuyen'));
    }

    public function ThemMoiNhanDanBanVaQuyetDinhTrucTiep(Request $request)
    {
        $this->authorize('add_nhaplieu-baocao');
        $tenxaphuong = $request->tenxaphuong;
        $noidungcongviec = $request->noidungcongviec;
        $coquanchutri = $request->coquanchutri;
        $hinhthucban = $request->hinhthucban;
        $sophuongan = $request->sophuongan;

        $donviid = $request->donvi;
        $tomtat = $request->tomtat;
        $tonggiatri = $request->tonggiatri;
        $nsnn = $request->nsnn;
        $nddg = $request->nddg;
        $ngaycong = $request->ngaycong;
        $khac = $request->khac;
        $sophieu = $request->sophieu;
        $tongso = $request->tongso;
        $ketquabieuquyet = strval(number_format(($sophieu / $tongso) * 100, 2)) . '%';
        $check = $this->ValidateNhanDanBanVaQuyetDinhTrucTiep($request);
        if ($check != null) {
            return $check;
        }
        $currentUser = Auth::user();
        DB::beginTransaction();
        try {
            DB::table('nhandan_ban_va_quyetdinh_tructiep')->insert([
                'id' => 0,
                'ten_xaphuong' => $tenxaphuong,
                'noidung_congviec' => $noidungcongviec,
                'coquan_chutri' => $coquanchutri,
                'hinhthuc_ban' => $hinhthucban,
                'so_phuongan' => $sophuongan,
                'ketqua_bieuquyet' => $ketquabieuquyet,
                'tomtat_noidung' => $tomtat,
                'tong_giatri' => $tonggiatri,
                'nsnn' => $nsnn,
                'nddg' => $nddg,
                'ngay_cong' => $ngaycong,
                'sophieu' => $sophieu,
                'tongso' => $tongso,
                'khac' => $khac,
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

    public function ValidateNhanDanBanVaQuyetDinhTrucTiep($request)
    {
        $tenxaphuong = $request->tenxaphuong;
        $noidungcongviec = $request->noidungcongviec;
        $coquanchutri = $request->coquanchutri;
        $hinhthucban = $request->hinhthucban;
        $sophuongan = $request->sophuongan;
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
    }

    public function ShowModalSuaNhanDanBanVaQuyetDinhTrucTiep(Request $request)
    {
        $id = $request->id;
        $item = NhandanBanVaQuyetdinhTructiep::find($id);
        $lsHinhThucs = [
            0 => "Hội nghị",
            1 => "Phát phiếu",
            2 => "Biểu quyết"
        ];
        $view = 'voyager::nhaplieu-baocao.partials.nhandan-ban-va-quyetdinh-tructiep.modal-sua';
        return Voyager::view($view, compact('item', 'lsHinhThucs'));
    }

    public function CapNhatNhanDanBanVaQuyetDinhTrucTiep(Request $request)
    {
        $this->authorize('edit_nhaplieu-baocao');
        $id = $request->id;
        $tenxaphuong = $request->tenxaphuong;
        $noidungcongviec = $request->noidungcongviec;
        $coquanchutri = $request->coquanchutri;
        $hinhthucban = $request->hinhthucban;
        $sophuongan = $request->sophuongan;
        $ketquabieuquyet = $request->ketquabieuquyet;
        $tomtat = $request->tomtat;
        $tonggiatri = $request->tonggiatri;
        $nsnn = $request->nsnn;
        $nddg = $request->nddg;
        $ngaycong = $request->ngaycong;
        $khac = $request->khac;
        $sophieu = $request->sophieu;
        $tongso = $request->tongso;
        $ketquabieuquyet = strval(number_format(($sophieu / $tongso) * 100, 2)) . '%';
        $item = NhanDanBanVaQuyetDinhTrucTiep::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateNhanDanBanVaQuyetDinhTrucTiep($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('nhandan_ban_va_quyetdinh_tructiep')
                ->where('id', $id)
                ->update([
                    'ten_xaphuong' => $tenxaphuong,
                    'noidung_congviec' => $noidungcongviec,
                    'coquan_chutri' => $coquanchutri,
                    'hinhthuc_ban' => $hinhthucban,
                    'so_phuongan' => $sophuongan,
                    'ketqua_bieuquyet' => $ketquabieuquyet,
                    'tomtat_noidung' => $tomtat,
                    'tong_giatri' => $tonggiatri,
                    'nsnn' => $nsnn,
                    'nddg' => $nddg,
                    'ngay_cong' => $ngaycong,
                    'khac' => $khac,
                    'sophieu' => $sophieu,
                    'tongso' => $tongso,
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

    public function XoaNhanDanBanVaQuyetDinhTrucTiep(Request $request)
    {
        $this->authorize('delete_nhaplieu-baocao');
        $id = $request->id;
        $item = NhandanBanVaQuyetdinhTructiep::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('nhandan_ban_va_quyetdinh_tructiep')
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
