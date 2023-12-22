<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small"
        onclick="saveDoc('exportContent10', 'KẾT QUẢ TỔ CHỨC HỌP THÔN, BẢN, TỔ DÂN PHỐ');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>
</div>
<div class="container" id="exportContent10">
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">TT</th>
                <th rowspan="2">Huyện/TP</th>
                <th rowspan="2">Tên xã phường, thị trấn</th>
                <th rowspan="2">Tổng số thôn, bản, tổ dân phố</th>
                <th colspan="3">Số thôn, bản, tổ dân phố tổ chức họp toàn thể</th>
                <th rowspan="2">Ghi chú</th>
                @if ($isxembaocao == 'false')
                    <th rowspan="2"></th>
                @endif
            </tr>
            <tr>
                <th>1 năm/lần</th>
                <th>1 năm/2 lần</th>
                <th>Khác</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tongso = 0;
                $tongso1nam = 0;
                $tongso2nam = 0;
                $khac = 0;
            @endphp
            @foreach ($lsKetQuaToChucHops as $index => $dataItem)
                @php
                    $tongso += $dataItem->tongso_thonban;
                    $tongso1nam += $dataItem->sothonban_hop1nam1lan;
                    $tongso2nam += $dataItem->sothonban_hop1nam2lan;
                    $khac += $dataItem->sothonban_hopkhac;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $dataItem->donvi->donvicha->ten_donvi }}</td>
                    <td>
                        {{ $dataItem->ten_xaphuong }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->tongso_thonban }}
                    </td>

                    <td class="text-right">
                        {{ $dataItem->sothonban_hop1nam1lan }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->sothonban_hop1nam2lan }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->sothonban_hopkhac }}
                    </td>
                    <td>
                        {{ $dataItem->ghi_chu }}
                    </td>
                    @if ($isxembaocao == 'false')
                        <td class="width-50 text-center">
                            @can('edit_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="ShowModalSuaKetQuaToChucHopThonBanToDanPho({{ $dataItem->id }})"
                                    title="Sửa"><i class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                            @endcan
                            @can('delete_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="XoaKetQuaToChucHopThonBanToDanPho({{ $dataItem->id }})" title="Xóa"><i
                                        class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                            @endcan
                        </td>
                    @endif
                </tr>
            @endforeach
            @if (count($lsKetQuaToChucHops) == 0)
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
                    @if ($isxembaocao == 'false')
                        <td>

                        </td>
                    @endif
                </tr>
            @endif
            <tr>
                <td></td>
                <td>

                </td>
                <td style="text-align: left; font-weight: bold">Cộng</td>
                <td style="text-align: right">{{ $tongso }}</td>
                <td style="text-align: right">{{ $tongso1nam }}</td>
                <td style="text-align: right">{{ $tongso2nam }}</td>
                <td style="text-align: right">{{ $khac }}</td>
                <td style="text-align: right"></td>
                @if ($isxembaocao == 'false')
                    <td>

                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
