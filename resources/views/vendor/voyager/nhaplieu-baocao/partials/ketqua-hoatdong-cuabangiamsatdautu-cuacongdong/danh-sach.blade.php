<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small"
        onclick="saveDoc('exportContent8', 'KẾT QUẢ HOẠT ĐỘNG CỦA BAN GIÁM SÁT ĐẦU TƯ CỦA CỘNG ĐỒNG');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>
</div>
<div class="container" id="exportContent8">

    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th class="text-center">TT</th>
                <th>Huyện/TP</th>
                <th>Tên xã phường, thị trấn</th>
                <th>Số công trình, dự án trên địa bàn</th>
                <th>Số cuộc giám sát</th>
                <th>Phát hiện số sai phạm/công trình, dự án</th>
                <th>Số vụ việc kiến nghị</th>
                <th>Thu hồi tiền (đồng)</th>
                <th>Giảm trừ quyết toán (đồng)</th>
                <th>Xử lý khác (đồng)</th>
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
                    $tong1 += $dataItem->so_congtrinh;
                    $tong2 += $dataItem->socuoc_giamsat;
                    $tong3 += $dataItem->phathien_sosaipham;
                    $tong4 += $dataItem->sovuviec_kiennghi;
                    $tong5 += $dataItem->thuhoi_tien;
                    $tong6 += $dataItem->giamtru_quyettoan;
                    $tong7 += $dataItem->xuly_khac;
                    
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        {{ $dataItem->donvi->donvicha->ten_donvi }}
                    </td>
                    <td>
                        {{ $dataItem->ten_xaphuong }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->so_congtrinh }}
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
                        {{ number_format($dataItem->giamtru_quyettoan, 0, '.', ',') }}
                    </td>
                    <td class="text-right">
                        {{ number_format($dataItem->xuly_khac, 0, '.', ',') }}
                    </td>
                    @if ($isxembaocao == 'false')
                        <td class="width-50 text-center">
                            @can('edit_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="ShowModalSuaKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong({{ $dataItem->id }})"
                                    title="Sửa"><i class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                            @endcan
                            @can('delete_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="XoaKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong({{ $dataItem->id }})"
                                    title="Xóa"><i class="glyphicon glyphicon-trash icon icon-delete"></i></a>
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
                <td style="text-align: right">{{ number_format($tong5, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($tong6, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($tong7, 0, '.', ',') }}</td>

                @if ($isxembaocao == 'false')
                    <td>

                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
