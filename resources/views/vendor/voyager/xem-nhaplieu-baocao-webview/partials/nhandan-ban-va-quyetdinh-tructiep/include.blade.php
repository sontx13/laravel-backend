<script>
    //-----------------Nhân dân bàn và quyết định trực tiếp--------------------
    function DrawNhanDanBanVaQuyetDinhTrucTiep() {
        showLoading();
        $("#content-nhandan-ban-va-quyetdinh-tructiep").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/view/xem-nhandan-ban-va-quyetdinh-tructiep-webview',
            data: {
                "_token": "{{ csrf_token() }}",
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
    //-----------------End Nhân dân bàn và quyết định trực tiếp--------------------
</script>
