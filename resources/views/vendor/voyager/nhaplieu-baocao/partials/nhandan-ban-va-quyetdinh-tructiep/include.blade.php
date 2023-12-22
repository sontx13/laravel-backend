<script>
    //-----------------Nhân dân bàn và quyết định trực tiếp--------------------




    function DrawNhanDanBanVaQuyetDinhTrucTiep() {
        console.log("DrawNhanDanBanVaQuyetDinhTrucTiep");

        showLoading();
        $("#content-nhandan-ban-va-quyetdinh-tructiep").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/admin/nhandan-ban-va-quyetdinh-tructiep',
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
                $("#content-nhandan-ban-va-quyetdinh-tructiep").html(response);
            },
            error: function(err) {
                console.log(err);
                hideLoading();
                if (err.status == 403) {
                    toastr.error('Người dùng không có quyền thực hiện thao tác này');
                } else {
                    toastr.error('Hiển thị kết quả thực hiện công khai không thành công');
                }
            }
        });
    }

    function ShowModalThemMoiNhanDanBanVaQuyetDinhTrucTiep() {
        ResetModalThemMoiNhanDanBanVaQuyetDinhTrucTiep();
        $("#themoiNhanDanBanVaQuyetDinhTrucTiepModal").modal('show');
    }

    function ResetModalThemMoiNhanDanBanVaQuyetDinhTrucTiep() {
        //$("#txt-tenxaphuong-2").val('');
        $("#txt-noidungcongviec-2").val('');
        $("#txt-coquanchutri-2").val('');
        $("#txt-hinhthucban-2").val(0).trigger('change');
        $("#txt-sophuongan-2").val('');
        $("#txt-ketquabieuquyet-2").val('');
    }

    function formatNumberDefault(value) {
        let cleanedNumber = value.replace(/[^\d]/g, '');
        return cleanedNumber;
    }

    function ThemMoiNhanDanBanVaQuyetDinhTrucTiep() {
        var params = {};
        params.tenxaphuong = $("#txt-tenxaphuong-2").val();
        params.noidungcongviec = $("#txt-noidungcongviec-2").val();
        params.coquanchutri = $("#txt-coquanchutri-2").val();
        params.hinhthucban = $("#txt-hinhthucban-2").val();
        params.sophuongan = $("#txt-sophuongan-2").val();
        params.tomtat = $("#txt-tomtatnoidung-2").val();
        params.ketquabieuquyet = $("#txt-ketquabieuquyet-2").val();
        params.tonggiatri = formatNumberDefault($("#txt-tonggiatri-2").val());
        params.nsnn = formatNumberDefault($("#txt-nsnn-2").val());
        params.nddg = formatNumberDefault($("#txt-nddg-2").val());
        params.ngaycong = formatNumberDefault($("#txt-ngaycong-2").val());
        params.khac = $("#txt-khac-2").val();
        params.tongso = formatNumberDefault($("#txt-tongso-2").val());
        params.sophieu = formatNumberDefault($("#txt-sophieu-2").val());
        var donvi = $('#cbx-donvi').val();
        if (!ValidateNhanDanBanVaQuyetDinhTrucTiep(params)) {
            return;
        }
        $.ajax({
            type: 'post',
            url: '/admin/nhandan-ban-va-quyetdinh-tructiep/them-moi',
            data: {
                "_token": "{{ csrf_token() }}",
                tenxaphuong: params.tenxaphuong,
                noidungcongviec: params.noidungcongviec,
                coquanchutri: params.coquanchutri,
                hinhthucban: params.hinhthucban,
                sophuongan: params.sophuongan,
                ketquabieuquyet: params.ketquabieuquyet,
                tomtat: params.tomtat,
                tonggiatri: params.tonggiatri,
                nsnn: params.nsnn,
                nddg: params.nddg,
                ngaycong: params.ngaycong,
                khac: params.khac,
                sophieu: params.sophieu,
                tongso: params.tongso,
                donvi: donvi,
                quarter: $('#quarter-2').val(),
                year: $('#year-2').val()
            },
            success: function(response) {
                hideLoading();
                if (response.error_code == "0") {
                    toastr.success('Thêm mới thành công');
                    $("#themoiNhanDanBanVaQuyetDinhTrucTiepModal").modal('hide');
                    DrawNhanDanBanVaQuyetDinhTrucTiep();
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

    function ValidateNhanDanBanVaQuyetDinhTrucTiep(params) {
        var tenxaphuong = params.tenxaphuong;
        var noidungcongviec = params.noidungcongviec;
        var coquanchutri = params.coquanchutri;
        var hinhthucban = params.hinhthucban;
        var sophuongan = params.sophuongan
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
        return true;
    }

    function ShowModalSuaNhanDanBanVaQuyetDinhTrucTiep(id) {

        $.ajax({
            type: 'post',
            url: '/admin/nhandan-ban-va-quyetdinh-tructiep/sua-modal',
            data: {
                id: id
            },
            success: function(response) {

                $("#modal-sua-nhandanbanvaquyetdinh").html(response);
                $('#suaNhanDanBanVaQuyetDinhTrucTiepModal').modal('show');


            },
            error: function(err) {
                console.log(err);
                toastr.error('Hiển thị modal sửa không thành công');
            }
        });
    }

    function CapNhatNhanDanBanVaQuyetDinhTrucTiep(id) {
        var params = {};
        params.tenxaphuong = $("#txt-edit-tenxaphuong-2").val();
        params.noidungcongviec = $("#txt-edit-noidungcongviec-2").val();
        params.coquanchutri = $("#txt-edit-coquanchutri-2").val();
        params.hinhthucban = $("#txt-edit-hinhthucban-2").val();
        params.sophuongan = $("#txt-edit-sophuongan-2").val();
        params.ketquabieuquyet = $("#txt-edit-ketquabieuquyet-2").val();
        params.tomtat = $("#txt-tomtatnoidung-2").val();
        params.tonggiatri = formatNumberDefault($("#txt-tonggiatri-2").val());
        params.nsnn = formatNumberDefault($("#txt-nsnn-2").val());
        params.nddg = formatNumberDefault($("#txt-nddg-2").val());
        params.ngaycong = formatNumberDefault($("#txt-ngaycong-2").val());
        params.khac = $("#txt-khac-2").val();
        params.tongso = formatNumberDefault($("#txt-tongso-2").val());
        params.sophieu = formatNumberDefault($("#txt-sophieu-2").val());
        if (!ValidateNhanDanBanVaQuyetDinhTrucTiep(params)) {
            return;
        }
        $.ajax({
            type: 'post',
            url: '/admin/nhandan-ban-va-quyetdinh-tructiep/cap-nhat',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                tenxaphuong: params.tenxaphuong,
                noidungcongviec: params.noidungcongviec,
                coquanchutri: params.coquanchutri,
                hinhthucban: params.hinhthucban,
                sophuongan: params.sophuongan,
                ketquabieuquyet: params.ketquabieuquyet,
                tomtat: params.tomtat,
                tonggiatri: params.tonggiatri,
                nsnn: params.nsnn,
                nddg: params.nddg,
                ngaycong: params.ngaycong,
                khac: params.khac,
                sophieu: params.sophieu,
                tongso: params.tongso,
            },
            success: function(response) {
                hideLoading();
                if (response.error_code == "0") {
                    toastr.success('Cập nhật thành công');
                    $("#suaNhanDanBanVaQuyetDinhTrucTiepModal").modal('hide');
                    DrawNhanDanBanVaQuyetDinhTrucTiep();
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

    function XoaNhanDanBanVaQuyetDinhTrucTiep(id) {
        swal("Bạn có chắc chắn muốn xóa bản ghi?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/nhandan-ban-va-quyetdinh-tructiep/xoa',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                DrawNhanDanBanVaQuyetDinhTrucTiep();
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
    //-----------------End Nhân dân bàn và quyết định trực tiếp--------------------
</script>
