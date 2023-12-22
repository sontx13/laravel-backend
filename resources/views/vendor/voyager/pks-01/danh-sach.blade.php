<div class="in" style="float: right;">
    <a href="#" class="btn btn-success btn-small" onclick="window.print()">
        <span class="glyphicon glyphicon-print"></span> In báo cáo
    </a>
    <a href="#" class="btn btn-info btn-small"
        onclick="saveDoc('exportContent11', 'KẾT QUẢ HỖ TRỢ HƯỚNG DẪN NGƯỜI DÂN TỔ CHỨC THỰC HIỆN THỦ TỤCH ÀNH CHÍNH TẠI BỘ PHẬN MỘT CỬA');">
        <span class="glyphicon glyphicon-download"></span> Tải word
    </a>
</div>
<div class="container" id="exportContent11">
    <div class="text-center">
        <span class="title-table-report ">KHẢO SÁT LẤY Ý KIẾN CỦA CÁN BỘ, CÔNG CHỨC VỀ THỰC HIỆN QUY CHẾ DÂN CHỦ Ở CƠ QUAN XÃ, PHƯỜNG, THỊ TRẤN</span>
    </div>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th>Tên xã, phường, thị trấn</th>
                <th>Số luọng cán bộ công chức thuộc cơ quan cấp xã</th>
                @if ($isxembaocao == 'false')
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>

            @foreach ($lsKetQua as $index => $dataItem)
                <tr>
                    <td style="vertical-align: middle!important;">{{ $index + 1 }}</td>
                    <td style="vertical-align: middle!important;">
                        {{ $dataItem->ten_xaphuong }}
                    </td>

                    <td style="text-align:center;vertical-align: middle!important;">
                        {{ $dataItem->so_luong }}
                    </td>
                    @if ($isxembaocao == 'false')
                        <td class="width-50 text-center" style="vertical-align: middle!important;">
                            @can('edit_ketqua_hotro_huongdan_motcua')
                                <a href="javascript:void(0)"
                                    onclick="ShowModalSuaKetQuaHoTroHuongDanMotCua({{ $dataItem->id }})" title="Sửa"><i
                                        class="glyphicon glyphicon-edit icon icon-edit"></i></a>
                            @endcan
                            @can('delete_ketqua_hotro_huongdan_motcua')
                                <a href="javascript:void(0)" onclick="XoaKetQuaHoTroHuongDanMotCua({{ $dataItem->id }})"
                                    title="Xóa"><i class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                            @endcan
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
