<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DonVi;
use Carbon\Carbon;
use App\Models\Posts;

class NhapLieuBaoCaoController extends VoyagerBaseController
{
    public function Index(Request $request)
    {
        $this->authorize('browse_nhaplieu-baocao');
        $view = 'voyager::nhaplieu-baocao.index';
        $currentUser = Auth::user();
        $tendonvi = parent::GetTenDonViHienThiNhapLieuBaoCao($currentUser->donvi_id);
        $donvis = [];
        if ($currentUser->is_admin) {
            $donvis = DonVi::get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        return Voyager::view($view, compact('donvis', 'tendonvi'));
    }

    // View index nhập liệu báo cáo
    public function Index_Backup(Request $request)
    {
        $this->authorize('browse_nhaplieu-baocao');
        $view = 'voyager::nhaplieu-baocao.index-backup';
        $currentUser = Auth::user();
        $tendonvi = parent::GetTenDonViHienThiNhapLieuBaoCao($currentUser->donvi_id);
        $donvis = [];
        if ($currentUser->is_admin) {
            $donvis = DonVi::get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        return Voyager::view($view, compact('donvis', 'tendonvi'));
    }

    // View index nhập liệu báo cáo
    public function Index2(Request $request)
    {

        $this->authorize('browse_nhaplieu-baocao');
        $view = 'voyager::nhaplieu-baocao.index2';
        $currentUser = Auth::user();
        $tendonvi = parent::GetTenDonViHienThiNhapLieuBaoCao($currentUser->donvi_id);
        $donvis = [];
        if ($currentUser->is_admin) {
            $donvis = DonVi::get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis', 'tendonvi', 'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }


    public function Index3(Request $request)
    {
        $this->authorize('browse_nhaplieu-baocao');
        $view = 'voyager::nhaplieu-baocao.index3';
        $currentUser = Auth::user();
        $tendonvi = parent::GetTenDonViHienThiNhapLieuBaoCao($currentUser->donvi_id);
        $donvis = [];
        if ($currentUser->is_admin) {
            $donvis = DonVi::get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis', 'tendonvi', 'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }


    public function Index4(Request $request)
    {
        $this->authorize('browse_nhaplieu-baocao');
        $view = 'voyager::nhaplieu-baocao.index4';
        $currentUser = Auth::user();
        $tendonvi = parent::GetTenDonViHienThiNhapLieuBaoCao($currentUser->donvi_id);
        $donvis = [];
        if ($currentUser->is_admin) {
            $donvis = DonVi::get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis', 'tendonvi', 'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }


    public function Index5(Request $request)
    {
        $this->authorize('browse_nhaplieu-baocao');
        $view = 'voyager::nhaplieu-baocao.index5';
        $currentUser = Auth::user();
        $tendonvi = parent::GetTenDonViHienThiNhapLieuBaoCao($currentUser->donvi_id);
        $donvis = [];
        if ($currentUser->is_admin) {
            $donvis = DonVi::get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis', 'tendonvi', 'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }


    public function Index6(Request $request)
    {
        $this->authorize('browse_nhaplieu-baocao');
        $view = 'voyager::nhaplieu-baocao.index6';
        $currentUser = Auth::user();
        $tendonvi = parent::GetTenDonViHienThiNhapLieuBaoCao($currentUser->donvi_id);
        $donvis = [];
        if ($currentUser->is_admin) {
            $donvis = DonVi::get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis', 'tendonvi', 'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }

    public function Index7(Request $request)
    {
        $this->authorize('browse_nhaplieu-baocao');
        $view = 'voyager::nhaplieu-baocao.index7';
        $currentUser = Auth::user();
        $tendonvi = parent::GetTenDonViHienThiNhapLieuBaoCao($currentUser->donvi_id);
        $donvis = [];
        if ($currentUser->is_admin) {
            $donvis = DonVi::get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis', 'tendonvi', 'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }


    public function Index8(Request $request)
    {
        $this->authorize('browse_nhaplieu-baocao');
        $view = 'voyager::nhaplieu-baocao.index8';
        $currentUser = Auth::user();
        $tendonvi = parent::GetTenDonViHienThiNhapLieuBaoCao($currentUser->donvi_id);
        $donvis = [];
        if ($currentUser->is_admin) {
            $donvis = DonVi::get();
        } else {
            $donviIdAlls = parent::GetDsDonviIds();
            $donvis = DonVi::whereIn('id', $donviIdAlls)->get();
        }
        $currentYear = Carbon::now()->year;
        $lsPosts = Posts::where('category_id', 1)->orderBy('published_at', 'desc')->get();
        $lsDonViCha = DonVi::where('id_donvi_cha', auth()->user()->donvi_id)->get();
        $donvi_id = auth()->user()->donvi_id;
        $dvh = 0;
        $dvx = 0;
        $tungay = Carbon::now()->startOfYear();
        $denngay = Carbon::now()->endOfYear();
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        return Voyager::view($view, compact('donvis', 'tendonvi', 'currentYear', 'lsPosts', 'lsDonViCha', 'donvi_id', 'dvh', 'dvx', 'tungay', 'denngay', 'dataType'));
    }


    protected function guard()
    {
        return Auth::guard(app('VoyagerGuard'));
    }
}
