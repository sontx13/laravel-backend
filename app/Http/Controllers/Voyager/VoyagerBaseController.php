<?php

namespace App\Http\Controllers\Voyager;

use App\Enums\CapDonViEnum;
use App\Models\DonVi;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;

class VoyagerBaseController extends BaseVoyagerBaseController
{
    //
    public function GetDsDonviIds()
    {
        $donviIdAlls = [];
        $donviid = Auth::user()->donvi_id;
        $donVi = DonVi::find($donviid);
        if ($donviid != null && $donVi != null) {
            $capDV = $donVi->cap_donvi;
            if ($capDV == CapDonViEnum::CapTinh || Auth::user()->is_admin == 1) {
                $lsDonVis = DonVi::select(['id'])->get();
                foreach ($lsDonVis as $donviItem) {
                    array_push($donviIdAlls, $donviItem->id);
                }
            } else if ($capDV == CapDonViEnum::CapHuyen) {
                $lsDonViCons = DonVi::where('id_donvi_cha', $donviid)->select(['id'])->get();
                foreach ($lsDonViCons as $donviConItem) {
                    array_push($donviIdAlls, $donviConItem->id);
                }
                array_push($donviIdAlls, $donviid);
            } else {
                array_push($donviIdAlls, $donviid);
            }
        }
        return $donviIdAlls;
    }

    public function GetDsDonviIds2($donviid)
    {
        $donviIdAlls = [];
        //$donviid = Auth::user()->donvi_id;
        $donVi = DonVi::find($donviid);
        if ($donviid != null && $donVi != null) {
            $capDV = $donVi->cap_donvi;
            if ($capDV == CapDonViEnum::CapTinh || Auth::user()->is_admin == 1) {
                $lsDonVis = DonVi::select(['id'])->get();
                foreach ($lsDonVis as $donviItem) {
                    array_push($donviIdAlls, $donviItem->id);
                }
            } else if ($capDV == CapDonViEnum::CapHuyen) {
                $lsDonViCons = DonVi::where('id_donvi_cha', $donviid)->select(['id'])->get();
                foreach ($lsDonViCons as $donviConItem) {
                    array_push($donviIdAlls, $donviConItem->id);
                }
                array_push($donviIdAlls, $donviid);
            } else {
                array_push($donviIdAlls, $donviid);
            }
        }
        return $donviIdAlls;
    }

    public function GetTenDonViHienThiNhapLieuBaoCao($donviid)
    {
        $tendonvi = "";
        if ($donviid != null) {
            $donvi = DonVi::find($donviid);
            $tendonvi = $donvi->ten_donvi;
            if ($donvi->id_donvi_cha != null) {
                $donviCha = DonVi::find($donvi->id_donvi_cha);
                $tendonvi = $tendonvi . ", " . $donviCha->ten_donvi;
            }
        }
        return $tendonvi;
    }

}
