<script>
    //-----------------Kết quả hoạt động của ban thanh tra nhân dân--------------------
    function DrawDonThuKhieuNaiToCao() {
        showLoading();
        $("#content-donthu-khieunai-tocao").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/view/xem-donthu-khieunai-tocao-webview',
            data: {
                "_token": "{{ csrf_token() }}",
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
    //-----------------End Đơn thư khiếu nại--------------------
</script>
