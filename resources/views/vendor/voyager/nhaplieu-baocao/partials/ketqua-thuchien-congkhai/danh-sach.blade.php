<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small" onclick="saveDoc('exportContent1', 'KẾT QUẢ THỰC HIỆN CÔNG KHAI');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>
</div>
<div class="container" id="exportContent1">
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">TT</th>
                <th rowspan="2">Huyện/TP</th>
                <th rowspan="2">Tên xã, phường, thị trấn</th>
                <th rowspan="2">Nội dung công khai</th>
                <th rowspan="2">Cơ quan thực hiện công khai</th>
                <th colspan="4">Hình thức công khai</th>
                <th width="160" rowspan="2">Công khai theo kế hoạch số</th>

                <th rowspan="2">File KH</th>
                <th rowspan="2">Ghi chú</th>
                @if ($isxembaocao == 'false')
                    <th rowspan="2" class="width-50"></th>
                @endif
            </tr>
            <tr>
                <th width="50" class="text-center">Niêm yết</th>
                <th width="50" class="text-center">Loa truyền thanh</th>
                <th width="50" class="text-center">Qua trưởng thôn, TDP</th>
                <th width="50" class="text-center">Khác</th>
            </tr>
        </thead>
        <tbody>
            @php
                $niemyet = 0;
                $loaphuong = 0;
                $truongthon = 0;
                $khac = 0;
            @endphp
            @foreach ($lsKetQuaThucHiens as $index => $kqThucHien)
                @php
                    if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::NiemYet) {
                        $niemyet++;
                    }
                    if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::LoaTruyenThanh) {
                        $loaphuong++;
                    }
                    if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::QuaTruongThong) {
                        $truongthon++;
                    }
                    if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::Khac) {
                        $khac++;
                    }
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $kqThucHien->donvi->donvicha->ten_donvi }}</td>
                    <td>
                        {{ $kqThucHien->ten_xaphuong }}
                    </td>
                    <td>
                        {{ $kqThucHien->noidung_congkhai }}
                    </td>
                    <td>
                        {{ $kqThucHien->coquan_congkhai }}
                    </td>
                    <td class="text-center">
                        @if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::NiemYet)
                            X
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::LoaTruyenThanh)
                            X
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::QuaTruongThong)
                            X
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($kqThucHien->hinhthuc_congkhai == App\Enums\HinhThucCongKhaiEnum::Khac)
                            X
                        @endif
                    </td>
                    <td>
                        {{ $kqThucHien->sokehoach_congkhai }}
                    </td>

                    <td class="text-center">
                        @if ($kqThucHien->filecongkhai_path != null)
                            <a href="{{ $kqThucHien->filecongkhai_path }}" target="_blank">Tải về</a>
                        @endif
                    </td>
                    <td>
                        {{ $kqThucHien->ghi_chu }}
                    </td>
                    @if ($isxembaocao == 'false')
                        <td class="width-50 text-center">
                            @can('edit_nhaplieu-baocao')
                                <a href="javascript:void(0)" onclick="ShowAddEditKQTHCK({{ $kqThucHien->id }})"
                                    title="Sửa"><i class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                            @endcan
                            @can('delete_nhaplieu-baocao')
                                <a href="javascript:void(0)" onclick="XoaKetQuaThucHienCongKhai({{ $kqThucHien->id }})"
                                    title="Xóa"><i class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                            @endcan
                        </td>
                    @endif
                </tr>
            @endforeach
            @if (count($lsKetQuaThucHiens) == 0)
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
                <td style="text-align: right">{{ $niemyet }}</td>
                <td style="text-align: right">{{ $loaphuong }}</td>
                <td style="text-align: right">{{ $truongthon }}</td>
                <td style="text-align: right">{{ $khac }}</td>
                <td style="text-align: right"></td>
                <td style="text-align: right"></td>
                @if ($isxembaocao == 'false')
                    <td>

                    </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
