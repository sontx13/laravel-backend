<!DOCTYPE html>
<script>
    //-----------------Kết quả thực hiện công khai--------------------
    // -- Vẽ các loại báo cáo
    var fileCongKhaiId = 0;

    function DrawKetQuaThucHienCongKhai() {
        showLoading();
        $("#content-ketqua-thuchien-congkhai").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-thuchien-congkhai',
            data: {
                "_token": "{{ csrf_token() }}",
                isxembaocao: isXemBaocao,
                donvi: donvi,
                donvicha: $('#donviIdHuyen').val(),
                quarter: $('#quarter').val(),
                year: $('#year').val()
            },
            success: function (response) {
                hideLoading();
                $("#content-ketqua-thuchien-congkhai").html(response);
            },
            error: function (err) {
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

    function ShowModalThemMoiKetQuaThucHienCongKhai() {
        ResetModalThemMoiKetQuaThucHienCongKhai();
        $("#themoiKetQuaThucHienCongKhaiModal").modal('show');
    }

    function InitControlModalThemMoiKetQuaThucHienCongKhai() {
        // hình thức công khai - mutile select
        $("txt-hinhthuccongkhai-1").select2();
        // ngày văn bản
        $("#txt-ngayvanban-1").datetimepicker({
            format: 'DD/MM/YYYY'
        });
        // ngày công khai
        $("#txt-ngaycongkhai-1").datetimepicker({
            format: 'DD/MM/YYYY'
        });
    }

    function ChonFileKeHoachCongKhaiUpload() {
        var file = $('#txt-filecongkhai-1').prop('files');
        if (file.length > 0) {
            $('#txt-tenfilecongkhai-1').text(file[0].name);
        } else {
            $('#txt-tenfilecongkhai-1').text('');
        }
    }

    function ResetModalThemMoiKetQuaThucHienCongKhai() {
        //$("#txt-tenxaphuong-1").val('');
        $("#txt-noidungcongkhai-1").val('');
        $("#txt-coquanthuchiencongkhai-1").val('');
        $("#txt-hinhthuccongkhai-1").val(0).trigger('change');
        $("#txt-sokehoachcongkhai-1").val('');
        $("#txt-kyhieukehoachcongkhai-1").val('');
        $('#txt-ngayvanban-1').data('DateTimePicker').date(null);
        $("#txt-coquanbanhanh-1").val('');
        $('#txt-ngaycongkhai-1').data('DateTimePicker').date(null);
        $("#txt-filecongkhai-1").val('');
        $("#txt-ghichu-1").val('');
    }

    function ThemMoiKetQuaThucHienCongKhai() {
        var params = {};

        params.noidungcongkhai = $("#txt-noidungcongkhai-1").val();
        params.coquanthuchiencongkhai = $("#txt-coquanthuchiencongkhai-1").val();
        params.hinhthuccongkhai = $("#txt-hinhthuccongkhai-1").val();
        params.sokehoachcongkhai = $("#txt-sokehoachcongkhai-1").val();
        params.kyhieukehoachcongkhai = $("#txt-kyhieukehoachcongkhai-1").val();
        var datevanban = $("#txt-ngayvanban-1").data("DateTimePicker").date();
        params.ngayvanban = datevanban != null ? datevanban.format("DD/MM/YYYY") : "";
        params.coquanbanhanh = $("#txt-coquanbanhanh-1").val();
        var datecongkhai = $("#txt-ngaycongkhai-1").data("DateTimePicker").date();
        params.ngaycongkhai = datecongkhai != null ? datecongkhai.format("DD/MM/YYYY") : "";
        params.filecongkhai = $("#filecongkhai-path-1").val();
        params.ghichu = $("#txt-ghichu-1").val();

        if (!ValidateKetQuaThucHienCongKhai(params)) {
            return;
        }
        // lấy nội dung file từ input file
        if (params.filecongkhai.length > 0) {
            var reader = new FileReader();
            reader.readAsDataURL(params.filecongkhai[0]);
            reader.onload = function () {
                console.log(reader.result);
                params.fileconkhaibase64 = reader.result;
                params.tenfilecongkhai = params.filecongkhai[0].name;
                CallApiThemMoiKetQuaThucHienCongKhai(params);
            };
            reader.onerror = function (error) {
                toastr.error('Đính kèm file không thành công');
            };
        } else {
            CallApiThemMoiKetQuaThucHienCongKhai(params);
        }
    }

    function UploadFileCongKhai() {
        var filecongkhai = $("#txt-filecongkhai-1").prop("files");
        if (filecongkhai.length <= 0) {
            toastr.warning('file đính kèm không được để trống');
            return false;
        }
        var fd = new FormData();
        for (var index = 0; index < filecongkhai.length; index++) {
            fd.append('file_' + index, filecongkhai[index]);
        }
        $.ajax({
            url: '/admin/file/upload',
            data: fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (response) {
                if (response.error_code == '0') {
                    toastr.success('Upload file thành công');
                    $('#filecongkhai-path-1').val(response.file_path);

                    $('.listfile-1').attr('href', response.file_path);
                    $('.listfile-1').text(response.file_path);

                    $('.currentfile-1').show();
                    $('.upload-1').hide();
                } else {
                    toastr.success(response.message);
                }
            },
            error: function (error) {
                if (error.status == 403) {
                    toastr.error('Người dùng không có quyền thực hiện thao tác này');
                } else {
                    toastr.error('Upload file không thành công');
                }
                // hideLoading();
            }
        });

    }

    function CallApiThemMoiKetQuaThucHienCongKhai(params) {
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-thuchien-congkhai/them-moi',
            data: {
                "_token": "{{ csrf_token() }}",
                tenxaphuong: params.tenxaphuong,
                noidungcongkhai: params.noidungcongkhai,
                coquanthuchiencongkhai: params.coquanthuchiencongkhai,
                hinhthuccongkhai: params.hinhthuccongkhai.join(','),
                sokehoachcongkhai: params.sokehoachcongkhai,
                kyhieukehoachcongkhai: params.sokehoachcongkhai,
                ngayvanban: params.ngayvanban,
                coquanbanhanh: params.coquanbanhanh,
                ngaycongkhai: params.ngaycongkhai,
                filecongkhai: params.filecongkhai,
                tenfilecongkhai: params.tenfilecongkhai,
                ghichu: params.ghichu
            },
            success: function (response) {
                hideLoading();
                if (response.error_code == "0") {
                    toastr.success('Thêm mới thành công');
                    $("#themoiKetQuaThucHienCongKhaiModal").modal('hide');
                    DrawKetQuaThucHienCongKhai();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (err) {
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

    function ValidateKetQuaThucHienCongKhai(params) {

        var noidungcongkhai = params.noidungcongkhai;
        var coquanthuchiencongkhai = params.coquanthuchiencongkhai;
        var hinhthuccongkhai = params.hinhthuccongkhai;
        var congkhaitheosokehoach = params.congkhaitheosokehoach;
        if (!noidungcongkhai || noidungcongkhai == "" || noidungcongkhai == '') {
            toastr.warning('Nội dung công khai không được để trống');
            return false;
        }
        if (!coquanthuchiencongkhai || coquanthuchiencongkhai == "" || coquanthuchiencongkhai == '') {
            toastr.warning('Cơ quan thực hiện công khai không được để trống');

            return false;
        }
        return true;
    }


    function ShowModalSuaKetQuaThucHienCongKhai(id) {
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-thuchien-congkhai/sua-modal',
            data: {
                id: id
            },
            success: function (response) {
                $("#modal-sua-ketquathuchien").html(response);
                $('#suaKetQuaThucHienCongKhaiModal').modal('show');
            },
            error: function (err) {
                console.log(err);
                toastr.error('Hiển thị modal sửa kết quả thực hiện công khai không thành công');
            }
        });
    }

    function ShowAddEditKQTHCK(id) {
        $.ajax({
            type: 'post',
            url: '{{route('voyager.kqthck.add-edit')}}',
            data: {
                id: id
            },
            success: function (response) {
                $("#modal-sua-ketquathuchien").html(response);
                $('#AddEditKetQuaThucHienCongKhaiModal').modal('show');
            },
            error: function (err) {
                console.log(err);
                toastr.error('Hiển thị modal sửa kết quả thực hiện công khai không thành công');
            }
        });
    }

    function CapNhatKetQuaThucHienCongKhai(id) {
        var params = {};
        params.tenxaphuong = $("#txt-edit-tenxaphuong-1").val();
        params.noidungcongkhai = $("#txt-edit-noidungcongkhai-1").val();
        params.coquanthuchiencongkhai = $("#txt-edit-coquanthuchiencongkhai-1").val();
        params.hinhthuccongkhai = $("#txt-edit-hinhthuccongkhai-1").val();
        params.congkhaitheosokehoach = $("#txt-edit-congkhaitheokehoachso-1").val();
        params.ghichu = $("#txt-edit-ghichu-1").val();
        if (!ValidateKetQuaThucHienCongKhai(params)) {
            return;
        }
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-thuchien-congkhai/cap-nhat',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                tenxaphuong: params.tenxaphuong,
                noidungcongkhai: params.noidungcongkhai,
                coquanthuchiencongkhai: params.coquanthuchiencongkhai,
                hinhthuccongkhai: params.hinhthuccongkhai,
                congkhaitheosokehoach: params.congkhaitheosokehoach,
                ghichu: params.ghichu
            },
            success: function (response) {
                hideLoading();
                if (response.error_code == "0") {
                    toastr.success('Cập nhật thành công');
                    $("#suaKetQuaThucHienCongKhaiModal").modal('hide');
                    DrawKetQuaThucHienCongKhai();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (err) {
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

    function XoaKetQuaThucHienCongKhai(id) {
        swal("Bạn có chắc chắn muốn xóa bản ghi?", {
            buttons: ["Không", "Có"],
            dangerMode: true
        })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/ketqua-thuchien-congkhai/xoa',
                        data: {
                            id: id
                        },
                        success: function (response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                DrawKetQuaThucHienCongKhai();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (err) {
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

    //-----------------End Kết quả thực hiện công khai--------------------

    function AddEditKetQuaThucHienCongKhai(id) {
        var params = {};
        params.tenxaphuong = $("#txt-tenxaphuong-1").val()
        params.noidungcongkhai = $("#txt-noidungcongkhai-1").val();
        params.coquanthuchiencongkhai = $("#txt-coquanthuchiencongkhai-1").val();
        params.hinhthuccongkhai = $("#txt-hinhthuccongkhai-1").val();
        params.sokehoachcongkhai = $("#txt-sokehoachcongkhai-1").val();
        params.kyhieukehoachcongkhai = $("#txt-kyhieukehoachcongkhai-1").val();
        var datevanban = $("#txt-ngayvanban-1").data("DateTimePicker").date();
        params.ngayvanban = datevanban != null ? datevanban.format("DD/MM/YYYY") : "";
        params.coquanbanhanh = $("#txt-coquanbanhanh-1").val();

        params.filecongkhai = $("#filecongkhai-path-1").val();
        params.ghichu = $("#txt-ghichu-1").val();

        if (!ValidateKetQuaThucHienCongKhai(params)) {
            return;
        }
        $.ajax({
            type: 'post',
            url: "{{route('voyager.kqthck.add-edit-submit')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                tenxaphuong: params.tenxaphuong,
                noidungcongkhai: params.noidungcongkhai,
                coquanthuchiencongkhai: params.coquanthuchiencongkhai,
                hinhthuccongkhai: params.hinhthuccongkhai.join(','),
                sokehoachcongkhai: params.sokehoachcongkhai,
                kyhieukehoachcongkhai: params.sokehoachcongkhai,
                ngayvanban: params.ngayvanban,
                coquanbanhanh: params.coquanbanhanh,
                filecongkhai: params.filecongkhai,
                ghichu: params.ghichu,
                quarter: $('#quarter-1').val(),
                year: $('#year-1').val()
            },
            success: function (response) {
                hideLoading();
                if (response.error_code == "0") {
                    toastr.success('Cập nhật thành công');
                    $("#AddEditKetQuaThucHienCongKhaiModal").modal('hide');
                    DrawKetQuaThucHienCongKhai();
                } else {
                    toastr.error(response.message);
                }
            },
            error: function (err) {
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

</script>
