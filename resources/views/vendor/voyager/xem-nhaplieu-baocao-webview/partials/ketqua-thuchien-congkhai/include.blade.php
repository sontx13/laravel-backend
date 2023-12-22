<!DOCTYPE html>
<script>
    //-----------------Kết quả thực hiện công khai--------------------
    // -- Vẽ các loại báo cáo
    function DrawKetQuaThucHienCongKhai() {
        showLoading();
        $("#content-ketqua-thuchien-congkhai").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/view/xem-ketqua-thuchien-congkhai-webview',
            data: {
                "_token": "{{ csrf_token() }}",
                donvi: donvi,
                donvicha: $('#donviIdHuyen').val(),
                quarter: $('#quarter').val(),
                year: $('#year').val()
            },
            success: function(response) {
                hideLoading();
                $("#content-ketqua-thuchien-congkhai").html(response);
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
    //-----------------End Kết quả thực hiện công khai--------------------
</script>
