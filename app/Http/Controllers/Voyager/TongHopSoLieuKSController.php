<?php

namespace App\Http\Controllers\Voyager;

use App\Models\DmNhomCk;
use App\Models\DonthuKhieunaiTocao;
use App\Models\DonVi;
use App\Models\KetquaHoatdongCuabangiamsatdautuCuacongdong;
use App\Models\KetquaHoatdongCuabanthanhtraNhandan;
use App\Models\KetQuaHoTroHuongDanMotCua;
use App\Models\KetQuaHoTroHuongDanMotCua06;
use App\Models\KetquaHuydongvonXaydungHatangcoso;
use App\Models\Posts;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\KetquaThuchienCongkhaiNew;
use App\Models\KetquaTochuchopThonbanTodanpho;
use App\Models\NhandanBanBieuquyetCoquanCothamquyenQuyetdinh;
use App\Models\NhandanBanVaQuyetdinhTructiep;
use App\Models\NhandanKiemtraGiamsat;
use App\Models\NhandanThamgiaYkien;
use App\Models\PKS01;
use App\Models\PKS02;
use App\Models\PKS03;
use App\Models\PKS04;
use App\Models\PKS07;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;

class TongHopSoLieuKSController extends VoyagerBaseController
{
    public function index(Request $request)
    {
        $view = 'voyager::tonghop-solieu-ks.browse';

        $donvis = [];
        $donvi_id = auth()->user()->donvi_id;
        $tendonvi = DonVi::where('ma_donvi', auth()->user()->donvi_id)->get();
        $donvicha =  DonVi::where('ma_donvi', $tendonvi[0]->group_donvi)->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $currentUser = Auth::user();
        $dvh = 0;
        $lsXa = collect();
        $baocaotonghop = true;
        $lsHuyen = [];
        $quy = 1;
        $nam = Carbon::now()->year;
        $baocao = 1;
        $lsData = [];
        if ($request->donvi_huyen) {
            $dvh = $request->donvi_huyen;
        }
        if ($request->nam) {
            $nam = $request->nam;
        }
        if ($request->quy) {
            $quy = $request->quy;
        }
        if ($request->baocao) {
            $baocao = $request->baocao;
        }
        $lsData = [];
        if ($donvi_id != 1) {
            $lsHuyen = Donvi::where('id', '=', $donvi_id)->get();
        } else {
            if ($request->donvi_huyen == null || $request->donvi_huyen == 0) {
                $lsHuyen = Donvi::where('id_donvi_cha', '=', 1)->get();
            } else {
                $lsHuyen = Donvi::where('id', '=', $request->donvi_huyen)->get();
            }
        }
        for ($i = 0; $i < $lsHuyen->count(); $i++) {
            $item = Donvi::where('id_donvi_cha', '=', $lsHuyen[$i]->ma_donvi)->get();
            $lsHuyen[$i]->tong_so = $item->count();
            $totalMuc = 0;
            $total = 0;

            for ($j = 0; $j < $item->count(); $j++) {
                switch ($baocao) {
                    case 1:
                        $lsData = NhandanBanVaQuyetdinhTructiep::where('quarter', $quy)->where('year', $nam)->where('donvi_id', '=', $item[$j]->id)->get();
                        break;
                    case 2:
                        $lsData = NhandanBanBieuquyetCoquanCothamquyenQuyetdinh::where('quarter', $quy)->where('year', $nam)->where('donvi_id', '=', $item[$j]->id)->get();
                        break;
                    case 3:
                        $lsData = NhandanThamgiaYkien::where('quarter', $quy)->where('year', $nam)->where('donvi_id', '=', $item[$j]->id)->get();
                        break;
                    case 4:
                        $lsData = KetquaHuydongvonXaydungHatangcoso::where('quarter', $quy)->where('year', $nam)->where('donvi_id', '=', $item[$j]->id)->get();
                        break;
                    case 5:
                        $lsData = NhandanKiemtraGiamsat::where('quarter', $quy)->where('year', $nam)->where('donvi_id', '=', $item[$j]->id)->get();
                        break;
                    case 6:
                        $lsData = KetquaHoatdongCuabanthanhtraNhandan::where('quarter', $quy)->where('year', $nam)->where('donvi_id', '=', $item[$j]->id)->get();
                        break;
                    case 7:
                        $lsData = KetquaHoatdongCuabangiamsatdautuCuacongdong::where('quarter', $quy)->where('year', $nam)->where('donvi_id', '=', $item[$j]->id)->get();
                        break;
                    case 8:
                        $lsData = DonthuKhieunaiTocao::where('quarter', $quy)->where('year', $nam)->where('donvi_id', '=', $item[$j]->id)->get();
                        break;
                    case 9:
                        $lsData = KetquaTochuchopThonbanTodanpho::where('quarter', $quy)->where('year', $nam)->where('donvi_id', '=', $item[$j]->id)->get();
                        break;
                }
                if ($lsData->count()) {
                    $item[$j]->dem = $lsData->count();
                    $item[$j]->check = 1;
                    $totalMuc = $totalMuc + $lsData->count();
                    $total = $total + 1;
                }
            }
            $lsHuyen[$i]->tong_so_muc = $totalMuc;
            $lsHuyen[$i]->total = $total;
            $lsXa = $lsXa->concat($item);
        }
        return Voyager::view($view, compact(
            'donvis',
            'lsDonViCha',
            'donvi_id',
            'tendonvi',
            'donvicha',
            'dvh',
            'lsHuyen',
            'lsXa',
            'baocao',
            'quy',
            'nam'
        ));
    }
    public function index01(Request $request)
    {
        $view = 'voyager::tonghop-solieu-ks.browse-02';

        $donvis = [];
        $donvi_id = auth()->user()->donvi_id;
        $tendonvi = DonVi::where('ma_donvi', auth()->user()->donvi_id)->get();
        $donvicha =  DonVi::where('ma_donvi', $tendonvi[0]->group_donvi)->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $currentUser = Auth::user();
        $dvh = 0;
        $lsXa = collect();
        $baocaotonghop = true;
        $lsHuyen = [];
        $lsData = [];
        if ($request->donvi_huyen) {
            $dvh = $request->donvi_huyen;
        }
        $lsData = [];
        if ($donvi_id != 1) {
            $lsHuyen = Donvi::where('id', '=', $donvi_id)->get();
        } else {
            if ($request->donvi_huyen == null || $request->donvi_huyen == 0) {
                $lsHuyen = Donvi::where('id_donvi_cha', '=', 1)->get();
            } else {
                $lsHuyen = Donvi::where('id', '=', $request->donvi_huyen)->get();
            }
        }
        $fromDate = Carbon::now();
        $toDate = Carbon::now();
        if ($request->fromDate) {
            $fromDate = $request->fromDate;
        }
        if ($request->toDate) {
            $toDate = $request->toDate;
        }
        for ($i = 0; $i < $lsHuyen->count(); $i++) {
            $item = Donvi::where('id_donvi_cha', '=', $lsHuyen[$i]->ma_donvi)->get();
            $lsHuyen[$i]->tong_so = $item->count();
            $totalMuc = 0;
            $total = 0;

            for ($j = 0; $j < $item->count(); $j++) {
                $lsData = PKS01::where('donvi_id', '=', $item[$j]->id)->whereBetween('created_at', [$fromDate, $toDate])->get();
                if ($lsData->count()) {
                    $item[$j]->dem = $lsData->count();
                    $item[$j]->check = 1;
                    $totalMuc = $totalMuc + $lsData->count();
                    $total = $total + 1;
                }
            }
            $lsHuyen[$i]->tong_so_muc = $totalMuc;
            $lsHuyen[$i]->total = $total;
            $lsXa = $lsXa->concat($item);
            $currentYear = Carbon::now()->year;
            $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        }
        return Voyager::view($view, compact(
            'donvis',
            'lsDonViCha',
            'donvi_id',
            'tendonvi',
            'donvicha',
            'dvh',
            'lsHuyen',
            'lsXa',
            'currentYear',
            'lsPosts',
            'fromDate',
            'toDate'
        ));
    }
    public function index02(Request $request)
    {
        $view = 'voyager::tonghop-solieu-ks.browse-03';

        $donvis = [];
        $donvi_id = auth()->user()->donvi_id;
        $tendonvi = DonVi::where('ma_donvi', auth()->user()->donvi_id)->get();
        $donvicha =  DonVi::where('ma_donvi', $tendonvi[0]->group_donvi)->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $currentUser = Auth::user();
        $dvh = 0;
        $lsXa = collect();
        $baocaotonghop = true;
        $lsHuyen = [];
        $lsData = [];
        if ($request->donvi_huyen) {
            $dvh = $request->donvi_huyen;
        }
        $lsData = [];
        if ($donvi_id != 1) {
            $lsHuyen = Donvi::where('id', '=', $donvi_id)->get();
        } else {
            if ($request->donvi_huyen == null || $request->donvi_huyen == 0) {
                $lsHuyen = Donvi::where('id_donvi_cha', '=', 1)->get();
            } else {
                $lsHuyen = Donvi::where('id', '=', $request->donvi_huyen)->get();
            }
        }
        $fromDate = Carbon::now();;
        $toDate = Carbon::now();
        if ($request->fromDate) {
            $fromDate = $request->fromDate;
        }
        if ($request->toDate) {
            $toDate = $request->toDate;
        }
        for ($i = 0; $i < $lsHuyen->count(); $i++) {
            $item = Donvi::where('id_donvi_cha', '=', $lsHuyen[$i]->ma_donvi)->get();
            $lsHuyen[$i]->tong_so = $item->count();
            $totalMuc = 0;
            $total = 0;

            for ($j = 0; $j < $item->count(); $j++) {
                $lsData = PKS02::where('donvi_id', '=', $item[$j]->id)->whereBetween('created_at', [$fromDate, $toDate])->get();
                if ($lsData->count()) {
                    $item[$j]->dem = $lsData->count();
                    $item[$j]->check = 1;
                    $totalMuc = $totalMuc + $lsData->count();
                    $total = $total + 1;
                }
            }
            $lsHuyen[$i]->tong_so_muc = $totalMuc;
            $lsHuyen[$i]->total = $total;
            $lsXa = $lsXa->concat($item);
            $currentYear = Carbon::now()->year;
            $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        }
        return Voyager::view($view, compact(
            'donvis',
            'lsDonViCha',
            'donvi_id',
            'tendonvi',
            'donvicha',
            'dvh',
            'lsHuyen',
            'lsXa',
            'currentYear',
            'lsPosts',
            'fromDate',
            'toDate'
        ));
    }
    public function index03(Request $request)
    {
        $view = 'voyager::tonghop-solieu-ks.browse-04';

        $donvis = [];
        $donvi_id = auth()->user()->donvi_id;
        $tendonvi = DonVi::where('ma_donvi', auth()->user()->donvi_id)->get();
        $donvicha =  DonVi::where('ma_donvi', $tendonvi[0]->group_donvi)->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
       
        $currentUser = Auth::user();
        $dvh = 0;
        $lsXa = collect();
        $baocaotonghop = true;
        $lsHuyen = [];
        $lsData = [];
        if ($request->donvi_huyen) {
            $dvh = $request->donvi_huyen;
        }
        $lsData = [];
        if ($donvi_id != 1) {
            $lsHuyen = Donvi::where('id', '=', $donvi_id)->get();
        } else {
            if ($request->donvi_huyen == null || $request->donvi_huyen == 0) {
                $lsHuyen = Donvi::where('id_donvi_cha', '=', 1)->get();
            } else {
                $lsHuyen = Donvi::where('id', '=', $request->donvi_huyen)->get();
            }
        }
        $fromDate = Carbon::now();;
        $toDate = Carbon::now();
        if ($request->fromDate) {
            $fromDate = $request->fromDate;
        }
        if ($request->toDate) {
            $toDate = $request->toDate;
        }
        for ($i = 0; $i < $lsHuyen->count(); $i++) {
            $item = Donvi::where('id_donvi_cha', '=', $lsHuyen[$i]->ma_donvi)->get();
            $lsHuyen[$i]->tong_so = $item->count();
            $totalMuc = 0;
            $total = 0;

            for ($j = 0; $j < $item->count(); $j++) {
                $lsData = PKS03::where('donvi_id', '=', $item[$j]->id)->whereBetween('created_at', [$fromDate, $toDate])->get();
                if ($lsData->count()) {
                    $item[$j]->dem = $lsData->count();
                    $item[$j]->check = 1;
                    $totalMuc = $totalMuc + $lsData->count();
                    $total = $total + 1;
                }
            }
            $lsHuyen[$i]->tong_so_muc = $totalMuc;
            $lsHuyen[$i]->total = $total;
            $lsXa = $lsXa->concat($item);
            $currentYear = Carbon::now()->year;
            $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        }
        return Voyager::view($view, compact(
            'donvis',
            'lsDonViCha',
            'donvi_id',
            'tendonvi',
            'donvicha',
            'dvh',
            'lsHuyen',
            'lsXa',
            'currentYear',
            'lsPosts',
            'fromDate',
            'toDate'
        ));
    }
    public function index04(Request $request)
    {
        $view = 'voyager::tonghop-solieu-ks.browse-05';

        $donvis = [];
        $donvi_id = auth()->user()->donvi_id;
        $tendonvi = DonVi::where('ma_donvi', auth()->user()->donvi_id)->get();
        $donvicha =  DonVi::where('ma_donvi', $tendonvi[0]->group_donvi)->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $currentUser = Auth::user();
        $dvh = 0;
        $lsXa = collect();
        $baocaotonghop = true;
        $lsHuyen = [];
        $lsData = [];
        if ($request->donvi_huyen) {
            $dvh = $request->donvi_huyen;
        }
        $lsData = [];
        if ($donvi_id != 1) {
            $lsHuyen = Donvi::where('id', '=', $donvi_id)->get();
        } else {
            if ($request->donvi_huyen == null || $request->donvi_huyen == 0) {
                $lsHuyen = Donvi::where('id_donvi_cha', '=', 1)->get();
            } else {
                $lsHuyen = Donvi::where('id', '=', $request->donvi_huyen)->get();
            }
        }
        $fromDate = Carbon::now();;
        $toDate = Carbon::now();
        if ($request->fromDate) {
            $fromDate = $request->fromDate;
        }
        if ($request->toDate) {
            $toDate = $request->toDate;
        }
        for ($i = 0; $i < $lsHuyen->count(); $i++) {
            $item = Donvi::where('id_donvi_cha', '=', $lsHuyen[$i]->ma_donvi)->get();
            $lsHuyen[$i]->tong_so = $item->count();
            $totalMuc = 0;
            $total = 0;

            for ($j = 0; $j < $item->count(); $j++) {
                $lsData = PKS04::where('donvi_id', '=', $item[$j]->id)->whereBetween('created_at', [$fromDate, $toDate])->get();
                if ($lsData->count()) {
                    $item[$j]->dem = $lsData->count();
                    $item[$j]->check = 1;
                    $totalMuc = $totalMuc + $lsData->count();
                    $total = $total + 1;
                }
            }
            $lsHuyen[$i]->tong_so_muc = $totalMuc;
            $lsHuyen[$i]->total = $total;
            $lsXa = $lsXa->concat($item);
            $currentYear = Carbon::now()->year;
            $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        }
        return Voyager::view($view, compact(
            'donvis',
            'lsDonViCha',
            'donvi_id',
            'tendonvi',
            'donvicha',
            'dvh',
            'lsHuyen',
            'lsXa',
            'currentYear',
            'lsPosts',
            'fromDate',
            'toDate'
        ));
    }
    public function index05(Request $request)
    {
        $view = 'voyager::tonghop-solieu-ks.browse-06';

        $donvis = [];
        $donvi_id = auth()->user()->donvi_id;
        $tendonvi = DonVi::where('ma_donvi', auth()->user()->donvi_id)->get();
        $donvicha =  DonVi::where('ma_donvi', $tendonvi[0]->group_donvi)->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $currentUser = Auth::user();
        $dvh = 0;
        $lsXa = collect();
        $baocaotonghop = true;
        $lsHuyen = [];
        $lsData = [];
        if ($request->donvi_huyen) {
            $dvh = $request->donvi_huyen;
        }
        $lsData = [];
        if ($donvi_id != 1) {
            $lsHuyen = Donvi::where('id', '=', $donvi_id)->get();
        } else {
            if ($request->donvi_huyen == null || $request->donvi_huyen == 0) {
                $lsHuyen = Donvi::where('id_donvi_cha', '=', 1)->get();
            } else {
                $lsHuyen = Donvi::where('id', '=', $request->donvi_huyen)->get();
            }
        }
        $fromDate = Carbon::now();;
        $toDate = Carbon::now();
        if ($request->fromDate) {
            $fromDate = $request->fromDate;
        }
        if ($request->toDate) {
            $toDate = $request->toDate;
        }
        for ($i = 0; $i < $lsHuyen->count(); $i++) {
            $item = Donvi::where('id_donvi_cha', '=', $lsHuyen[$i]->ma_donvi)->get();
            $lsHuyen[$i]->tong_so = $item->count();
            $totalMuc = 0;
            $total = 0;

            for ($j = 0; $j < $item->count(); $j++) {
                $lsData = KetQuaHoTroHuongDanMotCua::where('donvi_id', '=', $item[$j]->id)->whereBetween('created_at', [$fromDate, $toDate])->get();
                if ($lsData->count()) {
                    $item[$j]->dem = $lsData->count();
                    $item[$j]->check = 1;
                    $totalMuc = $totalMuc + $lsData->count();
                    $total = $total + 1;
                }
            }
            $lsHuyen[$i]->tong_so_muc = $totalMuc;
            $lsHuyen[$i]->total = $total;
            $lsXa = $lsXa->concat($item);
            $currentYear = Carbon::now()->year;
            $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        }
        return Voyager::view($view, compact(
            'donvis',
            'lsDonViCha',
            'donvi_id',
            'tendonvi',
            'donvicha',
            'dvh',
            'lsHuyen',
            'lsXa',
            'currentYear',
            'lsPosts',
            'fromDate',
            'toDate'
        ));
    }
    public function index06(Request $request)
    {
        $view = 'voyager::tonghop-solieu-ks.browse-07';

        $donvis = [];
        $donvi_id = auth()->user()->donvi_id;
        $tendonvi = DonVi::where('ma_donvi', auth()->user()->donvi_id)->get();
        $donvicha =  DonVi::where('ma_donvi', $tendonvi[0]->group_donvi)->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $currentUser = Auth::user();
        $dvh = 0;
        $lsXa = collect();
        $baocaotonghop = true;
        $lsHuyen = [];
        $lsData = [];
        if ($request->donvi_huyen) {
            $dvh = $request->donvi_huyen;
        }
        $lsData = [];
        if ($donvi_id != 1) {
            $lsHuyen = Donvi::where('id', '=', $donvi_id)->get();
        } else {
            if ($request->donvi_huyen == null || $request->donvi_huyen == 0) {
                $lsHuyen = Donvi::where('id_donvi_cha', '=', 1)->get();
            } else {
                $lsHuyen = Donvi::where('id', '=', $request->donvi_huyen)->get();
            }
        }
        $fromDate = Carbon::now();;
        $toDate = Carbon::now();
        if ($request->fromDate) {
            $fromDate = $request->fromDate;
        }
        if ($request->toDate) {
            $toDate = $request->toDate;
        }
        for ($i = 0; $i < $lsHuyen->count(); $i++) {
            $item = Donvi::where('id_donvi_cha', '=', $lsHuyen[$i]->ma_donvi)->get();
            $lsHuyen[$i]->tong_so = $item->count();
            $totalMuc = 0;
            $total = 0;

            for ($j = 0; $j < $item->count(); $j++) {
                $lsData = KetQuaHoTroHuongDanMotCua06::where('donvi_id', '=', $item[$j]->id)->whereBetween('created_at', [$fromDate, $toDate])->get();
                if ($lsData->count()) {
                    $item[$j]->dem = $lsData->count();
                    $item[$j]->check = 1;
                    $totalMuc = $totalMuc + $lsData->count();
                    $total = $total + 1;
                }
            }
            $lsHuyen[$i]->tong_so_muc = $totalMuc;
            $lsHuyen[$i]->total = $total;
            $lsXa = $lsXa->concat($item);
            $currentYear = Carbon::now()->year;
            $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        }
        return Voyager::view($view, compact(
            'donvis',
            'lsDonViCha',
            'donvi_id',
            'tendonvi',
            'donvicha',
            'dvh',
            'lsHuyen',
            'lsXa',
            'currentYear',
            'lsPosts',
            'fromDate',
            'toDate'
        ));
    }
    public function index07(Request $request)
    {
        $view = 'voyager::tonghop-solieu-ks.browse-08';

        $donvis = [];
        $donvi_id = auth()->user()->donvi_id;
        $tendonvi = DonVi::where('ma_donvi', auth()->user()->donvi_id)->get();
        $donvicha =  DonVi::where('ma_donvi', $tendonvi[0]->group_donvi)->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $currentUser = Auth::user();
        $dvh = 0;
        $lsXa = collect();
        $baocaotonghop = true;
        $lsHuyen = [];
        $lsData = [];
        if ($request->donvi_huyen) {
            $dvh = $request->donvi_huyen;
        }
        $lsData = [];
        if ($donvi_id != 1) {
            $lsHuyen = Donvi::where('id', '=', $donvi_id)->get();
        } else {
            if ($request->donvi_huyen == null || $request->donvi_huyen == 0) {
                $lsHuyen = Donvi::where('id_donvi_cha', '=', 1)->get();
            } else {
                $lsHuyen = Donvi::where('id', '=', $request->donvi_huyen)->get();
            }
        }
        $fromDate = Carbon::now();;
        $toDate = Carbon::now();
        if ($request->fromDate) {
            $fromDate = $request->fromDate;
        }
        if ($request->toDate) {
            $toDate = $request->toDate;
        }
        for ($i = 0; $i < $lsHuyen->count(); $i++) {
            $item = Donvi::where('id_donvi_cha', '=', $lsHuyen[$i]->ma_donvi)->get();
            $lsHuyen[$i]->tong_so = $item->count();
            $totalMuc = 0;
            $total = 0;

            for ($j = 0; $j < $item->count(); $j++) {
                $lsData = PKS07::where('donvi_id', '=', $item[$j]->id)->whereBetween('created_at', [$fromDate, $toDate])->get();
                if ($lsData->count()) {
                    $item[$j]->dem = $lsData->count();
                    $item[$j]->check = 1;
                    $totalMuc = $totalMuc + $lsData->count();
                    $total = $total + 1;
                }
            }
            $lsHuyen[$i]->tong_so_muc = $totalMuc;
            $lsHuyen[$i]->total = $total;
            $lsXa = $lsXa->concat($item);
            $currentYear = Carbon::now()->year;
            $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        }
        return Voyager::view($view, compact(
            'donvis',
            'lsDonViCha',
            'donvi_id',
            'tendonvi',
            'donvicha',
            'dvh',
            'lsHuyen',
            'lsXa',
            'currentYear',
            'lsPosts',
            'fromDate',
            'toDate'
        ));
    }
}
