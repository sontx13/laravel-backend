<div class="">
    <div class="row header header-tb">
        <div class="col-sm-4">
            <div class="row">
                <div class="col-sm-2">
                    <span>TT</span>
                </div>
                <div class="col-sm-4">
                    <span>Ngày gửi</span>
                </div>
                <div class="col-sm-6">
                    <span>Người gửi</span>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-2">
                    <span>Số ĐT</span>
                </div>
                <div class="col-sm-4">
                    <span>Địa chỉ</span>
                </div>
                <div class="col-sm-3">
                    <span>Vấn đề PAKN</span>
                </div>
                <div class="col-sm-1">
                    <span>T.Thái</span>
                </div>
                <div class="col-sm-1">
                    <span>C.Khai</span>
                </div>
                <div class="col-sm-1">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    @foreach ($lsPAKN as $keyItem => $dataItem)
        <div class="row row-border">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-2 text-center">
                        <span>{{($pageNumber - 1) * 10 + $keyItem + 1}}</span>
                    </div>
                    <div class="col-sm-4">
                        <span>{{$dataItem->ngay_tao}}</span>
                    </div>
                    <div class="col-sm-6">
                        <span>{{$dataItem->ten}}</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-2">
                        <span>{{$dataItem->so_dien_thoai}}</span>
                    </div>
                    <div class="col-sm-4">
                        <span>{{$dataItem->dia_chi}}</span>
                    </div>
                    <div class="col-sm-3">
                        <span>{{$dataItem->tieu_de}}</span>
                    </div>
                    <div class="col-sm-1">
                        @if ($dataItem->status == App\Enums\TrangThaiXuLyPAKNEnum::ChuaXuLy)
                            <i class="glyphicon glyphicon-question-sign icon tt-chua-xuly" title="Chưa xử lý"></i>
                        @elseif ($dataItem->status == App\Enums\TrangThaiXuLyPAKNEnum::DangXuLy)
                            <i class="glyphicon glyphicon-time icon tt-dang-xuly" title="Đang xử lý"></i>
                        @elseif ($dataItem->status == App\Enums\TrangThaiXuLyPAKNEnum::DaXuLy)
                            <i class="glyphicon glyphicon-ok-sign icon tt-da-xuly" title="Đã xử lý"></i>
                        @endif
                    </div>
                    <div class="col-sm-1">
                        @if ($dataItem->is_public == App\Enums\TrangThaiCongKhaiPAKNEnum::KhongCongKhai)
                            <i class="glyphicon glyphicon-lock icon tt-khong-congkhai" title="Không công khai"></i>
                        @elseif ($dataItem->is_public == App\Enums\TrangThaiCongKhaiPAKNEnum::CongKhai)
                            <i class="glyphicon glyphicon-flag icon tt-congkhai" title="Công khai"></i>
                        @endif
                    </div>
                    <div class="col-sm-1">
                    <!--<a href="javascript:void(0)" onclick="ShowModalSuaPAKN({{$dataItem->id}})" title="Sửa"><i
                        class="glyphicon glyphicon-option-horizontal icon icon-edit"></i></a>-->
                        <a href="{{route('voyager.quan-tri-pakn.edit', ['id'=>$dataItem->id])}}" title="Sửa"><i
                                class="glyphicon glyphicon-option-horizontal icon icon-edit"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@if ($countPAKN->count > 10)
    <ul class="pagination">
        @for ($page = 1; $page <= $countPAKN->count/10 + 1; $page++)
            @if ($page == $pageNumber)
                <li class="active"><a onclick="drawDsPAKN({{$page}})">{{$page}}</a></li>
            @else
                <li><a onclick="drawDsPAKN({{$page}})">{{$page}}</a></li>
            @endif
        @endfor
    </ul>
@endif
<script>
    var pageNumber = {{$pageNumber}};
</script>

