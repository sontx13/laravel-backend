<div>
    @foreach ($lsKetQuaHoatDongs as $index => $dataItem)
    <div class="card card-baocao-nhaplieu">
        <div class="col-sm-12">
            <label>{{$index + 1}}. Tên xã, phường, thị trấn:</label><span class="ten-xaphuong"> {{$dataItem->ten_xaphuong}}</span>
        </div>
        <div class="col-sm-12">
            <label>Số công trình, dự án trên địa bàn:</label><span> {{$dataItem->so_congtrinh}}</span>
        </div>
        <div class="col-sm-12">
            <label>Số cuộc giám sát:</label><span> {{$dataItem->socuoc_giamsat}}</span>
        </div>
        <div class="col-sm-12">
            <label>Phát hiện số sai phạm/công trình, dự án:</label><span class="hinh-thuc"> {{$dataItem->phathien_sosaipham}}</span>
        </div>
        <div class="col-sm-12">
            <label>Số vụ việc kiến nghị:</label><span class="hinh-thuc"> {{$dataItem->sovuviec_kiennghi}}</span>
        </div>
        <div class="col-sm-12">
            <label>Thu hồi tiền (đồng):</label><span class="hinh-thuc"> {{$dataItem->thuhoi_tien}}</span>
        </div>
        <div class="col-sm-12">
            <label>Giảm trừ quyết toán (đồng):</label><span class="hinh-thuc"> {{$dataItem->giamtru_quyettoan}}</span>
        </div>
        <div class="col-sm-12">
            <label>Xử lý khác (đồng):</label><span> {{$dataItem->xuly_khac}}</span>
        </div>
    </div>
    @endforeach
</div>
