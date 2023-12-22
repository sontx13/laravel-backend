<script>
    //-----------------Kết quả hoạt động của ban thanh tra nhân dân--------------------
          function DrawKetQuaHoatDongCuaBanThanhTraNhanDan() {
            showLoading();
            $("#content-ketqua-hoatdong-cuabanthanhtra-nhandan").empty();
            var donvi = $('#cbx-donvi').val();
            $.ajax({
                type: 'post',
                url: '/admin/ketqua-hoatdong-cuabanthanhtra-nhandan',
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
                    $("#content-ketqua-hoatdong-cuabanthanhtra-nhandan").html(response);
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
        function ShowModalThemMoiKetQuaHoatDongCuaBanThanhTraNhanDan() {
            ResetModalThemMoiKetQuaHoatDongCuaBanThanhTraNhanDan();
            $("#themoiKetQuaHoatDongCuaBanThanhTraNhanDanModal").modal('show');
        }
        function ResetModalThemMoiKetQuaHoatDongCuaBanThanhTraNhanDan() {
            //$("#txt-tenxaphuong-7").val('');
            $("#txt-socuocgiamsat-7").val('');
            $("#txt-phathiensosaipham-7").val('');
            $("#txt-sovuvieckiennghi-7").val('');
            $("#txt-thuhoitien-7").val('');
            $("#txt-xulykhacvetien-7").val('');
            $("#txt-thuhoidat-7").val('');
            $("#txt-xulykhacvedat-7").val('');
            $("#txt-kiennghixulybatcap-7").val('');
        }
        function ThemMoiKetQuaHoatDongCuaBanThanhTraNhanDan() {
            var params = {};
            params.tenxaphuong =  $("#txt-tenxaphuong-7").val();
            params.socuocgiamsat =  $("#txt-socuocgiamsat-7").val();
            params.phathiensosaipham = $("#txt-phathiensosaipham-7").val();
            params.sovuvieckiennghi = $("#txt-sovuvieckiennghi-7").val();
            params.thuhoitien = $("#txt-thuhoitien-7").val().replace(',', '');
            params.xulykhacvetien = $("#txt-xulykhacvetien-7").val().replace(',', '');
            params.thuhoidat = $("#txt-thuhoidat-7").val();
            params.xulykhacvedat = $("#txt-xulykhacvedat-7").val();
            params.kiennghixulybatcap = $("#txt-kiennghixulybatcap-7").val();
            var donvi = $('#cbx-donvi').val();
            if (!ValidateKetQuaHoatDongCuaBanThanhTraNhanDan(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/ketqua-hoatdong-cuabanthanhtra-nhandan/them-moi',
                data: {
                    "_token": "{{ csrf_token() }}",
                    tenxaphuong: params.tenxaphuong,
                    socuocgiamsat: params.socuocgiamsat,
                    phathiensosaipham: params.phathiensosaipham,
                    sovuvieckiennghi: params.sovuvieckiennghi,
                    thuhoitien: params.thuhoitien,
                    xulykhacvetien: params.xulykhacvetien,
                    thuhoidat: params.thuhoidat,
                    xulykhacvedat: params.xulykhacvedat,
                    kiennghixulybatcap: params.kiennghixulybatcap,
                    donvi: donvi,
                    quarter: $('#quarter-7').val(),
                    year: $('#year-7').val()
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Thêm mới thành công');
                            $("#themoiKetQuaHoatDongCuaBanThanhTraNhanDanModal").modal('hide');
                            DrawKetQuaHoatDongCuaBanThanhTraNhanDan();
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
        function ValidateKetQuaHoatDongCuaBanThanhTraNhanDan(params) {
            var tenxaphuong = params.tenxaphuong;
            var socuocgiamsat = params.socuocgiamsat;
            var phathiensosaipham = params.phathiensosaipham;
            var sovuvieckiennghi = params.sovuvieckiennghi;
            var thuhoitien = params.thuhoitien;
            var xulykhacvetien = params.xulykhacvetien;
            var thuhoidat = params.thuhoidat;
            var xulykhacvedat = params.xulykhacvedat;
            var kiennghixulybatcap = params.kiennghixulybatcap;
            if (!tenxaphuong || tenxaphuong == "" || tenxaphuong == '') {
                toastr.warning('Tên xã phường không được để trống');
                return false;
            }

            if ($('#txt-socuocgiamsat-7').val() == ''
                || $('#txt-phathiensosaipham-7').val() == ''
                || $('#txt-sovuvieckiennghi-7').val() == ''
                || $('#txt-thuhoitien-7').val() == ''
                || $('#txt-xulykhacvetien-7').val() == ''
                || $('#txt-thuhoidat-7').val() == ''
                || $('#txt-xulykhacvedat-7').val() == '') {
                toastr.warning('Vui lòng nhập đủ các trường thông tin');
                return false;
            }
            return true;
        }

        function ShowModalSuaKetQuaHoatDongCuaBanThanhTraNhanDan(id) {
            $.ajax({
                    type: 'post',
                    url: '/admin/ketqua-hoatdong-cuabanthanhtra-nhandan/sua-modal',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#modal-sua-ketquahoatdongcuabanthanhtranhandan").html(response);
                        $('#suaKetQuaHoatDongCuaBanThanhTraNhanDanModal').modal('show');
                    },
                    error: function(err) {
                        console.log(err);
                        toastr.error('Hiển thị modal sửa không thành công');
                    }
                });
        }

        function CapNhatKetQuaHoatDongCuaBanThanhTraNhanDan(id) {
            var params = {};
            params.tenxaphuong = $("#txt-edit-tenxaphuong-7").val();
            params.socuocgiamsat =  $("#txt-edit-socuocgiamsat-7").val();
            params.phathiensosaipham = $("#txt-edit-phathiensosaipham-7").val();
            params.sovuvieckiennghi = $("#txt-edit-sovuvieckiennghi-7").val();
            params.thuhoitien = $("#txt-edit-thuhoitien-7").val();
            params.xulykhacvetien = $("#txt-edit-xulykhacvetien-7").val();
            params.thuhoidat = $("#txt-edit-thuhoidat-7").val();
            params.xulykhacvedat = $("#txt-edit-xulykhacvedat-7").val();
            params.kiennghixulybatcap = $("#txt-edit-kiennghixulybatcap-7").val();
            if (!ValidateKetQuaHoatDongCuaBanThanhTraNhanDan(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/ketqua-hoatdong-cuabanthanhtra-nhandan/cap-nhat',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    tenxaphuong: params.tenxaphuong,
                    socuocgiamsat: params.socuocgiamsat,
                    phathiensosaipham: params.phathiensosaipham,
                    sovuvieckiennghi: params.sovuvieckiennghi,
                    thuhoitien: params.thuhoitien,
                    xulykhacvetien: params.xulykhacvetien,
                    thuhoidat: params.thuhoidat,
                    xulykhacvedat: params.xulykhacvedat,
                    kiennghixulybatcap: params.kiennghixulybatcap
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Cập nhật thành công');
                            $("#suaKetQuaHoatDongCuaBanThanhTraNhanDanModal").modal('hide');
                            DrawKetQuaHoatDongCuaBanThanhTraNhanDan();
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

        function XoaKetQuaHoatDongCuaBanThanhTraNhanDan(id) {
            swal("Bạn có chắc chắn muốn xóa bản ghi?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/ketqua-hoatdong-cuabanthanhtra-nhandan/xoa',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                DrawKetQuaHoatDongCuaBanThanhTraNhanDan();
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
        //-----------------End Kết quả hoạt động của ban thanh tra nhân dân--------------------
</script>
