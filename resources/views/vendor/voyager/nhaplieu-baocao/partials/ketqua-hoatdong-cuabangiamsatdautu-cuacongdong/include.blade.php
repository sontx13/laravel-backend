<script>
    //-----------------Kết quả hoạt động của ban thanh tra nhân dân--------------------
          function DrawKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong() {
            showLoading();
            $("#content-ketqua-hoatdong-cuabangiamsatdautu-cuacongdong").empty();
            var donvi = $('#cbx-donvi').val();
            $.ajax({
                type: 'post',
                url: '/admin/ketqua-hoatdong-cuabangiamsatdautu-cuacongdong',
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
                    $("#content-ketqua-hoatdong-cuabangiamsatdautu-cuacongdong").html(response);
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
        function ShowModalThemMoiKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong() {
            ResetModalThemMoiKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong();
            $("#themoiKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongModal").modal('show');
        }
        function ResetModalThemMoiKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong() {
            //$("#txt-tenxaphuong-8").val('');
            $("#txt-socongtrinh-8").val('');
            $("#txt-socuocgiamsat-8").val('');
            $("#txt-phathiensosaipham-8").val('');
            $("#txt-sovuvieckiennghi-8").val('');
            $("#txt-thuhoitien-8").val('');
            $("#txt-giamtruquyettoan-8").val('');
            $("#txt-xulykhac-8").val('');
        }
        function ThemMoiKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong() {
            var params = {};
            params.tenxaphuong =  $("#txt-tenxaphuong-8").val();
            params.socongtrinh =  $("#txt-socongtrinh-8").val();
            params.socuocgiamsat = $("#txt-socuocgiamsat-8").val();
            params.phathiensosaipham = $("#txt-phathiensosaipham-8").val();
            params.sovuvieckiennghi = $("#txt-sovuvieckiennghi-8").val();
            params.thuhoitien = $("#txt-thuhoitien-8").val().replace(',', '');
            params.giamtruquyettoan = $("#txt-giamtruquyettoan-8").val().replace(',', '');
            params.xulykhac = $("#txt-xulykhac-8").val().replace(',', '');
            var donvi = $('#cbx-donvi').val();
            if (!ValidateKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/ketqua-hoatdong-cuabangiamsatdautu-cuacongdong/them-moi',
                data: {
                    "_token": "{{ csrf_token() }}",
                    tenxaphuong: params.tenxaphuong,
                    socongtrinh: params.socongtrinh,
                    socuocgiamsat: params.socuocgiamsat,
                    phathiensosaipham: params.phathiensosaipham,
                    sovuvieckiennghi: params.sovuvieckiennghi,
                    thuhoitien: params.thuhoitien,
                    giamtruquyettoan: params.giamtruquyettoan,
                    xulykhac: params.xulykhac,
                    donvi: donvi,
                    quarter: $('#quarter-8').val(),
                    year: $('#year-8').val()
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Thêm mới thành công');
                            $("#themoiKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongModal").modal('hide');
                            DrawKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong();
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
        function ValidateKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong(params) {
            var tenxaphuong = params.tenxaphuong;
            var socongtrinh = params.socongtrinh;
            var socuocgiamsat = params.socuocgiamsat;
            var phathiensosaipham = params.phathiensosaipham;
            var sovuvieckiennghi = params.sovuvieckiennghi;
            var thuhoitien = params.thuhoitien;
            var giamtruquyettoan = params.giamtruquyettoan;
            var xulykhac = params.xulykhac;
            if (!tenxaphuong || tenxaphuong == "" || tenxaphuong == '') {
                toastr.warning('Tên xã phường không được để trống');
                return false;
            }

            if ($('#txt-socongtrinh-8').val() == ''
                || $('#txt-socuocgiamsat-8').val() == ''
                || $('#txt-phathiensosaipham-8').val() == ''
                || $('#txt-sovuvieckiennghi-8').val() == ''
                || $('#txt-thuhoitien-8').val() == ''
                || $('#txt-giamtruquyettoan-8').val() == ''
                || $('#txt-xulykhac-8').val() == '') {
                toastr.warning('Vui lòng nhập đủ các trường thông tin');
                return false;
            }

            return true;
        }

        function ShowModalSuaKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong(id) {
            $.ajax({
                    type: 'post',
                    url: '/admin/ketqua-hoatdong-cuabangiamsatdautu-cuacongdong/sua-modal',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#modal-sua-ketquahoatdongcuabangiamsatdautucuacongdong").html(response);
                        $('#suaKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongModal').modal('show');
                    },
                    error: function(err) {
                        console.log(err);
                        toastr.error('Hiển thị modal sửa không thành công');
                    }
                });
        }

        function CapNhatKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong(id) {
            var params = {};
            params.tenxaphuong =  $("#txt-edit-tenxaphuong-8").val();
            params.socongtrinh =  $("#txt-edit-socongtrinh-8").val();
            params.socuocgiamsat = $("#txt-edit-socuocgiamsat-8").val();
            params.phathiensosaipham = $("#txt-edit-phathiensosaipham-8").val();
            params.sovuvieckiennghi = $("#txt-edit-sovuvieckiennghi-8").val();
            params.thuhoitien = $("#txt-edit-thuhoitien-8").val();
            params.giamtruquyettoan = $("#txt-edit-giamtruquyettoan-8").val();
            params.xulykhac = $("#txt-edit-xulykhac-8").val();
            if (!ValidateKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/ketqua-hoatdong-cuabangiamsatdautu-cuacongdong/cap-nhat',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    tenxaphuong: params.tenxaphuong,
                    socongtrinh: params.socongtrinh,
                    socuocgiamsat: params.socuocgiamsat,
                    phathiensosaipham: params.phathiensosaipham,
                    sovuvieckiennghi: params.sovuvieckiennghi,
                    thuhoitien: params.thuhoitien,
                    giamtruquyettoan: params.giamtruquyettoan,
                    xulykhac: params.xulykhac
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Cập nhật thành công');
                            $("#suaKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongModal").modal('hide');
                            DrawKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong();
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

        function XoaKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong(id) {
            swal("Bạn có chắc chắn muốn xóa bản ghi?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/ketqua-hoatdong-cuabangiamsatdautu-cuacongdong/xoa',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                DrawKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong();
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
        //-----------------End Kết quả hoạt động của ban giám sát đầu tư của cộng đồng--------------------
</script>
