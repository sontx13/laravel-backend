<div class="container">
    <div class="row header header-tb row-flex">
        <div class="col-sm-5">
            <div class="row">
                <div class="col-sm-2">
                    <span>STT</span>
                </div>
                <div class="col-sm-4">
                    <span>Tiêu đề</span>
                </div>
                <div class="col-sm-6">
                    <span>Nội dung</span>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="row">
                <div class="col-sm-3">
                    <span>Ds người nhận</span>
                </div>
                <div class="col-sm-3">
                    <span>Ds nhóm nhận</span>
                </div>
                <div class="col-sm-1">
                    <span>Tr.Thái</span>
                </div>
                <div class="col-sm-2">
                    <span>Ngày gửi</span>
                </div>
                <div class="col-sm-3">
                    <span>Xử lý</span>
                </div>
            </div>
        </div>
    </div>
    @foreach ($lsThongBaos as $keyItem => $dataItem)
    <div class="row row-border row-flex">
        <div class="col-sm-5">
            <div class="row row-flex">
                <div class="col-sm-2 text-center">
                    <span>{{$keyItem + 1}}</span>
                </div>
                <div class="col-sm-4">
                    <span>{{$dataItem->tieu_de}}</span>
                </div>
                <div class="col-sm-6">
                    <span>{{$dataItem->noi_dung}}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="row row-flex">
                <div class="col-sm-3">
                    @if (count($dataItem->dsNguoiNhanHienThis) > 0)
                    @foreach ($dataItem->dsNguoiNhanHienThis as $nguoinhan)
                    <div>
                        <span>{{$nguoinhan}}</span>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="col-sm-3 text-center">
                    @if (count($dataItem->dsNhomNhanHienThis) > 0)
                    @foreach ($dataItem->dsNhomNhanHienThis as $nhomnhan)
                    <div>
                        <span>{{$nhomnhan}}</span>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="col-sm-1 text-center notification">
                    @if ($dataItem->trang_thai == App\Enums\TrangThaiThongBaoEnum::ChuaGui)
                        <i class="glyphicon glyphicon-bell  icon-new-send" title="Chưa gửi"></i>
                    @elseif ($dataItem->trang_thai == App\Enums\TrangThaiThongBaoEnum::GuiThanhCong)
                        <i class="glyphicon glyphicon-ok icon-send-success" title="Gửi thành công"></i>
                    @elseif ($dataItem->trang_thai == App\Enums\TrangThaiThongBaoEnum::GuiLoi)
                        <i class="glyphicon glyphicon-remove icon-send-error" title="Gửi lỗi"></i>
                    @endif
                    {{-- <span class="{{App\Http\Controllers\Voyager\QuanTriThongBaoController::GetClassTT($dataItem->trang_thai)}} form-control">{{App\Http\Controllers\Voyager\QuanTriThongBaoController::GetDisplayTT($dataItem->trang_thai)}}</span> --}}
                </div>
                <div class="col-sm-2">
                    <span>{{$dataItem->ngay_gui}}</span>
                </div>
                <div class="col-sm-3 text-center">
                    @if ($dataItem->trang_thai == App\Enums\TrangThaiThongBaoEnum::ChuaGui)
                        @can('send_thong-bao')
                        <a href="javascript:void(0)" onclick="GuiThongBao({{$dataItem->id}})" title="Gửi thông báo"><i
                            class="glyphicon glyphicon-play-circle icon icon-send"></i></a>
                        @endcan
                        @can('edit_thong-bao')
                        <a href="javascript:void(0)" onclick="ShowModalSuaThongBao({{$dataItem->id}})" title="Sửa"><i
                            class="glyphicon glyphicon-option-horizontal icon icon-edit"></i></a>
                        @endcan
                        @can('delete_thong-bao')
                        <a href="javascript:void(0)" onclick="XoaThongBao({{$dataItem->id}})" title="Xóa"><i
                            class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                        @endcan
                    @elseif ($dataItem->trang_thai == App\Enums\TrangThaiThongBaoEnum::GuiLoi)
                        <span>{{$dataItem->ket_qua}}</span>
                    @endif
                    <span style="font-size: 28px;">&nbsp;</span>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
