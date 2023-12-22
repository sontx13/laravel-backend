<div class="container">
    <div class="text-center">
        <span class="title-table-report ">BÁO CÁO KẾT QUẢ HƯỚNG DẪN NGƯỜI DÂN THỰC HIỆN KHẢO SÁT</span>
    </div>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th>Tên đơn vị</th>
                <th>Số lượt làm thủ tục hành chính </th>
                <th>Số người đánh giá khảo sát</th>
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
                <td style="vertical-align: middle!important;">
                    {{$dataItem->ten_xaphuong}}
                </td>
                <td style="text-align:center;vertical-align: middle!important;">
                    {{$dataItem->so_luot}}
                </td>

                <td style=" text-align:center;vertical-align: middle!important;">
                    {{$dataItem->so_nguoi}}
                </td>
            </tr>
            @endforeach
            @if (count($lsKetQua) == 0)
            <tr>
                <th class="text-center"></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @endif
            <tr>
                <td></td>

                <td style="text-align: left; font-weight: bold">Lũy kế</td>
                <td style="text-align: center">{{$tongluot}}</td>
                <td style="text-align: center">{{$tongnguoi}}</td>
            </tr>
        </tbody>
    </table>
</div>