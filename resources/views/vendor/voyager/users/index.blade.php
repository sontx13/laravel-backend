<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Người dùng')
@section('page_header')
    <form method="get" action="{{ route('voyager.users.index') }}">
        <div class="container-fluid card header">
            <h1 class="title-baocao">
                Danh sách người dùng
            </h1>
            <div class="row select-baocao">
                <div class="col-sm-1">
                    <span>Đơn vị</span>
                </div>
                <div class="col-sm-3">
                    <select id="donviid" name="donviid" class="select2">
                        <option value="0">-- Chưa chọn --</option>
                        @foreach ($donvis as $donvi)
                            <option value="{{$donvi->id}}" {{ ($donvi->id == $donviid ? 'selected' : '') }}>{{$donvi->ten_donvi}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-1">
                    <span>Từ khóa</span>
                </div>
                <div class="col-sm-3">
                    <input type="text" id="keyword" name="keyword" class="input-full" value="{{ $keyword }}"/>
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-info btn-add-new">Tìm kiếm</button>
                </div>
                <div class="col-sm-2">
                    <a class="btn btn-success btn-add-new" onclick="ShowPopupThemMoiUser()">Thêm mới</a>
                </div>
            </div>
        </div>
    </form>
@stop

@section('content')
    <div class="container-fluid">
        <div id="ds-user">
            <table class="table table-bordered table-hover table-stripper">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên đăng nhập</th>
                    <th>Họ và tên</th>
                    <th>Đơn vị</th>
                    <th>Huyện</th>
                    <th>Trạng thái</th>
                    <th>Xử lý</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lsUsers as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if ($user->donvi != null)
                                {{$user->donvi->ten_donvi}}
                            @endif
                        </td>
                        <td>
                            @if ($user->donvi != null && $user->donvi->cap_donvi == 3)
                                @php
                                    $donViCha = \App\Models\DonVi::where('id', $user->donvi->id_donvi_cha)->first();
                                @endphp
                                {{$donViCha->ten_donvi}}
                            @endif
                                @if ($user->donvi != null && $user->donvi->cap_donvi == 2)
                                    {{$user->donvi->ten_donvi}}
                                @endif
                        </td>
                        <td>
                            <span class="form-control {{App\Http\Controllers\Voyager\UserController::GetClassTTNguoiDung($user->status)}}">{{App\Http\Controllers\Voyager\UserController::GetDisplayTTNguoiDung($user->status)}}</span>
                        </td>
                        <td>
                            <a href="javascript:void(0)" onclick="ChuyenTrangThaiNguoiDung({{$user->id}})" title="Chuyển trạng thái"><i class="glyphicon glyphicon-refresh icon icon-chuyentt"></i></a>
                            <a href="javascript:void(0)" onclick="ShowPopupSuaUser({{$user->id}})" title="Sửa"><i class="glyphicon glyphicon-option-horizontal icon icon-edit"></i></a>
                            <a href="javascript:void(0)" onclick="ShowPopupXoaUser({{$user->id}})" title="Xóa"><i class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                            <a href="javascript:void(0)" onclick="ResetPassword({{$user->id}})" title="Đặt về mật khẩu mặc định"><i class="glyphicon glyphicon-repeat icon icon-reset-mk"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $lsUsers->links("pagination::bootstrap-4") !!}
        </div>
    </div>
    <div id="modal-sua">

    </div>
    <div class="modal fade" id="themoiUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-large-size modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
              <span class="modal-title" id="themmoiModalLabel">Thêm mới người dùng</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Họ tên </span><span class="required">(*)</span>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="txt-hoten" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Tên đăng nhập</span><span class="required">(*)</span>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="txt-tendangnhap" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Đơn vị</span><span class="required">(*)</span>
                        </div>
                        <div class="col-sm-9 width-full">
                            <select id="txt-dvi" class="form-control select2">
                                @foreach ($donvis as $donvi)
                                    <option value="{{$donvi->id}}">{{$donvi->ten_donvi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Đơn vị phụ</span>
                        </div>
                        <div class="col-sm-9 width-full">
                            <select id="txt-donviphu" class="form-control" multiple="multiple">
                                @foreach ($donvis as $donvi)
                                    <option value="{{$donvi->id}}">{{$donvi->ten_donvi}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Vai trò </span><span class="required">(*)</span>
                        </div>
                        <div class="col-sm-9 width-full">
                            <select id="txt-vaitro" class="form-control select2">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Vai trò phụ</span>
                        </div>
                        <div class="col-sm-9 width-full">
                            <select id="txt-vaitrophu" class="form-control select2" multiple="multiple">
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Địa chỉ</span>
                        </div>
                        <div class="col-sm-9 width-full">
                            <input type="text" id="txt-diachi" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Là cán bộ</span>
                        </div>
                        <div class="col-sm-9 width-full">
                            <select id="txt-iscanbo" class="form-control select2">
                                <option selected value="0">Không</option>
                                <option value="1">Có</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary btn-them" onclick="ThemMoiUser()">Thêm</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="{{ voyager_asset('lib/css/responsive.dataTables.min.css') }}"> --}}
    {{-- @if(!$dataType->server_side && config('dashboard.data_tables.responsive'))
    @endif --}}
@stop
@include('voyager::loading.spin')
<link rel="stylesheet" href="/css/style.css">
@section('javascript')
    <script src="/js/app.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <!-- DataTables -->
    {{-- @if(!$dataType->server_side && config('dashboard.data_tables.responsive'))
        <script src="{{ voyager_asset('lib/js/dataTables.responsive.min.js') }}"></script>

    @endif --}}
    <script>


        function ShowPopupThemMoiUser() {
            ResetModalThemMoi();
            $("#themoiUserModal").modal('show');
        }

        function ThemMoiUser() {
            var hoten = $("#txt-hoten").val();
            var tendangnhap = $("#txt-tendangnhap").val();
            var donvi = $("#txt-dvi").val();
            var donviphu = $("#txt-donviphu").val();
            var vaitro = $("#txt-vaitro").val();
            var vaitrophu = $("#txt-vaitrophu").val();
            var diachi = $("#txt-diachi").val();
            var iscanbo = $("#txt-iscanbo").val();
            if (ValidateUser(hoten, tendangnhap, donvi, vaitro)) {
                $.ajax({
                    type: 'post',
                    url: '/admin/user/them-moi',
                    data: {
                        hoten: hoten,
                        tendangnhap: tendangnhap,
                        donvi: donvi,
                        donviphu: donviphu,
                        vaitro: vaitro,
                        vaitrophu: vaitrophu,
                        diachi: diachi,
                        iscanbo: iscanbo
                    },
                    success: function (response) {
                        if (response.error_code == 0) {
                            toastr.success('Thêm mới người dùng thành công');
                            $('#themoiUserModal').modal('hide');
                            drawDsUser();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (err) {
                        console.log(err);
                        toastr.error('Thêm mới người dùng không thành công');
                    }
                });
            }
        }

        function ValidateUser(hoten, tendangnhap, donvi, vaitro) {
            if (!hoten || hoten == "" || hoten == '' || hoten == null) {
                toastr.warning('Họ tên người dùng không được để trống');
                return false;
            }
            if (!tendangnhap || tendangnhap == "" || tendangnhap == '' || tendangnhap == null) {
                toastr.warning('Tên đăng nhập không được để trống');
                return false;
            }
            if (!donvi || donvi == "" || donvi == '' || donvi == null) {
                toastr.warning('Đơn vị không được để trống');
                return false;
            }
            if (!vaitro || vaitro == "" || vaitro == '' || vaitro == null || vaitro == 0) {
                toastr.warning('Vai trò không được để trống');
                return false;
            }
            return true;
        }

        function ResetModalThemMoi() {
            $("#txt-hoten").val('');
            $("#txt-tendangnhap").val('');
        }

        function ShowPopupSuaUser(userid) {
            $.ajax({
                type: 'post',
                url: '/admin/user/sua-modal',
                data: {
                    userid: userid
                },
                success: function (response) {
                    $("#modal-sua").html(response);
                    $('#txt-edit-dvi').select2();
                    $('#txt-edit-donviphu').select2();
                    $('#txt-edit-vaitro').select2();
                    $('#txt-edit-vaitrophu').select2();
                    $('#suaUserModal').modal('show');
                },
                error: function (err) {
                    console.log(err);
                    toastr.error('Hiển thị modal sửa người dùng không thành công');
                }
            });
        }

        function ShowPopupXoaUser(userid) {
            swal("Bạn có chắc chắn muốn xóa người dùng?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
                .then((value) => {
                    if (value) {
                        $.ajax({
                            type: 'post',
                            url: '/admin/user/xoa',
                            data: {
                                userid: userid
                            },
                            success: function (response) {
                                if (response.error_code == 0) {
                                    toastr.success('Xóa người dùng thành công');
                                    drawDsUser();
                                } else {
                                    toastr.error(response.message);
                                }
                            },
                            error: function (err) {
                                console.log(err);
                                toastr.error('Xóa người dùng không thành công');
                            }
                        });
                    }
                })
        }

        function UpdateUser(userid) {
            var hoten = $("#txt-edit-hoten").val();
            var tendangnhap = $("#txt-edit-tendangnhap").val();
            var donvi = $("#txt-edit-dvi").val();
            var donviphu = $("#txt-edit-donviphu").val();
            var vaitro = $("#txt-edit-vaitro").val();
            var vaitrophu = $("#txt-edit-vaitrophu").val();
            var diachi = $("#txt-edit-diachi").val();
            var iscanbo = $("#txt-edit-iscanbo").val();
            if (ValidateUser(hoten, tendangnhap, donvi, vaitro)) {
                $.ajax({
                    type: 'post',
                    url: '/admin/user/cap-nhat',
                    data: {
                        userid: userid,
                        hoten: hoten,
                        tendangnhap: tendangnhap,
                        donvi: donvi,
                        donviphu: donviphu,
                        vaitro: vaitro,
                        vaitrophu: vaitrophu,
                        diachi: diachi,
                        iscanbo: iscanbo
                    },
                    success: function (response) {
                        if (response.error_code == 0) {
                            toastr.success('Cập nhật người dùng thành công');
                            $('#suaUserModal').modal('hide');
                            drawDsUser();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (err) {
                        console.log(err);
                        toastr.error('Cập nhật người dùng không thành công');
                    }
                });
            }
        }

        function ChuyenTrangThaiNguoiDung(userid) {
            $.ajax({
                type: 'post',
                url: '/admin/user/chuyen-trangthai',
                data: {
                    userid: userid
                },
                success: function (response) {
                    if (response.error_code == 0) {
                        toastr.success('Chuyển trạng thái người dùng thành công');
                        drawDsUser();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (err) {
                    console.log(err);
                    toastr.error('Chuyển trạng thái người dùng không thành công');
                }
            });
        }

        function PreviewImage(event, selector) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById(selector);
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function RemoveEditAvatar() {
            $('#edit-file-avatar').val('');
            $('#edit-img-avatar').attr("src", " ");
        }

        function RemoveAvatar() {
            $('#file-avatar').val('');
            $('#img-avatar').attr("src", " ");
        }

        function ResetPassword(userid) {
            swal("Bạn có chắc chắn muốn đặt lại mật khẩu mặc định cho người dùng?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
                .then((value) => {
                    if (value) {
                        $.ajax({
                            type: 'post',
                            url: '/admin/user/resetpassword',
                            data: {
                                userid: userid
                            },
                            success: function (response) {
                                if (response.error_code == 0) {
                                    toastr.success('Đặt lại mật khẩu mặc định thành công');
                                } else {
                                    toastr.error(response.message);
                                }
                            },
                            error: function (err) {
                                console.log(err);
                                toastr.error('Đặt lại mật khẩu mặc định không thành công');
                            }
                        });
                    }
                })
        }

        $(document).ready(function () {
            drawDsUser();
            $('#txt-dvi').select2();
            $('#txt-donviphu').select2();
            $('#txt-vaitro').select2();
            $('#txt-vaitrophu').select2();
        });
    </script>
@stop
