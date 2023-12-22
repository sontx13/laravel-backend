<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small"
        onclick="saveDoc('exportContent3', 'NHÂN DÂN BÀN, BIỂU QUYẾT, CƠ QUAN CÓ THẨM QUYỀN QUYẾT ĐỊNH');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>
</div>
<div class="container" id="exportContent3">
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">TT</th>
                <th rowspan="2">Huyện/TP</th>
                <th rowspan="2">Tên xã, phường, thị trấn</th>
                <th rowspan="2">Nội dung công việc</th>
                <th rowspan="2">Loại công việc</th>
                <th rowspan="2">Cơ quan chủ trì</th>
                <th colspan="2">Hình thức bàn</th>
                <th rowspan="2">Số phương án được chuẩn bị</th>
                <th rowspan="2">Kết quả biểu quyết</th>
                @if ($isxembaocao == 'false')
                    <th rowspan="2" class="width-50"></th>
                @endif
            </tr>
            <tr>
                <th>Hội nghị</th>
                <th>Phát phiếu</th>
            </tr>
        </thead>
        <tbody>
            @php
                $hoinghi = 0;
                $phatphieu = 0;
                $sophuongan = 0;
            @endphp
            @foreach ($lsNhanDanBanVaCoQuanQuyetDinhs as $index => $dataItem)
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
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $dataItem->donvi->donvicha->ten_donvi }}</td>
                    <td>
                        {{ $dataItem->ten_xaphuong }}
                    </td>
                    <td>
                        {{ $dataItem->noidung_congviec }}
                    </td>
                    <td>
                        @switch($dataItem->loaicongviec)
                            @case(0)
                                <span>Hương ước, quy ước của thôn, tổ dân phố</span>
                            @break

                            @case(1)
                                <span>Bãi, miễn nhiệm, bãi nhiệm trưởng thôn, tổ trưởng tổ dân phố</span>
                            @break

                            @case(2)
                                <span>Bầu, bãi nhiệm thành viên Ban thanh tra nhân dân</span>
                            @break

                            @case(3)
                                <span>Bầu, bãi nhiệm Ban giám sát đầu tư của cộng đồng</span>
                            @break

                            @default
                                {{ $dataItem->loaicongviec }}
                        @endswitch
                    </td>
                    <td>
                        {{ $dataItem->coquan_chutri }}
                    </td>
                    <td class="text-center">
                        @if ($dataItem->hinhthuc_ban == App\Enums\HinhThucBanEnum::HoiNghi)
                            X
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($dataItem->hinhthuc_ban == App\Enums\HinhThucBanEnum::PhatPhieu)
                            X
                        @endif
                    </td>
                    <td>
                        {{ $dataItem->so_phuongan }}
                    </td>
                    <td>
                        {{ $dataItem->ketqua_bieuquyet }}
                    </td>
                    @if ($isxembaocao == 'false')
                        <td class="width-50 text-center">
                            @can('edit_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="ShowModalSuaNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh({{ $dataItem->id }})"
                                    title="Sửa"><i class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                            @endcan
                            @can('delete_nhaplieu-baocao')
                                <a href="javascript:void(0)"
                                    onclick="XoaNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh({{ $dataItem->id }})"
                                    title="Xóa"><i class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                            @endcan
                        </td>
                    @endif
                </tr>
            @endforeach
            @if (count($lsNhanDanBanVaCoQuanQuyetDinhs) == 0)
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
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center">{{ $hoinghi }}</td>
                <td style="text-align: center">{{ $phatphieu }}</td>
                <td style="text-align: left">{{ $sophuongan }}</td>
                <td style="text-align: right"></td>
                @if ($isxembaocao == 'false')
                    <td>

                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
