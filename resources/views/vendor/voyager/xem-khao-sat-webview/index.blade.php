<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Khảo sát')

@section('page_header')
<div class="card">
    <h1 class="title-PAKN">
        Báo cáo Kháo sát
    </h1>
</div>
@stop

@section('content')
<div id="ds-khaosat">
</div>
<div id="modal-sua-khaosat">
</div>
@stop
<link rel="stylesheet" href="/css/style.css">
@section('javascript')
{{-- <script src="/js/app.js"></script> --}}
<script src="/js/sweetalert.min.js"></script>
<script>
    drawDsPAKN();
    function drawDsPAKN() {
        $("#ds-khaosat").empty();
        showLoading();
        $.ajax({
            type: 'post',
            url: '/pakn/xem-khao-sat-webview',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(result) {
                $("#ds-khaosat").html(result);
                hideLoading();
            },
            error: function(err) {
                console.log(err);
                hideLoading();
            }
        });
    }
</script>
@stop
