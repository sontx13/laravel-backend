<?php

namespace App\Http\Controllers\Voyager;

use App\Enums\TrangThaiThongBaoEnum;
use App\Helpers\FireBaseHelper;
use App\Models\TiepNhanPakn;
use App\Models\User;
use App\Models\UserDeviceToken;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Role;
use Carbon\Carbon;

class QuanTriPAKNController extends VoyagerBaseController
{
    // View index quản trị thông báo
    public function Index(Request $request)
    {
        $view = 'voyager::quantri-PAKN.index';

        $lsPAKN = TiepNhanPakn::get();
        return Voyager::view($view, compact('lsPAKN'));
    }

    public function PartialViewDsPAKN(Request $request)
    {
        $pageSize = $request->pagesize ?? 10;
        $pageNumber = $request->pagenumber ?? 1;
        $ttXyLy = $request->ttxuly ?? -1;
        $ttCongKhai = $request->ttcongkhai ?? -1;

        $keyword = $request->keyword;

        $countPAKN = $this->CountDsPAKN($ttXyLy, $ttCongKhai, $keyword);
        $lsPAKN = $this->GetDsPAKN($pageSize, $pageNumber, $ttXyLy, $ttCongKhai, $keyword);
        $view = 'voyager::quantri-PAKN.partials.danh-sach';
        return Voyager::view($view, compact('lsPAKN', 'countPAKN', 'pageNumber'));
    }

    private function GetDsPAKN($pageSize, $pageNumber, $ttXyLy, $ttCongKhai, $keyword)
    {
        $query =
            "SELECT
                id,
                ten,
                dia_chi,
                so_dien_thoai,
                email,
                tieu_de,
                noi_dung,
                url_tai_lieu,
                DATE_FORMAT(created_at,'%H:%i %d/%m/%Y ') AS ngay_tao,
                updated_at,
                deleted_at,
                tra_loi,
                `status`,
                is_public
            FROM tiep_nhan_pakn
            WHERE
                (? = -1 OR status = ?) AND
                (? = -1 OR is_public = ?)
                AND (tieu_de LIKE ? OR dia_chi LIKE ?)
            ORDER BY
                created_at DESC,
                FIELD(status, 1, 0, 2),
                FIELD(is_public, 1, 0)
            LIMIT ?,?";
        if (empty($keyword)) {
            $query = str_replace("AND (tieu_de LIKE ? OR dia_chi LIKE ?)", "", $query);
            return DB::select($query, [$ttXyLy, $ttXyLy, $ttCongKhai, $ttCongKhai, ($pageNumber - 1) * $pageSize, $pageSize]);
        } else {
            $keyword = '%' . $keyword . '%';
            return DB::select($query, [$ttXyLy, $ttXyLy, $ttCongKhai, $ttCongKhai, $keyword, $keyword, ($pageNumber - 1) * $pageSize, $pageSize]);
        }
    }

    private function CountDsPAKN($ttXyLy, $ttCongKhai)
    {
        $query =
            "SELECT
                count(*) as count
            FROM tiep_nhan_pakn
            WHERE
                ($ttXyLy = -1 OR status = ?) AND
                ($ttCongKhai = -1 OR is_public = ?)";
        return DB::selectOne($query, [$ttXyLy, $ttCongKhai]);
    }

    public function ShowModalSuaPAKN(Request $request)
    {
        $id = $request->id;
        $item = TiepNhanPakn::find($id);
        $view = 'voyager::quantri-PAKN.partials.modal-sua';
        return Voyager::view($view, compact('item'));
    }

    public function CapNhatPAKN(Request $request)
    {
        $id = $request->id;
        $traloi = $request->traloi;
        $ttxuly = $request->ttxuly;
        $ttcongkhai = $request->ttcongkhai;


        $ten = $request->ten;
        $so_dien_thoai = $request->so_dien_thoai;
        $ngay_gui = Carbon::createFromFormat('d/m/Y', $request->ngay_gui);
        $noidung = $request->noidung;


        $item = TiepNhanPakn::find($id);
        if ($item == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Bản ghi không tồn tại'
            ], 200);
        }
        DB::beginTransaction();
        try {
            DB::table('tiep_nhan_pakn')
                ->where('id', $id)
                ->update([
                    'tra_loi' => $traloi,
                    'status' => $ttxuly,
                    'is_public' => $ttcongkhai,
                    'updated_at' => date("Y-m-d H:i:s"),
                    'ten' => $ten,
                    'so_dien_thoai' => $so_dien_thoai,
                    'noi_dung' => $noidung,
                    'created_at' => $ngay_gui
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
}
