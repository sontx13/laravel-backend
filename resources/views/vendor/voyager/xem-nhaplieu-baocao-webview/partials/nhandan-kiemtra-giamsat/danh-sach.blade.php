<div>
    @foreach ($lsNhanDanKiemTraGiamSats as $index => $dataItem)
    <div class="card card-baocao-nhaplieu">
        <div class="col-sm-12">
            <label>{{$index + 1}}. Nội dung giám sát</label>
        </div>
        <div class="col-sm-12">
            <textarea disabled="disabled" class="width-100">{{$dataItem->noidung_giamsat}}</textarea>
        </div>
        <div class="col-sm-12">
            <label>Cơ quan thực hiện:</label>
            @if ($dataItem->coquan_thuchien == App\Enums\CoQuanThucHienEnum::BanThanhTraNhanDan)
                <span class="hinh-thuc"> Ban thanh tra nhân dân </span>
            @endif
            @if ($dataItem->coquan_thuchien == App\Enums\CoQuanThucHienEnum::BanGiamSatDauTuCuaCongDong)
                <span class="hinh-thuc"> Ban giám sát đầu tư của cộng đồng </span>
            @endif
            @if ($dataItem->coquan_thuchien == App\Enums\CoQuanThucHienEnum::Khac)
                <span class="hinh-thuc"> Khác</span>
            @endif
        </div>
        <div class="col-sm-12">
            <label>Số ý kiến kiến nghị sau giám sát</label>
            <br>
            <span class="font-italic">Với cấp ủy:</span><span> {{$dataItem->soykien_capuy}}</span>
            <br>
            <span class="font-italic">Với chính quyền:</span><span> {{$dataItem->soykien_chinhquyen}}</span>
            <br>
            <span class="font-italic">Khác:</span><span> {{$dataItem->soykien_khac}}</span>
        </div>
        <div class="col-sm-12">
            <label>Ghi chú:</label><span> {{$dataItem->ghi_chu}}</span>
        </div>
    </div>
    @endforeach
</div>
