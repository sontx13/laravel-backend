<div>
    @foreach ($lsKetQuaHuyDongVons as $index => $dataItem)
        <div class="row card card-baocao-nhaplieu">
            <div class="col-sm-12">
                <label>{{$index + 1}}. Tên xã, phường, thị trấn:</label><span
                    class="ten-xaphuong"> {{$dataItem->ten_xaphuong}}</span>
            </div>
            <div class="col-sm-12">
                <textarea disabled="disabled" class="width-100">{{$dataItem->ten_congtrinh}}</textarea>
            </div>
            <div class="col-sm-12">
                <label>Tổng giá trị:</label><span> {{number_format($dataItem->tong_giatri, 2, '.', ',')}}</span>
            </div>
            <div class="col-sm-12">
                <label>Nhân dân đóng góp:</label><span> {{number_format($dataItem->nhandan_donggop, 2, '.', ',')}} </span>
            </div>
            <div class="col-sm-12">
                <label>Nhà nước hỗ trợ:</label><span> {{number_format($dataItem->nhanuoc_hotro, 2, '.', ',')}}</span>
            </div>
            <div class="col-sm-12">
                <label>Ghi chú:</label><span> {{$dataItem->ghi_chu}}</span>
            </div>
        </div>
    @endforeach
</div>
