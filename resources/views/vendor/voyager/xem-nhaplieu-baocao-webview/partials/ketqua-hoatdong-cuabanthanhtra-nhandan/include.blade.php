<script>
    //-----------------Kết quả hoạt động của ban thanh tra nhân dân--------------------
    function DrawKetQuaHoatDongCuaBanThanhTraNhanDan() {
        showLoading();
        $("#content-ketqua-hoatdong-cuabanthanhtra-nhandan").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/view/xem-ketqua-hoatdong-cuabanthanhtra-nhandan-webview',
            data: {
                "_token": "{{ csrf_token() }}",
                donvi: donvi,
                donvicha: $('#donviIdHuyen').val(),
                quarter: $('#quarter').val(),
                year: $('#year').val()
            },
            success: function(response) {
                hideLoading();
                $("#content-ketqua-hoatdong-cuabanthanhtra-nhandan").html(response);
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
    //-----------------End Kết quả hoạt động của ban thanh tra nhân dân--------------------
</script>
