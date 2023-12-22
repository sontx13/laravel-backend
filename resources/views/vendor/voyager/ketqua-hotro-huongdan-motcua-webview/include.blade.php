<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="Stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script>
    //-----------------Kết quả tổ chức họp thôn bản tổ dân phố--------------------
    function DrawKetQuaHoTroHuongDanMotCuaWebview() {
        showLoading();
        $("#content-ketqua-hotro-huongdan-motcua-webview").empty();

        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-hotro-huongdan-motcua-webview',
            data: {
                "_token": "{{ csrf_token() }}",
                isxembaocao: isXemBaocao,
                donvi: donvi,
                donvicha: $('#donviIdHuyen').val(),
                donvicha: $('#donviIdHuyen').val(),
                fromDate: $('#fromDate').val() + "01:00:00",
                toDate: $('#toDate').val() + "23:00:00",
            },
            success: function(response) {
                hideLoading();
                $("#content-ketqua-hotro-huongdan-motcua-webview").html(response);
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

    function ShowModalThemMoiKetQuaHoTroHuongDanMotCua() {
        ResetModalThemMoiKetQuaHoTroHuongDanMotCua();
        $("#themmoiwebview").modal('show');
        $('#datepicker').datetimepicker({
            format: 'YYYY-MM-DD hh:mm:ss'
        });

    }

    function ResetModalThemMoiKetQuaHoTroHuongDanMotCua() {
        $("#txt-hoten").val('');
        $("#datepicker").val('');
        $("#txt-soluot").val('');
        $("#txt-songuoi").val('');
    }

    function ThemMoiKetQuaHoTroHuongDanMotCua() {
        var params = {};
        params.tenxaphuong = $("#txt-tenxaphuong").val();
        params.hoten = JSON.stringify($("#txt-hoten").val());
        params.soluot = $("#txt-soluot").val();
        params.songuoi = $("#txt-songuoi").val();
        params.date = $("#datepicker").val();
        var donvi = $('#cbx-donvi').val();
        if (!ValidateKetQuaHoTroHuongDanMotCua(params)) {
            return;
        }
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-hotro-huongdan-motcua/them-moi',
            data: {
                "_token": "{{ csrf_token() }}",
                tenxaphuong: params.tenxaphuong,
                hoten: params.hoten,
                chucvu: params.chucvu,
                soluot: params.soluot,
                songuoi: params.songuoi,
                date: params.date
            },
            success: function(response) {
                hideLoading();
                if (response.error_code == "0") {
                    toastr.success('Thêm mới thành công');
                    $("#themoiKetQuaHoTroHuongDanMotCuaModal").modal('hide');
                    DrawKetQuaHoTroHuongDanMotCua();
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

    function ValidateKetQuaHoTroHuongDanMotCua(params) {
        var tenxaphuong = params.tenxaphuong;
        if (!tenxaphuong || tenxaphuong == "" || tenxaphuong == '') {
            toastr.warning('Tên xã phường không được để trống');
            return false;
        }
        return true;
    }

    function ShowModalSuaKetQuaHoTroHuongDanMotCua(id) {
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-hotro-huongdan-motcua/sua-modal',
            data: {
                id: id
            },
            success: function(response) {
                $("#modal-sua-ketquahotrohuongdanmotcua").html(response);
                $('#1').modal('show');
                $('#datepicker').datetimepicker({
                    format: 'YYYY-MM-DD hh:mm:ss'
                });
            },
            error: function(err) {
                console.log(err);
                toastr.error('Hiển thị modal sửa không thành công');
            }
        });
    }

    function CapNhatKetQuaHoTroHuongDanMotCua(id) {
        var params = {};
        params.tenxaphuong = $("#txt-edit-tenxaphuong").val();
        params.hoten = JSON.stringify($("#txt-edit-hoten").val());
        params.soluot = $("#txt-edit-soluot").val();
        params.songuoi = $("#txt-edit-songuoi").val();
        if (!ValidateKetQuaHoTroHuongDanMotCua(params)) {
            return;
        }
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-hotro-huongdan-motcua/cap-nhat',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                tenxaphuong: params.tenxaphuong,
                hoten: params.hoten,
                chucvu: params.chucvu,
                soluot: params.soluot,
                songuoi: params.songuoi,
                date: $("#datepicker").val()
            },
            success: function(response) {
                hideLoading();
                if (response.error_code == "0") {
                    toastr.success('Cập nhật thành công');
                    $('#1').modal('hide');
                    DrawKetQuaHoTroHuongDanMotCua();
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

    function XoaKetQuaHoTroHuongDanMotCua(id) {
        swal("Bạn có chắc chắn muốn xóa bản ghi?", {
                buttons: ["Không", "Có"],
                dangerMode: true
            })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/ketqua-hotro-huongdan-motcua/xoa',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                DrawKetQuaHoTroHuongDanMotCua();
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

    //-----------------End Kết quả tổ chức họp thôn, bản, tổ dân phố--------------------
</script>