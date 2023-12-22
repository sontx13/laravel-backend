<script>
    //-----------------Kết quả hoạt động của ban thanh tra nhân dân--------------------
    function DrawKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong() {
        showLoading();
        $("#content-ketqua-hoatdong-cuabangiamsatdautu-cuacongdong").empty();
        var donvi = $('#cbx-donvi').val();
        $.ajax({
            type: 'post',
            url: '/view/xem-ketqua-hoatdong-cuabangiamsatdautu-cuacongdong-webview',
            data: {
                "_token": "{{ csrf_token() }}",
                donvi: donvi,
                donvicha: $('#donviIdHuyen').val(),
                quarter: $('#quarter').val(),
                year: $('#year').val()
            },
            success: function(response) {
                hideLoading();
                $("#content-ketqua-hoatdong-cuabangiamsatdautu-cuacongdong").html(response);
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
    //-----------------End Kết quả hoạt động của ban giám sát đầu tư của cộng đồng--------------------
</script>
