<script>
    //-----------------Kết quả huy động vốn xây dựng hậ tầng cơ sở--------------------
    function DrawKetQuaHuyDongVonXayDungHaTangCoSo() {
        showLoading();
        $("#content-ketqua-huydongvon-xaydung-hatangcoso").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/view/xem-ketqua-huydongvon-xaydung-hatangcoso-webview',
            data: {
                "_token": "{{ csrf_token() }}",
                donvi: donvi,
                donvicha: $('#donviIdHuyen').val(),
                quarter: $('#quarter').val(),
                year: $('#year').val()
            },
            success: function(response) {
                hideLoading();
                $("#content-ketqua-huydongvon-xaydung-hatangcoso").html(response);
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
    //-----------------End Kết quả huy động vốn xây dựng hạ tầng cơ sở--------------------
</script>
