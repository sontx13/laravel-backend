<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Chính quyền thân thiện')
<style>
    .box_report {
        background-color: #f9fbea;
        border-top: 8px solid #42b734;
        border-left: 1px solid #dadce0;
        border-right: 1px solid #dadce0;
        border-bottom: 1px solid #dadce0;
        padding: 10px;
        margin: 10px;
        border-radius: 4px;
        height: 100px;
    }

    .box_report .box_left {
        float: left;
        margin-right: 10px;
        padding-top: 0;
    }

    .box_report .box_left a {
        height: 70px;
        width: 70px;
        display: inline-block;
        font-size: 40px;
        color: red;
        border: 3px solid #ffa000;
    }

    .box_report .box_left a span {
        font-size: 35px;
    }

    .box_report .box_right .box_title {
        text-align: center;
        margin-top: 5px;
    }

    .box_report .box_right .box_title a {
        color: black;
        font-weight: bold;
        line-height: 26px;
        font-size: 15px;
    }

    .box_report .box_right .box_title a:hover {
        color: #ff9800;
    }

    .card-baocao {
        margin-left: 25px;
    }
</style>
@section('page_header')
    <div class="card card-baocao header">
        <h1 class="" style="font-weight:bold;color:black; font-size:27px">
            CHÍNH QUYỀN THÂN THIỆN
        </h1>
        <div class="row">
            @if(auth()->user()->hasPermission('nhaplieu_chinhquyen-thanthien') && auth()->user()->role_id != 6)
                <div class="col-sm-4">
                    <div class="box_report">
                        <div class="box_left text-center">
                            <a href="{{ route('voyager.chinhquyen-thanthien.nhaplieu') }}" title="">
                                <span class="icon voyager-browser"></span>
                            </a>
                        </div>

                        <div class="box_right">
                            <p class="box_title">
                                <a href="{{ route('voyager.chinhquyen-thanthien.nhaplieu') }}" title="">Nhập liệu cấp
                                    xã, phường, thị trấn</a>
                            </p>

                            <div class="box_information">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(auth()->user()->role_id != 6)
                <div class="col-sm-4">
                    <div class="box_report">
                        <div class="box_left text-center">
                            <a href="{{ route('voyager.chinhquyen-thanthien.baocaohuyen') }}" title="">
                                <span class="icon voyager-news"></span>
                            </a>
                        </div>

                        <div class="box_right">
                            <p class="box_title">
                                <a href="{{ route('voyager.chinhquyen-thanthien.baocaohuyen') }}" title="">Báo cáo cấp
                                    huyện</a>
                            </p>

                            <div class="box_information">
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-sm-4">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="{{ route('voyager.chinhquyen-thanthien.baocaotinh') }}" title="">
                            <span class="icon voyager-book-download"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="{{ route('voyager.chinhquyen-thanthien.baocaotinh') }}" title="">Báo cáo cấp
                                tỉnh</a>
                        </p>

                        <div class="box_information">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

<link rel="stylesheet" href="/css/style.css">
