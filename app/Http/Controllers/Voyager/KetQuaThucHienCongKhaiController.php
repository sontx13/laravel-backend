<?php

namespace App\Http\Controllers\Voyager;

use App\Constant\RoleConstant;
use App\Models\DonVi;
use App\Models\KetquaThuchienCongkhai;
use Carbon\Carbon;
use DateTime;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KetQuaThucHienCongKhaiController extends VoyagerBaseController
{
    //-------------Kết quả thực hiện công khai---------------
    // Nhập số liệu: - Chỉ cấp xã nhập cho chính xã đấy
    // Xem báo cáo: - Cấp xã, huyện xem tất cả các xã trong huyện
    //              - Cấp tỉnh xem tất cả các xã trong tỉnh
    public function KetQuaThucHienCongKhai(Request $request)
    {
        $isxembaocao = $request->isxembaocao;

        $lsKetQuaThucHiens = [];
        $queryFinal = KetquaThuchienCongkhai::query();

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

        $lsKetQuaThucHiens = $queryFinal->get();


        $view = 'voyager::nhaplieu-baocao.partials.ketqua-thuchien-congkhai.danh-sach';
        return Voyager::view($view, compact(['lsKetQuaThucHiens',
            'isxembaocao']));
    }

    public
    function ThemMoiKetQuaThucHienCongKhai(Request $request)
    {
        $this->authorize('add_nhaplieu-baocao');
        $noidungcongkhai = $request->noidungcongkhai;
        $coquanthuchiencongkhai = $request->coquanthuchiencongkhai;
        $hinhthuccongkhai = $request->hinhthuccongkhai;
        $sokehoachcongkhai = $request->sokehoachcongkhai;
        $kyhieukehoachcongkhai = $request->kyhieukehoachcongkhai;
        $ngayvanban = $request->ngayvanban;
        $coquanbanhanh = $request->coquanbanhanh;
        $ngaycongkhai = $request->ngaycongkhai;
        $filecongkhai = $request->filecongkhai;
        $tenfilecongkhai = $request->tenfilecongkhai;
        $ghichu = $request->ghichu;
        $check = $this->ValidateKetQuaThucHienCongKhai($request);
        if ($check != null) {
            return $check;
        }
        $currentUser = Auth::user();
        try {
            if ($filecongkhai != null) {
                $path = 'uploads/kehoachcongkhai/' . $tenfilecongkhai;
                $storage = Storage::disk('public');
                $storage->put($path, base64_decode($filecongkhai), 'public');
            }
            $kqThucHien = new KetQuaThucHienCongKhai();
            $kqThucHien->ten_xaphuong = parent::GetTenDonViHienThiNhapLieuBaoCao($currentUser->donvi_id);
            $kqThucHien->noidung_congkhai = $noidungcongkhai;
            $kqThucHien->coquan_congkhai = $coquanthuchiencongkhai;
            $kqThucHien->hinhthuc_congkhai = $hinhthuccongkhai;
            $kqThucHien->sokehoach_congkhai = $sokehoachcongkhai;
            $kqThucHien->kyhieukehoach_congkhai = $kyhieukehoachcongkhai;
            $kqThucHien->ngay_vanban = $ngayvanban != null ? DateTime::createFromFormat('d/m/Y', $ngayvanban) : null;
            $kqThucHien->coquan_banhanh = $coquanbanhanh;
            $kqThucHien->ngay_congkhai = $ngaycongkhai != null ? DateTime::createFromFormat('d/m/Y', $ngaycongkhai) : null;
            $kqThucHien->ghi_chu = $ghichu;
            $kqThucHien->created_by = $currentUser->id;
            $kqThucHien->donvi_id = $currentUser->donvi_id;
            $kqThucHien->save();
            return response()->json([
                'error_code' => 0,
                'message' => 'Lưu thành công'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Lưu không thành công',
                'data' => $e->getMessage()
            ], 200);
        }
    }

    public
    function ValidateKetQuaThucHienCongKhai($request)
    {
        $noidungcongkhai = $request->noidungcongkhai;
        $coquanthuchiencongkhai = $request->coquanthuchiencongkhai;
        $donviid = Auth::user()->donvi_id;
        if ($donviid == null || $donviid == 0) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Đơn vị của người dùng trống, xin vui lòng liên hệ quản trị để thiết lập đơn vị'
            ], 200);
        }
        if ($noidungcongkhai == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Nội dung công khai không được để trống'
            ], 200);
        }
        if ($coquanthuchiencongkhai == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Cơ quan thực hiện công khai không được để trống'
            ], 200);
        }
    }

    public
    function ShowModalSuaKetQuaThucHienCongKhai(Request $request)
    {
        $id = $request->id;
        $item = KetquaThuchienCongkhai::find($id);
        $lsHinhThucs = [
            0 => "Niêm Yết",
            1 => "Loa truyền thanh",
            2 => "Qua trưởng thôn, TDP",
            3 => "Khác"
        ];
        $view = 'voyager::nhaplieu-baocao.partials.ketqua-thuchien-congkhai.modal-sua';
        return Voyager::view($view, compact('item', 'lsHinhThucs'));
    }

    public
    function CapNhatKetQuaThucHienCongKhai(Request $request)
    {
        $this->authorize('edit_nhaplieu-baocao');
        $id = $request->id;
        $tenxaphuong = $request->tenxaphuong;
        $noidungcongkhai = $request->noidungcongkhai;
        $coquanthuchiencongkhai = $request->coquanthuchiencongkhai;
        $hinhthuccongkhai = $request->hinhthuccongkhai;
        $congkhaitheosokehoach = $request->congkhaitheosokehoach;
        $ghichu = $request->ghichu;
        $item = KetquaThuchienCongkhai::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateKetQuaThucHienCongKhai($request);
        if ($check != null) {
            return $check;
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('ketqua_thuchien_congkhai')
                ->where('id', $id)
                ->update([
                    'ten_xaphuong' => $tenxaphuong,
                    'noidung_congkhai' => $noidungcongkhai,
                    'coquan_congkhai' => $coquanthuchiencongkhai,
                    'hinhthuc_congkhai' => $hinhthuccongkhai,
                    'sokehoach_congkhai' => $congkhaitheosokehoach,
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

    public
    function XoaKetQuaThucHienCongKhai(Request $request)
    {
        $this->authorize('delete_nhaplieu-baocao');
        $id = $request->id;
        $item = KetquaThuchienCongkhai::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $currentUserId = Auth::user()->id;
        DB::beginTransaction();
        try {
            DB::table('ketqua_thuchien_congkhai')
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

//-------------End Kết quả thực hiện công khai---------------

    public
    function ShowAddEditKQTHCK(Request $request)
    {
        $item = null;
        $tendonvi = \auth()->user()->donvi->ten_donvi;
        if ($request->id != 0) {
            $item = KetquaThuchienCongkhai::find($request->id);
            $tendonvi = $item->donvi->ten_donvi;
        }

        $lsHinhThucs = [
            0 => "Niêm Yết",
            1 => "Loa truyền thanh",
            2 => "Qua trưởng thôn, TDP",
            3 => "Khác"
        ];

        $view = 'voyager::nhaplieu-baocao.partials.ketqua-thuchien-congkhai.add-edit';

        return Voyager::view($view, compact([
            'item',
            'tendonvi',
            'lsHinhThucs'
        ]));
    }

    public
    function SubmitEditKetQuaThucHienCongKhai(Request $request)
    {
        $this->authorize('edit_nhaplieu-baocao');
        $id = $request->id;
        $item = new KetquaThuchienCongkhai();
        if ($id != 0) {
            $item = KetquaThuchienCongkhai::find($id);
        }

        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        $check = $this->ValidateKetQuaThucHienCongKhai($request);
        if ($check != null) {
            return $check;
        }

        try {
            $item->ten_xaphuong = $request->tenxaphuong;
            $item->noidung_congkhai = $request->noidungcongkhai;
            $item->coquan_congkhai = $request->coquanthuchiencongkhai;
            $item->hinhthuc_congkhai = $request->hinhthuccongkhai;
            $item->sokehoach_congkhai = $request->sokehoachcongkhai;
            $item->kyhieukehoach_congkhai = $request->kyhieukehoachcongkhai;
            $item->ngay_vanban = $request->ngayvanban ? Carbon::createFromFormat('d/m/Y', $request->ngayvanban) : null;
            $item->ghi_chu = $request->ghichu;
            $item->coquan_banhanh = $request->coquanbanhanh;
            $item->filecongkhai_path = $request->filecongkhai;
            $item->created_by = \auth()->user()->id;
            $item->donvi_id = \auth()->user()->donvi_id;

            $item->quarter = $request->quarter;
            $item->year = $request->year;

            $item->save();

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
}
