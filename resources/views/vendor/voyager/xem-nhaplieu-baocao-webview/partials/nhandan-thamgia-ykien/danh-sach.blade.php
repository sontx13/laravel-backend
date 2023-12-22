<div>
    @foreach ($lsNhanDanThamGiaYKiens as $index => $dataItem)
    <div class="row card card-baocao-nhaplieu">
        <div class="col-sm-12">
            <label>{{$index + 1}}. Tên xã, phường, thị trấn:</label><span class="ten-xaphuong"> {{$dataItem->ten_xaphuong}}</span>
        </div>
        <div class="col-sm-12">
            <textarea disabled="disabled" class="width-100">{{$dataItem->noidung_xinykien}}</textarea>
        </div>
        <div class="col-sm-12">
            <label>Cơ quan chủ trì:</label><span> {{$dataItem->coquan_chutri}}</span>
        </div>
        <div class="col-sm-12">
            <label>Hình thức nhân dân tham gia ý kiến:</label>
            @if ($dataItem->hinhthuc_thamgia_ykien == App\Enums\HinhThucBanEnum::HoiNghi)
                <span class="hinh-thuc"> Hội Nghị </span>
            @endif
            @if ($dataItem->hinhthuc_thamgia_ykien == App\Enums\HinhThucBanEnum::PhatPhieu)
                <span class="hinh-thuc"> Phát Phiếu </span>
            @endif
            @if ($dataItem->hinhthuc_thamgia_ykien == App\Enums\HinhThucThamGiaYKienEnum::HomThuGopY)
                <span class="hinh-thuc"> Hòm Thư Góp Ý </span>
            @endif
        </div>
        <div class="col-sm-12">
            <label>Ghi chú:</label><span> {{$dataItem->ghi_chu}}</span>
        </div>
    </div>
    @endforeach
</div>
