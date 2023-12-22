<?php

namespace App\Http\Controllers\Voyager;

use App\Models\ChinhQuyenThanThien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DonVi;
use Carbon\Carbon;
use App\Models\Posts;

class ChinhQuyenThanThienController extends VoyagerBaseController
{
    public function index(Request $request)
    {
        if (!\auth()->user()->hasPermission('browse_chinhquyen-thanthien')) {
            abort(403);
        }

        $view = 'voyager::chinhquyen-thanthien.index';

        return Voyager::view($view);
    }

    public function baoCaoHuyen(Request $request)
    {
        if (!\auth()->user()->hasPermission('browse_chinhquyen-thanthien')) {
            abort(403);
        }

        $year = Carbon::now()->year;
        if ($request->has('year')) {
            $year = $request->year;
        }

        $donVi = DonVi::find(\auth()->user()->donvi_id);
        $donViId = $donVi->id;
        if ($request->has('donvi_id')) {
            $donViId = $request->donvi_id;
        }

        if ($donVi->cap_donvi == 3) {
            $donViId = $donVi->id_donvi_cha;
        }

        if ($request->has('donvi_id')) {
            $donViId = $request->donvi_id;
        }

        $query = "SELECT
                    @rownum := @rownum + 1 AS stt,
                    dv.id,
                    dv.ten_donvi,
                    CASE
                        WHEN a.sl IS NOT NULL THEN
                            CONCAT(a.sl,'/', '5')
                        ELSE
                            CONCAT('0/5')
                    END
                    as hoso_denghi,
                    CASE
                        WHEN b.sl IS NOT NULL THEN
                            CONCAT(b.sl,'/', '5')
                        ELSE
                            CONCAT('0/5')
                    END
                    as tailieu_minhchung,
                    100 as diem_chuan,
                    c.diem_tucham,
                    'Xã nhập liệu' as trang_thai
                    FROM (SELECT @rownum := 0) r, don_vi dv
                    LEFT JOIN (SELECT donvi_id, COUNT(donvi_id) SL FROM chinhquyenthanthien WHERE nam = ? AND chitieu_id IN(11,12,13,14,15) AND tl_minhchung IS NOT NULL GROUP BY donvi_id) a ON dv.id = a.donvi_id
                    LEFT JOIN (SELECT donvi_id, COUNT(donvi_id) SL FROM chinhquyenthanthien WHERE nam = ? AND chitieu_id IN(21,22,23,24,25) AND tl_minhchung IS NOT NULL GROUP BY donvi_id) b ON dv.id = b.donvi_id
                    LEFT JOIN (SELECT donvi_id, SUM(diem_tucham) diem_tucham FROM chinhquyenthanthien WHERE nam = ? AND chitieu_id IN(21,22,23,24,25) GROUP BY donvi_id) c ON dv.id = c.donvi_id
                    WHERE dv.id_donvi_cha = ?
                    ORDER BY dv.ten_donvi";
        $data = DB::select($query, [$year, $year, $year, $donViId]);

        $lsYears = [];
        for ($i = $year - 5; $i <= $year + 5; $i++) {
            $lsYears[] = $i;
        }
        $view = 'voyager::chinhquyen-thanthien.baocaohuyen';

        return Voyager::view($view, compact([
            'year',
            'lsYears',
            'data'
        ]));
    }

    public function baoCaoTinh(Request $request)
    {
        if (!\auth()->user()->hasPermission('browse_chinhquyen-thanthien')) {
            abort(403);
        }

        $year = Carbon::now()->year;
        if ($request->has('year')) {
            $year = $request->year;
        }

        $query = "select
                    @rownum := @rownum + 1 AS stt,
                    dv.id,
                    dv.ten_donvi,
                    IFNULL(k.sohoso, 0) sohoso
                    from (SELECT @rownum := 0) r, don_vi dv
                    LEFT JOIN (
                            SELECT
                                h.id_donvi_cha, SUM(sohoso) as sohoso
                            FROM(
                            SELECT
                            dv.id,
                            dv.id_donvi_cha,
                            dv.ten_donvi,
                            CASE
                                WHEN a.sl IS NULL AND b.sl IS NULL THEN 0
                                ELSE 1
                            END as sohoso,
                            100 as diem_chuan,
                            c.diem_tucham,
                            'Xã nhập liệu' as trang_thai
                            FROM don_vi dv
                            LEFT JOIN (SELECT donvi_id, COUNT(donvi_id) SL FROM chinhquyenthanthien WHERE nam = ? AND chitieu_id IN(11,12,13,14,15) AND tl_minhchung IS NOT NULL GROUP BY donvi_id) a ON dv.id = a.donvi_id
                            LEFT JOIN (SELECT donvi_id, COUNT(donvi_id) SL FROM chinhquyenthanthien WHERE nam = ? AND chitieu_id IN(21,22,23,24,25) AND tl_minhchung IS NOT NULL GROUP BY donvi_id) b ON dv.id = b.donvi_id
                            LEFT JOIN (SELECT donvi_id, SUM(diem_tucham) diem_tucham FROM chinhquyenthanthien WHERE nam = ? AND chitieu_id IN(21,22,23,24,25) GROUP BY donvi_id) c ON dv.id = c.donvi_id
                            ) h GROUP BY h.id_donvi_cha
                    ) k on dv.id = k.id_donvi_cha
                    WHERE dv.cap_donvi = 2
                    ORDER BY dv.id";
        $data = DB::select($query, [$year, $year, $year]);

        $lsYears = [];
        for ($i = $year - 5; $i <= $year + 5; $i++) {
            $lsYears[] = $i;
        }
        $view = 'voyager::chinhquyen-thanthien.baocaotinh';

        return Voyager::view($view, compact([
            'year',
            'lsYears',
            'data'
        ]));
    }

    public function nhaplieu(Request $request)
    {
        $isEdit = true;
        $currentUser = Auth::user();
        $donvi_id = $currentUser->donvi_id;
        if ($request->has('donvi_id')) {
            $donvi_id = $request->donvi_id;
        }
        if (!$currentUser->hasPermission('browse_chinhquyen-thanthien')) {
            abort(403);
        }

        if (!$currentUser->hasPermission('nhaplieu_chinhquyen-thanthien')) {
            $isEdit = false;
        }

        if ($currentUser->donvi_id != $donvi_id) {
            $isEdit = false;
        }
        $tendonvi = parent::GetTenDonViHienThiNhapLieuBaoCao($donvi_id);

        $year = Carbon::now()->year;
        if ($request->has('year')) {
            $year = $request->year;
        }
        $lsYears = [];
        for ($i = $year - 5; $i <= $year + 5; $i++) {
            $lsYears[] = $i;
        }

        $view = 'voyager::chinhquyen-thanthien.nhaplieu';
        return Voyager::view($view, compact([
            'year',
            'tendonvi',
            'lsYears',
            'isEdit'
        ]));
    }

    public function uploadFileDinhKem(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error_code' => '1',
                'message' => 'Chỉ chấp nhận file .pdf'
            ]);
        }
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $year = $request->input('year');
            $type = $request->input('type');
            $chiTieuId = $request->input('chitieu_id');
            $donViId = \auth()->user()->donvi_id;

            $vbFilePathAb = '/chinhquyenthanthien/';
            $vbFilePath = public_path() . $vbFilePathAb;
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move($vbFilePath, $name);
            $path = $vbFilePathAb . $name;

            $record = ChinhQuyenThanThien::where('donvi_id', $donViId)
                ->where('chitieu_id', $chiTieuId)
                ->where('nam', $year)
                ->first();

            if ($record) {
                if ($type == 1) {
                    $record->tl_minhchung = $path;
                }
                if ($type == 2) {
                    $record->tl_mucluc = $path;
                }
                $record->save();
            } else {
                $record = new ChinhQuyenThanThien();
                $record->donvi_id = $donViId;
                $record->chitieu_id = $chiTieuId;
                $record->nam = $year;
                if ($type == 1) {
                    $record->tl_minhchung = $path;
                }
                if ($type == 2) {
                    $record->tl_mucluc = $path;
                }
                $record->save();
            }

            return response()->json([
                'error_code' => '0',
                'message' => 'Thành công',
                'path' => $path,
                'filename' => $name
            ]);
        }

        return response()->json([
            'error_code' => '1',
            'message' => 'Danh sách file trống'
        ]);

    }

    public function xoaFileDinhKem(Request $request)
    {
        $year = $request->input('year');
        $type = $request->input('type');
        $chiTieuId = $request->input('chitieu_id');
        $donViId = \auth()->user()->donvi_id;

        $record = ChinhQuyenThanThien::where('donvi_id', $donViId)
            ->where('chitieu_id', $chiTieuId)
            ->where('nam', $year)
            ->first();

        if ($record) {
            if ($type == 1) {
                $record->tl_minhchung = null;
            }
            if ($type == 2) {
                $record->tl_mucluc = null;
            }
            $record->save();
        }

        return response()->json([
            'error_code' => '0',
            'message' => 'Thành công'
        ]);

    }

    public function saveDiemMulti(Request $request)
    {
        $jsonData = $request->input('data');
        $data = json_decode($jsonData, true);

        $error_code = '0';
        $message = 'Thành công';

        foreach ($data as $object) {
            $year = $object['year'];
            $diem = $object['diem'];
            $chiTieuId = $object['chitieu_id'];
            $donViId = \auth()->user()->donvi_id;

            if ($diem != ''){
                switch ($chiTieuId) {
                    case 21:
                        if ($diem < 0 || $diem > 20) {
                            $error_code = '1';
                            $message = 'Điểm tự chấm mục số 1 không đúng';
                        }
                        break;
                    case 22:
                        if ($diem < 0 || $diem > 25) {
                            $error_code = '1';
                            $message = 'Điểm tự chấm mục số 2 không đúng';
                        }
                        break;
                    case 23:
                        if ($diem < 0 || $diem > 20) {
                            $error_code = '1';
                            $message = 'Điểm tự chấm mục số 3 không đúng';
                        }
                        break;
                    case 24:
                        if ($diem < 0 || $diem > 15) {
                            $error_code = '1';
                            $message = 'Điểm tự chấm mục số 4 không đúng';
                        }
                        break;
                    case 25:
                        if ($diem < 0 || $diem > 20) {
                            $error_code = '1';
                            $message = 'Điểm tự chấm mục số 5 không đúng';
                        }
                        break;
                    default:
                        break;
                }

                if ($error_code !== '0') {
                    return response()->json([
                        'error_code' => $error_code,
                        'message' => $message,
                    ]);
                }
                $record = ChinhQuyenThanThien::where('donvi_id', $donViId)
                    ->where('chitieu_id', $chiTieuId)
                    ->where('nam', $year)
                    ->first();

                if ($record) {
                    $record->diem_tucham = $diem;
                    $record->save();
                } else {
                    $record = new ChinhQuyenThanThien();
                    $record->donvi_id = $donViId;
                    $record->chitieu_id = $chiTieuId;
                    $record->nam = $year;
                    $record->diem_tucham = $diem;
                    $record->save();
                }
            }
        }

        return response()->json([
            'error_code' => $error_code,
            'message' => $message,
        ]);

    }

    public function loadViewData(Request $request)
    {
        $year = $request->input('year');

        $currentUser = Auth::user();
        $donvi_id = $currentUser->donvi_id;
        if ($request->has('donvi_id') && $request->input('donvi_id') != 'null') {
            $donvi_id = $request->input('donvi_id');
        }

        $records = ChinhQuyenThanThien::where('donvi_id', $donvi_id)
            ->where('nam', $year)
            ->get();
        return response()->json([
            'error_code' => '0',
            'message' => 'Thành công',
            'lsData' => $records
        ]);

    }

    protected function guard()
    {
        return Auth::guard(app('VoyagerGuard'));
    }
}
