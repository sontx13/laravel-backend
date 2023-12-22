<?php

namespace App\Http\Controllers;

use App\Enums\TrangThaiDocThongBaoEnum;
use App\Models\LichsuThongbao;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ThongBaoApiController extends Controller
{
    public $successStatus = Response::HTTP_OK;

    public function GetDsThongBaos(Request $request)
    {
        $currentUser = Auth::user();
        $pagenumber = $request->pagenumber;
        $pagesize = $request->pagesize;
        $trangthai = $request->trangthai;
        $lsThongBaos = $this->DsThongBaos($currentUser->id, $trangthai ?? -1, $pagenumber ?? 1, $pagesize ?? 10);
        return response()->json([
            'error_code' => 0,
            'message' => 'Thành công',
            'data' => $lsThongBaos,
        ], Response::HTTP_OK);
    }

    public function CapNhatDocThongBao(Request $request) {
        $id = $request->id;
        $lichsuThongBao = LichsuThongbao::find($id);
        if ($lichsuThongBao == null) {
            return response()->json([
                'error_code' => 1,
                'message' => 'Không tồn tại bản ghi',
            ], Response::HTTP_OK);
        } else {
            DB::beginTransaction();
            try {
                DB::table('lichsu_thongbao')
                ->where('id', $id)
                ->update([
                    'trang_thai' => TrangThaiDocThongBaoEnum::DaDoc,
                    'viewed_at' => date("Y-m-d H:i:s")
                ]);
                DB::commit();
                return response()->json([
                    'error_code' => 0,
                    'message' =>  'Thành công',
                ], Response::HTTP_OK);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'error_code' => 1,
                    'message' => $e->getMessage(),
                ], Response::HTTP_OK);
            }
        }
    }

    public function DsThongBaos($userid, $trangthai, $pagenumber, $pagesize) {
        $query =
        "SELECT
            ls.id,
            tb.tieu_de,
            tb.noi_dung,
            tb.du_lieu,
            tb.ngay_gui,
            ls.trang_thai
        FROM app_qcdc.lichsu_thongbao ls
        INNER JOIN app_qcdc.thong_bao tb
            ON ls.thongbao_id = tb.id
        WHERE
            ls.user_id = ?
            AND (? = -1 OR ls.trang_thai = ?)
            ORDER BY ls.created_at DESC
        LIMIT ?, ?;
            ";
        return DB::select($query, [$userid, $trangthai, $trangthai, ($pagenumber - 1) * $pagesize, $pagesize]);
    }
}
