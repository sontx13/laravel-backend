<script>
    //-----------------Kết quả hoạt động của ban thanh tra nhân dân--------------------
          function DrawDonThuKhieuNaiToCao() {
            showLoading();
            $("#content-donthu-khieunai-tocao").empty();
            var donvi = $('#cbx-donvi').val();
            $.ajax({
                type: 'post',
                url: '/admin/donthu-khieunai-tocao',
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
                    $("#content-donthu-khieunai-tocao").html(response);
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
        function ShowModalThemMoiDonThuKhieuNaiToCao() {
            ResetModalThemMoiDonThuKhieuNaiToCao();
            $("#themoiDonThuKhieuNaiToCaoModal").modal('show');
        }
        function ResetModalThemMoiDonThuKhieuNaiToCao() {
            //$("#txt-tenxaphuong-9").val('');
            $("#txt-sodonthudatiepnhantrongkybaocao-9").val('');
            $("#txt-sodonthudatiepnhantinhtudaunam-9").val('');
            $("#txt-sodonthudagiaiquyettrongkybaocao-9").val('');
            $("#txt-sodonthudagiaiquyettinhtudaunam-9").val('');
            $("#txt-tongsodonthuchuagiaiquyet-9").val('');
            $("#txt-ghichu-9").val('');
        }
        function ThemMoiDonThuKhieuNaiToCao() {
            var params = {};
            params.tenxaphuong =  $("#txt-tenxaphuong-9").val();
            params.sodonthudatiepnhantrongkybaocao =  $("#txt-sodonthudatiepnhantrongkybaocao-9").val();
            params.sodonthudatiepnhantinhtudaunam = $("#txt-sodonthudatiepnhantinhtudaunam-9").val();
            params.sodonthudagiaiquyettrongkybaocao = $("#txt-sodonthudagiaiquyettrongkybaocao-9").val();
            params.sodonthudagiaiquyettinhtudaunam = $("#txt-sodonthudagiaiquyettinhtudaunam-9").val();
            params.tongsodonthuchuagiaiquyet = $("#txt-tongsodonthuchuagiaiquyet-9").val();
            params.ghichu = $("#txt-ghichu-9").val();
            var donvi = $('#cbx-donvi').val();
            if (!ValidateDonThuKhieuNaiToCao(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/donthu-khieunai-tocao/them-moi',
                data: {
                    "_token": "{{ csrf_token() }}",
                    tenxaphuong: params.tenxaphuong,
                    sodonthudatiepnhantrongkybaocao: params.sodonthudatiepnhantrongkybaocao,
                    sodonthudatiepnhantinhtudaunam: params.sodonthudatiepnhantinhtudaunam,
                    sodonthudagiaiquyettrongkybaocao: params.sodonthudagiaiquyettrongkybaocao,
                    sodonthudagiaiquyettinhtudaunam: params.sodonthudagiaiquyettinhtudaunam,
                    tongsodonthuchuagiaiquyet: params.tongsodonthuchuagiaiquyet,
                    ghichu: params.ghichu,
                    donvi: donvi,
                    quarter: $('#quarter-9').val(),
                    year: $('#year-9').val()
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Thêm mới thành công');
                            $("#themoiDonThuKhieuNaiToCaoModal").modal('hide');
                            DrawDonThuKhieuNaiToCao();
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
        function ValidateDonThuKhieuNaiToCao(params) {
            var tenxaphuong = params.tenxaphuong;
            if (!tenxaphuong || tenxaphuong == "" || tenxaphuong == '') {
                toastr.warning('Tên xã phường không được để trống');
                return false;
            }

            if ($('#txt-sodonthudatiepnhantrongkybaocao-9').val() == ''
                || $('#txt-sodonthudatiepnhantinhtudaunam-9').val() == ''
                || $('#txt-sodonthudagiaiquyettrongkybaocao-9').val() == ''
                || $('#txt-sodonthudagiaiquyettinhtudaunam-9').val() == ''
                || $('#txt-tongsodonthuchuagiaiquyet-9').val() == '') {
                toastr.warning('Vui lòng nhập đủ các trường thông tin');
                return false;
            }
            return true;
        }

        function ShowModalSuaDonThuKhieuNaiToCao(id) {
            $.ajax({
                    type: 'post',
                    url: '/admin/donthu-khieunai-tocao/sua-modal',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#modal-sua-donthukhieunaitocao").html(response);
                        $('#suaDonThuKhieuNaiToCaoModal').modal('show');
                    },
                    error: function(err) {
                        console.log(err);
                        toastr.error('Hiển thị modal sửa không thành công');
                    }
                });
        }

        function CapNhatDonThuKhieuNaiToCao(id) {
            var params = {};
            params.tenxaphuong =  $("#txt-edit-tenxaphuong-9").val();
            params.sodonthudatiepnhantrongkybaocao =  $("#txt-edit-sodonthudatiepnhantrongkybaocao-9").val();
            params.sodonthudatiepnhantinhtudaunam = $("#txt-edit-sodonthudatiepnhantinhtudaunam-9").val();
            params.sodonthudagiaiquyettrongkybaocao = $("#txt-edit-sodonthudagiaiquyettrongkybaocao-9").val();
            params.sodonthudagiaiquyettinhtudaunam = $("#txt-edit-sodonthudagiaiquyettinhtudaunam-9").val();
            params.tongsodonthuchuagiaiquyet = $("#txt-edit-tongsodonthuchuagiaiquyet-9").val();
            if (!ValidateDonThuKhieuNaiToCao(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/donthu-khieunai-tocao/cap-nhat',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    tenxaphuong: params.tenxaphuong,
                    sodonthudatiepnhantrongkybaocao: params.sodonthudatiepnhantrongkybaocao,
                    sodonthudatiepnhantinhtudaunam: params.sodonthudatiepnhantinhtudaunam,
                    sodonthudagiaiquyettrongkybaocao: params.sodonthudagiaiquyettrongkybaocao,
                    sodonthudagiaiquyettinhtudaunam: params.sodonthudagiaiquyettinhtudaunam,
                    tongsodonthuchuagiaiquyet: params.tongsodonthuchuagiaiquyet,
                    ghichu: params.ghichu
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Cập nhật thành công');
                            $("#suaDonThuKhieuNaiToCaoModal").modal('hide');
                            DrawDonThuKhieuNaiToCao();
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

        function XoaDonThuKhieuNaiToCao(id) {
            swal("Bạn có chắc chắn muốn xóa bản ghi?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/donthu-khieunai-tocao/xoa',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                DrawDonThuKhieuNaiToCao();
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
        //-----------------End Đơn thư khiếu nại--------------------
</script>
