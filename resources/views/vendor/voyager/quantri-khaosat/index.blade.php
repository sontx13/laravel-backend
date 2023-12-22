<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Quản trị khảo sát')

@section('page_header')
<div class="card">
    <h1 class="title-baocao">
        Khảo sát
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
<script src="/js/app.js"></script>
<script src="/js/sweetalert.min.js"></script>
<script>
    drawDsKhaoSat();
        function drawDsKhaoSat() {
            $("#ds-khaosat").empty();
            showLoading();
            $.ajax({
                type: 'post',
                url: '/admin/khao-sat/danh-sach',
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
        function ShowModalSuaKhaoSat(id) {
            $.ajax({
                    type: 'post',
                    url: '/admin/khao-sat/sua-modal',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#modal-sua-khaosat").html(response);
                        $('#suaKhaoSatModal').modal('show');
                    },
                    error: function(err) {
                        console.log(err);
                        toastr.error('Hiển thị modal sửa không thành công');
                    }
                });
        }

        function CapNhatKhaoSat(id) {
            var trangthai = $("#txt-edit-trangthai").val();
            var ngaybatdau = $("#txt-edit-ngaybatdau").val();
            var ngayketthuc = $("#txt-edit-ngayketthuc").val();
            $.ajax({
                type: 'post',
                url: '/admin/khao-sat/cap-nhat',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    trangthai: trangthai,
                    ngaybatdau: ngaybatdau,
                    ngayketthuc: ngayketthuc
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Cập nhật thành công');
                            $("#suaKhaoSatModal").modal('hide');
                            drawDsKhaoSat();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(err) {
                    console.log(err);
                    hideLoading();
                    if (err.status == 403) {
                        toastr.error('Người dùng không có quyền thực hiện thao tác này');
                    } else {
                        toastr.error('Cập nhật không thành công');
                    }
                }
            });
        }
</script>
@stop
