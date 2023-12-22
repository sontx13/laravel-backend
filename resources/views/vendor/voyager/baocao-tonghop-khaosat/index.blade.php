<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Khảo sát')

@section('page_header')

<div class="baocao-khaosat">
    <div class="container-fluid xem-khao-sat">
        {{-- @foreach ($lsKhaoSats as $khaosat)
            <div class="box-khaosat">
                <div class="flex-box-survey">
                    <img class="img-khaosat-box" src="/images/khaosat.png" alt="khaosat" />
                    <a href="{{url('/pakn/xem-khao-sat-webview/chi-tiet/'.$khaosat->id)}}" class="name-survey">
        {{$khaosat->ten_khaosat}}
        </a>
    </div>
</div>
@endforeach --}}
<div class="box-khaosat">
    <div class="flex-box-survey">
        <img class="img-khaosat-box" src="/images/khaosat.png" alt="khaosat" />
        <a href="{{url('/admin/baocao-ks-tonghop')}}" class="name-survey">
            Báo cáo tổng hợp
        </a>
    </div>

    <div class="flex-box-survey">
        <img class="img-khaosat-box" src="/images/khaosat.png" alt="khaosat" />
        <a href="{{url('/admin/baocao-ks-chitiet')}}" class="name-survey">
            Báo cáo chi tiết
        </a>
    </div>
    <div class="flex-box-survey">
        <img class="img-khaosat-box" src="/images/khaosat.png" alt="khaosat" />
        <a href="{{url('/admin/ketqua_hotro_huongdan_motcua-webview')}}" class="name-survey">
            Báo cáo kết quả hướng dẫn
        </a>
    </div>
</div>

</div>

</div>

@stop
<link rel="stylesheet" href="/css/style.css">