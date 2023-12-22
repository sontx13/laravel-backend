<?php

namespace App\Http\Controllers\Voyager;

use App\Models\ThongBao;
use Carbon\Carbon;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\VoyagerController as BaseVoyagerController;

class VoyagerController extends BaseVoyagerController
{
    public function index()
    {
        $startOfMonth = Carbon::now()->startOfYear();
        $endOfMonth = Carbon::now()->endOfYear();
        $roleName = auth()->user()->role->name;
        $lsThongBao = null;
        if ($roleName != null) {
            $lsThongBao = ThongBao::where('nhom_nhan', 'like', '%' . $roleName . '%')->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->orderBy('ngay_gui', 'desc')
                ->get();
        }
        return Voyager::view('voyager::index', compact([
            'lsThongBao'
        ]));
    }
}
