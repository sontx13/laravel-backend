<div class="container">
    @foreach ($lsDonThuKhieuNais as $index => $dataItem)
    <div class="card card-baocao-nhaplieu">
        <div class="col-sm-12">
            <label>{{$index + 1}}. Tên xã, phường, thị trấn:</label><span class="ten-xaphuong"> {{$dataItem->ten_xaphuong}}</span>
        </div>
        <div class="col-sm-12">
            <label>Số đơn thư khiếu nại tố cáo đã tiếp nhận</label>
            <br>
            <span class="font-italic">Trong kỳ báo cáo:</span><span class="hinh-thuc"> {{$dataItem->sodonthu_datiepnhan_trongkybaocao}}</span>
            <br>
            <span class="font-italic">Tính từ đầu năm:</span><span class="hinh-thuc"> {{$dataItem->sodonthu_datiepnhan_tinhtudaunam}}</span>
        </div>
        <div class="col-sm-12">
            <label>Số đơn thư khiếu nại tố cáo đã được giải quyết</label>
            <br>
            <span class="font-italic">Trong kỳ báo cáo:</span><span class="hinh-thuc"> {{$dataItem->sodonthu_dagiaiquyet_trongkybaocao}}</span>
            <br>
            <span class="font-italic">Tính từ đầu năm:</span><span class="hinh-thuc"> {{$dataItem->sodonthu_dagiaiquyet_tinhtudaunam}}</span>
        </div>
        <div class="col-sm-12">
            <label>Tổng số đơn thư khiếu nại, tố cáo chưa được giải quyết:</label><span class="hinh-thuc"> {{$dataItem->tongso_donthu_chuagiaiquyet}}</span>
        </div>
        <div class="col-sm-12">
            <label>Ghi chú:</label><span> {{$dataItem->ghi_chu}}</span>
        </div>
    </div>
    @endforeach
</div>
