<script>
    //-----------------Kết quả huy động vốn xây dựng hậ tầng cơ sở--------------------
        function DrawKetQuaHuyDongVonXayDungHaTangCoSo() {
            showLoading();
            $("#content-ketqua-huydongvon-xaydung-hatangcoso").empty();
            var donvi = $('#cbx-donvi').val();
            $.ajax({
                type: 'post',
                url: '/admin/ketqua-huydongvon-xaydung-hatangcoso',
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
                    $("#content-ketqua-huydongvon-xaydung-hatangcoso").html(response);
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
        function ShowModalThemMoiKetQuaHuyDongVonXayDungHaTangCoSo() {
            ResetModalThemMoiKetQuaHuyDongVonXayDungHaTangCoSo();
            $("#themoiKetQuaHuyDongVonXayDungHaTangCoSoModal").modal('show');
        }
        function ResetModalThemMoiKetQuaHuyDongVonXayDungHaTangCoSo() {
            //$("#txt-tenxaphuong-5").val('');
            $("#txt-tencongtrinh-5").val('');
            $("#txt-tonggiatri-5").val('');
            $("#txt-nhandandonggop-5").val('');
            $("#txt-nhanuochotro-5").val('');
            $("#txt-ghichu-5").val('');
        }
        function ThemMoiKetQuaHuyDongVonXayDungHaTangCoSo() {
            var params = {};
            params.tenxaphuong = $("#txt-tenxaphuong-5").val();
            params.tencongtrinh = $("#txt-tencongtrinh-5").val();
            params.tonggiatri = $("#txt-tonggiatri-5").val();
            params.nhandandonggop = $("#txt-nhandandonggop-5").val();
            params.nhanuochotro = $("#txt-nhanuochotro-5").val();
            params.ghichu = $("#txt-ghichu-5").val();
            var donvi = $('#cbx-donvi').val();
            if (!ValidateKetQuaHuyDongVonXayDungHaTangCoSo(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/ketqua-huydongvon-xaydung-hatangcoso/them-moi',
                data: {
                    "_token": "{{ csrf_token() }}",
                    tenxaphuong: params.tenxaphuong,
                    tencongtrinh: params.tencongtrinh,
                    tonggiatri: params.tonggiatri,
                    nhandandonggop: params.nhandandonggop,
                    nhanuochotro: params.nhanuochotro,
                    ghichu: params.ghichu,
                    donvi: donvi,
                    quarter: $('#quarter-5').val(),
                    year: $('#year-5').val()
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Thêm mới thành công');
                            $("#themoiKetQuaHuyDongVonXayDungHaTangCoSoModal").modal('hide');
                            DrawKetQuaHuyDongVonXayDungHaTangCoSo();
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
        function ValidateKetQuaHuyDongVonXayDungHaTangCoSo(params) {
            var tenxaphuong = params.tenxaphuong;
            var tencongtrinh = params.tencongtrinh;
            var tonggiatri = params.tonggiatri;
            var nhandandonggop = params.nhandandonggop;
            var nhanuochotro = params.nhanuochotro
            if (!tenxaphuong || tenxaphuong == "" || tenxaphuong == '') {
                toastr.warning('Tên xã phường, thị trấn không được để trống');
                return false;
            }
            if (!tencongtrinh || tencongtrinh == "" || tencongtrinh == '') {
                toastr.warning('Tên công trình không được để trống');
                return false;
            }
            if (!tonggiatri || tonggiatri == "" || tonggiatri == '') {
                toastr.warning('Tổng giá trị không được để trống');
                return false;
            }
            if (!nhandandonggop || nhandandonggop == "" || nhandandonggop == '') {
                toastr.warning('Nhân dân đóng góp không được để trống');
                return false;
            }
            if (!nhanuochotro || nhanuochotro == "" || nhanuochotro == '') {
                toastr.warning('Nhà nước hỗ trợ không được để trống');
                return false;
            }
            return true;
        }

        function ShowModalSuaKetQuaHuyDongVonXayDungHaTangCoSo(id) {
            $.ajax({
                    type: 'post',
                    url: '/admin/ketqua-huydongvon-xaydung-hatangcoso/sua-modal',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#modal-sua-ketquahuydongvonxaydunghatangcoso").html(response);
                        $('#suaKetQuaHuyDongVonXayDungHaTangCoSoModal').modal('show');
                    },
                    error: function(err) {
                        console.log(err);
                        toastr.error('Hiển thị modal sửa không thành công');
                    }
                });
        }

        function CapNhatKetQuaHuyDongVonXayDungHaTangCoSo(id) {
            var params = {};
            params.tenxaphuong = $("#txt-edit-tenxaphuong-5").val();
            params.tencongtrinh =  $("#txt-edit-tencongtrinh-5").val();
            params.tonggiatri = $("#txt-edit-tonggiatri-5").val().replace(',', '');
            params.nhandandonggop = $("#txt-edit-nhandandonggop-5").val().replace(',', '');
            params.nhanuochotro = $("#txt-edit-nhanuochotro-5").val().replace(',', '');
            params.ghichu = $("#txt-edit-ghichu-5").val();
            if (!ValidateKetQuaHuyDongVonXayDungHaTangCoSo(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/ketqua-huydongvon-xaydung-hatangcoso/cap-nhat',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    tenxaphuong: params.tenxaphuong,
                    tencongtrinh: params.tencongtrinh,
                    tonggiatri: params.tonggiatri,
                    nhandandonggop: params.nhandandonggop,
                    nhanuochotro: params.nhanuochotro,
                    ghichu: params.ghichu
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Cập nhật thành công');
                            $("#suaKetQuaHuyDongVonXayDungHaTangCoSoModal").modal('hide');
                            DrawKetQuaHuyDongVonXayDungHaTangCoSo();
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

        function XoaKetQuaHuyDongVonXayDungHaTangCoSo(id) {
            swal("Bạn có chắc chắn muốn xóa bản ghi?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/ketqua-huydongvon-xaydung-hatangcoso/xoa',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                DrawKetQuaHuyDongVonXayDungHaTangCoSo();
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
        //-----------------End Kết quả huy động vốn xây dựng hạ tầng cơ sở--------------------
</script>
