<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small" onclick="saveDoc('exportContent4', 'NHÂN DÂN THAM GIA Ý KIẾN');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>
</div>
<div class="" id="exportContent4">
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th rowspan="2">Tên xã, phường, thị trấn</th>
                <th class="text-center" rowspan="2">
                    MSND
                </th>
                <th class="text-center" rowspan="2">
                    Mục
                </th>
                <th rowspan="2">Nội dung</th>
                <th rowspan="2">Tóm tắt nội dung lấy ý kiến</th>
                <th colspan="8">Hình thức lấy ý kiến</th>
                <th colspan="2">Thời gian lấy ý kiến</th>
                <th colspan="3">Đính tệp</th>
                @if ($isxembaocao == 'false')
                    <th></th>
                @endif
            </tr>
            <tr>
                <th class="text-center" style="vertical-align: middle;font-style: italic;">HN tiếp xúc đối thoại</th>
                <th class="text-center" style="vertical-align: middle; font-style: italic;">Họp dân</th>
                <th class="text-center"style="vertical-align: middle; font-style: italic;">Phát phiếu
                </th>
                <th class="text-center"style="vertical-align: middle; font-style: italic;">Hòm thư</th>
                <th class="text-center"style="vertical-align: middle; font-style: italic;">Ban CTMT
                </th>
                <th class="text-center"style="vertical-align: middle;font-style: italic;">Trang tin điện tử</th>
                <th class="text-center"style="vertical-align: middle;font-style: italic;">Mạng xã hội</th>
                <th class="text-center"style="vertical-align: middle;font-style: italic;">Tổ chức đối thoại</th>
                <th class="text-center"style="vertical-align: middle;font-style: italic;">Từ ngày
                </th>
                <th class="text-center" style="vertical-align: middle;font-style: italic;">Đến ngày</th>
                <th class="text-center"style="vertical-align: middle;font-style: italic;">Kế hoạch lấy ý kiến
                </th>
                <th class="text-center" style="vertical-align: middle;font-style: italic;">BC giải trình</th>
                <th class="text-center" style="vertical-align: middle;font-style: italic;">Dự thảo xin ý kiến</th>
                @if ($isxembaocao == 'false')
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($lsNhanDanThamGiaYKiens as $index => $dataItem)
                <tr>
                    <td>
                        {{ $dataItem->ten_xaphuong }}/{{ $dataItem->donvi->donvicha->ten_donvi }}
                    </td>
                    <td>
                        @if ($dataItem->noidung)
                            {{ $dataItem->noidung->msnd }}
                        @endif

                    </td>
                    <td>
                        @if ($dataItem->noidung)
                            {{ $dataItem->noidung->muc }}
                        @endif
                    </td>
                    <td>
                        @if ($dataItem->noidung)
                            {{ $dataItem->noidung->noidung }}
                        @endif
                    </td>
                    <td>
                        {{ $dataItem->tomtat }}
                    </td>
                    @php
                        $jsonString = $dataItem->hinhthuc_thamgia_ykien; // Chuỗi JSON
                        $arrayData = json_decode($jsonString, true); // Chuyển chuỗi JSON thành mảng
                    @endphp

                    @if (is_array($arrayData))
                        <td class="text-center">
                            @foreach ($arrayData as $item)
                                @if ($item == 'Hội nghị tiếp xúc, đối thoại')
                                    X
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach ($arrayData as $item)
                                @if ($item == 'Họp cộng đồng dân cư')
                                    X
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach ($arrayData as $item)
                                @if ($item == 'Phát phiếu lấy ý kiến')
                                    X
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach ($arrayData as $item)
                                @if ($item == 'Hòm thư, đường dây nóng')
                                    X
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach ($arrayData as $item)
                                @if ($item == 'Thông qua Ban công tác Mặt trận và các tổ chức chính trị - xã hội')
                                    X
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach ($arrayData as $item)
                                @if ($item == 'Thông qua trang tin điện tử cấp xã')
                                    X
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach ($arrayData as $item)
                                @if ($item == 'Thông qua mạng viễn thông, mạng xã hội')
                                    X
                                @endif
                            @endforeach
                        </td>
                        <td class="text-center">
                            @foreach ($arrayData as $item)
                                @if ($item == 'Tổ chức đối thoại, lấy ý kiến công dân')
                                    X
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td>
                        @if ($dataItem->bat_dau_y_kien && $dataItem->ket_thuc_y_kien)
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dataItem->bat_dau_y_kien)->format('d/m/Y') }}
                        @endif
                    </td>
                    <td>
                        @if ($dataItem->bat_dau_y_kien && $dataItem->ket_thuc_y_kien)
                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $dataItem->ket_thuc_y_kien)->format('d/m/Y') }}
                        @endif
                    </td>

                    <td>
                        @if ($dataItem->ke_hoach)
                            <a href="{{ $dataItem->ke_hoach }}">Tải xuống</a>
                        @endif
                    </td>
                    <td>
                        @if ($dataItem->baocao)
                            <a href="{{ $dataItem->baocao }}">Tải xuống</a>
                        @endif
                    </td>
                    <td>
                        @if ($dataItem->duthao)
                            <a href="{{ $dataItem->duthao }}" target="_blank">Tải xuống</a>
                        @endif
                    </td>
                    @if ($isxembaocao == 'false')
                        <td class="width-50 text-center">
                            @can('edit_nhaplieu-baocao')
                                <a href="javascript:void(0)" onclick="ShowModalSuaNhanDanThamGiaYKien({{ $dataItem->id }})"
                                    title="Sửa"><i class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                            @endcan
                            @can('delete_nhaplieu-baocao')
                                <a href="javascript:void(0)" onclick="XoaNhanDanThamGiaYKien({{ $dataItem->id }})"
                                    title="Xóa"><i class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                            @endcan
                        </td>
                    @endif
                </tr>
            @endforeach
            @if (count($lsNhanDanThamGiaYKiens) == 0)
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
        </tbody>
    </table>
</div>
