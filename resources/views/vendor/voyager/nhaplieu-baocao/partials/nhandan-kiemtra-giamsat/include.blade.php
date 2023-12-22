<script>
    //-----------------Nhân dân tham gia ý kiến--------------------
          function DrawNhanDanKiemTraGiamSat() {
            showLoading();
            $("#content-nhandan-kiemtra-giamsat").empty();
            var donvi = $('#cbx-donvi').val();
            $.ajax({
                type: 'post',
                url: '/admin/nhandan-kiemtra-giamsat',
                data: {
                    "_token": "{{ csrf_token() }}",
                    isxembaocao: isXemBaocao,
                    donvi: donvi,
                    donvicha: $('#donviIdHuyen').val(),
                    quarter: $('#quarter').val(),
                    year: $('#year').val()
                },
                success: function(response) {
                    hideLoading();
                    $("#content-nhandan-kiemtra-giamsat").html(response);
                },
                error: function(err) {
                    console.log(err);
                    hideLoading();
                    if (err.status == 403) {
                        toastr.error('Người dùng không có quyền thực hiện thao tác này');
                    } else {
                        toastr.error('Hiển thị danh sách không thành công');
                    }
                }
            });
        }
        function ShowModalThemMoiNhanDanKiemTraGiamSat() {
            ResetModalThemMoiNhanDanKiemTraGiamSat();
            $("#themoiNhanDanKiemTraGiamSatModal").modal('show');
        }
        function ResetModalThemMoiNhanDanKiemTraGiamSat() {
            $("#txt-noidunggiamsat-6").val('');
            $("#txt-coquanthuchien-6").val('0');
            $("#txt-soykiencapuy-6").val('');
            $("#txt-soykienchinhquyen-6").val('');
            $("#txt-soykienkhac-6").val('');
            $("#txt-ghichu-6").val('');
        }
        function ThemMoiNhanDanKiemTraGiamSat() {
            var params = {};
            params.noidunggiamsat =  $("#txt-noidunggiamsat-6").val();
            params.coquanthuchien =  $("#txt-coquanthuchien-6").val();
            params.soykiencapuy = $("#txt-soykiencapuy-6").val();
            params.soykienchinhquyen = $("#txt-soykienchinhquyen-6").val();
            params.soykienkhac = $("#txt-soykienkhac-6").val();
            params.ghichu = $("#txt-ghichu-6").val();
            var donvi = $('#cbx-donvi').val();
            if (!ValidateNhanDanKiemTraGiamSat(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/nhandan-kiemtra-giamsat/them-moi',
                data: {
                    "_token": "{{ csrf_token() }}",
                    noidunggiamsat: params.noidunggiamsat,
                    coquanthuchien: params.coquanthuchien,
                    soykiencapuy: params.soykiencapuy,
                    soykienchinhquyen: params.soykienchinhquyen,
                    soykienkhac: params.soykienkhac,
                    ghichu: params.ghichu,
                    donvi: donvi,
                    quarter: $('#quarter-6').val(),
                    year: $('#year-6').val()
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Thêm mới thành công');
                            $("#themoiNhanDanKiemTraGiamSatModal").modal('hide');
                            DrawNhanDanKiemTraGiamSat();
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
        function ValidateNhanDanKiemTraGiamSat(params) {
            var noidunggiamsat = params.noidunggiamsat;
            var coquanthuchien = params.coquanthuchien;
            var soykiencapuy = params.soykiencapuy;
            var soykienchinhquyen = params.soykienchinhquyen;
            var soykiencapuy = params.soykiencapuy;
            var soykienkhac = params.soykienkhac;
            if (!noidunggiamsat || noidunggiamsat == "" || noidunggiamsat == '') {
                toastr.warning('Nội dung giám sát không được để trống');
                return false;
            }
            if (!coquanthuchien || coquanthuchien == "" || coquanthuchien == '') {
                toastr.warning('Cơ quan thực hiện không được để trống');
                return false;
            }

            if ($('#txt-soykiencapuy-6').val() == ''
                || $('#txt-soykienchinhquyen-6').val() == ''
                || $('#txt-soykienkhac-6').val() == '') {
                toastr.warning('Vui lòng nhập đủ các trường thông tin');
                return false;
            }

            return true;
        }

        function ShowModalSuaNhanDanKiemTraGiamSat(id) {
            $.ajax({
                    type: 'post',
                    url: '/admin/nhandan-kiemtra-giamsat/sua-modal',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#modal-sua-nhandankiemtragiamsat").html(response);
                        $('#suaNhanDanKiemTraGiamSatModal').modal('show');
                    },
                    error: function(err) {
                        console.log(err);
                        toastr.error('Hiển thị modal sửa không thành công');
                    }
                });
        }

        function CapNhatNhanDanKiemTraGiamSat(id) {
            var params = {};
            params.noidunggiamsat = $("#txt-edit-noidunggiamsat-6").val();
            params.coquanthuchien =  $("#txt-edit-coquanthuchien-6").val();
            params.soykiencapuy = $("#txt-edit-soykiencapuy-6").val();
            params.soykienchinhquyen = $("#txt-edit-soykienchinhquyen-6").val();
            params.soykienkhac = $("#txt-edit-soykienkhac-6").val();
            params.ghichu = $("#txt-edit-ghichu-6").val();
            if (!ValidateNhanDanKiemTraGiamSat(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/nhandan-kiemtra-giamsat/cap-nhat',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    noidunggiamsat: params.noidunggiamsat,
                    coquanthuchien: params.coquanthuchien,
                    soykiencapuy: params.soykiencapuy,
                    soykienchinhquyen: params.soykienchinhquyen,
                    soykienkhac: params.soykienkhac,
                    ghichu: params.ghichu,
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Cập nhật thành công');
                            $("#suaNhanDanKiemTraGiamSatModal").modal('hide');
                            DrawNhanDanKiemTraGiamSat();
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

        function XoaNhanDanKiemTraGiamSat(id) {
            swal("Bạn có chắc chắn muốn xóa bản ghi?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/nhandan-kiemtra-giamsat/xoa',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                DrawNhanDanKiemTraGiamSat();
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
        //-----------------End Nhân dân kiểm tra giám sát--------------------
</script>
