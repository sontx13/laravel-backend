<div>
    @foreach ($lsKetQuaThucHiens as $index => $kqThucHien)
    <div class="row card card-baocao-nhaplieu">
        <div class="col-sm-12">
            <label>{{$index + 1}}. Tên xã, phường, thị trấn:</label><span class="ten-xaphuong"> {{$kqThucHien->ten_xaphuong}}</span>
        </div>
        <div class="col-sm-12">
            <textarea disabled="disabled" class="width-100">{{$kqThucHien->noidung_congkhai}}</textarea>
        </div>
        <div class="col-sm-12">
            <label>Cơ quan thực hiện công khai:</label><span> {{$kqThucHien->coquan_congkhai}}</span>
        </div>
        <div class="col-sm-12">
            <label>Hình thức công khai:</label>
            @if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::NiemYet)
                <span class="hinh-thuc"> Niêm yết </span>
            @endif
            @if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::LoaTruyenThanh)
                <span class="hinh-thuc"> Loa truyền thanh </span>
            @endif
            @if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::QuaTruongThong)
                <span class="hinh-thuc"> Truyền thông</span>
            @endif
            @if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::Khac)
                <span class="hinh-thuc"> Khác</span>
            @endif
        </div>
        <div class="col-sm-12">
            <label>Công khai theo kế hoạch số:</label><span> {{$kqThucHien->sokehoach_congkhai}}</span>
        </div>
        <div class="col-sm-12">
            <label>Ghi chú:</label><span> {{$kqThucHien->ghi_chu}}</span>
        </div>
    </div>
    @endforeach
</div>
