<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models;
use App\Models\KetquaThuchienCongkhai;
use App\Models\NhandanBanBieuquyetCoquanCothamquyenQuyetdinh;
use App\Models\NhandanBanVaQuyetdinhTructiep;
use App\Models\DonVi;
use App\Models\Posts;
use App\Models\User;
use Carbon\Carbon;

class XemNhapLieuBaoCaoController extends VoyagerBaseController
{
    // View index nhập liệu báo cáo
    public function Index(Request $request)
    {
        $donvis = [];
        $lsDonViCha = DonVi::where('id_donvi_cha', 1)->get();
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $donvis = DonVi::where('showon_select', 1)->get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds2(auth()->user()->donvi_id);
            $donvis = DonVi::whereIn('id', $donviIdAlls)
                ->orderBy('cap_donvi', 'ASC')
                ->orderBy('ten_donvi', 'ASC')
                ->get();
        }

        $view = 'voyager::xem-nhaplieu-baocao.index';

        return Voyager::view($view, compact('donvis', 'lsDonViCha'));
    }

    public function Index_backup(Request $request)
    {
        $donvis = [];
        $lsDonViCha = DonVi::where('id_donvi_cha', 1)->get();
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $donvis = DonVi::where('showon_select', 1)->get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds2(auth()->user()->donvi_id);
            $donvis = DonVi::whereIn('id', $donviIdAlls)
                ->orderBy('cap_donvi', 'ASC')
                ->orderBy('ten_donvi', 'ASC')
                ->get();
        }

        $view = 'voyager::xem-nhaplieu-baocao.index-backup';

        return Voyager::view($view, compact('donvis', 'lsDonViCha'));
    }

    public function Index2(Request $request)
    {
        $donvis = [];
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $donvis = DonVi::where('showon_select', 1)->get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds2(auth()->user()->donvi_id);
            $donvis = DonVi::whereIn('id', $donviIdAlls)
                ->orderBy('cap_donvi', 'ASC')
                ->orderBy('ten_donvi', 'ASC')
                ->get();
        }

        $view = 'voyager::xem-nhaplieu-baocao.index2';
        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        if(auth()->user()->donvi_id <2){
            $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        }
        else{
            $lsDonViCha = DonVi::where('id', auth()->user()->donvi_id)->get();
        }
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis',  'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }
    public function Index3(Request $request)
    {
        $donvis = [];
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $donvis = DonVi::where('showon_select', 1)->get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds2(auth()->user()->donvi_id);
            $donvis = DonVi::whereIn('id', $donviIdAlls)
                ->orderBy('cap_donvi', 'ASC')
                ->orderBy('ten_donvi', 'ASC')
                ->get();
        }

        $view = 'voyager::xem-nhaplieu-baocao.index3';

        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        if(auth()->user()->donvi_id <2){
            $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        }
        else{
            $lsDonViCha = DonVi::where('id', auth()->user()->donvi_id)->get();
        }
        
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis',  'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }
    public function Index4(Request $request)
    {
        $donvis = [];
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $donvis = DonVi::where('showon_select', 1)->get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds2(auth()->user()->donvi_id);
            $donvis = DonVi::whereIn('id', $donviIdAlls)
                ->orderBy('cap_donvi', 'ASC')
                ->orderBy('ten_donvi', 'ASC')
                ->get();
        }

        $view = 'voyager::xem-nhaplieu-baocao.index4';

        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        if(auth()->user()->donvi_id <2){
            $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        }
        else{
            $lsDonViCha = DonVi::where('id', auth()->user()->donvi_id)->get();
        }
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis',  'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }
    public function Index5(Request $request)
    {
        $donvis = [];
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $donvis = DonVi::where('showon_select', 1)->get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds2(auth()->user()->donvi_id);
            $donvis = DonVi::whereIn('id', $donviIdAlls)
                ->orderBy('cap_donvi', 'ASC')
                ->orderBy('ten_donvi', 'ASC')
                ->get();
        }

        $view = 'voyager::xem-nhaplieu-baocao.index5';

        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
          if(auth()->user()->donvi_id <2){
            $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        }
        else{
            $lsDonViCha = DonVi::where('id', auth()->user()->donvi_id)->get();
        }
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis',  'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }
    public function Index6(Request $request)
    {
        $donvis = [];
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $donvis = DonVi::where('showon_select', 1)->get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds2(auth()->user()->donvi_id);
            $donvis = DonVi::whereIn('id', $donviIdAlls)
                ->orderBy('cap_donvi', 'ASC')
                ->orderBy('ten_donvi', 'ASC')
                ->get();
        }

        $view = 'voyager::xem-nhaplieu-baocao.index6';

        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
          if(auth()->user()->donvi_id <2){
            $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        }
        else{
            $lsDonViCha = DonVi::where('id', auth()->user()->donvi_id)->get();
        }
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis',  'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }
    public function Index7(Request $request)
    {
        $donvis = [];
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $donvis = DonVi::where('showon_select', 1)->get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds2(auth()->user()->donvi_id);
            $donvis = DonVi::whereIn('id', $donviIdAlls)
                ->orderBy('cap_donvi', 'ASC')
                ->orderBy('ten_donvi', 'ASC')
                ->get();
        }

        $view = 'voyager::xem-nhaplieu-baocao.index7';
        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
          if(auth()->user()->donvi_id <2){
            $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        }
        else{
            $lsDonViCha = DonVi::where('id', auth()->user()->donvi_id)->get();
        }
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis',  'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }

    public function Index8(Request $request)
    {
        $donvis = [];
        $currentUser = Auth::user();
        if ($currentUser->is_admin) {
            $donvis = DonVi::where('showon_select', 1)->get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds2(auth()->user()->donvi_id);
            $donvis = DonVi::whereIn('id', $donviIdAlls)
                ->orderBy('cap_donvi', 'ASC')
                ->orderBy('ten_donvi', 'ASC')
                ->get();
        }

        $view = 'voyager::xem-nhaplieu-baocao.index8';

        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
          if(auth()->user()->donvi_id <2){
            $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        }
        else{
            $lsDonViCha = DonVi::where('id', auth()->user()->donvi_id)->get();
        }
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis',  'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }

    protected function guard()
    {
        return Auth::guard(app('VoyagerGuard'));
    }
}
