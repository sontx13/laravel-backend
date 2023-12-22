<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Nhập số liệu khảo sát')
<style>
    .box_report {
        background-color: #f9fbea;
        border-top: 8px solid #067037;
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
            NHẬP SỐ LIỆU KHẢO SÁT
        </h1>
        <div class="row">
            <div class="col-sm-3">
                <div class="box_report">
                    <div class="box_left text-center">
                        <a href="/admin/pks_01" title="">
                            <span class="icon voyager-file-text"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/pks_01" title="">I. Phiếu khảo sát 01</a>
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
                        <a href="/admin/pks_02" title="">
                            <span class="icon voyager-browser"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/pks_02" title="">II. Phiếu khảo sát 02</a>
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
                        <a href="/admin/pks_03" title="">
                            <span class="icon voyager-news"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/pks_03" title="">III. Phiếu khảo sát 03</a>
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
                        <a href="/admin/pks_04" title="">
                            <span class="icon voyager-book-download"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/pks_04" title="">IV. Phiếu khảo sát 04</a>
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
                        <a href="/admin/pks_05" title="">
                            <span class="icon voyager-dashboard"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/pks_05" title="">V. Phiếu khảo sát 05</a>
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
                        <a href="/admin/pks_06" title="">
                            <span class="icon voyager-photo"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/pks_06" title="">VI. Phiếu khảo sát 06</a>
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
                        <a href="/admin/pks_07" title="">
                            <span class="icon voyager-company"></span>
                        </a>
                    </div>

                    <div class="box_right">
                        <p class="box_title">
                            <a href="/admin/pks_07" title="">VII. Phiếu khảo sát 07</a>
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
