<div>
    @foreach ($lsKetQuaHoatDongs as $index => $dataItem)
    <div class="card card-baocao-nhaplieu">
        <div class="col-sm-12">
            <label>{{$index + 1}}. Tên xã, phường, thị trấn:</label><span class="ten-xaphuong"> {{$dataItem->ten_xaphuong}}</span>
        </div>
        <div class="col-sm-12">
            <label>Số cuộc giám sát:</label><span class="hinh-thuc"> {{$dataItem->socuoc_giamsat}}</span>
        </div>
        <div class="col-sm-12">
            <label>Phát hiện số sai phạm/ vụ việc:</label><span class="hinh-thuc"> {{$dataItem->phathien_sosaipham}}</span>
        </div>
        <div class="col-sm-12">
            <label>Thu hồi tiền (đồng):</label><span class="hinh-thuc"> {{$dataItem->thuhoi_tien}}</span>
        </div>
        <div class="col-sm-12">
            <label>Xử lý khác về tiền (đồng):</label><span class="hinh-thuc"> {{$dataItem->xulykhac_vetien}}</span>
        </div>
        <div class="col-sm-12">
            <label>Thu hồi đất (m2):</label><span class="hinh-thuc"> {{$dataItem->thuhoi_dat}}</span>
        </div>
        <div class="col-sm-12">
            <label>Xử lý khác về đất (m2):</label><span class="hinh-thuc"> {{$dataItem->xulykhac_vedat}}</span>
        </div>
        <div class="col-sm-12">
            <label>Kiến nghị xử lý bất cập, vướng mắc về quy định pháp luật (nêu cụ thể):</label><span> {{$dataItem->kiennghi_xulybatcap}}</span>
        </div>
    </div>
    @endforeach
</div>
