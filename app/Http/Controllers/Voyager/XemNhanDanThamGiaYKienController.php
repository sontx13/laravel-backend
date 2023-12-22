<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonVi;
use App\Models\NhandanThamgiaYkien;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class XemNhanDanThamGiaYKienController extends VoyagerBaseController
{
    //-------------Nhân dân bàn và quyết định trực tiếp---------------
    public function NhanDanThamGiaYKien(Request $request) {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsNhanDanThamGiaYKiens = [];
        $queryFinal = NhandanThamgiaYkien::query();
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
            $lsNhanDanThamGiaYKiens = $queryFinal->get();


        $view = 'voyager::xem-nhaplieu-baocao-webview.partials.nhandan-thamgia-ykien.danh-sach';
        return Voyager::view($view, compact('lsNhanDanThamGiaYKiens'));
    }

    public function ThemMoiNhanDanThamGiaYKien(Request $request) {
        // $this->authorize('add_bieu-quyet');
        $tenxaphuong = $request->tenxaphuong;
        $noidungxinykien = $request->noidungxinykien;
        $coquanchutri = $request->coquanchutri;
        $hinhthucthamgiaykien = $request->hinhthucthamgiaykien;
        $ghichu = $request->ghichu;
        $donviid = $request->donvi;
        $check = $this->ValidateNhanDanThamGiaYKien($request);
        if ($check != null) {
            return $check;
        }
        $currentUser = Auth::user();
        DB::beginTransaction();
        try {
            DB::table('nhandan_thamgia_ykien')->insert([
                'id' => 0,
                'ten_xaphuong' => $tenxaphuong,
                'noidung_xinykien' => $noidungxinykien,
                'coquan_chutri' => $coquanchutri,
                'hinhthuc_thamgia_ykien' => $hinhthucthamgiaykien,
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

    public function ValidateNhanDanThamGiaYKien($request) {
        $tenxaphuong = $request->tenxaphuong;
        $noidungxinykien = $request->noidungxinykien;
        $coquanchutri = $request->coquanchutri;
        $hinhthucthamgiaykien = $request->hinhthucthamgiaykien;
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
        if ($noidungxinykien == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Nội dung xin ý kiến không được để trống'
            ], 200);
        }
        if ($coquanchutri == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Cơ quan chủ trì không được để trống'
            ], 200);
        }
        if ($hinhthucthamgiaykien == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Hình thức tham gia ý kiến không được để trống'
            ], 200);
        }
    }

    public function ShowModalSuaNhanDanThamGiaYKien(Request $request) {
        $id = $request->id;
        $item = NhandanThamgiaYkien::find($id);
        $lsHinhThucs = [
            0 => "Hội nghị",
            1 => "Phát phiếu",
            2 => "Hòm thư góp ý"
        ];
        $view = 'voyager::nhaplieu-baocao.partials.nhandan-thamgia-ykien.modal-sua';
        return Voyager::view($view, compact('item', 'lsHinhThucs'));
    }

    public function CapNhatNhanDanThamGiaYKien(Request $request) {
        $id = $request->id;
        $tenxaphuong = $request->tenxaphuong;
        $noidungxinykien = $request->noidungxinykien;
        $coquanchutri = $request->coquanchutri;
        $hinhthucthamgiaykien = $request->hinhthucthamgiaykien;
        $ghichu = $request->ghichu;
        $item = NhandanThamgiaYkien::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateNhanDanThamGiaYKien($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('nhandan_thamgia_ykien')
                ->where('id', $id)
                ->update([
                    'ten_xaphuong' => $tenxaphuong,
                    'noidung_xinykien' => $noidungxinykien,
                    'coquan_chutri' => $coquanchutri,
                    'hinhthuc_thamgia_ykien' => $hinhthucthamgiaykien,
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

    public function XoaNhanDanThamGiaYKien(Request $request) {
        $id = $request->id;
        $item = NhanDanThamGiaYKien::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('nhandan_thamgia_ykien')
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
    //-------------End Nhân dân tham gia ý kiến---------------
}
