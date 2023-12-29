<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models;
use App\Models\DonVi;
use App\Models\KhaoSat;

class BaoCaoTongHopKhaoSatController extends VoyagerBaseController
{
    // View index báo cáo tổng hợp khảo sát
    public function Index(Request $request)
    {
        $this->authorize('browse_baocao-tonghop-khaosat');
        $currentUser = Auth::user();
        $donvis = [];
        $dsKhaoSats = KhaoSat::get();
        if ($currentUser->is_admin == 1) {
            $donvis = DonVi::where('cap_donvi', 2)->get();
        }
        else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donvis = DonVi::where('cap_donvi', 2)->get();
            //$donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $view = 'voyager::baocao-tonghop-khaosat.index';
        return Voyager::view($view,compact('donvis', 'dsKhaoSats'));
    }

      // View index báo cáo tổng hợp khảo sát mobile
      public function Baocaokstonghop(Request $request)
      {
          $currentUser = Auth::user();
          if (!Auth::user()->hasPermission('xem_bao_cao_ks')){
            abort(403);
          }
          $donvis = [];
          $dsKhaoSats = KhaoSat::get();
          if ($currentUser->is_admin == 1) {
              $donvis = DonVi::where('cap_donvi', 2)->get();
          }
          else {
              $donviIdAlls = parent::GetDsDonviIds();
              $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
          }
          $view = 'voyager::baocao-tonghop-khaosat.baocao-ks-tonghop-browser';
          return Voyager::view($view,compact('donvis', 'dsKhaoSats'));
      }

        // View index báo cáo chi tiết khảo sát mobile
    public function Baocaokschitiet(Request $request)
    {
        if (!Auth::user()->hasPermission('xem_bao_cao_ks')){
            abort(403);
        }
        $currentUser = Auth::user();
        $donvis = [];
        $dsKhaoSats = KhaoSat::get();
        if ($currentUser->is_admin == 1) {
            $donvis = DonVi::where('cap_donvi', 2)->get();
        }
        else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $view = 'voyager::baocao-tonghop-khaosat.baocao-ks-chitiet-browser';
        return Voyager::view($view,compact('donvis', 'dsKhaoSats'));
    }

    public function GetSoLuotTonghopDataChart(Request $request) {
        $khaosatid = $request->khaosatid;
        $tungayDate = $request->tungayDate;
        $denngayDate = $request->denngayDate;
        $sapxep = $request->sapxep;

        $ketqua = null;

        $ketqua = $this->GetDataSoLuotTonghop($khaosatid,$tungayDate,$denngayDate,$sapxep);

        return response()->json([
            'error_code' => 0,
            'message' => 'Thành công',
            'data' => $ketqua
        ], 200);
    }
    public function GetDataChart(Request $request) {
        $khaosatid = $request->khaosatid;
        $cauhoi = $request->cauhoi;
        $traloi = $request->traloi;
        //$donvi = $request->donvi;
        //$linhvuc = $request->linhvuc;
        $type = $request->type;
        $tungayDate = $request->tungayDate;
        $denngayDate = $request->denngayDate;
        $sapxep = $request->sapxep;

        $ketqua = null;
        // Lấy dữ liệu tổng hợp
        if ($type == 0) {
            $ketqua = $this->GetDataTongHop($cauhoi, $khaosatid,$tungayDate,$denngayDate,$sapxep);
        // Lấy dữ liệu chi tiết
        }

        if ($type == 1) {
            $ketqua = $this->GetDataTraloi($cauhoi, $khaosatid, $traloi,$tungayDate,$denngayDate,$sapxep);
        // Lấy dữ liệu chi tiết
        }
        return response()->json([
            'error_code' => 0,
            'message' => 'Thành công',
            'data' => $ketqua
        ], 200);
    }
    public function GetDataSoLuotKhaoSat(Request $request) {
        $khaosatid = $request->khaosatid;
        $tungayDate = $request->tungayDate;
        $denngayDate = $request->denngayDate;
        $sapxep = $request->sapxep;

        $lsDonViSoLuots = $this->GetSoLuotKsByDonVis($khaosatid,$tungayDate,$denngayDate,$sapxep);
        $view = 'voyager::baocao-tonghop-khaosat.partials.soluot-khaosat';
        return Voyager::view($view,compact('lsDonViSoLuots'));
    }

    public function GetDataSoLuotKhaoSatChitiet(Request $request) {
        $khaosatid = $request->khaosatid;
        $tungayDate = $request->tungayDate;
        $denngayDate = $request->denngayDate;
        $sapxep = $request->sapxep;
        $donvi = $request->donvi;

        $lsDonViSoLuots = $this->GetSoLuotKsByDonVis_chitiet($khaosatid,$tungayDate,$denngayDate,$sapxep,$donvi);
        $view = 'voyager::baocao-tonghop-khaosat.partials.soluot-khaosat-chitiet';
        return Voyager::view($view,compact('lsDonViSoLuots'));
    }

    public function GetDataTraloiKhaoSat(Request $request) {
        $khaosatid = $request->khaosatid;
        $cauhoi = $request->cauhoi;
        $tungayDate = $request->tungayDate;
        $denngayDate = $request->denngayDate;
        $sapxep = $request->sapxep;

        $lsTraloi = $this->GetCautraloi($khaosatid,$cauhoi,$tungayDate,$denngayDate,$sapxep);
        $view = 'voyager::baocao-tonghop-khaosat.partials.traloi-khaosat';
        return Voyager::view($view,compact('lsTraloi'));
    }

    public function GetDataTraloiKhaoSatHuyen(Request $request) {
        $khaosatid = $request->khaosatid;
        $cauhoi = $request->cauhoi;
        $traloi = $request->traloi;
        $tungayDate = $request->tungayDate;
        $denngayDate = $request->denngayDate;
        $sapxep = $request->sapxep;

        $ketqua = $this->GetDataTraloi($cauhoi, $khaosatid, $traloi,$tungayDate,$denngayDate,$sapxep);
        $view = 'voyager::baocao-tonghop-khaosat.partials.traloi-khaosat-huyen';
        return Voyager::view($view,compact('ketqua'));
    }

    public function GetDataTraloiKhaoSatXa(Request $request) {
        $khaosatid = $request->khaosatid;
        $cauhoi = $request->cauhoi;
        $traloi = $request->traloi;
        $donvi = $request->donvi;
        $tungayDate = $request->tungayDate;
        $denngayDate = $request->denngayDate;
        $sapxep = $request->sapxep;

        $ketqua = $this->GetDonvi($khaosatid,$cauhoi,$traloi,$donvi,$tungayDate,$denngayDate,$sapxep);
        $view = 'voyager::baocao-tonghop-khaosat.partials.traloi-khaosat-xa';
        return Voyager::view($view,compact('ketqua'));
    }


    public function GetDataDonvi(Request $request) {
        $khaosatid = $request->khaosatid;
        $cauhoi = $request->cauhoi;
        $traloi = $request->traloi;
        $donvi = $request->donvi;
        $tungayDate = $request->tungayDate;
        $denngayDate = $request->denngayDate;
        $sapxep = $request->sapxep;

        $ketqua = null;

        $ketqua = $this->GetDonvi($khaosatid,$cauhoi,$traloi,$donvi,$tungayDate,$denngayDate,$sapxep);

        return response()->json([
            'error_code' => 0,
            'message' => 'Thành công',
            'data' => $ketqua
        ], 200);
    }

    public function GetDataDropdownTraloi(Request $request) {
        $khaosatid = $request->khaosatid;
        $cauhoi = $request->cauhoi;
        $tungayDate = $request->tungayDate;
        $denngayDate = $request->denngayDate;
        $sapxep = $request->sapxep;

        $ketqua = null;

        $ketqua = $this->GetCautraloi($khaosatid,$cauhoi,$tungayDate,$denngayDate,$sapxep);

        return response()->json([
            'error_code' => 0,
            'message' => 'Thành công',
            'data' => $ketqua
        ], 200);
    }

    private function GetSoLuotKsByDonVis_chitiet($khaosatid,$tungayDate,$denngayDate,$sapxep,$donvi) {
        $currentUser = Auth::user();
        $sapxepStr = " a.luotks";
        if($sapxep == 1){
            $sapxepStr = " a.luotks asc";
        }

        if($sapxep == 2){
            $sapxepStr = " a.luotks desc";
        }

        if($sapxep == 3){
            $sapxepStr = " dv.ten_donvi_ct";
        }

        if($donvi == 0){
            $query =
            " SELECT dv.ten_donvi_ct,IFNULL(a.luotks,0) as soluotks FROM (
                SELECT donvi_id,count( distinct uuid) as luotks
                FROM khaosat_ketqua
                WHERE khaosat_id = ?
                and created_at >= ?
                and created_at <= ?
                group by donvi_id
            ) a
            RIGHT JOIN don_vi dv ON a.donvi_id = dv.id
            ORDER BY ".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate]);

        } else if($donvi == 1){
            $query =
            " SELECT dv.ten_donvi_ct,IFNULL(a.luotks,0) as soluotks FROM (
                SELECT donvi_id,count( distinct uuid) as luotks
                FROM khaosat_ketqua
                WHERE khaosat_id = ?
                and created_at >= ?
                and created_at <= ?
                group by donvi_id
            ) a
            RIGHT JOIN don_vi dv ON a.donvi_id = dv.id
            WHERE cap_donvi = 2
            ORDER BY ".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate]);

        } else{
            $query =
            " SELECT dv.ten_donvi_ct,IFNULL(a.luotks,0) as soluotks FROM (
                SELECT donvi_id,count( distinct uuid) as luotks
                FROM khaosat_ketqua
                WHERE khaosat_id = ?
                and created_at >= ?
                and created_at <= ?
                group by donvi_id
            ) a
            RIGHT JOIN don_vi dv ON a.donvi_id = dv.id
            WHERE id_donvi_cha = ? or id = ?
            ORDER BY ".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate,$donvi,$donvi]);
        }
    }


    private function GetSoLuotKsByDonVis($khaosatid,$tungayDate,$denngayDate,$sapxep) {
        $currentUser = Auth::user();
        $sapxepStr = " d.ten_donvi";
        if($sapxep == 1){
            $sapxepStr = " d.soluotks asc";
        }

        if($sapxep == 2){
            $sapxepStr = " d.soluotks desc";
        }

        if($sapxep == 3){
            $sapxepStr = " d.ten_donvi_ct";
        }

        //dd("sapxep=="+$sapxep);

        //if ($currentUser->is_admin) {
            $query =
            "SELECT * FROM (
                SELECT c.*, IFNULL(SUM(c.luotks),0)  as soluotks FROM
                        (SELECT * FROM (
                                    SELECT donvi_id,count( distinct uuid) as luotks
                                    FROM khaosat_ketqua
                                    WHERE khaosat_id = ?
                                    and created_at >= ?
                                    and created_at <= ?
                                    group by donvi_id
                                ) a
                                RIGHT JOIN don_vi dv ON a.donvi_id = dv.id) c
                GROUP BY c.group_donvi)d
                WHERE d.cap_donvi =2
                ORDER BY ".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate]);
            //return $query;
        //}
        // else {
        //     $donviIdAlls = parent::GetDsDonviIds();
        //     $donviStr = implode(',', $donviIdAlls);
        //     $query =
        //     "SELECT
        //         *
        //     FROM
        //     (SELECT
        //         donvi_id,
        //         count( distinct uuid) as soluotks
        //         FROM khaosat_ketqua
        //         WHERE khaosat_id = ?
        //         group by donvi_id) a
        //     LEFT JOIN don_vi dv
        //         ON a.donvi_id = dv.id
        //     WHERE
        //         a.donvi_id IN (".$donviStr.")";
        //     return DB::select($query, [$khaosatid]);
        // }
    }


    public function GetDataSoLuotTonghop($khaosatid,$tungayDate,$denngayDate,$sapxep) {
        $currentUser = Auth::user();

        $sapxepStr = " d.ten_donvi";
        if($sapxep == 1){
            $sapxepStr = " d.soluotks asc";
        }

        if($sapxep == 2){
            $sapxepStr = " d.soluotks desc";
        }

        if($sapxep == 3){
            $sapxepStr = " d.ten_donvi_ct";
        }

        //if ($currentUser->is_admin) {
            $query =
            "SELECT * FROM (
                SELECT c.*, IFNULL(SUM(c.luotks),0)  as soluotks FROM
                        (SELECT * FROM (
                                    SELECT donvi_id,count( distinct uuid) as luotks
                                    FROM khaosat_ketqua
                                    WHERE khaosat_id = ?
                                    and created_at >= ?
                                    and created_at <= ?
                                    group by donvi_id
                                ) a
                                RIGHT JOIN don_vi dv ON a.donvi_id = dv.id) c
                GROUP BY c.group_donvi)d
                WHERE d.cap_donvi =2
                ORDER BY ".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate]);
        //}
    }

    private function GetDonvi($khaosatid,$cauhoi,$traloi,$donvi,$tungayDate,$denngayDate,$sapxep) {
        $currentUser = Auth::user();

        $sapxepStr = " ORDER BY ten_donvi";
        if($sapxep == 1){
            $sapxepStr = " ORDER BY soluong asc";
        }

        if($sapxep == 2){
            $sapxepStr = " ORDER BY soluong desc";
        }

        if($sapxep == 3){
            $sapxepStr = "ORDER BY c.ten_donvi_ct";
        }


        if ($donvi == 0) {
            $query =
            "SELECT c.ten_donvi_ct,IFNULL(c.luotks,0)  as soluong  FROM
            (
                SELECT * FROM (
                SELECT donvi_id,count( distinct uuid) as luotks
                FROM khaosat_ketqua
                WHERE khaosat_id = ?
                and created_at >= ?
                and created_at <= ?
                and cau_hoi = ?
                and cau_tra_loi = ?
                group by donvi_id) a
            RIGHT JOIN don_vi dv ON a.donvi_id = dv.id) c
            ".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate, $cauhoi ,$traloi ]);
        }else if ($donvi == 1) {
            $query =
            "SELECT c.ten_donvi_ct,IFNULL(c.luotks,0)  as soluong  FROM
            (
                SELECT * FROM (
                SELECT donvi_id,count( distinct uuid) as luotks
                FROM khaosat_ketqua
                WHERE khaosat_id = ?
                and created_at >= ?
                and created_at <= ?
                and cau_hoi = ?
                and cau_tra_loi = ?
                group by donvi_id) a
            RIGHT JOIN don_vi dv ON a.donvi_id = dv.id) c
            WHERE id_donvi_cha =1
            ".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate, $cauhoi ,$traloi ]);
        }else {
            $query =
            "SELECT c.ten_donvi_ct,IFNULL(c.luotks,0)  as soluong  FROM
            (
                SELECT * FROM (
                SELECT donvi_id,count( distinct uuid) as luotks
                FROM khaosat_ketqua
                WHERE khaosat_id = ?
                and created_at >= ?
                and created_at <= ?
                and cau_hoi = ?
                and cau_tra_loi = ?
                group by donvi_id) a
            RIGHT JOIN don_vi dv ON a.donvi_id = dv.id) c
            WHERE group_donvi = ?
            ".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate, $cauhoi ,$traloi ,$donvi]);
        }

    }

    private function GetCautraloi($khaosatid,$cauhoi,$tungayDate,$denngayDate,$sapxep) {
        $currentUser = Auth::user();

        $sapxepStr = "";
        if($sapxep == 1){
            $sapxepStr = " ORDER BY soluong asc";
        }

        if($sapxep == 2){
            $sapxepStr = " ORDER BY soluong desc";
        }

        //if ($currentUser->is_admin) {
            $query =
            "SELECT cau_tra_loi,count( distinct uuid) as soluong
            FROM khaosat_ketqua
            WHERE khaosat_id = ?
            and created_at >= ?
            and created_at <= ?
            and cau_hoi = ?
            group by cau_tra_loi".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate, $cauhoi]);
        //}
    }

    private function GetDropdowntraloi($khaosatid,$cauhoi,$tungayDate,$denngayDate,$sapxep) {
        $currentUser = Auth::user();
        $sapxepStr = "";
        if($sapxep == 1){
            $sapxepStr = " ORDER BY soluong asc";
        }

        if($sapxep == 2){
            $sapxepStr = " ORDER BY soluong desc";
        }

        //if ($currentUser->is_admin) {
            $query =
            "SELECT cau_tra_loi,count( distinct uuid) as soluong
            FROM khaosat_ketqua
            WHERE khaosat_id = ?
            and created_at >= ?
            and created_at <= ?
            and cau_hoi = ?
            group by cau_tra_loi".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate, $cauhoi]);
        //}
    }

    public function GetDataTraloi($cauhoi, $khaosatid, $traloi,$tungayDate,$denngayDate,$sapxep) {
        $currentUser = Auth::user();

        $sapxepStr = " ORDER BY d.ten_donvi";
        if($sapxep == 1){
            $sapxepStr = " ORDER BY d.soluong asc";
        }

        if($sapxep == 2){
            $sapxepStr = " ORDER BY d.soluong desc";
        }

        if($sapxep == 3){
            $sapxepStr = " ORDER BY d.ten_donvi";
        }

        //if ($currentUser->is_admin) {
            $query =
                "SELECT * FROM (
                    SELECT c.*, IFNULL(SUM(c.luotks),0)  as soluong FROM
                            (SELECT * FROM (
                                    SELECT donvi_id,count( distinct uuid) as luotks
                                    FROM khaosat_ketqua
                                    WHERE khaosat_id = ?
                                    and created_at >= ?
                                    and created_at <= ?
                                    and cau_hoi = ?
                                    and cau_tra_loi = ?
                                    group by donvi_id
                                    ) a
                                    RIGHT JOIN don_vi dv ON a.donvi_id = dv.id) c
                    GROUP BY c.group_donvi)d
                    WHERE d.cap_donvi =2".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate, $cauhoi, $traloi]);
        //}
    }

    public function GetDataTongHop($cauhoi, $khaosatid,$tungayDate,$denngayDate,$sapxep) {
        $currentUser = Auth::user();

        $sapxepStr = "";
        if($sapxep == 1){
            $sapxepStr = " ORDER BY soluong asc";
        }

        if($sapxep == 2){
            $sapxepStr = " ORDER BY soluong desc";
        }

        //if ($currentUser->is_admin) {
            $query =
                "SELECT cau_tra_loi,count( distinct uuid) as soluong
                FROM khaosat_ketqua
                WHERE khaosat_id = ?
                and created_at >= ?
                and created_at <= ?
                and cau_hoi = ?
                group by cau_tra_loi
                ".$sapxepStr;
            return DB::select($query, [$khaosatid,$tungayDate,$denngayDate, $cauhoi]);
        //}
        // else {
        //     $donviIdAlls = parent::GetDsDonviIds();
        //     $donviStr = implode(',', $donviIdAlls);
        //     $query =
        //     "SELECT
        //         cau_tra_loi,
        //         count(cau_tra_loi) AS so_luot
        //     FROM khaosat_ketqua where khaosat_id = ? and cau_hoi = ?
        //     AND uuid IN (
        //         SELECT uuid FROM khaosat_ketqua where khaosat_id = ? and (? = -1 OR cau_tra_loi = ?) and ((? = -1 AND donvi_id IN (".$donviStr.")) OR donvi_id = ?)
        //     )
        //     group by cau_tra_loi;
        //     ";
        // return DB::select($query, [$khaosatid, $cauhoi, $khaosatid, $linhvuc, $linhvuc, $donvi, $donvi]);
        // }
    }

    public function GetDataCauhoi($cauhoi, $khaosatid,$tungayDate,$denngayDate,$sapxep) {
        $currentUser = Auth::user();

        $sapxepStr = "";
        if($sapxep == 1){
            $sapxepStr = " ORDER BY soluong asc";
        }

        if($sapxep == 2){
            $sapxepStr = " ORDER BY soluong desc";
        }
        //if ($currentUser->is_admin) {
            $query =
                "SELECT cau_tra_loi,count( distinct uuid) as soluong
                FROM khaosat_ketqua
                WHERE khaosat_id = ?
                and created_at >= ?
                and created_at <= ?
                and cau_hoi = ?
                group by cau_tra_loi
                ".$sapxepStr;
            return DB::select($query, [$khaosatid, $cauhoi,$tungayDate,$denngayDate]);
        //}
    }

    public function GetDataChiTiet($cauhoi, $khaosatid,$tungayDate,$denngayDate,$sapxep) {
        $currentUser = Auth::user();

        $sapxepStr = "";
        if($sapxep == 1){
            $sapxepStr = " ORDER BY soluong asc";
        }

        if($sapxep == 2){
            $sapxepStr = " ORDER BY soluong desc";
        }
        //if ($currentUser->is_admin) {
            $query =
                "SELECT cau_tra_loi,count( distinct uuid) as soluong
                FROM khaosat_ketqua
                WHERE khaosat_id = ?
                and created_at >= ?
                and created_at <= ?
                and cau_hoi = ?
                group by cau_tra_loi".$sapxepStr;
                return DB::select($query, [$khaosatid, $cauhoi,$tungayDate,$denngayDate]);
        //}
        // else {
        //     $donviIdAlls = parent::GetDsDonviIds();
        //     $donviStr = implode(',', $donviIdAlls);
        //     $query =
        //         "SELECT
        //             cau_tra_loi, linhvuc,
        //             count(cau_tra_loi) as tong
        //         from
        //         (SELECT
        //                 filteruuid.cau_tra_loi,
        //                 khaosat.cau_tra_loi as linhvuc
        //             from
        //             (SELECT
        //                     *
        //                 FROM khaosat_ketqua
        //                 where
        //                     khaosat_id = ?
        //                     and cau_hoi = ?
        //                     AND uuid IN (SELECT uuid FROM khaosat_ketqua where khaosat_id = ? and ((? = -1 AND donvi_id IN (".$donviStr.")) OR donvi_id = ?))
        //                 ) filteruuid
        //             inner join khaosat_ketqua as khaosat
        //                 on filteruuid.uuid = khaosat.uuid
        //             where
        //                 (khaosat.cau_hoi = ? or khaosat.cau_hoi = '2: Lĩnh vực thủ tục hành chính đã giải quyết')
        //                 and khaosat.cau_hoi != filteruuid.cau_hoi) b
        //             where
        //             (? = -1 OR b.linhvuc = ?)
        //             group by b.linhvuc,
        //                     b.cau_tra_loi
        //                     ;";
        //     return DB::select($query, [$khaosatid, $cauhoi, $khaosatid, $donvi, $donvi ,$cauhoi, $linhvuc, $linhvuc ]);
        // }
    }
    protected function guard()
    {
        return Auth::guard(app('VoyagerGuard'));
    }
}
