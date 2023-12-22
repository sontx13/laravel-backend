<div class="container">
    <button class="btn btn-primary pull-right" id="export-btn">Tải xuống excel</button>
    <table class="table table-bordered" border="1" id="my-table" style="background-color: #fff">
        <thead>
            <tr>
                <th rowspan="2" class="text-center" style="vertical-align: middle;font-weight: bold;">STT</th>
                <th class="text-center" rowspan="2" style="vertical-align: middle; font-weight: bold;">Tên đơn vị
                </th>
                <th class="text-center" rowspan="2" style="vertical-align: middle; font-weight: bold; ">
                    Tên xã, phường, thị trấn
                </th>
                <th class="text-center" rowspan="2" style="vertical-align: middle; font-weight: bold; ">
                    Kết quả nhập số liệu
                </th>
                <th class="text-center" rowspan="2" style="vertical-align: middle; font-weight: bold; width:15%;">
                    Số lần nhập liệu
                <th class="text-center"colspan="3" style="vertical-align: middle; font-weight: bold;">Đánh giá
                </th>
            </tr>
            <tr>
                <th class="text-center"style="vertical-align: middle;font-style: italic;">Tốt</th>
                <th class="text-center"style="vertical-align: middle;font-style: italic; width:7rem">Trung bình
                </th>
                <th class="text-center" style="vertical-align: middle;font-style: italic;">Yếu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lsHuyen as $item)
                <tr>
                    <th rowspan="{{ $item->tong_so + 2 }}" style="vertical-align: middle; text-algin:center">
                        {{ $loop->index + 1 }}
                    </th>
                    <th rowspan="{{ $item->tong_so + 2 }}"
                        style="vertical-align: middle; text-algin:center; font-weight:bold;border-right-width: 1px;">
                        {{ $item->ten_donvi }}</th>
                </tr>


                @foreach ($lsXa as $item2)
                    @if ($item2->id_donvi_cha == $item->id)
                        <tr>
                            <td>{{ $item2->ten_donvi }}</td>
                            <td>
                                @if ($item2->check == 1)
                                    X
                                @endif
                            </td>
                            <td>{{ $item2->dem }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td style="font-weight:bold">Tổng số</td>
                    <td>
                        {{ $item->total }}
                    </td>
                    <td>{{ $item->tong_so_muc }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
