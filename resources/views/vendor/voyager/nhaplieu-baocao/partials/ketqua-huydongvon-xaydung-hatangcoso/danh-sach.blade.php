<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small"
        onclick="saveDoc('exportContent5', 'KẾT QUẢ HUY ĐỘNG VỐN XÂY DỰNG HẠ TẦNG CƠ SỞ');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>
</div>
<div class="container" id="exportContent5">
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">TT</th>
                <th rowspan="2">Huyện/TP</th>
                <th rowspan="2">Nội dung giám sát</th>
                <th rowspan="2">Tên công trình (cuộc vận động)</th>
                <th rowspan="2">Tổng giá trị</th>
                <th colspan="2">Trong đó</th>
                <th rowspan="2">Ghi chú</th>
                @if ($isxembaocao == 'false')
                    <th rowspan="2" class="width-50"></th>
                @endif
            </tr>
            <tr>
                <th>Nhân dân đóng góp</th>
                <th>Nhà nước hỗ trợ</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tong1 = 0;
                $tong2 = 0;
                $tong3 = 0;
            @endphp
            @foreach ($lsKetQuaHuyDongVons as $index => $dataItem)
                @php
                    $tong1 += $dataItem->tong_giatri;
                    $tong2 += $dataItem->nhandan_donggop;
                    $tong3 += $dataItem->nhanuoc_hotro;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dataItem->donvi->donvicha->ten_donvi }}</td>
                    <td>
                        {{ $dataItem->ten_xaphuong }}
                    </td>
                    <td>
                        {{ $dataItem->ten_congtrinh }}
                    </td>
                    <td class="text-right">
                        {{ number_format($dataItem->tong_giatri, 0, '.', ',') }}
                    </td>
                    <td class="text-right">
                        {{ number_format($dataItem->nhandan_donggop, 0, '.', ',') }}
                    </td>
                    <td class="text-right">
                        {{ number_format($dataItem->nhanuoc_hotro, 0, '.', ',') }}
                    </td>
                    <td>
                        {{ $dataItem->ghi_chu }}
                    </td>
                    @if ($isxembaocao == 'false')
                        <td class="width-50 text-center">
                            @can('edit_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="ShowModalSuaKetQuaHuyDongVonXayDungHaTangCoSo({{ $dataItem->id }})"
                                    title="Sửa"><i class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                            @endcan
                            @can('delete_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="XoaKetQuaHuyDongVonXayDungHaTangCoSo({{ $dataItem->id }})" title="Xóa"><i
                                        class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                            @endcan
                        </td>
                    @endif
                </tr>
            @endforeach
            @if (count($lsKetQuaHuyDongVons) == 0)
                <tr class="add-row">
                    <td>...</td>
                    <td></td>
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

                <td style="text-align: right">{{ number_format($tong1, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($tong2, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($tong3, 0, '.', ',') }}</td>
                <td style="text-align: right"></td>
                @if ($isxembaocao == 'false')
                    <td>

                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
