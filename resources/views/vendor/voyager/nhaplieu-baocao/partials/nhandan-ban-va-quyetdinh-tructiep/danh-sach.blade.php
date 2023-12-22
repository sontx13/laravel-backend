<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small"
        onclick="saveDoc('exportContent2', 'NHÂN DÂN BÀN VÀ QUYẾT ĐỊNH TRỰC TIẾP');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>

</div>
<div class="container" id="exportContent2">
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th rowspan="2">Tên xã, phường, thị trấn</th>
                <th rowspan="2">Cơ quan chủ trì</th>
                <th rowspan="2">Số phương án được chuẩn bị</th>
                <th rowspan="2">Nội dung</th>
                <th rowspan="2">Tóm tắt nội dung</th>
                <th rowspan="2">Tổng giá trị</th>
                <th colspan="4">Trong đó</th>
                <th rowspan="2">Hình thức bàn</th>
                <th rowspan="2">Kết quả biểu quyết</th>
                @if ($isxembaocao == 'false')
                    <th rowspan="2" class="width-50"></th>
                @endif
            </tr>
            <tr>
                <th>NSNN</th>
                <th>Nhân dân đóng góp (tiền)</th>
                <th>Ngày công</th>
                <th>Khác</th>
            </tr>
        </thead>
        <tbody>
            @php
                $hoinghi = 0;
                $phatphieu = 0;
                $sophuongan = 0;
            @endphp
            @foreach ($lsNhanDanBanVaQuyetDinhs as $index => $dataItem)
                @php
                    if ($dataItem->hinhthuc_ban == App\Enums\HinhThucBanEnum::HoiNghi) {
                        $hoinghi++;
                    }
                    if ($dataItem->hinhthuc_ban == App\Enums\HinhThucBanEnum::PhatPhieu) {
                        $phatphieu++;
                    }
                    $sophuongan += $dataItem->so_phuongan;
                @endphp
                <tr>
                    <td>
                        {{ $dataItem->ten_xaphuong }} / {{ $dataItem->donvi->donvicha->ten_donvi }}
                    </td>
                    <td>
                        {{ $dataItem->coquan_chutri }}
                    </td>
                    <td>
                        {{ $dataItem->so_phuongan }}
                    </td>
                    <td>
                        {{ $dataItem->noidung_congviec }}
                    </td>
                    <td>
                        {{ $dataItem->tomtat_noidung }}
                    </td>
                    <td>
                        {{ number_format($dataItem->tong_giatri, 0, '.', '.') }}
                    </td>
                    <td>
                        {{ number_format($dataItem->nsnn, 0, '.', '.') }}
                    </td>
                    <td>
                        {{ number_format($dataItem->nddg, 0, '.', '.') }}
                    </td>
                    <td>
                        {{ number_format($dataItem->ngay_cong, 0, '.', '.') }}
                    </td>
                    <td>
                        {{ $dataItem->khac }}
                    </td>
                    <td class="text-center">
                        @if ($dataItem->hinhthuc_ban == App\Enums\HinhThucBanEnum::HoiNghi)
                            Hội nghị
                        @endif
                        @if ($dataItem->hinhthuc_ban == App\Enums\HinhThucBanEnum::PhatPhieu)
                            Phát biểu
                        @endif
                        @if ($dataItem->hinhthuc_ban == App\Enums\HinhThucBanEnum::BieuQuyet)
                            Biểu quyết
                        @endif
                    </td>

                    <td>
                        {{ $dataItem->ketqua_bieuquyet }}
                    </td>
                    @if ($isxembaocao == 'false')
                        <td class="width-50 text-center">
                            @can('edit_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="ShowModalSuaNhanDanBanVaQuyetDinhTrucTiep({{ $dataItem->id }})"
                                    title="Sửa"><i class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                            @endcan
                            @can('delete_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="XoaNhanDanBanVaQuyetDinhTrucTiep({{ $dataItem->id }})" title="Xóa"><i
                                        class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                            @endcan
                        </td>
                    @endif
                </tr>
            @endforeach
            @if (count($lsNhanDanBanVaQuyetDinhs) == 0)
            @endif
        </tbody>
    </table>
</div>
