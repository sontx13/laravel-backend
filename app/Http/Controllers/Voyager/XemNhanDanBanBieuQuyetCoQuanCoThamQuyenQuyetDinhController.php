<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonVi;
use App\Models\NhandanBanBieuquyetCoquanCothamquyenQuyetdinh;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class XemNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhController extends VoyagerBaseController
{
     //-------------Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định---------------
     public function NhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh(Request $request) {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
         $lsNhanDanBanVaCoQuanQuyetDinhs = [];
         $queryFinal = NhandanBanBieuquyetCoquanCothamquyenQuyetdinh::query();
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
             $lsNhanDanBanVaCoQuanQuyetDinhs = $queryFinal->get();

        $view = 'voyager::xem-nhaplieu-baocao-webview.partials.nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh.danh-sach';
        return Voyager::view($view, compact('lsNhanDanBanVaCoQuanQuyetDinhs'));
    }

    public function ThemMoiNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh(Request $request) {
        // $this->authorize('add_bieu-quyet');
        $tenxaphuong = $request->tenxaphuong;
        $noidungcongviec = $request->noidungcongviec;
        $coquanchutri = $request->coquanchutri;
        $hinhthucban = $request->hinhthucban;
        $sophuongan = $request->sophuongan;
        $ketquabieuquyet = $request->ketquabieuquyet;
        $donviid = $request->donvi;
        $check = $this->ValidateNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh($request);
        if ($check != null) {
            return $check;
        }
        $currentUser = Auth::user();
        DB::beginTransaction();
        try {
            DB::table('nhandan_ban_bieuquyet_coquan_cothamquyen_quyetdinh')->insert([
                'id' => 0,
                'ten_xaphuong' => $tenxaphuong,
                'noidung_congviec' => $noidungcongviec,
                'coquan_chutri' => $coquanchutri,
                'hinhthuc_ban' => $hinhthucban,
                'so_phuongan' => $sophuongan,
                'ketqua_bieuquyet' => $ketquabieuquyet,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => null,
                'deleted_at' => null,
                'created_by' => $currentUser,
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

    public function ValidateNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh($request) {
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

    public function ShowModalSuaNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh(Request $request) {
        $id = $request->id;
        $item = NhandanBanBieuquyetCoquanCothamquyenQuyetdinh::find($id);
        $lsHinhThucs = [
            0 => "Hội nghị",
            1 => "Phát phiếu"
        ];
        $view = 'voyager::nhaplieu-baocao.partials.nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh.modal-sua';
        return Voyager::view($view, compact('item', 'lsHinhThucs'));
    }

    public function CapNhatNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh(Request $request) {
        $id = $request->id;
        $tenxaphuong = $request->tenxaphuong;
        $noidungcongviec = $request->noidungcongviec;
        $coquanchutri = $request->coquanchutri;
        $hinhthucban = $request->hinhthucban;
        $sophuongan = $request->sophuongan;
        $ketquabieuquyet = $request->ketquabieuquyet;
        $item = NhandanBanBieuquyetCoquanCothamquyenQuyetdinh::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('nhandan_ban_bieuquyet_coquan_cothamquyen_quyetdinh')
                ->where('id', $id)
                ->update([
                'ten_xaphuong' => $tenxaphuong,
                'noidung_congviec' => $noidungcongviec,
                'coquan_chutri' => $coquanchutri,
                'hinhthuc_ban' => $hinhthucban,
                'so_phuongan' => $sophuongan,
                'ketqua_bieuquyet' => $ketquabieuquyet,
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

    public function XoaNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh(Request $request) {
        $id = $request->id;
        $item = NhandanBanBieuquyetCoquanCothamquyenQuyetdinh::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('nhandan_ban_bieuquyet_coquan_cothamquyen_quyetdinh')
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
    //-------------End Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định---------------
}
