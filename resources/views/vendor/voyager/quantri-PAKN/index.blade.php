<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Quản trị phản ánh kiến nghị')

@section('page_header')
    <div class="card">
        <h1 class="title-baocao">
            Phản ánh kiến nghị
        </h1>
        <div class="row select-baocao">
            <div class="col-sm-1">
                <span>Từ khóa</span>
            </div>
            <div class="col-sm-3">
                <input type="text" id="keyword" name="keyword" class="input-full" value="" onchange="drawDsPAKN(1)" />
            </div>
            <div class="col-sm-1">
                <span>TT Xử lý</span>
            </div>
            <div class="col-sm-2">
                <select id="cbx-trangthai-xuly" class="select2 form-control" onchange="drawDsPAKN(1)">
                    <option value="-1">Tất cả</option>
                    <option value="0">Chưa xử lý</option>
                    <option value="1">Đang xử lý</option>
                    <option value="2">Đã xử lý</option>
                </select>
            </div>
            <div class="col-sm-1">
                <span>TT Công khai</span>
            </div>
            <div class="col-sm-2">
                <select id="cbx-trangthai-congkhai" class="select2 form-control" onchange="drawDsPAKN(1)">
                    <option value="-1">Tất cả</option>
                    <option value="0">Không công khai</option>
                    <option value="1">Công khai</option>
                </select>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div id="ds-pakn">
    </div>
    <div id="modal-sua-pakn">
    </div>
@stop
<link rel="stylesheet" href="/css/style.css">
@section('javascript')
    <script src="/js/app.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script>
        drawDsPAKN(1);

        function drawDsPAKN(pagenumber) {
            $("#ds-pakn").empty();
            var ttxuly = $("#cbx-trangthai-xuly").val();
            var ttcongkhai = $("#cbx-trangthai-congkhai").val();
            var keyword = $("#keyword").val();
            showLoading();
            $.ajax({
                type: 'post',
                url: '/admin/quan-tri-pakn/danh-sach',
                data: {
                    "_token": "{{ csrf_token() }}",
                    pagenumber: pagenumber,
                    ttxuly: ttxuly,
                    ttcongkhai: ttcongkhai,
                    keyword: keyword
                },
                success: function (result) {
                    $("#ds-pakn").html(result);
                    hideLoading();
                },
                error: function (err) {
                    console.log(err);
                    hideLoading();
                }
            });
        }

        function ShowModalSuaPAKN(id) {
            $.ajax({
                type: 'post',
                url: '/admin/quan-tri-pakn/sua-modal',
                data: {
                    id: id
                },
                success: function (response) {
                    $("#modal-sua-pakn").html(response);
                    $('#txt-edit-dsnguoinhan').select2();
                    $('#suaPAKNModal').modal('show');
                },
                error: function (err) {
                    console.log(err);
                    toastr.error('Hiển thị modal sửa không thành công');
                }
            });
        }

        function CapNhatPAKN(id) {
            var traloi = $("#txt-traloi").val();
            var ttxuly = $("#cbx-trangthai-xuly-edit").val();
            var ttcongkhai = $("#cbx-trangthai-congkhai-edit").val();
            $.ajax({
                type: 'post',
                url: '/admin/quan-tri-pakn/cap-nhap',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    traloi: traloi,
                    ttxuly: ttxuly,
                    ttcongkhai: ttcongkhai
                },
                success: function (response) {
                    hideLoading();
                    if (response.error_code == "0") {
                        toastr.success('Cập nhật thành công');
                        $("#suaPAKNModal").modal('hide');
                        drawDsPAKN(pageNumber);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (err) {
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
