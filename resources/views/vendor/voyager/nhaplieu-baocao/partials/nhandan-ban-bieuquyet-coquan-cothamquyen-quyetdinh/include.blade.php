<script>
    //-----------------Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định----
        function DrawNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh() {
            showLoading();
            $("#content-nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh").empty();
            var donvi = $('#cbx-donvi').val();
            $.ajax({
                type: 'post',
                url: '/admin/nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh',
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
                    $("#content-nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh").html(response);
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
        function ShowModalThemMoiNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh() {
            ResetModalThemMoiNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh();
            $("#themoiNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhModal").modal('show');
        }
        function ResetModalThemMoiNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh() {
            //$("#txt-tenxaphuong-3").val('');
            $("#txt-noidungcongviec-3").val('');
            $("#txt-coquanchutri-3").val('');
            $("#txt-hinhthucban-3").val(0).trigger('change');
            $("#txt-sophuongan-3").val('');
            $("#txt-ketquabieuquyet-3").val('');
        }
        function ThemMoiNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh() {
            var params = {};
            params.tenxaphuong =  $("#txt-tenxaphuong-3").val();
            params.noidungcongviec =  $("#txt-noidungcongviec-3").val();
            params.coquanchutri = $("#txt-coquanchutri-3").val();
            params.hinhthucban = $("#txt-hinhthucban-3").val();
            params.sophuongan = $("#txt-sophuongan-3").val();
            params.ketquabieuquyet = $("#txt-ketquabieuquyet-3").val();
            params.loaicongviec = $("#txt-loaicongviec-3").val();
            var donvi = $('#cbx-donvi').val();
            if (!ValidateNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh/them-moi',
                data: {
                    "_token": "{{ csrf_token() }}",
                    tenxaphuong: params.tenxaphuong,
                    noidungcongviec: params.noidungcongviec,
                    coquanchutri: params.coquanchutri,
                    hinhthucban: params.hinhthucban,
                    sophuongan: params.sophuongan,
                    ketquabieuquyet: params.ketquabieuquyet,
                    donvi: donvi,
                    loaicongviec: params.loaicongviec,
                    quarter: $('#quarter-3').val(),
                    year: $('#year-3').val()
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Thêm mới thành công');
                            $("#themoiNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhModal").modal('hide');
                            DrawNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh();
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
        function ValidateNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh(params) {
            var tenxaphuong = params.tenxaphuong;
            var noidungcongviec = params.noidungcongviec;
            var coquanchutri = params.coquanchutri;
            var hinhthucban = params.hinhthucban;
            var sophuongan = params.sophuongan
            var ketquabieuquyet = params.ketquabieuquyet
            if (!tenxaphuong || tenxaphuong == "" || tenxaphuong == '') {
                toastr.warning('Tên xã phường, thị trấn không được để trống');
                return false;
            }
            if (!noidungcongviec || noidungcongviec == "" || noidungcongviec == '') {
                toastr.warning('Nội dung công việc không được để trống');
                return false;
            }
            if (!coquanchutri || coquanchutri == "" || coquanchutri == '') {
                toastr.warning('Cơ quan chủ trì không được để trống');
                return false;
            }
            if (!hinhthucban || hinhthucban == "" || hinhthucban == '') {
                toastr.warning('Hình thức bàn không được để trống');
                return false;
            }
            if (!sophuongan || sophuongan == "" || sophuongan == '') {
                toastr.warning('Số phương án được chuẩn bị không được để trống');
                return false;
            }
            if (!ketquabieuquyet || ketquabieuquyet == "" || ketquabieuquyet == '') {
                toastr.warning('Kết quả biểu quyết không được để trống');
                return false;
            }
            return true;
        }

        function ShowModalSuaNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh(id) {
            $.ajax({
                    type: 'post',
                    url: '/admin/nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh/sua-modal',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#modal-sua-nhandanbancoquancothamquyenquyetdinh").html(response);
                        $('#suaNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhModal').modal('show');
                    },
                    error: function(err) {
                        console.log(err);
                        toastr.error('Hiển thị modal sửa không thành công');
                    }
                });
        }

        function CapNhatNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh(id) {
            var params = {};
            params.tenxaphuong = $("#txt-edit-tenxaphuong-3").val();
            params.noidungcongviec =  $("#txt-edit-noidungcongviec-3").val();
            params.coquanchutri = $("#txt-edit-coquanchutri-3").val();
            params.hinhthucban = $("#txt-edit-hinhthucban-3").val();
            params.sophuongan = $("#txt-edit-sophuongan-3").val();
            params.ketquabieuquyet = $("#txt-edit-ketquabieuquyet-3").val();
            if (!ValidateNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh(params)) {
                return;
            }
            $.ajax({
                type: 'post',
                url: '/admin/nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh/cap-nhat',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    tenxaphuong: params.tenxaphuong,
                    noidungcongviec: params.noidungcongviec,
                    coquanchutri: params.coquanchutri,
                    hinhthucban: params.hinhthucban,
                    sophuongan: params.sophuongan,
                    ketquabieuquyet: params.ketquabieuquyet
                },
                success: function(response) {
                    hideLoading();
                    if (response.error_code == "0") {
                            toastr.success('Cập nhật thành công');
                            $("#suaNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhModal").modal('hide');
                            DrawNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh();
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

        function XoaNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh(id) {
            swal("Bạn có chắc chắn muốn xóa bản ghi?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh/xoa',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                DrawNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh();
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
        //-----------------End Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định--------------------
</script>
