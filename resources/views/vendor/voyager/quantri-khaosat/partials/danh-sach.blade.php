<div class="container">
    <div class="row header header-tb row-flex">
        <div class="col-sm-1">
            <span>STT</span>
        </div>
        <div class="col-sm-2">
            <span>Khảo Sát</span>
        </div>
        <div class="col-sm-3">
            <span>Đường dẫn</span>
        </div>
        <div class="col-sm-1">
            <span>Trạng thái</span>
        </div>
        <div class="col-sm-2">
            <span>Ngày bắt đầu</span>
        </div>
        <div class="col-sm-2">
            <span>Ngày kết thúc</span>
        </div>
        <div class="col-sm-1">
            <span>Xử lý</span>
        </div>
    </div>
    @foreach ($lsKhaoSats as $keyItem => $dataItem)
    <div class="row row-border row-flex">
        <div class="col-sm-1 text-center">
            <span>{{$keyItem + 1}}</span>
        </div>
        <div class="col-sm-2">
            <span>{{$dataItem->ten_khaosat}}</span>
        </div>
        <div class="col-sm-3">
            <span>{{$dataItem->url}}</span>
        </div>
        <div class="col-sm-1  text-center">
            @if ($dataItem->trang_thai == App\Enums\TrangThaiKhaoSatEnum::KhongHoatDong)
                <i class="" title="Không Hoạt Động"></i>
            @elseif ($dataItem->trang_thai == App\Enums\TrangThaiKhaoSatEnum::HoatDong)
                <i class="glyphicon glyphicon-ok icon-send-success" title="Hoạt Động"></i>
            @endif
        </div>
        <div class="col-sm-2">
            <span>{{$dataItem->ngay_batdau}}</span>
        </div>
        <div class="col-sm-2">
            <span>{{$dataItem->ngay_ketthuc}}</span>
        </div>
        <div class="col-sm-1 text-center">
            <a href="javascript:void(0)" onclick="ShowModalSuaKhaoSat({{$dataItem->id}})" title="Sửa"><i
                class="glyphicon glyphicon-option-horizontal icon icon-edit"></i></a>
            <span style="font-size: 28px;">&nbsp;</span>
        </div>
    </div>
    @endforeach
</div>
