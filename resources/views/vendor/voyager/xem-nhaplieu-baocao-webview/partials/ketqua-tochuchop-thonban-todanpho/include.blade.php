<script>
    //-----------------Kết quả tổ chức họp thôn bản tổ dân phố--------------------
    function DrawKetQuaToChucHopThonBanToDanPho() {
        showLoading();
        $("#content-ketqua-tochuchop-thonban-todanpho").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/view/xem-ketqua-tochuchop-thonban-todanpho-webview',
            data: {
                "_token": "{{ csrf_token() }}",
                donvi: donvi,
                donvicha: $('#donviIdHuyen').val(),
                quarter: $('#quarter').val(),
                year: $('#year').val()
            },
            success: function(response) {
                hideLoading();
                $("#content-ketqua-tochuchop-thonban-todanpho").html(response);
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
    //-----------------End Kết quả tổ chức họp thôn, bản, tổ dân phố--------------------
</script>
