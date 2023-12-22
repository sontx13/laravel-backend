<div>
    @foreach ($lsNhanDanBanVaCoQuanQuyetDinhs as $index => $dataItem)
    <div class="row card card-baocao-nhaplieu">
        <div class="col-sm-12">
            <label>{{$index + 1}}. Tên xã, phường, thị trấn:</label><span class="ten-xaphuong"> {{$dataItem->ten_xaphuong}}</span>
        </div>
        <div class="col-sm-12">
            <textarea disabled="disabled" class="width-100">{{$dataItem->noidung_congviec}}</textarea>
        </div>
        <div class="col-sm-12">
            <label>Cơ quan chủ trì:</label><span> {{$dataItem->coquan_chutri}}</span>
        </div>
        <div class="col-sm-12">
            <label>Hình thức bàn:</label>
            @if ($dataItem->hinhthuc_ban == App\Enums\HinhThucBanEnum::HoiNghi)
                <span class="hinh-thuc"> Hội Nghị </span>
            @endif
            @if ($dataItem->hinhthuc_ban == App\Enums\HinhThucBanEnum::PhatPhieu)
                <span class="hinh-thuc"> Phát Phiếu </span>
            @endif
        </div>
        <div class="col-sm-12">
            <label>Số phương án được chuẩn bị:</label><span> {{$dataItem->so_phuongan}}</span>
        </div>
        <div class="col-sm-12">
            <label>Kêt quả biểu quyết:</label><span> {{$dataItem->ketqua_bieuquyet}}</span>
        </div>
    </div>
    @endforeach
</div>
