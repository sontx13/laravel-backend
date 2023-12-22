<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\DmPhuongxa;
use App\Models\DmHuyen;
use App\Models\DmTinh;

class DanhMucController extends VoyagerBaseController
{
    public function getDmTinhs(Request $request)
    {
        $input = $request->q;
        $id_quocgia = $request->id_quocgia;

        if (empty($id_quocgia)) {
            return response()->json([]);
        }

        if (empty($input)) {
            $list = DmTinh::where('id_quocgia', $id_quocgia)->get();
        }else{
            $list = DmTinh::where('id_quocgia', $id_quocgia)
                            ->where('ten', 'like', '%' . $input . '%')->get();
        }

        $formattedObjs = [];

        foreach ($list as $obj) {
            $formattedObjs[] = ['id' => $obj->id, 'text' => $obj->ten];
        }

        return response()->json($formattedObjs);
    }

    public function getDmHuyens(Request $request)
    {
        $input = $request->q;
        $id_tinh = $request->id_tinh;

        if (empty($id_tinh)) {
            return response()->json([]);
        }

        if (empty($input)) {
            $list = DmHuyen::where('id_tinh', $id_tinh)->get();
        }else{
            $list = DmHuyen::where('id_tinh', $id_tinh)
                            ->where('ten', 'like', '%' . $input . '%')->get();
        }

        $formattedObjs = [];

        foreach ($list as $obj) {
            $formattedObjs[] = ['id' => $obj->id, 'text' => $obj->ten];
        }

        return response()->json($formattedObjs);
    }

    public function getDmXaphuongs(Request $request)
    {
        $input = $request->q;
        $id_huyen = $request->id_huyen;

        if (empty($id_huyen)) {
            return response()->json([]);
        }

        if (empty($input)) {
            $list = DmPhuongxa::where('id_huyen', $id_huyen)->get();
        }else{
            $list = DmPhuongxa::where('id_huyen', $id_huyen)
                            ->where('ten', 'like', '%' . $input . '%')->get();
        }

        $formattedObjs = [];

        foreach ($list as $obj) {
            $formattedObjs[] = ['id' => $obj->id, 'text' => $obj->ten];
        }

        return response()->json($formattedObjs);
    }
}
