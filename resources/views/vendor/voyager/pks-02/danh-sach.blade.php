<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small" onclick="saveDoc('exportContent11', 'KẾT QUẢ HỖ TRỢ HƯỚNG DẪN NGƯỜI DÂN TỔ CHỨC THỰC HIỆN THỦ TỤCH ÀNH CHÍNH TẠI BỘ PHẬN MỘT CỬA');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>
</div>
<div class="container" id="exportContent11">
    <div class="text-center">
        <span class="title-table-report ">KHẢO SÁT LẤY Ý KIẾN ĐỐI VỚI CHỦ TỊCH UBND CẤP XÃ</span>
    </div>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th>Ngày báo cáo</th>
                <th>Tên đơn vị</th>
                <th>Họ tên, chức vụ cán bộ đoàn viên được phân công</th>
                <th>Số lượt người dân, tổ chức làm thủ tục hành chính tại bộ phận một cửa</th>
                <th>Số người, tổ chức tham gia đánh giá khảo sát</th>
                @if ($isxembaocao == 'false')
                <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @php
            $tongnguoi = 0;
            $tongluot = 0;
            @endphp
            @foreach ($lsKetQua as $index => $dataItem)
            @php
            $tongnguoi += $dataItem->so_nguoi;
            $tongluot += $dataItem->so_luot;
            @endphp
            <tr>
                <td style="vertical-align: middle!important;">{{$index + 1}}</td>
                <td style="vertical-align: middle!important;">{{ \Carbon\Carbon::parse($dataItem->date)->format('d/m/Y')}}</td>
                <td style="vertical-align: middle!important;">
                    {{$dataItem->ten_xaphuong}}
                </td>
                <td style="vertical-align: middle!important; white-space: pre-line">
                    {{$dataItem->ho_ten}}
                </td>

                <td style="text-align:center;vertical-align: middle!important;">
                    {{$dataItem->so_luot}}
                </td>

                <td style=" text-align:center;vertical-align: middle!important;">
                    {{$dataItem->so_nguoi}}
                </td>
                @if ($isxembaocao == 'false')
                <td class="width-50 text-center" style="vertical-align: middle!important;">
                    @can('edit_ketqua_hotro_huongdan_motcua')
                    <a href="javascript:void(0)" onclick="ShowModalSuaKetQuaHoTroHuongDanMotCua({{$dataItem->id}})" title="Sửa"><i class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                    @endcan
                    @can('delete_ketqua_hotro_huongdan_motcua')
                    <a href="javascript:void(0)" onclick="XoaKetQuaHoTroHuongDanMotCua({{$dataItem->id}})" title="Xóa"><i class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                    @endcan
                </td>
                @endif
            </tr>
            @endforeach
            @if (count($lsKetQua) == 0)
            <tr>
                <td class="text-center"></td>
                <td></td>
                <td class="text-center">
                </td>
                <td class="text-center">
                </td>

                <td class="text-center">
                </td>

                <td class="text-center">
                </td>
                </td>
            </tr>
            @endif
            <tr>
                <td></td>
                <td>

                </td>
                <td style="text-align: left; font-weight: bold">Lũy kế</td>
                <td style="text-align: right"></td>
                <td style="text-align: center">{{$tongluot}}</td>
                <td style="text-align: center">{{$tongnguoi}}</td>
                @if ($isxembaocao == 'false')
                <td>

                </td>
                @endif
            </tr>
        </tbody>
    </table>
</div>