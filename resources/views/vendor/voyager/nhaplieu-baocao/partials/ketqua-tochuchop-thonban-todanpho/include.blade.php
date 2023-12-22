<script>
    //-----------------Kết quả tổ chức họp thôn bản tổ dân phố--------------------
    function DrawKetQuaToChucHopThonBanToDanPho() {
        showLoading();
        $("#content-ketqua-tochuchop-thonban-todanpho").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-tochuchop-thonban-todanpho',
            data: {
                "_token": "{{ csrf_token() }}",
                isxembaocao: isXemBaocao,
                donvi: donvi,
                donvicha: $('#donviIdHuyen').val(),
                donvicha: $('#donviIdHuyen').val(),
                quarter: $('#quarter').val(),
                year: $('#year').val()
            },
            success: function (response) {
                hideLoading();
                $("#content-ketqua-tochuchop-thonban-todanpho").html(response);

                $("#txt-tongsothonban-10").change(function(){
                    var tong = parseInt($('#txt-tongsothonban-10').val());
                    var tong1 = parseInt($('#txt-sothonbanhop1nam1lan-10').val());
                    var tong2 = parseInt($('#txt-sothonbanhop1nam2lan-10').val());
                    var tong3 = parseInt($('#txt-sothonbanhopkhac-10').val());
                    if (tong < (tong1 + tong2 +tong3)){
                        alert('Điều kiện: (1) >= (2) + (3) +(4)');
                    }
                });

                $("#txt-sothonbanhop1nam1lan-10").change(function(){
                    var tong = parseInt($('#txt-tongsothonban-10').val());
                    var tong1 = parseInt($('#txt-sothonbanhop1nam1lan-10').val());
                    var tong2 = parseInt($('#txt-sothonbanhop1nam2lan-10').val());
                    var tong3 = parseInt($('#txt-sothonbanhopkhac-10').val());
                    if (tong < (tong1 + tong2 +tong3)){
                        alert('Điều kiện: (1) >= (2) + (3) +(4)');
                    }
                });

                $("#txt-sothonbanhop1nam2lan-10").change(function(){
                    var tong = parseInt($('#txt-tongsothonban-10').val());
                    var tong1 = parseInt($('#txt-sothonbanhop1nam1lan-10').val());
                    var tong2 = parseInt($('#txt-sothonbanhop1nam2lan-10').val());
                    var tong3 = parseInt($('#txt-sothonbanhopkhac-10').val());
                    if (tong < (tong1 + tong2 +tong3)){
                        alert('Điều kiện: (1) >= (2) + (3) +(4)');
                    }
                });

                $("#txt-sothonbanhopkhac-10").change(function(){
                    var tong = parseInt($('#txt-tongsothonban-10').val());
                    var tong1 = parseInt($('#txt-sothonbanhop1nam1lan-10').val());
                    var tong2 = parseInt($('#txt-sothonbanhop1nam2lan-10').val());
                    var tong3 = parseInt($('#txt-sothonbanhopkhac-10').val());
                    if (tong < (tong1 + tong2 +tong3)){
                        alert('Điều kiện: (1) >= (2) + (3) +(4)');
                    }
                });

            },
            error: function (err) {
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

    function ShowModalThemMoiKetQuaToChucHopThonBanToDanPho() {
        ResetModalThemMoiKetQuaToChucHopThonBanToDanPho();
        $("#themoiKetQuaToChucHopThonBanToDanPhoModal").modal('show');
    }

    function ResetModalThemMoiKetQuaToChucHopThonBanToDanPho() {
        //$("#txt-tenxaphuong-10").val('');
        $("#txt-tongso_thonban-10").val('');
        $("#txt-sothonban_hop1nam1lan-10").val('');
        $("#txt-sothonban_hop1nam2lan-10").val('');
        $("#txt-sothonban_hopkhac-10").val('');
        $("#txt-ghichu-9").val('');
    }

    function ThemMoiKetQuaToChucHopThonBanToDanPho() {
        var params = {};
        params.tenxaphuong = $("#txt-tenxaphuong-10").val();
        params.tongsothonban = $("#txt-tongsothonban-10").val();
        params.sothonbanhop1nam1lan = $("#txt-sothonbanhop1nam1lan-10").val();
        params.sothonbanhop1nam2lan = $("#txt-sothonbanhop1nam2lan-10").val();
        params.sothonbanhopkhac = $("#txt-sothonbanhopkhac-10").val();
        params.ghichu = $("#txt-ghichu-10").val();
        params.quarter = $("#quarter-10").val();
        params.year = $("#year-10").val();
        var donvi = $('#cbx-donvi').val();
        if (!ValidateKetQuaToChucHopThonBanToDanPho(params)) {
            return;
        }
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-tochuchop-thonban-todanpho/them-moi',
            data: {
                "_token": "{{ csrf_token() }}",
                tenxaphuong: params.tenxaphuong,
                tongsothonban: params.tongsothonban,
                sothonbanhop1nam1lan: params.sothonbanhop1nam1lan,
                sothonbanhop1nam2lan: params.sothonbanhop1nam2lan,
                sothonbanhopkhac: params.sothonbanhopkhac,
                ghichu: params.ghichu,
                donvi: donvi,
                quarter: params.quarter,
                year: params.year
            },
            success: function (response) {
                hideLoading();
                if (response.error_code == "0") {
                    toastr.success('Thêm mới thành công');
                    $("#themoiKetQuaToChucHopThonBanToDanPhoModal").modal('hide');
                    DrawKetQuaToChucHopThonBanToDanPho();
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

    function ValidateKetQuaToChucHopThonBanToDanPho(params) {
        var tenxaphuong = params.tenxaphuong;
        if (!tenxaphuong || tenxaphuong == "" || tenxaphuong == '') {
            toastr.warning('Tên xã phường không được để trống');
            return false;
        }

        if ($('#txt-tongsothonban-10').val() == ''
            || $('#txt-sothonbanhop1nam1lan-10').val() == ''
            || $('#txt-sothonbanhop1nam2lan-10').val() == ''
            || $('#txt-sothonbanhopkhac-10').val() == '') {
            toastr.warning('Vui lòng nhập đủ các trường thông tin');
            return false;
        }
        return true;
    }

    function ShowModalSuaKetQuaToChucHopThonBanToDanPho(id) {
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-tochuchop-thonban-todanpho/sua-modal',
            data: {
                id: id
            },
            success: function (response) {
                $("#modal-sua-ketquatochuchopthonbantodanpho").html(response);
                $('#suaKetQuaToChucHopThonBanToDanPhoModal').modal('show');
            },
            error: function (err) {
                console.log(err);
                toastr.error('Hiển thị modal sửa không thành công');
            }
        });
    }

    function CapNhatKetQuaToChucHopThonBanToDanPho(id) {
        var params = {};
        params.tenxaphuong = $("#txt-edit-tenxaphuong-10").val();
        params.tongsothonban = $("#txt-edit-tongsothonban-10").val();
        params.sothonbanhop1nam1lan = $("#txt-edit-sothonbanhop1nam1lan-10").val();
        params.sothonbanhop1nam2lan = $("#txt-edit-sothonbanhop1nam2lan-10").val();
        params.sothonbanhopkhac = $("#txt-edit-sothonbanhopkhac-10").val();
        params.ghichu = $("#txt-edit-ghichu-10").val();
        if (!ValidateKetQuaToChucHopThonBanToDanPho(params)) {
            return;
        }
        $.ajax({
            type: 'post',
            url: '/admin/ketqua-tochuchop-thonban-todanpho/cap-nhat',
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
                tenxaphuong: params.tenxaphuong,
                tongsothonban: params.tongsothonban,
                sothonbanhop1nam1lan: params.sothonbanhop1nam1lan,
                sothonbanhop1nam2lan: params.sothonbanhop1nam2lan,
                sothonbanhopkhac: params.sothonbanhopkhac,
                ghichu: params.ghichu
            },
            success: function (response) {
                hideLoading();
                if (response.error_code == "0") {
                    toastr.success('Cập nhật thành công');
                    $("#suaKetQuaToChucHopThonBanToDanPhoModal").modal('hide');
                    DrawKetQuaToChucHopThonBanToDanPho();
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

    function XoaKetQuaToChucHopThonBanToDanPho(id) {
        swal("Bạn có chắc chắn muốn xóa bản ghi?", {
            buttons: ["Không", "Có"],
            dangerMode: true
        })
            .then((value) => {
                if (value) {
                    showLoading();
                    $.ajax({
                        type: 'post',
                        url: '/admin/ketqua-tochuchop-thonban-todanpho/xoa',
                        data: {
                            id: id
                        },
                        success: function (response) {
                            hideLoading();
                            if (response.error_code == "0") {
                                toastr.success('Xóa thành công');
                                DrawKetQuaToChucHopThonBanToDanPho();
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

    //-----------------End Kết quả tổ chức họp thôn, bản, tổ dân phố--------------------
</script>
