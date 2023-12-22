<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models;
use App\Models\DonVi;
use App\Models\KetquaThuchienCongkhai;
use App\Models\NhandanBanBieuquyetCoquanCothamquyenQuyetdinh;
use App\Models\NhandanBanVaQuyetdinhTructiep;

class XemNhapLieuBaoCaoWebViewController extends VoyagerBaseController
{
    // View index nhập liệu báo cáo
    public function Index(Request $request)
    {
        $view = 'voyager::xem-nhaplieu-baocao-webview.index';
        $donvis = DonVi::where('showon_select', 1)->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', 1)->get();
        
        return Voyager::view($view, compact('donvis', 'lsDonViCha'));
    }

    public function GetDsDonvi(Request $request)
    {
        $idHuyen = $request->idHuyen;

        $lsDonVis = DonVi::where('id_donvi_cha', $idHuyen)->get();

        return response()->json([
            'error_code' => 0,
            'message' => 'Thành công',
            'data' => $lsDonVis,
        ], Response::HTTP_OK);
    }
}
