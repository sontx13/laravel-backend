<?php

namespace App\Http\Controllers\Voyager;

use App\Constant\ApiConstant;
use App\Enums\LoaiNguoiDungEnum;
use App\Enums\TrangThaiCongKhaiPAKNEnum;
use App\Enums\TrangThaiXuLyPAKNEnum;
use App\Helpers\KhaoSatUtils;
use App\Helpers\SmsUtils;
use App\Models\KhaosatKetqua;
use App\Models\DonVi;
use App\Models\TiepNhanPakn;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DmPhuongxa;
use App\Models\DmHuyen;
use App\Models\DmTinh;
use App\Models\KhaoSat;

class KhaoSatController extends VoyagerBaseController
{
    // View index phản ánh kiến nghị
    public function Index(Request $request)
    {
        $hoten = $request->header('hoten');
        $sodienthoai = $request->header('sodienthoai');

        $message = '';
        $lsTinhs = DmTinh::where('id_quocgia', 239)
            ->get();
        $view = 'voyager::khao-sat.pakn-index';

        return Voyager::view($view, compact([
                'lsTinhs',
                'message',
                'hoten',
                'sodienthoai'
            ]
        ));
    }

    public function paknList(Request $request)
    {
        $results = TiepNhanPakn::where('is_public', TrangThaiCongKhaiPAKNEnum::CongKhai)
            // ->where('status', TrangThaiXuLyPAKNEnum::DaXuLy)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $view = 'voyager::khao-sat.pakn-browser';
        return Voyager::view($view,
            compact(
                'results'
            )
        );
    }

    public function paknDetails($id)
    {
        $item = TiepNhanPakn::find($id);
        $view = 'voyager::khao-sat.pakn-chitiet';
        return Voyager::view($view,
            compact(
                'item'
            )
        );
    }

    public function TiepNhan(Request $request)
    {
        $lsTinhs = DmTinh::where('id_quocgia', 239)
            ->get();
        $message = '';

        if ($request->isMethod('post')) {
            $dHoTen = $request->ho_ten;
            $dTinh = $request->matinh;
            $dHuyen = $request->mahuyen;
            $dPhuongXa = $request->maxa;
            $dSoDienThoai = $request->sodienthoai;
            $dEmail = $request->email;
            $dPAKNVeViec = $request->pakn_ve_viec;
            $dNoiDung = $request->noi_dung;
            $data = [
                $dHoTen,
                $dTinh,
                $dHuyen,
                $dPhuongXa,
                $dSoDienThoai,
                $dEmail,
                $dPAKNVeViec,
                $dNoiDung
            ];

            $diachi = $request->dia_chi;
            $paknId = DB::table('tiep_nhan_pakn')->insertGetId([
                'ten' => $dHoTen,
                'dia_chi' => $diachi,
                'ma_tinh' => $dTinh,
                'ma_huyen' => $dHuyen,
                'ma_xa' => $dPhuongXa,
                'so_dien_thoai' => $dSoDienThoai,
                'email' => $dEmail,
                'tieu_de' => $dPAKNVeViec,
                'noi_dung' => $dNoiDung,
                'status' => TrangThaiXuLyPAKNEnum::ChuaXuLy,
                'is_public' => TrangThaiCongKhaiPAKNEnum::KhongCongKhai,
                'created_at' => Carbon::now()
            ]);

            // Lưu file
            $files = $request->file('fileDinhKem');
            if ($request->hasFile('fileDinhKem')) {
                $vbFilePathAb = '/paknfile/';
                $vbFilePath = public_path() . $vbFilePathAb;

                foreach ($files as $file) {

                    $name = Str::uuid() . '.' . $file->getClientOriginalExtension();
                    $file->move($vbFilePath, $name);
                    $filepath = $vbFilePathAb . $name;
                    DB::table('pakn_file')->insert([
                        'id_pakn' => $paknId,
                        'file_name' => $file->getClientOriginalName(),
                        'file_type' => $file->getClientOriginalExtension(),
                        'file_path' => $filepath
                    ]);

                }
            }

            $message = 'Tiếp nhận thành công phản ánh kiến nghị!';

        }
        $view = 'voyager::khao-sat.pakn-index';
        return Voyager::view($view, compact('lsTinhs', 'message'));
    }

    // View index thực hiện khảo sát
    public function Index_KhaoSat(Request $request)
    {
        $hoten = $request->header('hoten');
        $sodienthoai = $request->header('sodienthoai');
        $lsDonVis = DonVi::where('id_donvi_cha',1)->orderBy('ten_donvi','asc')->get();
        $donvi = $request->donvi;
        $donvi_obj = $donvi != null ? DonVi::where('id',$donvi)->get() : null;
        $view = 'voyager::khao-sat.index';
        $currentUser = Auth::user();
        $sdt = $currentUser != null ? $currentUser->username : null;
        return Voyager::view($view, compact('lsDonVis', 'donvi', 'sdt', 'donvi_obj'));
    }

    public function GetDonvi(Request $request)
    {
        $idHuyen = $request->idHuyen;

        $lsDonVis = DonVi::where('id_donvi_cha',$idHuyen)->orderBy('ten_donvi','asc')->get();

        return response()->json([
            'error_code' => 0,
            'message' => 'Thành công',
            'data' => $lsDonVis,
        ], Response::HTTP_OK);
    }

    public function GuiKhaoSat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'sodienthoai' => 'required|regex:/[0-9]{10}/|digits:10',
            // 'maxacnhan' => auth()->check() ? '' : 'required|string',
            'donvi' => 'required',
            'cauhois' => 'present|array',
            'cauhois.*.cauhoi' => 'required|string'
        ], [
            // 'sodienthoai.required' => 'Vui lòng nhập số điện thoại',
            // 'sodienthoai.regex' => 'Số điện thoại không đúng',
            // 'sodienthoai.digits' => 'Số điện thoại không đúng',
            // 'maxacnhan.required' => 'Vui lòng nhập mã xác nhận',
            // 'maxacnhan.regex' => 'Mã xác nhận không đúng',
            'donvi.required' => 'Vui lòng chọn đơn vị',
            'cauhois.*.cauhoi.required' => 'Câu hỏi không được trống'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'error_code' => 1
            ]);
        }

        // $isValidOtp = KhaoSatUtils::checkValidOTP($request->sodienthoai, $request->maxacnhan);

        // if (auth()->check()) {
        //     $isValidOtp = true;
        // }

        // if (!$isValidOtp) {
        //     return response()->json([
        //         'message' => 'Mã xác nhận không hợp lệ!',
        //         'error_code' => 4
        //     ]);
        // }

        $uuid = Str::uuid();
        $cauhoiIx = 0;

        foreach ($request->cauhois as $cauhoi) {
            $cauhoiIx++;

            $khaosat = new KhaosatKetqua();
            $khaosat->khaosat_id = 1;
            $khaosat->so_dien_thoai = $request->so_dien_thoai;
            $khaosat->email = $request->email;
            $khaosat->uuid = $uuid;

            if (auth()->check()) {
                $khaosat->user_id = auth()->user()->id;
            }

            $khaosat->cau_hoi = $cauhoi['cauhoi'];
            $khaosat->cau_tra_loi = $cauhoi['traloi'];
            $khaosat->thu_tu = $cauhoiIx;
            $khaosat->donvi_id = $request->donvi;
            $khaosat->save();
        }

        return response()->json([
            'message' => 'Gửi khảo sát thành công!',
            'error_code' => 0
        ]);
    }

    public function GuiOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sodienthoai' => 'required|regex:/[0-9]{10}/|digits:10',
        ], [
            'sodienthoai.required' => 'Vui lòng nhập số điện thoại',
            'sodienthoai.regex' => 'Số điện thoại không đúng',
            'sodienthoai.digits' => 'Số điện thoại không đúng'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'error_code' => 1
            ]);
        }

        if (KhaoSatUtils::checkOTPRecently($request->sodienthoai)) {
            SmsUtils::sendSMSOTP($request->sodienthoai, $request->header('x-real-ip'));
        } else {
            return response()->json([
                'message' => 'Thao tác quá nhanh. Vui lòng thử lại sau 30s',
                'error_code' => 2
            ]);
        }

        return response()->json([
            'message' => 'Đã gửi OTP thành công',
            'error_code' => 0
        ]);
    }

    public function CheckOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sodienthoai' => 'required|regex:/[0-9]{10}/|digits:10',
            'maxacnhan' => 'required|string',
        ], [
            'sodienthoai.required' => 'Vui lòng nhập số điện thoại',
            'sodienthoai.regex' => 'Số điện thoại không đúng',
            'sodienthoai.digits' => 'Số điện thoại không đúng',
            'maxacnhan.required' => 'Vui lòng nhập mã xác nhận',
            'maxacnhan.regex' => 'Mã xác nhận không đúng',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'message' => $validator->errors()->all(),
                'error_code' => 1
            ]);
        }

        $isValidOtp = KhaoSatUtils::checkValidOTP($request->sodienthoai, $request->maxacnhan);

        if (!$isValidOtp) {
            return response()->json([
                'message' => 'Mã xác nhận không hợp lệ!',
                'error_code' => 1
            ]);
        } else {
            return response()->json([
                'message' => 'Mã xác hợp lệ!',
                'error_code' => 0
            ]);
        }
    }

    public function XemKhaoSat(Request $request)
    {
        $lsKhaoSat = KhaosatKetqua::get();

        $view = 'voyager::xem-khao-sat-webview.index';
        return Voyager::view($view, compact('lsKhaoSat'));
    }

    public function PartialViewDsKhaoSat(Request $request)
    {
        $lsKhaoSats = KhaoSat::get();
        $view = 'voyager::xem-khao-sat-webview.partials.danh-sach';
        return Voyager::view($view, compact('lsKhaoSats'));
    }

    public function DetailSurvey(Request $request)
    {
        $khaosatid = $request->khaosatid;
        $khaosat = KhaoSat::find($khaosatid);
        $currentUser = Auth::user();
        $lsDonVis = [];
        if ($currentUser->is_admin) {
            $lsDonVis = DonVi::get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $lsDonVis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $lsDonViSoLuots = $this->GetSoLuotKsByDonVis($khaosatid);
        $view = 'voyager::xem-khao-sat-webview.partials.detail';
        return Voyager::view($view, compact('lsDonVis', 'khaosat', 'lsDonViSoLuots'));
    }

    public function FilterCauHoi(Request $request)
    {
        $khaosatid = $request->khaosatid;
        $cauhoi = $request->cauhoi;
        $donvi = $request->donvi;
        $linhvuc = $request->linhvuc;

        $ketqua = $this->GetSoLieuTheoCauHoi($cauhoi, $donvi, $linhvuc, $khaosatid);
        return response()->json([
            'error_code' => 0,
            'message' => 'Lưu thành công',
            'data' => $ketqua
        ], 200);
    }

    public function FilterLinhVuc(Request $request)
    {
        $cauhoi = $request->cauhoi;
        $donvi = $request->donvi;
        $linhvuc = $request->linhvuc;
        $khaosatid = $request->khaosatid;
        $ketqua2 = $this->GetSoLieuTheoLinhVuc($cauhoi, $donvi, $linhvuc, $khaosatid);
        return response()->json([
            'error_code' => 0,
            'message' => 'Lưu thành công',
            'data' => $ketqua2
        ], 200);
    }

    private function GetSoLuotKsByDonVis($khaosatid)
    {
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $query =
                "SELECT
                *
            FROM
            (SELECT
                donvi_id,
                count( distinct uuid) as soluotks
                FROM app_qcdc.khaosat_ketqua
                WHERE khaosat_id = ?
                group by donvi_id) a
            LEFT JOIN app_qcdc.don_vi dv
                ON a.donvi_id = dv.id";
            return DB::select($query, [$khaosatid]);
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donviStr = implode(',', $donviIdAlls);
            $query =
                "SELECT
                *
            FROM
            (SELECT
                donvi_id,
                count( distinct uuid) as soluotks
                FROM app_qcdc.khaosat_ketqua
                WHERE khaosat_id = ?
                group by donvi_id) a
            LEFT JOIN app_qcdc.don_vi dv
                ON a.donvi_id = dv.id
            WHERE
                a.donvi_id IN (" . $donviStr . ")";
            return DB::select($query, [$khaosatid]);
        }

    }

    public function GetSoLieuTheoCauHoi($cauhoi, $donvi, $linhvuc, $khaosatid)
    {
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $query =
                "SELECT
                    cau_tra_loi,
                    count(cau_tra_loi) AS so_luot
                FROM app_qcdc.khaosat_ketqua where khaosat_id = ? and cau_hoi = ?
                AND uuid IN (
                    SELECT uuid FROM app_qcdc.khaosat_ketqua where khaosat_id = ? and (? = -1 OR cau_tra_loi = ?) and (? = -1 OR donvi_id = ?)
                )
                group by cau_tra_loi;
                ";
            return DB::select($query, [$khaosatid, $cauhoi, $khaosatid, $linhvuc, $linhvuc, $donvi, $donvi]);
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donviStr = implode(',', $donviIdAlls);
            $query =
                "SELECT
                cau_tra_loi,
                count(cau_tra_loi) AS so_luot
            FROM app_qcdc.khaosat_ketqua where khaosat_id = ? and cau_hoi = ?
            AND uuid IN (
                SELECT uuid FROM app_qcdc.khaosat_ketqua where khaosat_id = ? and (? = -1 OR cau_tra_loi = ?) and ((? = -1 AND donvi_id IN (" . $donviStr . ")) OR donvi_id = ?)
            )
            group by cau_tra_loi;
            ";
            return DB::select($query, [$khaosatid, $cauhoi, $khaosatid, $linhvuc, $linhvuc, $donvi, $donvi]);
        }
    }

    public function GetSoLieuTheoLinhVuc($cauhoi, $donvi, $linhvuc, $khaosatid)
    {
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $query =
                "SELECT
                    cau_tra_loi, linhvuc,
                    count(cau_tra_loi) as tong
                from
                (SELECT
                        filteruuid.cau_tra_loi,
                        khaosat.cau_tra_loi as linhvuc
                    from
                    (SELECT
                            *
                        FROM app_qcdc.khaosat_ketqua
                        where
                            khaosat_id = ?
                            and cau_hoi = ?
                            AND uuid IN (SELECT uuid FROM app_qcdc.khaosat_ketqua where khaosat_id = ? and (? = -1 OR donvi_id = ?))
                        ) filteruuid
                    inner join app_qcdc.khaosat_ketqua as khaosat
                        on filteruuid.uuid = khaosat.uuid
                    where
                        (khaosat.cau_hoi = ? or khaosat.cau_hoi = '1.3 Lĩnh vực giải quyết')
                        and khaosat.cau_hoi != filteruuid.cau_hoi) b
                    where
                    (? = -1 OR b.linhvuc = ?)
                    group by b.linhvuc,
                            b.cau_tra_loi
                            ;";
            return DB::select($query, [$khaosatid, $cauhoi, $khaosatid, $donvi, $donvi, $cauhoi, $linhvuc, $linhvuc]);
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donviStr = implode(',', $donviIdAlls);
            $query =
                "SELECT
                    cau_tra_loi, linhvuc,
                    count(cau_tra_loi) as tong
                from
                (SELECT
                        filteruuid.cau_tra_loi,
                        khaosat.cau_tra_loi as linhvuc
                    from
                    (SELECT
                            *
                        FROM app_qcdc.khaosat_ketqua
                        where
                            khaosat_id = ?
                            and cau_hoi = ?
                            AND uuid IN (SELECT uuid FROM app_qcdc.khaosat_ketqua where khaosat_id = ? and ((? = -1 AND donvi_id IN (" . $donviStr . ")) OR donvi_id = ?))
                        ) filteruuid
                    inner join app_qcdc.khaosat_ketqua as khaosat
                        on filteruuid.uuid = khaosat.uuid
                    where
                        (khaosat.cau_hoi = ? or khaosat.cau_hoi = '1.3 Lĩnh vực giải quyết')
                        and khaosat.cau_hoi != filteruuid.cau_hoi) b
                    where
                    (? = -1 OR b.linhvuc = ?)
                    group by b.linhvuc,
                            b.cau_tra_loi
                            ;";
            return DB::select($query, [$khaosatid, $cauhoi, $khaosatid, $donvi, $donvi, $cauhoi, $linhvuc, $linhvuc]);
        }
    }

    public function XemLaiKhaoSat(Request $request)
    {
        $khaosatid = $request->khaosatid;
        $currentUser = Auth::user();
        $lsKetQuas = $this->KqKhaoSat($currentUser->username, $khaosatid);
        $view = 'voyager::xemlai-khaosat.index';
        return Voyager::view($view, compact('lsKetQuas'));
    }

    public function KqKhaoSat($sodienthoai, $khaosatid)
    {
        $query =
            "SELECT
            kq.id,
            ks.ten_khaosat,
            kq.so_dien_thoai,
            kq.cau_hoi,
            kq.cau_tra_loi,
            kq.created_at,
            kq.uuid,
            kq.donvi_id,
            dv.ten_donvi
        FROM app_qcdc.khaosat_ketqua kq
        INNER JOIN app_qcdc.khao_sat ks
            ON kq.khaosat_id = ks.id
        LEFT JOIN app_qcdc.don_vi dv
            ON kq.donvi_id = dv.id
        WHERE
            khaosat_id = ?
            AND so_dien_thoai = ?
        ORDER BY
            kq.donvi_id,
            kq.uuid,
            kq.thu_tu;
        ";
        return DB::select($query, [$khaosatid, $sodienthoai]);
    }
}
