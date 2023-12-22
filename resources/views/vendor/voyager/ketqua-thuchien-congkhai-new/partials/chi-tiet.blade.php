<div class="" id="exportContent11" style="font-size: 13px!important;">
    <button class="btn btn-primary pull-right" id="export-btn-chitiet">Tải xuống excel</button>
    <table class="table table-bordered" id="tab-chitiet" border="1">
        <thead>
            <tr>
                <th rowspan="2" class="text-center"
                    style="vertical-align: middle;font-weight: bold;    width: 5px;
                writing-mode: vertical-rl;
                text-orientation: upright;">
                    Nhóm</th>
                <th class="text-center" rowspan="2"
                    style="vertical-align: middle; font-weight: bold; width: 5px;
                writing-mode: vertical-rl;
                text-orientation: upright; ">
                    Mục
                </th>
                <th class="text-center" rowspan="2"
                    style="vertical-align: middle; font-weight: bold;  width: 5px;
                writing-mode: vertical-rl;
                text-orientation: upright; ">
                    MSND
                </th>
                <th class="text-center" rowspan="2" style="vertical-align: middle; font-weight: bold; width:250px;">
                    Nội
                    dung
                <th class="text-center" rowspan="2" style="vertical-align: middle; font-weight: bold;  width:250px;">
                    Tóm tắt
                    thông
                    tin công khai
                </th>
                <th colspan="6" class="text-center" style="vertical-align: middle; font-weight: bold;">Hình thức
                    công khai</th>
                <th class="text-center" rowspan="2" style="vertical-align: middle; font-weight: bold;">Thời gian
                    công khai</th>
                <th colspan="2" class="text-center" style="vertical-align: middle; font-weight: bold;">Thời điểm
                    công khai</th>
                <th colspan="2" class="text-center" style="vertical-align: middle; font-weight: bold;">Đính tệp
                </th>
            </tr>
            <tr>
                <th class="text-center" style="vertical-align: middle;font-style: italic;">Niêm yết 1 nơi</th>
                <td class="text-center"style="vertical-align: middle; font-style: italic;">Niêm yết 2 nơi</td>
                <th class="text-center"style="vertical-align: middle; font-style: italic;">Đăng tải trên cổng thông
                    tin
                </th>
                <th class="text-center"style="vertical-align: middle; font-style: italic;">Loa truyền thanh</th>
                <th class="text-center"style="vertical-align: middle; font-style: italic;">Thông qua trưởng thôn, TDP
                </th>
                <th class="text-center"style="vertical-align: middle;font-style: italic;">Khác</th>
                <th class="text-center"style="vertical-align: middle;font-style: italic;">Từ ngày</th>
                <th class="text-center"style="vertical-align: middle;font-style: italic;">Đến ngày</th>
                <th class="text-center"style="vertical-align: middle;font-style: italic;">Kế hoạch công khai thông tin
                </th>
                <th class="text-center" style="vertical-align: middle;font-style: italic;">Thông tin công khai</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($lsResPage as $item)
                <tr>
                    <td class="text-center" style="font-weight:bold">
                        @if ($item->manhom != null)
                            {{ $item->manhom }}
                        @endif
                    </td>
                    <td>
                        @if ($item->muc_congkhai != null)
                            {{ $item->muc->ma_muc }}
                        @endif
                    </td>
                    <td>
                        @if ($item->muc_congkhai != null)
                            {{ $item->muc->ms_nd }}
                        @endif
                    </td>
                    <td>
                        @if ($item->muc_congkhai != null)
                            {{ $item->muc->noi_dung }}
                        @endif
                        @if ($item->nd != null)
                            <span style="font-weight:bold">{{ $item->nd }}</span>
                        @endif
                    </td>
                    <td>{{ $item->noidung_congkhai }}
                        <input type='hidden' id="hinhthuc_congkhai_{{ $loop->index }}"
                        value="{{ $item->hinhthuc_congkhai }}">
                    </td>
                    <td class="text-center" id='hinhthuc1_{{ $loop->index }}'><span></span></td>
                    <td class="text-center" id='hinhthuc2_{{ $loop->index }}'><span></span></td>
                    <th class="text-center" id='hinhthuc3_{{ $loop->index }}'><span></span></th>
                    <th class="text-center" id='hinhthuc4_{{ $loop->index }}'><span></span></th>
                    <th class="text-center" id='hinhthuc5_{{ $loop->index }}'><span></span></th>
                    <th class="text-center">
                        @if ($item->hinhthuc_khac)
                            {{ $item->hinhthuc_khac }}
                        @endif
                    </th>
                    <td>
                        @if ($item->tg_congkhai == '90ngay')
                            90 ngày
                        @endif
                        @if ($item->tg_congkhai == 'thuongxuyen')
                            Thường xuyên
                        @endif
                        @if ($item->tg_congkhai == '30ngay')
                            30 ngày
                        @endif
                        @if ($item->tg_congkhai == 'khac')
                            Khác
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($item->nd == null)
                            {{ \Carbon\Carbon::parse($item->ngay_bd_congkhai)->format('d/m/Y') }}
                        @endif

                    </td>
                    <td class="text-center">
                        @if ($item->nd == null)
                            {{ \Carbon\Carbon::parse($item->ngay_kt_congkhai)->format('d/m/Y') }}
                        @endif

                    </td>
                    <td class="text-center">
                        @if ($item->file_kh_congkhai_path != null)
                            <a href="{{ $item->file_kh_congkhai_path }}" target="_blank">Tải về</a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($item->filecongkhai_path != null)
                            <a href="{{ $item->filecongkhai_path }}" target="_blank">Tải về</a>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($checkTH != 1) 
                      
                            @can('add', app($dataType->model_name))
                                <a href="javascript:;" title="Xoá" class="btn btn-sm btn-danger  delete"
                                    data-id="{{ $item->id }}">
                                    Xoá
                                </a>
                                <a href="{{ route('voyager.ketqua-thuchien-congkhai-new.edit', $item->id) }}"
                                    title="Sửa" class="btn btn-sm btn-success edit">Sửa</a>
                            @endcan
                        @endif
                    </td>
                    {{-- @if ($isxembaocao == 'false')
                    <th></th>
                @endif --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type='hidden' id='count' value='{{ $count }}'>
</div>
<div>
    <p style="font-size:11px; font-style: italic;">*Chú thích:
        <br />Niêm yết 1 nơi: Niêm yết tại trụ sở Hội đồng nhân dân, Ủy ban nhân dân cấp xã.
        <br /> Niêm yết 2 nơi: Niêm yết tại trụ sở Hội đồng nhân dân, Ủy ban nhân dân cấp xã, tại nhà văn hóa và các
        điểm sinh
        hoạt cộng đồng ở thôn, tổ dân phố.
    </p>
</div>
<div class="pull-left">
    <div role="status" class="show-res" aria-live="polite">
        {{ trans_choice('voyager::generic.showing_entries', $lsResPage->count(), [
            'from' => $lsResPage->firstItem(),
            'to' => $lsResPage->lastItem(),
            'all' => $lsResPage->count(),
        ]) }}
    </div>
</div>
<div class="pull-right">
    {{ $lsResPage->appends([
            'donvi_huyen' => $dvh,
            'donvi_xa' => $dvx,
            'tu_ngay' => $tungay,
            'den_ngay' => $denngay,
        ])->links() }}
</div>

{{-- Single delete modal --}}
<div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="deleteHD">Bạn có chắc chắn xoá dữ liệu này không?</h4>
            </div>
            <div class="modal-footer">
                <form action="#" id="delete_form" method="POST">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger pull-right delete-confirm"
                        value="{{ __('voyager::generic.delete_confirm') }}">
                </form>
                <button type="button" class="btn btn-default pull-right"
                    data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
