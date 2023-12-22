<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small" onclick="saveDoc('exportContent9', 'ĐƠN THƯ KHIẾU NẠI TỐ CÁO');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>
</div>
<div class="container" id="exportContent9">
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">TT</th>
                <th rowspan="2">Huyện/TP</th>
                <th rowspan="2">Tên xã phường, thị trấn</th>
                <th colspan="2">Số đơn thư khiếu nại tố cáo đã tiếp nhận</th>
                <th colspan="2">Số đơn thư khiếu nại tố cáo đã được giải quyết</th>
                <th rowspan="2">Tổng số đơn thư khiếu nại, tố cáo chưa được giải quyết</th>
                <th rowspan="2">Ghi chú</th>
                @if ($isxembaocao == 'false')
                    <th rowspan="2"></th>
                @endif
            </tr>
            <tr>
                <th>Trong kỳ báo cáo</th>
                <th>Tính từ đầu năm</th>
                <th>Trong kỳ báo cáo</th>
                <th>Tính từ đầu năm</th>
            </tr>
        </thead>
        <tbody>
            @php
                $trongky1 = 0;
                $daunam1 = 0;
                $trongky2 = 0;
                $daunam2 = 0;
                $tong = 0;
            @endphp
            @foreach ($lsDonThuKhieuNais as $index => $dataItem)
                @php
                    $trongky1 += $dataItem->sodonthu_datiepnhan_trongkybaocao;
                    $daunam1 += $dataItem->sodonthu_datiepnhan_tinhtudaunam;
                    $trongky2 += $dataItem->sodonthu_dagiaiquyet_trongkybaocao;
                    $daunam2 += $dataItem->sodonthu_dagiaiquyet_tinhtudaunam;
                    $tong += $dataItem->tongso_donthu_chuagiaiquyet;
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
                        {{ $dataItem->sodonthu_datiepnhan_trongkybaocao }}
                    </td>

                    <td class="text-right">
                        {{ $dataItem->sodonthu_datiepnhan_tinhtudaunam }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->sodonthu_dagiaiquyet_trongkybaocao }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->sodonthu_dagiaiquyet_tinhtudaunam }}
                    </td>
                    <td class="text-right">
                        {{ $dataItem->tongso_donthu_chuagiaiquyet }}
                    </td>
                    <td>
                        {{ $dataItem->ghi_chu }}
                    </td>

                    @if ($isxembaocao == 'false')
                        <td class="width-50 text-center">
                            @can('edit_nhaplieu-baocao')
                                <a href="javascript:void(0)" onclick="ShowModalSuaDonThuKhieuNaiToCao({{ $dataItem->id }})"
                                    title="Sửa"><i class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                            @endcan
                            @can('delete_nhaplieu-baocao')
                                <a href="javascript:void(0)" onclick="XoaDonThuKhieuNaiToCao({{ $dataItem->id }})"
                                    title="Xóa"><i class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                            @endcan
                        </td>
                    @endif
                </tr>
            @endforeach
            @if (count($lsDonThuKhieuNais) == 0)
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
                <td style="text-align: right">{{ $trongky1 }}</td>
                <td style="text-align: right">{{ $daunam1 }}</td>
                <td style="text-align: right">{{ $trongky2 }}</td>
                <td style="text-align: right">{{ $daunam2 }}</td>
                <td style="text-align: right">{{ $tong }}</td>
                <td style="text-align: right"></td>
                @if ($isxembaocao == 'false')
                    <td>

                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
