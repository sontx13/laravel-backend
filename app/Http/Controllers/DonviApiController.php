<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DonVi;
use Illuminate\Support\Facades\DB;

/**
 * Class HoadonChoController
 */

class DonviApiController extends Controller
{
    public function donvi(Request $request)
    {
        try {
            if ($request->id != null && $request->id != 1) {
                $donvi = DB::table('don_vi')->where('don_vi.id', '=', $request->id)->first();
                $donvi_cha = DonVi::where('id', '=', $donvi->id_donvi_cha)->first();

                $data = [
                    'id' => $donvi->id,
                    'ten_donvi' => $donvi->ten_donvi,
                    'cap_donvi' => $donvi->cap_donvi,
                    'ten_donvi_ct' => $donvi->ten_donvi_ct,
                    'diachi_donvi' => $donvi->diachi_donvi,
                    'id_donvi_cha' => $donvi->id_donvi_cha,
                    'ten_donvi_cha' => $donvi_cha->ten_donvi
                ];
                return  response()->json([
                    'message' => 'Thành công',
                    'data' => $data
                ]);
            } else {
                $data = [
                    'id' => 1,
                    'ten_donvi' => 'Tỉnh Bắc Giang',
                    'cap_donvi' => '1',
                    'ten_donvi_ct' => 'Tỉnh Bắc Giang',
                    'diachi_donvi' => 'Tỉnh Bắc Giang',
                    'id_donvi_cha' => '1',
                    'ten_donvi_cha' => 'Tỉnh Bắc Giang'
                ];
                return  response()->json([
                    'message' => 'Thành công',
                    'data' => $data
                ]);
            }
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'Lỗiiii'
            ]);
        }
    }
}
