<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Kết quả thực hiện công khai</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Include jQuery -->
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Include Bootstrap DateTimePicker CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

    <!-- Include Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Include Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Include Bootstrap DateTimePicker JavaScript -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>


    <!-- Css custom -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}" />

    <style>
        body {
            font-family: 'Nunito';
            font-size: 16px;
            overflow-x: hidden;
        }
    </style>
</head>

<body class="congkhai">

    @if ($idXa == null)
        <div id="boxdonvi">
            @if ($idHuyen == null)
                <div class="form-group" id="donviHuyen">
                    <div class="row tilte-huyen">
                        <div class="col-sm-1 col-logo margin-30">
                            <a class="logo" href="https://bacgiang.gov.vn"><img alt="TTĐT BG" height="100"
                                    src="https://qcdc.bacgiang.gov.vn/documents/11619891/16766933/1683621983161_2.+Lo+go+QCDC.png"
                                    width="100"> </a>
                        </div>

                        <div class="col-sm-5 center margin-30">
                            <h4 class="title">
                                CÁC NỘI DUNG CÔNG KHAI
                            </h4>
                            <h4 class="title">
                                CỦA XÃ, PHƯỜNG, THỊ TRẤN TỈNH BẮC GIANG
                            </h4>
                            <h4 class="title">
                                NĂM 2023
                            </h4>
                            <h4>

                            </h4>


                        </div>

                        <div class="col-sm-3 tintieubieu">
                            @if ($lsPosts != null)
                                <h4 class="portlet-title">
                                    TIN TỨC
                                </h4>

                                <li value="{{ $lsPosts[0]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[0]->url_title }}">
                                        {{ $lsPosts[0]->title }}
                                    </a>
                                </li>
                                <li value="{{ $lsPosts[1]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[1]->url_title }}">
                                        {{ $lsPosts[1]->title }}
                                    </a>
                                </li>
                                <li value="{{ $lsPosts[2]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[2]->url_title }}">
                                        {{ $lsPosts[2]->title }}
                                    </a>
                                </li>
                            @endif
                        </div>
                        <div class="col-sm-3 tintieubieu">
                            @if ($lsPosts != null)
                                <h4 class="portlet-title">
                                    &nbsp;
                                </h4>

                                <li value="{{ $lsPosts[3]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[3]->url_title }}">
                                        {{ $lsPosts[3]->title }}
                                    </a>
                                </li>
                                <li value="{{ $lsPosts[4]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[4]->url_title }}">
                                        {{ $lsPosts[4]->title }}
                                    </a>
                                </li>
                                <li value="{{ $lsPosts[5]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[5]->url_title }}">
                                        {{ $lsPosts[5]->title }}
                                    </a>
                                </li>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div>
                        <h4 style="text-align:center;font-weight: bold;
                        color:#1d6cbb;">
                            QUY
                            ĐỊNH CỦA LUẬT THỰC HIỆN DÂN CHỦ Ở CƠ SỞ VỀ CÔNG KHAI THÔNG
                            TIN:</h4>
                        <div
                            style="text-align:center;font-size:18px; display: flex;
                        justify-content: center;">
                            <li>
                                <a style="margin-right:3rem;"
                                    href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/infographic-7-hinh-thuc-cong-khai-thong-tin-o-xa-phuong-thi-tran">Hình
                                    thức công khai </a>
                            </li>
                            <li>
                                <a
                                    href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/14-noi-dung-cong-khai-o-xa-phuong-thi-tran">Nội
                                    dung công khai </a>
                            </li>

                        </div>

                    </div>
                    <div class="row list-huyen">`
                        <ul class="congkhai_huyen">
                            <li value="12">
                                <a href="/view/congkhai-webview?idHuyen=12">
                                    UBND tỉnh Bắc Giang
                                </a>
                            </li>
                            @foreach ($lsDonVis as $item)
                                <li value="{{ $item->id }}">
                                    <a href="/view/congkhai-webview?idHuyen={{ $item->id }}">
                                        {{ $item->ten_donvi }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            @else
                <div class="form-group" id="donviXa">
                    <div class="row tilte-huyen">
                        <div class="col-sm-1 col-logo margin-30">
                            <a class="logo" href="https://bacgiang.gov.vn"><img alt="TTĐT BG" height="100"
                                    src="https://qcdc.bacgiang.gov.vn/documents/11619891/16766933/1683621983161_2.+Lo+go+QCDC.png"
                                    width="100"> </a>
                        </div>

                        <div class="col-sm-5 center margin-30">
                            <h4 class="title">
                                CÁC NỘI DUNG CÔNG KHAI
                            </h4>
                            <h4 class="title">
                                CỦA ĐƠN VỊ CẤP XÃ, @if ($donvi_huyen != null)
                                    <span style="text-transform: uppercase;">{{ $donvi_huyen[0]->ten_donvi }}</span>
                                @endif
                            </h4>
                            <h4 class="title">
                                NĂM 2023
                            </h4>
                            <a href="/view/congkhai-webview" class="btn btn-success" style="margin-top: 3px;">
                                Quay lại
                            </a>
                        </div>

                        <div class="col-sm-3 tintieubieu">
                            @if ($lsPosts != null)
                                <h4 class="portlet-title">
                                    TIN TỨC
                                </h4>

                                <li value="{{ $lsPosts[0]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[0]->url_title }}">
                                        {{ $lsPosts[0]->title }}
                                    </a>
                                </li>
                                <li value="{{ $lsPosts[1]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[1]->url_title }}">
                                        {{ $lsPosts[1]->title }}
                                    </a>
                                </li>
                                <li value="{{ $lsPosts[2]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[2]->url_title }}">
                                        {{ $lsPosts[2]->title }}
                                    </a>
                                </li>
                            @endif
                        </div>
                        <div class="col-sm-3 tintieubieu">
                            @if ($lsPosts != null)
                                <h4 class="portlet-title">
                                    &nbsp;
                                </h4>

                                <li value="{{ $lsPosts[3]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[3]->url_title }}">
                                        {{ $lsPosts[3]->title }}
                                    </a>
                                </li>
                                <li value="{{ $lsPosts[4]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[4]->url_title }}">
                                        {{ $lsPosts[4]->title }}
                                    </a>
                                </li>
                                <li value="{{ $lsPosts[5]->id }}">
                                    <a target="blank"
                                        href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[5]->url_title }}">
                                        {{ $lsPosts[5]->title }}
                                    </a>
                                </li>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row list-xa">
                        <ul class="congkhai_xa">
                            @foreach ($lsDonVis as $item)
                                <li value="{{ $item->id }}">
                                    <a
                                        href="/view/congkhai-webview?idHuyen={{ $idHuyen }}&idXa={{ $item->id }}">
                                        {{ $item->ten_donvi }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div>
                    <div style="text-align:center">
                        <h4 class="title">PHIẾU KHẢO SÁT MỨC ĐỘ HÀI LÒNG CỦA CÁN BỘ, CÔNG CHỨC, NGƯỜI DÂN, TỔ CHỨC VÀ
                            DOANH
                            NGHIỆP </h4>
                        <h4 class="title">ĐỐI VỚI ỦY BAN NHÂN DÂN @if ($donvi_xa != null)
                                <span style="">{{ $donvi_xa[0]->ten_donvi }}</span>
                                <span style="">{{ $donvi_huyen[0]->ten_donvi }}</span>
                            @endif
                        </h4>

                        {{-- <h3>PHIẾU KHẢO SÁT
                        </h3>
                        <h3>
                            Mức độ hài lòng của cán bộ, công chức, người dân, tổ chức và doanh nghiệp
                            <br />
                            đối với @if ($donvi_huyen != null)
                                @if ($donvi_huyen[0]->id == 12)
                                    <span style="">{{ $donvi_huyen[0]->ten_donvi }} </span>
                                @else
                                    <span style="">Ủy ban nhân dân {{ $donvi_huyen[0]->ten_donvi }}</span>
                                @endif
                            @endif
                        </h3> --}}
                        @if ($idHuyen == '12')
                            <a href="https://bacgiang.gov.vn/thong-tin-cong-khai" target="_blank"
                                style="margin-bottom:1rem;">
                                <img style="margin-bottom:2rem;"
                                    src="https://bacgiang.gov.vn/documents/11740984/11743826/1632361101074_page_178.png/377650b7-3ef3-43e4-bf71-78dbca941b47?t=1632361101078&gidzl=3uwUBj-bzci7bfylrh_-P0QRaoV0lgbd7vl9BSEoyceJd9qlcBVpP16VcoJBkl8p4vMJUJ3e7LXorgV_R0" />
                            </a>
                        @endif
                    </div>

                    <div class="list-qr">
                        <table class="table table-qr" border="0">
                            {{-- <thead>
                                <tr>
                                    <th style="width:5%; text-align:center">STT</th>
                                    <th style="width:35%;text-align:center">PHIẾU KHẢO SÁT</th>
                                    <th style="width:5%;text-align:center">MS</th>
                                    <th style="width:10%;text-align:center">Đối tượng lấy ý kiến</th>
                                    <th style="width:45%;text-align:center">Mã QR code</th>
                                </tr>
                            </thead> --}}
                            {{-- <th style="text-align:center ;vertical-align: middle;">{{ $loop->index + 1 }}</th> --}}
                            <th style="text-align:left ;vertical-align: middle;">
                                <h4 class="title">PKS lấy ý kiến của người dân, doanh nghiệp đối với công chức làm
                                    việc tại bộ phận một cửa
                                </h4>
                                <ul class="pks">
                                    <li>MS: PKS05</li>
                                    <li>Đối tượng lấy ý kiến: Người dân, doanh nghiệp</li>
                                </ul>
                            </th>

                            {{-- <th style="text-align:center ;vertical-align: middle;">{{ $item['id'] }}</th>
                                    <th style="text-align:center ;vertical-align: middle;">{{ $item['obj'] }}</th> --}}
                            <th style="text-align:center"><img style="width:250px"
                                    src="{{ asset('storage/qr_type5_' . $idHuyen . '.jpg') }}
                                            ">
                            </th>
                            </tr>

                            {{-- <th style="text-align:center ;vertical-align: middle;">1</th>
                                <th style="text-align:center ;vertical-align: middle;">PKS lấy ý kiến của người dân, doanh
                                    nghiệp đối với công chức
                                    làm việc tại bộ phận một
                                    cửa</th>
                                <th style="text-align:center ;vertical-align: middle;">PKS05</th>
                                <th style="text-align:center ;vertical-align: middle;">Người dân, doanh nghiệp</th>
                                <th style="text-align:center"><img style="width:250px"
                                        src="{{ asset('storage/qr_type5_' . $idHuyen . '.jpg') }}">
                                </th> --}}

                        </table>
                    </div>
                </div>
            @endif
        </div>
    @else
        <div id="ketqua_congkhai">
            <div class="row tilte-huyen">
                <div class="col-sm-1 col-logo margin-30">
                    <a class="logo" href="https://bacgiang.gov.vn"><img alt="TTĐT BG" height="100"
                            src="https://qcdc.bacgiang.gov.vn/documents/11619891/16766933/1683621983161_2.+Lo+go+QCDC.png"
                            width="100"> </a>
                </div>

                <div class="col-sm-5 center margin-30">
                    <h4 class="title">
                        CÁC NỘI DUNG CÔNG KHAI
                    </h4>
                    <h4 class="title">
                        CỦA
                        @if ($donvi_xa != null)
                            <span style="text-transform: uppercase;">{{ $donvi_xa[0]->ten_donvi }}</span>
                        @endif,
                        @if ($donvi_huyen != null)
                            <span style="text-transform: uppercase;">{{ $donvi_huyen[0]->ten_donvi }}</span>
                        @endif
                        NĂM 2023
                    </h4>
                    <a href="/view/congkhai-webview?idHuyen={{ $idHuyen }}" class="btn btn-success"
                        style="margin-top: 3px;">
                        Quay lại
                    </a>
                </div>

                <div class="col-sm-3 tintieubieu">
                    @if ($lsPosts != null)
                        <h4 class="portlet-title">
                            TIN TỨC
                        </h4>

                        <li value="{{ $lsPosts[0]->id }}">
                            <a target="blank"
                                href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[0]->url_title }}">
                                {{ $lsPosts[0]->title }}
                            </a>
                        </li>
                        <li value="{{ $lsPosts[1]->id }}">
                            <a target="blank"
                                href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[1]->url_title }}">
                                {{ $lsPosts[1]->title }}
                            </a>
                        </li>
                        <li value="{{ $lsPosts[2]->id }}">
                            <a target="blank"
                                href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[2]->url_title }}">
                                {{ $lsPosts[2]->title }}
                            </a>
                        </li>
                    @endif
                </div>
                <div class="col-sm-3 tintieubieu">
                    @if ($lsPosts != null)
                        <h4 class="portlet-title">
                            &nbsp;
                        </h4>

                        <li value="{{ $lsPosts[3]->id }}">
                            <a target="blank"
                                href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[3]->url_title }}">
                                {{ $lsPosts[3]->title }}
                            </a>
                        </li>
                        <li value="{{ $lsPosts[4]->id }}">
                            <a target="blank"
                                href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[4]->url_title }}">
                                {{ $lsPosts[4]->title }}
                            </a>
                        </li>
                        <li value="{{ $lsPosts[5]->id }}">
                            <a target="blank"
                                href="https://qcdc.bacgiang.gov.vn/chi-tiet-tin-tuc/-/asset_publisher/SUvaAKdUf4CG/content/{{ $lsPosts[5]->url_title }}">
                                {{ $lsPosts[5]->title }}
                            </a>
                        </li>
                    @endif
                </div>
            </div>
            <hr>

            <div class="row ketqua">
                <div id="exportContent11" style="padding: 10px;">
                    <form method="get" class="form-search">
                        <div class="row">
                            <input type="hidden" id="idXa" name="idXa" value="{{ $idXa }}"
                                class="form-control">
                            <input type="hidden" id="idHuyen" name="idHuyen" value="{{ $idHuyen }}"
                                class="form-control">
                            <div class="col-sm-1 select-baocao-span">
                                Từ ngày
                            </div>
                            <div class="col-sm-2 ">
                                {{-- <input type="text" class="form-control" id="tu_ngay" name="tu_ngay" readonly> --}}
                                <input type="text"
                                    value="@if ($tungay) {{ \Carbon\Carbon::parse($tungay)->format('d/m/Y ') }} @endif"
                                    id="tu_ngay" name="tu_ngay" class="form-control ">
                            </div>
                            <div class="col-sm-1 select-baocao-span">
                                Đến ngày
                            </div>
                            <div class="col-sm-2 ">
                                {{-- <input type="text" class="form-control" id="den_ngay" name="den_ngay" readonly> --}}
                                <input type="text"
                                    value="@if ($denngay) {{ \Carbon\Carbon::parse($denngay)->format('d/m/Y ') }} @endif"
                                    id="den_ngay" name="den_ngay" class="form-control ">
                            </div>
                            <div style="display: flex; justify-content: center; margin-bottom:1rem;">
                                <button type="submit" class="btn btn-sm btn-primary ">
                                    <i class="voyager-search"></i> <span class="hidden-xs hidden-sm">Tìm kiếm</span>
                                </button>
                                </span>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered" border="1" style="font-size: 13px!important;">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center titleTable"
                                    style="width: 5px; writing-mode: vertical-rl; text-orientation: upright;">Nhóm</th>
                                </th>
                                <th class="text-center titleTable" rowspan="2"
                                    style="width: 5px; writing-mode: vertical-rl; text-orientation: upright;">
                                    Mục
                                </th>
                                <th class="text-center titleTable" rowspan="2"
                                    style="vertical-align: middle; font-weight: bold; width: 5px; writing-mode: vertical-rl; text-orientation: upright;">
                                    MSND
                                </th>
                                <th class="text-center titleTable" rowspan="2"
                                    style="vertical-align: middle; font-weight: bold; width:250px;">
                                    Nội
                                    dung
                                <th class="text-center titleTable" rowspan="2"
                                    style="vertical-align: middle; font-weight: bold; width:250px;">Tóm tắt
                                    thông
                                    tin công khai
                                </th>
                                <th colspan="6" class="text-center"
                                    style="vertical-align: middle; font-weight: bold;">Hình thức
                                    công khai</th>
                                <th class="text-center" rowspan="2"
                                    style="vertical-align: middle; font-weight: bold;">Thời gian
                                    công khai</th>
                                <th colspan="2" class="text-center"
                                    style="vertical-align: middle; font-weight: bold;">Thời điểm
                                    công khai</th>
                                <th colspan="2" class="text-center">Đính tệp
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center italics">
                                    Niêm yết 1
                                    nơi</th>
                                <td class="text-center italics">
                                    Niêm yết 2
                                    nơi</td>
                                <th class="text-center italics">
                                    Đăng tải
                                    trên cổng thông
                                    tin
                                </th>
                                <th class="text-center italics">Loa truyền
                                    thanh</th>
                                <th class="text-center italics">
                                    Thông qua
                                    trưởng thôn, TDP
                                </th>
                                <th class="text-center italics">Khác
                                </th>
                                <th class="text-center italics">Từ ngày</th>
                                <th class="text-center italics">Đến ngày
                                </th>
                                <th class="text-center italics">Kế hoạch
                                    công khai thông tin
                                </th>
                                <th class="text-center italics">Thông tin
                                    công khai</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($lsResPage as $item)
                                <tr>
                                    <th class="text-center" style="font-weight:bold">
                                        @if ($item->manhom != null)
                                            {{ $item->manhom }}
                                        @endif
                                    </th>
                                    <th>
                                        @if ($item->muc_congkhai != null)
                                            {{ $item->muc->ma_muc }}
                                        @endif
                                    </th>
                                    <th>
                                        @if ($item->muc_congkhai != null)
                                            {{ $item->muc->ms_nd }}
                                        @endif
                                    </th>
                                    <th>
                                        @if ($item->muc_congkhai != null)
                                            {{ $item->muc->noi_dung }}
                                        @endif
                                        @if ($item->nd != null)
                                            {{ $item->nd }}
                                        @endif
                                    </th>
                                    <th>{{ $item->noidung_congkhai }}</th>
                                    <input type='hidden' id="hinhthuc_congkhai_{{ $loop->index }}"
                                        value="{{ $item->hinhthuc_congkhai }}">
                                    <td class="text-center" id='hinhthuc1_{{ $loop->index }}'></td>
                                    <td class="text-center" id='hinhthuc2_{{ $loop->index }}'></td>
                                    <th class="text-center" id='hinhthuc3_{{ $loop->index }}'></th>
                                    <th class="text-center" id='hinhthuc4_{{ $loop->index }}'></th>
                                    <th class="text-center" id='hinhthuc5_{{ $loop->index }}'></th>
                                    <th class="text-center">
                                        @if ($item->hinhthuc_khac)
                                            {{ $item->hinhthuc_khac }}
                                        @endif
                                    </th>
                                    <th>
                                        @if ($item->tg_congkhai == '90ngay')
                                            90 ngày
                                        @endif
                                        @if ($item->tg_congkhai == 'thuongxuyen')
                                            Thường xuyên
                                        @endif
                                        @if ($item->tg_congkhai == '30ngay')
                                            30 ngày
                                        @endif
                                        @if ($item->tg_congkhai == 'khac')
                                            Khác
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if ($item->nd == null)
                                            {{ \Carbon\Carbon::parse($item->ngay_bd_congkhai)->format('d/m/Y') }}
                                        @endif

                                    </th>
                                    <th class="text-center">
                                        @if ($item->nd == null)
                                            {{ \Carbon\Carbon::parse($item->ngay_kt_congkhai)->format('d/m/Y') }}
                                        @endif

                                    </th>
                                    <th class="text-center">
                                        @if ($item->file_kh_congkhai_path != null)
                                            <a href="{{ $item->file_kh_congkhai_path }}" target="_blank">Tải về</a>
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if ($item->filecongkhai_path != null)
                                            <a href="{{ $item->filecongkhai_path }}" target="_blank">Tải về</a>
                                        @endif
                                    </th>
                                    {{-- @if ($isxembaocao == 'false')
                                    <th></th>
                                @endif --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type='hidden' id='count' value='{{ $count }}'>
                </div>
                <div>
                    <p style="font-size:11px; font-style: italic;">*Chú thích:
                        <br />Niêm yết 1 nơi: Niêm yết tại trụ sở Hội đồng nhân dân, Ủy ban nhân dân cấp xã.
                        <br /> Niêm yết 2 nơi: Niêm yết tại trụ sở Hội đồng nhân dân, Ủy ban nhân dân cấp xã, tại nhà
                        văn hóa và các
                        điểm sinh
                        hoạt cộng đồng ở thôn, tổ dân phố.
                    </p>
                </div>
                <div class="pull-left">
                    <div role="status" class="show-res" aria-live="polite">
                        {{ trans_choice('voyager::generic.showing_entries', $lsResPage->count(), [
                            'from' => $lsResPage->firstItem(),
                            'to' => $lsResPage->lastItem(),
                            'all' => $lsResPage->count(),
                        ]) }}
                    </div>
                </div>
                <div class="pull-right">
                    {{ $lsResPage->appends([
                            'donvi_huyen' => $idHuyen,
                            'donvi_xa' => $idXa,
                            'tu_ngay' => $tungay,
                            'den_ngay' => $denngay,
                        ])->links() }}
                </div>

            </div>
            <div style="text-align:center">
                <h4 class="title">PHIẾU KHẢO SÁT MỨC ĐỘ HÀI LÒNG CỦA CÁN BỘ, CÔNG CHỨC, NGƯỜI DÂN, TỔ CHỨC VÀ
                    DOANH
                    NGHIỆP </h4>
                <h4 class="title">ĐỐI VỚI ỦY BAN NHÂN DÂN @if ($donvi_xa != null)
                        <span style="">{{ $donvi_xa[0]->ten_donvi }}</span>
                        <span style="">{{ $donvi_huyen[0]->ten_donvi }}</span>
                    @endif
                </h4>

            </div>
            <div>

            </div>
            <div class="list-qr">
                <table class="table table-qr" border="0">

                    {{-- <thead>
                        <tr>
                            <th style="width:5%; text-align:center">STT</th>
                            <th style="width:35%;text-align:center">PHIẾU KHẢO SÁT</th>
                            <th style="width:5%;text-align:center">MS</th>
                            <th style="width:10%;text-align:center">Đối tượng lấy ý kiến</th>
                            <th style="width:45%;text-align:center">Mã QR code</th>
                        </tr>
                    </thead> --}}

                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                {{-- <th style="text-align:center ;vertical-align: middle;">{{ $loop->index + 1 }}</th> --}}
                                <th style="text-align:left ;vertical-align: middle;">
                                    <h4 class="title">{{ $loop->index + 1 }}. PKS {{ $item['name'] }}
                                    </h4>
                                    <ul class="pks">
                                        <li>MS: {{ $item['id'] }}</li>
                                        <li>Đối tượng lấy ý kiến: {{ $item['obj'] }}</li>
                                    </ul>
                                </th>

                                {{-- <th style="text-align:center ;vertical-align: middle;">{{ $item['id'] }}</th>
                                <th style="text-align:center ;vertical-align: middle;">{{ $item['obj'] }}</th> --}}
                                <th style="text-align:center"><img style="width:250px"
                                        src="{{ asset('storage/qr_type' . ($loop->index + 1) . '_' . $donvi_xa[0]->id . '.jpg') }}
                                        ">
                                </th>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    @endif


</body>

</html>



<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $(function() {
    //     // Lấy ngày đầu tiên của tháng hiện tại
    //     var today = new Date();
    //     var firstDay = new Date(today.getFullYear(), today.getMonth(), 1);

    //     $('#tu_ngay').datepicker({
    //         format: 'dd-mm-yyyy',
    //         startDate: firstDay
    //     }).on('changeDate', function() {
    //         $(this).datepicker('hide');
    //     }).val('01' + '-' + ('0' + (new Date().getMonth() + 1)).slice(-2) + '-' + new Date().getFullYear());

    //     $('#den_ngay').datepicker({
    //         format: 'dd-mm-yyyy',
    //         startDate: '0d'
    //     }).on('changeDate', function(e) {
    //         $(this).val(e.format('dd-mm-yyyy'));
    //         $(this).datepicker('hide');
    //     }).val(new Date().toLocaleDateString('en-GB').replace(/\//g, '-'));

    // });

    $(document).ready(function() {
        var startOfMonth = moment().startOf('month');
        var endOfMonth = moment();
        $('#tu_ngay').datetimepicker({
            format: 'DD-MM-YYYY',
            defaultDate: startOfMonth
        });
        $('#den_ngay').datetimepicker({
            format: 'DD-MM-YYYY',
            defaultDate: endOfMonth
        });
        if ($('#count').val()) {
            var count = $('#count').val();
            for (let i = 0; i < count; i++) {
                var hinhthuc = $(`#hinhthuc_congkhai_${i}`).val()
                if (hinhthuc.includes('1')) {
                    $(`#hinhthuc1_${i}`).text('X')
                }
                if (hinhthuc.includes('2')) {
                    $(`#hinhthuc2_${i}`).text('X')
                }
                if (hinhthuc.includes('3')) {
                    $(`#hinhthuc3_${i}`).text('X')
                }
                if (hinhthuc.includes('4')) {
                    $(`#hinhthuc4_${i}`).text('X')
                }
                if (hinhthuc.includes('5')) {
                    $(`#hinhthuc5_${i}`).text('X')
                }
            }
        }
    });
    // $(function() {
    //     $('#tu_ngay').datepicker({
    //         format: 'dd/mm/yyyy'
    //     }).on('changeDate', function() {
    //         $(this).datepicker('hide');
    //     });

    //     $('#den_ngay').datepicker({
    //         format: 'dd/mm/yyyy'
    //     }).on('changeDate', function() {
    //         $(this).datepicker('hide');
    //     });
    // });
</script>

<style>
    .list-qr {
        max-width: 1170px;
        margin: auto;
    }

    .table-qr .title {
        font-size: 16px !important;
    }

    .table-qr tr th {
        padding: 0px !important;
        border-top: 1px dotted #2a5db1 !important;
    }

    .col-logo {
        margin-top: 10px;
        text-align: center;
    }

    .titleTable {
        vertical-align: middle !important;
        font-weight: bold;
    }

    .overflow {
        width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 6;
        -webkit-box-orient: vertical;
    }

    .italics {
        vertical-align: middle !important;
        font-style: italic;
        font-weight: 100 !important;
    }

    hr {
        border-top: 1px solid #1f4091;
    }

    .title {
        text-transform: uppercase;
        font-weight: bold;
        font-family: Arial;
        color: #134895;
    }

    #boxdonvi {
        padding: 15px;
    }

    .bold {
        font-weight: bold;
    }

    #boxdonvi,
    #ketqua_congkhai {
        padding: 15px 10px;
    }

    #boxdonvi ul {
        width: 100%;
        margin: 0;
    }

    #boxdonvi ul li {
        margin-bottom: 5px;
        font-weight: bold;
        font-family: Arial;
        margin-top: 5px;
        font-size: 16px;
        list-style-type: none;
        width: 25%;
        float: left;
        padding-left: 15px;
    }

    #boxdonvi ul li a {
        color: #000;
    }

    #boxdonvi .tilte-huyen,
    #boxdonvi .tilte-xa,
    #ketqua_congkhai .tilte-ketqua {}

    .tintieubieu {
        height: 175px;

    }

    .tintieubieu .portlet-title {
        font-weight: bold;
        font-family: Arial;
        color: #1d6cbb;
        border-bottom: 1px solid #1d6cbb;
    }

    .pks li {
        width: 100% !important;
        float: none !important;
        text-align: justify;
        padding: 5px 5px 5px 15px;
        line-height: 20px;
        list-style-type: none;
        background: url(https://qcdc.bacgiang.gov.vn/HiepHoi-DoanhNghiep-theme/theme-images/bullet-news.png) no-repeat center left;
    }

    .tintieubieu li {
        text-align: justify;
        border-bottom: 1px dotted #2a5db1;
        padding: 5px 5px 5px 15px;
        line-height: 20px;
        list-style-type: none;
        background: url(https://qcdc.bacgiang.gov.vn/HiepHoi-DoanhNghiep-theme/theme-images/bullet-news.png) no-repeat center left;
    }

    .tintieubieu li:last-child {
        border: 0px !important;
    }

    .tintieubieu li a {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .pks li {
        color: #134895;
    }

    .margin-30 {
        margin-top: 30px;
    }

    .center {
        text-align: center;
    }

    .font-table {
        font-weight: normal;
        font-style: italic;
        vertical-align: middle;
    }
</style>
