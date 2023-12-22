<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DonVi;
use App\Models\KetQuaHoTroHuongDanMotCua;
use App\Models\PKS02;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PKS02Controller extends VoyagerBaseController
{
    public function Index01(Request $request)
    {
        $view = 'voyager::pks-02.index';
        $donvis = [];
        $donvi_id = auth()->user()->donvi_id;
        $tendonvi = DonVi::where('ma_donvi', auth()->user()->donvi_id)->get();
        $donvicha =  DonVi::where('ma_donvi', $tendonvi[0]->group_donvi)->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $currentUser = Auth::user();


        if ($currentUser->is_admin) {

            $donvis = DonVi::where('showon_select', 1)->get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds2(auth()->user()->donvi_id);

            $donvis = DonVi::whereIn('id', $donviIdAlls)
                ->orderBy('cap_donvi', 'ASC')
                ->orderBy('ten_donvi', 'ASC')
                ->get();
        }
        return Voyager::view($view, compact('donvis', 'lsDonViCha', 'donvi_id', 'tendonvi', 'donvicha'));
    }
    public function KetQuaHoTroHuongDanMotCua(Request $request)
    {
        $donvi = $request->donvi;
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsKetQua = [];
        $queryFinal = PKS02::query();
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
        $lsKetQua = $queryFinal->where('deleted_at', null)
            ->where('date', '>=', $fromDate)
            ->where('date', '<=', $toDate)
            ->orderBy('date','desc')->get();
        foreach ($lsKetQua as $index  => $item) {
            $item->ho_ten = json_decode($item->ho_ten);
        }
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
        $view = 'voyager::pks-02.danh-sach';
        $isxembaocao = $request->isxembaocao;
        return Voyager::view($view, compact('lsKetQua', 'isxembaocao', 'tenHuyen'));
    }
    public function KetQuaHoTroHuongDanMotCuaWebview(Request $request)
    {
        $donvi = $request->donvi;
        $dsDonviIds = parent::GetDsDonviIds();
        $currentUser = Auth::user();
        $lsKetQua = [];
        $queryFinal = KetQuaHoTroHuongDanMotCua::query();
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



        if ($request->fromDate != null && $request->toDate != null) {
            $queryFinal = $queryFinal->where('date', '>', $request->fromDate);
            $queryFinal = $queryFinal->where('date', '<', $request->toDate);
        }

        $lsKetQua = $queryFinal->orderBy('so_luot')->get();
        foreach ($lsKetQua as $index  => $item) {
            $item->ho_ten = json_decode($item->ho_ten);
        }
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
        $view = 'voyager::pks-01-webview.danh-sach';
        $isxembaocao = $request->isxembaocao;
        return Voyager::view($view, compact('lsKetQua', 'isxembaocao', 'tenHuyen'));
    }

    public function ThemMoiKetQuaHoTroHuongDanMotCua(Request $request)
    {
        if (!auth()->user()->hasPermission('add_ketqua_hotro_huongdan_motcua')) {
            abort(403, 'Unauthorized action.');
        }
        $tenxaphuong = $request->tenxaphuong;
        $hoten = $request->hoten;
        $soluot  = $request->soluot;
        $songuoi = $request->songuoi;
        $donviid = $request->donvi;
        $check = $this->ValidateKetQuaHoTroHuongDanMotCua($request);
        if ($check != null) {
            return $check;
        }
        $currentUser = Auth::user();
        DB::beginTransaction();
        try {
            DB::table('ketqua_hotro_huongdan_motcua_pks02')->insert([
                'ten_xaphuong' => $tenxaphuong,
                'ho_ten' => $hoten, //họ têncán bộ được phân công

                'so_luot' => $soluot, // số lượt người dân làm thủ tục
                'so_nguoi' => $songuoi, // số người tham gia đánh giá khảo sát
                'created_at' => date("Y-m-d H:i:s"),
                // 'year' => $request->year,
                'date' => date($request->date),
                'donvi_id' => $donviid && $donviid != "0" && $donviid != 0 ? $donviid : $currentUser->donvi_id,
                'updated_at' => null,
                'deleted_at' => null,
                'created_by' => $currentUser->id,
                'updated_by' => null,
                'deleted_by' => null,
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

    public function ValidateKetQuaHoTroHuongDanMotCua($request)
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

    public function ShowModalSuaKetQuaHoTroHuongDanMotCua(Request $request)
    {
        $id = $request->id;
        $item = PKS02::find($id);
        $view = 'voyager::pks-01.modal-sua';
        return Voyager::view($view, compact('item'));
    }

    public function CapNhatKetQuaHoTroHuongDanMotCua(Request $request)
    {
        if (!auth()->user()->hasPermission('edit_ketqua_hotro_huongdan_motcua')) {
            abort(403, 'Unauthorized action.');
        }
        $id = $request->id;
        $tenxaphuong = $request->tenxaphuong;
        $soluot = $request->soluot;
        $item = PKS02::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateKetQuaHoTroHuongDanMotCua($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('ketqua_hotro_huongdan_motcua_pks02')
                ->where('id', $id)
                ->update([
                    'so_luong' => $soluot,
                    'updated_by' => $currentUserId,
                    'deleted_at' => null,
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

    public function XoaKetQuaHoTroHuongDanMotCua(Request $request)
    {
        if (!auth()->user()->hasPermission('delete_ketqua_hotro_huongdan_motcua')) {
            abort(403, 'Unauthorized action.');
        }
        $id = $request->id;
        $item = PKS02::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('ketqua_hotro_huongdan_motcua_pks02')
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
    protected function guard()
    {
        return Auth::guard(app('VoyagerGuard'));
    }
}
