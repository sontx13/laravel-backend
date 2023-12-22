<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small"
        onclick="saveDoc('exportContent7', 'KẾT QUẢ HOẠT ĐỘNG CỦA BAN THANH TRA NHÂN DÂN');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>
</div>
<div class="container" id="exportContent7">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">TT</th>
                <th>Huyện/TP</th>
                <th>Tên xã phường, thị trấn</th>
                <th>Số cuộc giám sát</th>
                <th>Phát hiện số sai phạm/ vụ việc</th>
                <th>Số vụ việc kiến nghị</th>
                <th>Thu hồi tiền (đồng)</th>
                <th>Xử lý khác về tiền (đồng)</th>
                <th>Thu hồi đất (m2)</th>
                <th>Xử lý khác về đất (m2)</th>
                <th>Kiến nghị xử lý bất cập, vướng mắc về quy định pháp luật (nêu cụ thể)</th>
                @if ($isxembaocao == 'false')
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @php
                $tong1 = 0;
                $tong2 = 0;
                $tong3 = 0;
                $tong4 = 0;
                $tong5 = 0;
                $tong6 = 0;
                $tong7 = 0;
            @endphp
            @foreach ($lsKetQuaHoatDongs as $index => $dataItem)
                @php
                    $tong1 += $dataItem->socuoc_giamsat;
                    $tong2 += $dataItem->phathien_sosaipham;
                    $tong3 += $dataItem->sovuviec_kiennghi;
                    $tong4 += $dataItem->thuhoi_tien;
                    $tong5 += $dataItem->xulykhac_vetien;
                    $tong6 += $dataItem->thuhoi_dat;
                    $tong7 += $dataItem->xulykhac_vedat;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $dataItem->donvi->donvicha->ten_donvi }}</td>
                    <td>
                        {{ $dataItem->ten_xaphuong }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->socuoc_giamsat }}
                    </td>

                    <td class="text-right">
                        {{ $dataItem->phathien_sosaipham }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->sovuviec_kiennghi }}
                    </td>
                    <td class="text-right">
                        {{ number_format($dataItem->thuhoi_tien, 0, '.', ',') }}
                    </td>
                    <td class="text-right">
                        {{ number_format($dataItem->xulykhac_vetien, 0, '.', ',') }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->thuhoi_dat }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->xulykhac_vedat }}
                    </td>
                    <td>
                        {{ $dataItem->kiennghi_xulybatcap }}
                    </td>
                    @if ($isxembaocao == 'false')
                        <td class="width-50">
                            @can('edit_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="ShowModalSuaKetQuaHoatDongCuaBanThanhTraNhanDan({{ $dataItem->id }})"
                                    title="Sửa"><i class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                            @endcan
                            @can('delete_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="XoaKetQuaHoatDongCuaBanThanhTraNhanDan({{ $dataItem->id }})" title="Xóa"><i
                                        class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                            @endcan
                        </td>
                    @endif
                </tr>
            @endforeach
            @if (count($lsKetQuaHoatDongs) == 0)
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
                <td style="text-align: right">{{ $tong1 }}</td>
                <td style="text-align: right">{{ $tong2 }}</td>
                <td style="text-align: right">{{ $tong3 }}</td>
                <td style="text-align: right">{{ $tong4 }}</td>
                <td style="text-align: right">{{ $tong5 }}</td>
                <td style="text-align: right">{{ $tong6 }}</td>
                <td style="text-align: right">{{ $tong7 }}</td>
                <td>

                </td>
                @if ($isxembaocao == 'false')
                    <td>

                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
