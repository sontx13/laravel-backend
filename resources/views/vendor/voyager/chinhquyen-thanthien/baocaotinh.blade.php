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

    .select2-container {
        border: 1px solid;
    }
    .text-left{
        font-weight: normal;
    }
    .card-baocao{
        padding: 0 5em;
    }
</style>
@section('page_header')
    <div class="card card-baocao header">
        <h2 class="" style="font-weight:bold;color:black; font-size:27px">
            Báo cáo cấp tỉnh
        </h2>
        <form method="GET" id="fm-report" action="{{ route('voyager.chinhquyen-thanthien.baocaotinh') }}"
              target="_blank">
            <div class="col-sm-3"></div>
            <div class="col-sm-1" style="margin-top: 8px;">Năm</div>
            <div class="col-sm-2">
                <select id="year" class="select2" name="year">
                    @foreach ($lsYears as $year1)
                        <option value="{{ $year1 }}" {{ $year1 == $year ? 'selected' : '' }}>
                            {{ $year1 }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" style="margin-top: 0;" class="btn btn-success chitiet">Xem báo cáo
                </button>
            </div>
            <div class="col-sm-4"></div>

        </form>
        <br/>
        <br/>
        <div class="row">
            <table class="table table-bordered" border="1">
                <thead>
                <tr>
                    <th class="text-center bold" style="width: 50px">TT</th>
                    <th class="text-center bold" style="width: 30%">Tên huyện</th>
                    <th class="text-center bold" style="width: 15%">Số xã nhập hồ sơ</th>
                    <th class="text-center bold">Gửi lên huyện</th>
                    <th class="text-center bold">Gửi lên tỉnh</th>
                    <th class="text-center bold">Được phê duyệt</th>
                    <th class="text-center bold">Từ chối hồ sơ</th>
                    <th class="text-center bold">#</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data))
                    @foreach ($data as $key => $value)
                        <tr>
                            <td class="text-left">{{ $value->stt }}</td>
                            <td class="text-left">{{ $value->ten_donvi }}</td>
                            <td class="text-left">{{ $value->sohoso }}</td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                            <td class="text-left"></td>
                            <td class="text-left">
                                <a target="_blank" href="{{ route('voyager.chinhquyen-thanthien.baocaohuyen', [ 'donvi_id' => $value->id, 'year' => $year ]) }}">Xem chi tiết</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

    </div>
@stop

<link rel="stylesheet" href="/css/style.css">
