<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small" onclick="saveDoc('exportContent6', 'NHÂN DÂN KIỂM TRA, GIÁM SÁT');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>
</div>
<div class="container" id="exportContent6">
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th rowspan="2">TT</th>
                <th rowspan="2">Huyện/TP</th>
                <th rowspan="2">Nội dung giám sát</th>
                <th colspan="3">Cơ quan thực hiện</th>
                <th colspan="3">Số ý kiến kiến nghị sau giám sát</th>
                <th rowspan="2">Ghi chú</th>
                @if ($isxembaocao == 'false')
                    <th rowspan="2" class="width-50"></th>
                @endif
            </tr>
            <tr>
                <th width="140">Ban thanh tra nhân dân</th>
                <th width="140">Ban giám sát đầu tư của cộng đồng</th>
                <th width="140">Khác</th>
                <th>Với cấp ủy</th>
                <th>Với chính quyền</th>
                <th>Khác</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tong1 = 0;
                $tong2 = 0;
                $tong3 = 0;
            @endphp
            @foreach ($lsNhanDanKiemTraGiamSats as $index => $dataItem)
                @php
                    $tong1 += $dataItem->soykien_capuy;
                    $tong2 += $dataItem->soykien_chinhquyen;
                    $tong3 += $dataItem->soykien_khac;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dataItem->donvi->donvicha->ten_donvi }}</td>
                    <td>
                        {{ $dataItem->noidung_giamsat }}
                    </td>
                    <td class="text-center">
                        @if ($dataItem->coquan_thuchien == App\Enums\CoQuanThucHienEnum::BanThanhTraNhanDan)
                            X
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($dataItem->coquan_thuchien == App\Enums\CoQuanThucHienEnum::BanGiamSatDauTuCuaCongDong)
                            X
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($dataItem->coquan_thuchien == App\Enums\CoQuanThucHienEnum::Khac)
                            X
                        @endif
                    </td>
                    <td class="text-right">
                        {{ $dataItem->soykien_capuy }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->soykien_chinhquyen }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->soykien_khac }}
                    </td>
                    <td>
                        {{ $dataItem->ghi_chu }}
                    </td>
                    @if ($isxembaocao == 'false')
                        <td class="width-50 text-center">
                            @can('edit_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="ShowModalSuaNhanDanKiemTraGiamSat({{ $dataItem->id }})" title="Sửa"><i
                                        class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                            @endcan
                            @can('delete_nhaplieu-baocao')
                                <a href="javascript:void(0)" onclick="XoaNhanDanKiemTraGiamSat({{ $dataItem->id }})"
                                    title="Xóa"><i class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                            @endcan
                        </td>
                    @endif
                </tr>
            @endforeach
            @if (count($lsNhanDanKiemTraGiamSats) == 0)
                <tr class="add-row">
                    <td>...</td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    <td>

                    </td>
                    @if ($isxembaocao == 'false')
                        <td>

                        </td>
                    @endif
                </tr>
            @endif
            <tr>
                <td></td>
                <td></td>
                <td style="text-align: left; font-weight: bold">Cộng</td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right">{{ $tong1 }}</td>
                <td style="text-align: right">{{ $tong2 }}</td>
                <td style="text-align: right">{{ $tong3 }}</td>
                <td style="text-align: right"></td>
                @if ($isxembaocao == 'false')
                    <td>

                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
