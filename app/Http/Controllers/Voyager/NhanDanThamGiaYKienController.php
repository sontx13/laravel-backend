<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonVi;
use App\Models\NhandanThamgiaYkien;
use App\Models\NoidungNhandanthamgiaykien;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NhanDanThamGiaYKienController extends VoyagerBaseController
{
    //-------------Nhân dân bàn và quyết định trực tiếp----------- ----
    public function NhanDanThamGiaYKien(Request $request)
    {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsNhanDanThamGiaYKiens = [];
        $queryFinal = NhandanThamgiaYkien::query();
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
        $lsNhanDanThamGiaYKiens = $queryFinal->get();

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
        $view = 'voyager::nhaplieu-baocao.partials.nhandan-thamgia-ykien.danh-sach';
        $isxembaocao = $request->isxembaocao;
        return Voyager::view($view, compact('lsNhanDanThamGiaYKiens', 'isxembaocao', 'tenHuyen'));
    }
    public function BaoCaoNhanDanThamGiaYKien(Request $request)
    {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsNhanDanThamGiaYKiens = [];
        $queryFinal = NhandanThamgiaYkien::query();
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
        $lsNhanDanThamGiaYKiens = $queryFinal->get();

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
        $view = 'voyager::nhaplieu-baocao.partials.nhandan-thamgia-ykien.bao-cao';
        $isxembaocao = $request->isxembaocao;
        return Voyager::view($view, compact('lsNhanDanThamGiaYKiens', 'isxembaocao', 'tenHuyen'));
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            if ($file->getClientOriginalExtension() === 'pdf' && $file->getMimeType() === 'application/pdf') {
                $file = $request->file('file');
                $path = $file->store('public/uploads');
                $url = Storage::url($path);
                return response()->json($url, 200);
            } else {
                return  response()->json("Lỗi", 403);
            }
        }
        return  response()->json("Lỗi", 403);
    }
    public function ThemMoiNhanDanThamGiaYKien(Request $request)
    {
        $this->authorize('add_nhaplieu-baocao');
        $tenxaphuong = $request->tenxaphuong;
        $noidungxinykien = $request->noidungxinykien;
        $coquanchutri = $request->coquanchutri;
        $hinhthucthamgiaykien = $request->hinhthucthamgiaykien;
        $ghichu = $request->ghichu;
        $tomtat = $request->tomtat;
        $kehoach = $request->kehoach;
        $duthao = $request->duthao;
        $tungay = $request->tungay;
        $denngay = $request->denngay;
        $ykienthamgia = $request->ykienthamgia;
        $ykientiepthu = $request->ykientiepthu;
        $baocao = $request->baocao;
        $donviid = $request->donvi;

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
                'tomtat' => $tomtat,
                'ke_hoach' => $kehoach,
                'duthao' => $duthao,
                'bat_dau_y_kien' => $tungay,
                'ket_thuc_y_kien' => $denngay,
                'so_y_kien_thamgia' => $ykienthamgia,
                'so_y_kien_tiepthu' => $ykientiepthu,
                'baocao' => $baocao,
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


    public function ShowModalSuaNhanDanThamGiaYKien(Request $request)
    {
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
    public function NoidungNhandanthamgiaykien()
    {
        $lsNoiDung = NoidungNhandanthamgiaykien::get();
        return  response()->json($lsNoiDung, 200);
    }

    public function CapNhatNhanDanThamGiaYKien(Request $request)
    {
        $this->authorize('edit_nhaplieu-baocao');
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

    public function XoaNhanDanThamGiaYKien(Request $request)
    {
        $this->authorize('delete_nhaplieu-baocao');
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
