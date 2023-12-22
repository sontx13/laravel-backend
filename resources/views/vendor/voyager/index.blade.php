@extends('voyager::master')

@section('content')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <div class="page-content">
        @include('voyager::alerts')

        <div class="container-fluid" style="padding-top: 2rem;">
            <a href="https://qcdc.bacgiang.gov.vn/"
                style="font-size: 20px;text-decoration:underline; font-weight: bold; color:rgb(0, 132, 255)">www.qcdc.bacgiang.gov.vn</a>
            <div> Cổng thông tin quy chế dân chủ tỉnh Bắc Giang </div>
            <div style="margin-top:3rem">
                <a href="https://qcdc.bacgiang.gov.vn/documents/11619891/0/4.+Noi+dung+cong+khai+dua+len+phan+mem+%28link+down+trang+chu%29.pdf/91a313b4-289c-4b54-a57b-696f31ccedf7"
                    style="font-size: 20px; text-decoration:underline; font-weight: bold;color:rgb(0, 132, 255)">File công
                    khai</a>
                <div>Bao gồm 60 tiểu mục công khai và mã số tương ứng</div>
            </div>
            <div style="margin-top:3rem">
                <a href="https://qcdc.bacgiang.gov.vn/documents/11619891/0/File+Nhan+dan+tham+gia+y+kien.pdf/689a8712-7d0b-4609-9f84-19ae0b74fb02"
                    style="font-size: 20px; text-decoration:underline; font-weight: bold;color:rgb(0, 132, 255)">Nội dung
                    Nhân dân tham gia ý kiến </a>
                <div>Mã số nội dung, mục và nội dung Nhân dân tham gia ý kiến
                </div>
            </div>

            <div style="margin-top:3rem">
                <a href="https://qcdc.bacgiang.gov.vn/documents/11619891/0/HDSD+phan+mem+quan+ly+thong+tin+QCDC.pdf/3a5b0a58-a4af-45e6-b0a1-67dfa6b6a446"
                    style="font-size: 20px; text-decoration:underline; font-weight: bold;color:rgb(0, 132, 255)">Hướng dẫn
                    sử dụng phần mềm
                </a>
                <div>Tài liệu hướng dẫn sử dụng Quản trị thông tin quy chế dân chủ
                </div>
            </div>
        </div>
        @if ($lsThongBao != null)
            <div class="container-fluid" style="margin-top:2rem;">
                <div class="">
                    <div class="" style="font-size: 20px; font-weight: bold;color:rgb(0, 132, 255)">Thông báo</div>
                    <div class="">
                        <div class="row">
                            <div class="col-md-12">
                                <br>
                                @if (sizeof($lsThongBao) == 0)
                                    <div class="alert alert-warning">
                                        Bạn không có thông báo nào!
                                    </div>
                                @else
                                    <ul>
                                        @foreach ($lsThongBao as $index => $tb)
                                            <li style="color: rgb(0, 153, 255)">{{ $tb->tieu_de }} : {{ $tb->noi_dung }}
                                            </li>
                                        @endforeach
                                    </ul>
                                    {{-- <table class="table table-sm table-bordered table-hover table-stripper">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Thông báo</th>
                                                <th>Nội dung</th>
                                                <th>Ngày gửi</th>
                                                <th>Dữ liệu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lsThongBao as $index => $tb)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $tb->tieu_de }}</td>
                                                    <td>{{ $tb->noi_dung }}</td>
                                                    <td>{{ $tb->ngay_gui }}</td>
                                                    <td>{{ $tb->du_lieu }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {!! $lsThongBao->links('pagination::bootstrap-4') !!} --}}
                                @endif

                            </div>

                        </div>


                    </div>
                </div>
            </div>

        @endif
    </div>
@stop
<style>
    .box {
        position: absolute;
        bottom: 0;
        right: 0;
        z-index: 9999999;
    }

    td,
    th {
        text-align: center !important;
    }
</style>
@section('javascript')


@stop
