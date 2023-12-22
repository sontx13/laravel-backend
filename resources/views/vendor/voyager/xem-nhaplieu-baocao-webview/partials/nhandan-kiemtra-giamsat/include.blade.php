<script>
    //-----------------Nhân dân tham gia ý kiến--------------------
    function DrawNhanDanKiemTraGiamSat() {
        showLoading();
        $("#content-nhandan-kiemtra-giamsat").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/view/xem-nhandan-kiemtra-giamsat-webview',
            data: {
                "_token": "{{ csrf_token() }}",
                donvi: donvi,
                donvicha: $('#donviIdHuyen').val(),
                quarter: $('#quarter').val(),
                year: $('#year').val()
            },
            success: function(response) {
                hideLoading();
                $("#content-nhandan-kiemtra-giamsat").html(response);
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
    //-----------------End Nhân dân kiểm tra giám sát--------------------
</script>
