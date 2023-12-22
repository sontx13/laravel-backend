<div>
    @foreach ($lsKetQuaToChucHops as $index => $dataItem)
    <div class="card card-baocao-nhaplieu">
        <div class="col-sm-12">
            <label>{{$index + 1}}. Tên xã, phường, thị trấn:</label><span class="ten-xaphuong"> {{$dataItem->ten_xaphuong}}</span>
        </div>
        <div class="col-sm-12">
            <label>Tổng số thôn, bản, tổ dân phố:</label><span> {{$dataItem->tongso_thonban}}</span>
        </div>
        <div class="col-sm-12">
            <label>Số thôn, bản, tổ dân phố tổ chức họp toàn thể</label>
            <br>
            <span class="font-italic">1 năm/lần:</span><span class="hinh-thuc"> {{$dataItem->sothonban_hop1nam1lan}}</span>
            <br>
            <span class="font-italic">1 năm/2 lần:</span><span class="hinh-thuc"> {{$dataItem->sothonban_hop1nam2lan}}</span>
            <br>
            <span class="font-italic">Khác:</span><span class="hinh-thuc"> {{$dataItem->sothonban_hopkhac}}</span>
        </div>
        <div class="col-sm-12">
            <label>Ghi chú:</label><span> {{$dataItem->ghi_chu}}</span>
        </div>
    </div>
    @endforeach
</div>
