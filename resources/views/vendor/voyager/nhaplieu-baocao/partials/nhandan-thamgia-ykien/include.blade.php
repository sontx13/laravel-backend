<script>
    //-----------------Nhân dân tham gia ý kiến--------------------


    function DrawNhanDanThamGiaYKien() {
        showLoading();
        $("#content-nhandan-thamgia-ykien").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/admin/nhandan-thamgia-ykien',
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
                $("#content-nhandan-thamgia-ykien").html(response);
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

    function ShowModalThemMoiNhanDanThamGiaYKien() {
        ResetModalThemMoiNhanDanThamGiaYKien();
        $.ajax({
            type: 'post',
            url: '/admin/nhandan-thamgia-ykien/noidung',
            success: function(response) {
                for (let i = 0; i < response.length; i++) {
                    $('#noidung').append('<option value="' + response[i].muc + '">' + response[i].muc +
                        '-' +
                        response[i].noidung +
                        '</option>');
                }

                $("#themoiNhanDanThamGiaYKienModal").modal('show');
            },
            error: function(err) {
                console.log(err);
                toastr.error('Hiển thị modal thêm mới không thành công');
            }
        });
    }
    var urlKeHoach;

    function UploadFile() {
        var fileName = $('#txt-kehoach-4').val();
        var fileExtension = fileName.split('.').pop().toLowerCase();

        var allowedExtensions = ['pdf'];

        if ($.inArray(fileExtension, allowedExtensions) === -1) {
            toastr.warning('Chỉ chấp nhận file PDF');
            $('#txt-kehoach-4').val('');
        } else {
            var formData = new FormData();
            formData.append('file', $("#txt-kehoach-4")[0].files[0]);
            $.ajax({
                url: '/admin/nhandan-thamgia-ykien/upload',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    urlKeHoach = response
                },
                error: function(xhr, status, error) {
                    toastr.warning('Chỉ chấp nhận file PDF');
                    $('#txt-kehoach-4').val('');
                }
            });
        }


    }
    var urlDuThao;

    function UploadFile3() {
        var fileName = $('#txt-duthao-4').val();
        var fileExtension = fileName.split('.').pop().toLowerCase();

        var allowedExtensions = ['pdf'];

        if ($.inArray(fileExtension, allowedExtensions) === -1) {
            toastr.warning('Chỉ chấp nhận file PDF');
            $('#txt-duthao-4').val('');
        } else {
            var formData = new FormData();
            formData.append('file', $("#txt-duthao-4")[0].files[0]);
            $.ajax({
                url: '/admin/nhandan-thamgia-ykien/upload',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    urlDuThao = response
                    console.log(urlDuThao)
                },
                error: function(xhr, status, error) {
                    toastr.warning('Chỉ chấp nhận file PDF');
                    $('#txt-duthao-4').val('');
                }
            });
        }


    }
    var urlBaocao;

    function UploadFile2() {
        var fileName = $('#txt-baocao-4').val();
        var fileExtension = fileName.split('.').pop().toLowerCase();

        var allowedExtensions = ['pdf'];

        if ($.inArray(fileExtension, allowedExtensions) === -1) {
            toastr.warning('Chỉ chấp nhận file PDF');
            $('#txt-baocao-4').val('');
        } else {
            var formData = new FormData();
            formData.append('file', $("#txt-baocao-4")[0].files[0]);
            $.ajax({
                url: '/admin/nhandan-thamgia-ykien/upload',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    urlBaocao = response
                },
                error: function(xhr, status, error) {
                    toastr.warning('Chỉ chấp nhận file PDF');
                    $('#txt-baocao-4').val('');
                }
            });
        }
    }

    function ResetModalThemMoiNhanDanThamGiaYKien() {
        //$("#txt-tenxaphuong-4").val('');
        $("#txt-noidungxinykien-4").val('');
        $("#txt-coquanchutri-4").val('');
        $("#txt-hinhthucthamgiaykien-4").val(0).trigger('change');
        $("#txt-ghichu-4").val('');
    }

    function ThemMoiNhanDanThamGiaYKien() {
        var jsonData = JSON.stringify(selectedValues);
        var params = {};
        params.tenxaphuong = $("#txt-tenxaphuong-4").val();
        params.noidungxinykien = $("#noidung").val();
        params.coquanchutri = $("#txt-coquanchutri-4").val();
        params.hinhthucthamgiaykien = jsonData;
        params.ghichu = $("#txt-ghichu-4").val();
        params.tomtat = $("#txt-tomtat-4").val();
        params.kehoach = urlKeHoach;
        params.duthao = urlDuThao;
        params.tungay = $("#txt-tungay-4").val();
        params.denngay = $("#txt-denngay-4").val();
        params.ykienthamgia = $("#txt-ykienthamgia-4").val();
        params.ykientiepthu = $("#txt-ykientiepthu-4").val();
        params.baocao = urlBaocao;
        var donvi = $('#cbx-donvi').val();
        console.log(params.baocao)
        $.ajax({
            type: 'post',
            url: '/admin/nhandan-thamgia-ykien/them-moi',
            data: {
                "_token": "{{ csrf_token() }}",
                tenxaphuong: params.tenxaphuong,
                noidungxinykien: params.noidungxinykien,
                coquanchutri: params.coquanchutri,
                hinhthucthamgiaykien: params.hinhthucthamgiaykien,
                ghichu: params.ghichu,
                donvi: donvi,
                tomtat: params.tomtat,
                kehoach: params.kehoach,
                duthao: params.duthao,
                tungay: params.tungay,
                denngay: params.denngay,
                ykienthamgia: params.ykienthamgia,
                ykientiepthu: params.ykientiepthu,
                baocao: params.baocao,
                quarter: $('#quarter-4').val(),
                year: $('#year-4').val()
            },
            success: function(response) {
                hideLoading();
                if (response.error_code == "0") {
                    toastr.success('Thêm mới thành công');
                    $("#themoiNhanDanThamGiaYKienModal").modal('hide');
                    DrawNhanDanThamGiaYKien();
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


    function ShowModalSuaNhanDanThamGiaYKien(id) {
        $.ajax({
            type: 'post',
            url: '/admin/nhandan-thamgia-ykien/sua-modal',
            data: {
                id: id
            },
            success: function(response) {
                $("#modal-sua-nhandanthamgiaykien").html(response);
                $('#suaNhanDanThamGiaYKienModal').modal('show');
            },
            error: function(err) {
                console.log(err);
                toastr.error('Hiển thị modal sửa không thành công');
            }
        });
    }

    function ShowModalSuaNhanDanThamGiaYKien(id) {
        $.ajax({
            type: 'post',
            url: '/admin/nhandan-thamgia-ykien/noidung',
            data: {
                id: id
            },
            success: function(response) {
                $("#modal-sua-nhandanthamgiaykien").html(response);
                $('#suaNhanDanThamGiaYKienModal').modal('show');
            },
            error: function(err) {
                console.log(err);
                toastr.error('Hiển thị modal sửa không thành công');
            }
        });
    }

    function CapNhatNhanDanThamGiaYKien(id) {
        var params = {};
        params.tenxaphuong = $("#txt-edit-tenxaphuong-4").val();
        params.noidungxinykien = $("#txt-edit-noidungxinykien-4").val();
        params.coquanchutri = $("#txt-edit-coquanchutri-4").val();
        params.hinhthucthamgiaykien = $("#txt-edit-hinhthucthamgiaykien-4").val();
        params.ghichu = $("#txt-edit-ghichu-4").val();
        $.ajax({
            type: 'post',
            url: '/admin/nhandan-thamgia-ykien/cap-nhat',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                tenxaphuong: params.tenxaphuong,
                noidungxinykien: params.noidungxinykien,
                coquanchutri: params.coquanchutri,
                hinhthucthamgiaykien: params.hinhthucthamgiaykien,
                ghichu: params.ghichu,
            },
            success: function(response) {
                hideLoading();
                if (response.error_code == "0") {
                    toastr.success('Cập nhật thành công');
                    $("#suaNhanDanThamGiaYKienModal").modal('hide');
                    DrawNhanDanThamGiaYKien();
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

    function XoaNhanDanThamGiaYKien(id) {
        swal("Bạn có chắc chắn muốn xóa bản ghi?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/nhandan-thamgia-ykien/xoa',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                DrawNhanDanThamGiaYKien();
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
    //-----------------End Nhân dân tham gia ý kiến--------------------
</script>
