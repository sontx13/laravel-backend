<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Báo cáo số liệu dân chủ')
<style>
    .box_report {
        background-color: #f9fbea;
        border-top: 8px solid #00c0ff;
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
        color: #4d00ff;
        border: 3px solid #00bafa;
    }

    .box_report .box_left a span {
        font-size: 35px;
    }

    .box_report .box_right .box_title {
        text-align: center;
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
</style>
@section('page_header')
    <div class="card card-baocao header">
        <h1 class="head-color">
            BÁO CÁO SỐ LIỆU DÂN CHỦ
        </h1>
        <div class="row">
            <div class="col-sm-3">
                <div class="box_report">
                    <div class=" text-center">
                        <a href="/admin/ketqua-thuchien-congkhai-new?checkTH=1" title="">
                            <img style="   height: 70px;width: 70px; margin-right:1rem"
                                src="https://qcdc.bacgiang.gov.vn/documents/11619891/17930266/1694680401094_congkhai.png" />
                        </a>
                    </div>

                    <div class="box_right">
                        <h4 class="box_title">
                            <a href="/admin/ketqua-thuchien-congkhai-new?checkTH=1" title="">I. Kết quả
                                thực hiện công khai</a>
                        </h4>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/xem-nhaplieu-baocao-2" title="">
                            <span class="icon voyager-browser"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <h4 class="box_title">
                            <a href="/admin/xem-nhaplieu-baocao-2" title="">II. Nhân dân bàn và
                                quyết định </a>
                        </h4>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/xem-nhaplieu-baocao-3" title="">
                            <span class="icon voyager-news"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <h4 class="box_title">
                            <a href="/admin/xem-nhaplieu-baocao-3" title="">III. Nhân dân tham gia
                                ý kiến</a>
                        </h4>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/xem-nhaplieu-baocao-4" title="">
                            <span class="icon voyager-book-download"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <h4 class="box_title">
                            <a href="/admin/xem-nhaplieu-baocao-4" title="">IV. Nhân dân kiểm tra
                                giám sát</a>
                        </h4>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/xem-nhaplieu-baocao-5" title="">
                            <span class="icon voyager-dashboard"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <h4 class="box_title">
                            <a href="/admin/xem-nhaplieu-baocao-5" title="">V. Ban thanh tra nhân
                                dân</a>
                        </h4>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/xem-nhaplieu-baocao-6" title="">
                            <span class="icon voyager-photo"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <h4 class="box_title">
                            <a href="/admin/xem-nhaplieu-baocao-6" title="">VI. Ban giám sát đầu tư
                                của cộng đồng</a>
                        </h4>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/xem-nhaplieu-baocao-7" title="">
                            <span class="icon voyager-company"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <h4 class="box_title">
                            <a href="/admin/xem-nhaplieu-baocao-7" title="">VII. Đơn thư khiếu nại,
                                tố cáo</a>
                        </h4>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/xem-nhaplieu-baocao-8" title="">
                            <span class="icon voyager-bar-chart"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <h4 class="box_title">
                            <a href="/admin/xem-nhaplieu-baocao-8" title="">VIII.
                                Họp thôn, bản, tổ dân
                                phố</a>
                        </h4>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

<link rel="stylesheet" href="/css/style.css">
