
@extends('voyager::master')

@section('page_title', 'Quản trị thông báo')

@section('page_header')
<div class="card header">
    <h1 class="title-baocao">
        Thông báo
    </h1>
    <div class="row select-baocao">
        <div class="col-sm-10">
            <select id="cbx-trangthai" class="select2 form-control" onchange="drawDsThongBao()">
                <option value="-1">Tất cả</option>
                <option value="0">Chưa gửi</option>
                <option value="1">Gửi thành công</option>
                <option value="2">Gửi lỗi</option>
            </select>
        </div>
        <div class="col-sm-2">
            @can('add_thong-bao')
            <button class="btn btn-primary" onclick="ShowModalThemMoiThongBao()">Thêm mới</button>
            @endcan
        </div>
    </div>
</div>
@stop

@section('content')
<div id="ds-thongbao">
</div>
<div id="modal-sua-thongbao">
</div>

<div class="modal fade" id="themoiThongBaoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Thêm thông báo</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <span>Tiêu đề </span>
                    </div>
                    <div class="col-sm-9">
                        <textarea id="txt-tieude" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Nội dung </span>
                    </div>
                    <div class="col-sm-9">
                        <textarea id="txt-noidung" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Dữ liệu </span>
                    </div>
                    <div class="col-sm-9">
                        <textarea id="txt-dulieu" class="form-control"></textarea>
                    </div>
                </div>
                <!--
                <div class="row">
                    <div class="col-sm-3">
                        <span>Danh sách người nhận </span>
                    </div>
                    <div class="col-sm-9 cbx-nguoinhan">
                        <select id="txt-dsnguoinhan" class="form-control select2" multiple="multiple">
                            @foreach ($lsUsers as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                -->
                <div class="row">
                    <div class="col-sm-3">
                        <span>Danh sách nhóm nhận </span>
                    </div>
                    <div class="col-sm-9 dsnhomnhan">
                        @foreach ($lsRoles as $role)
                        <div>
                            <input type="checkbox" role="{{$role->name}}" />{{$role->display_name}}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-them" onclick="ThemThongBao()">Thêm</button>
            </div>
        </div>
    </div>
</div>
@stop
<link rel="stylesheet" href="/css/style.css">
@section('javascript')
<script src="/js/app.js"></script>
<script src="/js/sweetalert.min.js"></script>
<script>
        drawDsThongBao();
        function drawDsThongBao() {
            var trangthai = $("#cbx-trangthai").val();
            $("#ds-thongbao").empty();
            showLoading();
            $.ajax({
                type: 'post',
                url: '/admin/thong-bao/danh-sach',
                data: {
                    "_token": "{{ csrf_token() }}",
                    trangthai: trangthai
                },
                success: function(result) {
                    $("#ds-thongbao").html(result);
                    hideLoading();
                },
                error: function(err) {
                    console.log(err);
                    hideLoading();
                }
            });
        }
        function ShowModalThemMoiThongBao() {
            ResetValueModalThemMoi();
            $('#themoiThongBaoModal').modal('show');
        }
        function ResetValueModalThemMoi() {
            $("#txt-tieude").val('');
            $("#txt-noidung").val('');
        }

        function ThemThongBao() {
            var tieude = $("#txt-tieude").val();
            var noidung = $("#txt-noidung").val();
            var dulieu = $("#txt-dulieu").val();

            var dsNhomNhan = $(".dsnhomnhan input").toArray().reduce(function(result, currentElement) {
                if ($(currentElement).prop('checked')) {
                    return result += $(currentElement).attr("role") + ",";
                } else {
                    return result;
                }
            }, "");
            dsNhomNhan = dsNhomNhan.slice(0, -1);
            if (!tieude || tieude == "" || tieude == null) {
                toastr.warning('Tiêu đề không được để trống');
                return;
            }
            if (!noidung || noidung == "" || noidung == null) {
                toastr.warning('Nội dung không được để trống');
                return;
            }

            $.ajax({
                type: 'post',
                url: '/admin/thong-bao/them-moi',
                data: {
                    "_token": "{{ csrf_token() }}",
                    tieude: tieude,
                    noidung: noidung,
                    dulieu: dulieu,
                    nguoinhan: null,
                    nhomnhan: dsNhomNhan
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Thêm mới thành công');
                            $("#themoiThongBaoModal").modal('hide');
                            drawDsThongBao();
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
                        toastr.error('Thêm mới không thành công');
                    }
                }
            });

        }

        function ShowModalSuaThongBao(id) {
            $.ajax({
                    type: 'post',
                    url: '/admin/thong-bao/sua-modal',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#modal-sua-thongbao").html(response);
                        $('#txt-edit-dsnguoinhan').select2();
                        $('#suaThongBaoModal').modal('show');
                    },
                    error: function(err) {
                        console.log(err);
                        toastr.error('Hiển thị modal sửa không thành công');
                    }
                });
        }

        function CapNhatThongBao(id) {
            var tieude = $("#txt-edit-tieude").val();
            var noidung = $("#txt-edit-noidung").val();
            var dulieu = $("#txt-edit-dulieu").val();
            var dsNguoiNhan = $("#txt-edit-dsnguoinhan").val().reduce(function(result, currentValue) {
                return result += currentValue + ",";
            }, "");
            dsNguoiNhan = dsNguoiNhan.slice(0, -1);
            var dsNhomNhan = $(".edit-dsnhomnhan input").toArray().reduce(function(result, currentElement) {
                if ($(currentElement).prop('checked')) {
                    return result += $(currentElement).attr("role") + ",";
                } else {
                    return result;
                }
            }, "");
            dsNhomNhan = dsNhomNhan.slice(0, -1);
            if (!tieude || tieude == "" || tieude == null) {
                toastr.warning('Tiêu đề không được để trống');
                return;
            }
            if (!noidung || noidung == "" || noidung == null) {
                toastr.warning('Nội dung không được để trống');
                return;
            }
            if ((!dsNguoiNhan || dsNguoiNhan == "" || dsNguoiNhan == null ) && (!dsNhomNhan || dsNhomNhan == "" || dsNhomNhan == null ) ){
                toastr.warning('Người nhận và nhóm nhận không được cùng để trống');
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/thong-bao/cap-nhat',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    tieude: tieude,
                    noidung: noidung,
                    dulieu: dulieu,
                    nguoinhan: dsNguoiNhan,
                    nhomnhan: dsNhomNhan
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Cập nhật thành công');
                            $("#suaThongBaoModal").modal('hide');
                            drawDsThongBao();
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

        function XoaThongBao(id) {
            swal("Bạn có chắc chắn muốn xóa bản ghi?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/thong-bao/xoa',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                drawDsThongBao();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function(err) {
                            hideLoading();
                            console.log(err);
                            if (err.status == 403) {
                                toastr.error('Người dùng không có quyền thực hiện thao tác này');
                            } else {
                                toastr.error('Xóa không thành công');
                            }
                        }
                    });
                }
            })
        }

        function GuiThongBao(id) {
            swal("Bạn có chắc chắn muốn gửi thông báo này?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/thong-bao/gui',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Gửi thành công');
                            } else {
                                toastr.error(response.message);
                            }
                            drawDsThongBao();
                        },
                        error: function(err) {
                            hideLoading();
                            console.log(err);
                            if (err.status == 403) {
                                toastr.error('Người dùng không có quyền thực hiện thao tác này');
                            } else {
                                toastr.error('Gửi không thành công');
                            }
                        }
                    });
                }
            })
        }
        $( document ).ready(function() {
            $('#txt-dsnguoinhan').select2();
        });

</script>
@stop
