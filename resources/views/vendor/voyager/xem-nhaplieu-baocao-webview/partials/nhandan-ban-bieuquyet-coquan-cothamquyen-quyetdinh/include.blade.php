<script>
    //-----------------Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định----
    function DrawNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh() {
        showLoading();
        $("#content-nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/view/xem-nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh-webview',
            data: {
                "_token": "{{ csrf_token() }}",
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
    //-----------------End Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định--------------------
</script>
