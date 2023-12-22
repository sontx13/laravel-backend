<?php

namespace App\Http\Controllers;

use App\Enums\TrangThaiKhaoSatEnum;
use App\Models\KhaoSat;
use App\Models\UserDeviceToken;
use http\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KhaoSatApiController extends Controller
{
    public $successStatus = Response::HTTP_OK;

    public function GetDsKhaoSats(Request $request)
    {
        $trangthai = $request->trangthai;
        $currentUser = Auth::user();
        $lsKhaoSats = $this->DsKhaoSats($currentUser->username, $trangthai);
        return response()->json([
            'error_code' => 0,
            'message' => 'Thành công',
            'data' => $lsKhaoSats,
        ], Response::HTTP_OK);
    }

    public function DsKhaoSats($sodienthoai, $trangthaithuchien) {
        $query =
        "SELECT
            a.id,
            a.ten_khaosat,
            a.ngay_batdau,
            a.ngay_ketthuc,
            CASE
                WHEN a.da_thuchien = 0 THEN a.url
                ELSE a.url_xemlai
            END AS url,
            a.da_thuchien,
            a.trang_thai
        FROM
            (SELECT
                DISTINCT
                ks.id,
                ks.ten_khaosat,
                ks.ngay_batdau,
                ks.ngay_ketthuc,
                ks.url,
                ks.url_xemlai,
                ks.trang_thai,
                CASE
                    WHEN kq.id IS NOT NULL THEN 1
                    WHEN kq.id IS NULL AND ks.trang_thai = 1
						AND (ks.ngay_batdau IS NULL OR ks.ngay_batdau <= ?)
						AND (ks.ngay_ketthuc IS NULL OR ks.ngay_ketthuc >= ?) THEN 0
					ELSE 2
                END AS da_thuchien
            FROM app_qcdc.khao_sat ks
            LEFT JOIN app_qcdc.khaosat_ketqua kq
                ON ks.id = kq.khaosat_id AND kq.so_dien_thoai = ?) a
        WHERE
            (? = -1 OR a.da_thuchien = ?)
            AND a.da_thuchien != 2;
        ";
        return DB::select($query, [date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $sodienthoai, $trangthaithuchien, $trangthaithuchien]);
    }
}
