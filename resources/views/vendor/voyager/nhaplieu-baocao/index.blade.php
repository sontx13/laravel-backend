<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Nhập số liệu dân chủ')
<style>
    .box_report {
        background-color: #f9fbea;
        border-top: 8px solid #ff9800;
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
</style>
@section('page_header')
    <div class="card card-baocao header">
        <h1 class="" style="font-weight:bold;color:black; font-size:27px">
            NHẬP SỐ LIỆU QUY CHẾ DÂN CHỦ
        </h1>
        <div class="row">
            <div class="col-sm-3">
                <div class="box_report" style="display: flex;align-items: center;">
                    <div class=" text-center">
                        <a href="/admin/ketqua-thuchien-congkhai-new" title="">
                            <img style="   height: 70px;width: 70px; margin-right:1rem"
                                src="https://qcdc.bacgiang.gov.vn/documents/11619891/17930266/1694680401094_congkhai.png" />
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/ketqua-thuchien-congkhai-new" title="">I. Kết quả
                                thực hiện công khai</a>
                        </p>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/nhaplieu-baocao-2" title="">
                            <span class="icon voyager-browser"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/nhaplieu-baocao-2" title="">II. Nhân dân bàn và
                                quyết định </a>
                        </p>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/nhaplieu-baocao-3" title="">
                            <span class="icon voyager-news"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/nhaplieu-baocao-3" title="">III. Nhân dân tham gia
                                ý kiến</a>
                        </p>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/nhaplieu-baocao-4" title="">
                            <span class="icon voyager-book-download"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/nhaplieu-baocao-4" title="">IV. Nhân dân kiểm tra
                                giám sát</a>
                        </p>

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
                        <a href="/admin/nhaplieu-baocao-5" title="">
                            <span class="icon voyager-dashboard"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/nhaplieu-baocao-5" title="">V.Ban thanh tra nhân
                                dân</a>
                        </p>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/nhaplieu-baocao-6" title="">
                            <span class="icon voyager-photo"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/nhaplieu-baocao-6" title="">VI. Ban giám sát đầu tư
                                của cộng đồng</a>
                        </p>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/nhaplieu-baocao-7" title="">
                            <span class="icon voyager-company"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/nhaplieu-baocao-7" title="">VII. Đơn thư khiếu nại,
                                tố cáo</a>
                        </p>

                        <div class="box_information">
                            <p> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/nhaplieu-baocao-8" title="">
                            <span class="icon voyager-bar-chart"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/nhaplieu-baocao-8" title="">VIII.
                                Họp thôn, bản, tổ dân
                                phố</a>
                        </p>

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
