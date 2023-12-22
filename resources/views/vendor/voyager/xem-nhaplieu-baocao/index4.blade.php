<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Báo cáo số liệu nhập liệu')

@section('page_header')
    <div class="card card-baocao header">
        <div class="row tilte-huyen">
            <div class="col-sm-1 col-logo margin-30">
                <a class="logo" href="https://bacgiang.gov.vn"><img alt="TTĐT BG" height="100"
                        src="https://qcdc.bacgiang.gov.vn/documents/11619891/16766933/1683621983161_2.+Lo+go+QCDC.png"
                        width="100"> </a>
            </div>

            <div class="col-sm-5 center margin-30">
                <h4 class="title" style="font-size:17px !important;">
                    NHÂN DÂN KIỂM TRA GIÁM SÁT
                </h4>
                <h4 class="title" style="font-size:17px !important;">
                    CỦA CÁC XÃ, PHƯỜNG, THỊ TRẤN TRÊN ĐỊA BÀN TỈNH
                </h4>
                <h4 class="title" style="font-size:17px !important;">
                    NĂM {{ $currentYear }}
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
        <div>
            <div class="row select-baocao">


                @if ($lsDonViCha != null)
                    <div class="col-sm-1 select-baocao-span">
                        <span>Đơn vị cha</span>
                    </div>
                    <div class="col-sm-3">
                        <select id="donviIdHuyen" class="form-control" onchange="huyenCheck()">
                            @foreach ($lsDonViCha as $donvi)
                                <option value="{{ $donvi->id }}">{{ $donvi->ten_donvi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-1 select-baocao-span" id="donviXalable" style="display:none">
                        <span>Đơn vị</span>
                    </div>
                    <div class="col-sm-3" id="donviXa" style="display:none">
                        <select id="cbx-donvi" class="select2" onchange="OnChangeDonVi()">
                            @foreach ($donvis as $donvi)
                                <option value="{{ $donvi->id }}">{{ $donvi->ten_donvi }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="col-sm-2 select-baocao-span " hidden>
                    <span>Báo cáo</span>
                </div>
                <div class="col-sm-6" hidden>
                    <select id="cbx-baocao" class="select2" onchange="OnChangeBaoCao()">
                        <option value="0">-- Chưa chọn --</option>
                        {{-- <option value="1">I. KẾT QUẢ THỰC HIỆN CÔNG KHAI</option> --}}
                        <option value="2">II. NHÂN DÂN BÀN VÀ QUYẾT ĐỊNH TRỰC TIẾP</option>
                        {{-- <option value="3">III. NHÂN DÂN BÀN, BIỂU QUYẾT, CƠ QUAN CÓ THẨM QUYỀN QUYẾT ĐỊNH</option> --}}
                        <option value="4">III. NHÂN DÂN THAM GIA Ý KIẾN</option>
                        {{-- <option value="5">V. KẾT QUẢ HUY ĐỘNG VỐN XÂY DỰNG HẠ TẦNG CƠ SỞ</option> --}}
                        <option value="6" selected>IV. NHÂN DÂN KIỂM TRA GIÁM SÁT</option>
                        <option value="7">V. KẾT QUẢ HOẠT ĐỘNG CỦA BAN THANH TRA NHÂN DÂN</option>
                        <option value="8">VI. KẾT QUẢ HOẠT ĐỘNG CỦA BAN GIÁM SÁT ĐẦU TƯ CỦA CỘNG ĐỒNG</option>
                        <option value="9">VII. ĐƠN THƯ KHIẾU NẠI, TỐ CÁO</option>
                        <option value="10">VIII. KẾT QUẢ TỔ CHỨC HỌP THÔN, BẢN, TỔ DÂN PHỐ</option>
                    </select>
                </div>

                <div class="col-sm-1 select-baocao-span">
                    <span>Quý</span>
                </div>
                <div class="col-sm-3">
                    @php
                        $curMonth = date('m', time());
                        $curQuarter = ceil($curMonth / 3);
                    @endphp
                    <select id="quarter" class="select2 form-control" name="quarter" onchange="OnChangeBaoCao()">
                        <option value="0">-- Tất cả --</option>
                        <option value="1" {{ $curQuarter == 1 ? 'selected' : '' }}>Quý 1</option>
                        <option value="2" {{ $curQuarter == 2 ? 'selected' : '' }}>Quý 2</option>
                        <option value="3" {{ $curQuarter == 3 ? 'selected' : '' }}>Quý 3</option>
                        <option value="4" {{ $curQuarter == 4 ? 'selected' : '' }}>Quý 4</option>
                    </select>
                </div>
                <div class="col-sm-1 select-baocao-span">
                    <span>Năm</span>
                </div>
                <div class="col-sm-3">
                    @php
                        $years = range(2022, 2030);
                        $currentYear = date('Y'); // Lấy năm hiện tại
                    @endphp

                    <select id="year" class="select2" name="year" onchange="OnChangeBaoCao()">
                        @foreach ($years as $year)
                            <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                {{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary pull-right" id="export-btn">Tải xuống excel</button>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="baocao">
        {{-- Kết quả thực hiện công khai --}}
        <div id="ketqua-thuchien-congkhai">
            <div id="content-ketqua-thuchien-congkhai">
            </div>
        </div>
        {{-- Nhân dân bàn và quyết định trực tiếp --}}
        <div id="nhandan-ban-va-quyetdinh-tructiep">
            <div id="content-nhandan-ban-va-quyetdinh-tructiep">
            </div>
        </div>
        {{-- Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định --}}
        {{-- <div id="nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh">
            <div id="content-nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh">
            </div>
        </div> --}}
        {{-- Nhân dân tham gia ý kiến --}}
        <div id="nhandan-thamgia-ykien">
            <div id="content-nhandan-thamgia-ykien">
            </div>
        </div>
        {{-- Kết quả huy động vốn xây dựng hậ tầng cơ sở --}}
        {{-- <div id="ketqua-huydongvon-xaydung-hatangcoso">
            <div id="content-ketqua-huydongvon-xaydung-hatangcoso">
            </div>
        </div> --}}
        {{-- Nhân dân kiểm tra, giám sát --}}
        <div id="nhandan-kiemtra-giamsat">
            <div id="content-nhandan-kiemtra-giamsat">
            </div>
        </div>
        {{-- Kết quả hoạt động của ban thanh tra nhân dân --}}
        <div id="ketqua-hoatdong-cuabanthanhtra-nhandan">
            <div id="content-ketqua-hoatdong-cuabanthanhtra-nhandan">
            </div>
        </div>
        {{-- Kết quả hoạt động của ban giám sát đầu tư của cộng đồng --}}
        <div id="ketqua-hoatdong-cuabangiamsatdatu-cuacongdong">
            <div id="content-ketqua-hoatdong-cuabangiamsatdautu-cuacongdong">
            </div>
        </div>
        {{-- Đơn thư khiếu nại tố cáo --}}
        <div id="donthu-khieunai-tocao">
            <div id="content-donthu-khieunai-tocao">
            </div>
        </div>
        {{-- Kết quả tổ chức họp thôn, bản, tổ dân phố --}}
        <div id="ketqua-tochuchop-thonban-todanpho">
            <div id="content-ketqua-tochuchop-thonban-todanpho">
            </div>
        </div>

    </div>
@stop
@include('voyager::loading.spin')
@include('voyager::nhaplieu-baocao.partials.ketqua-thuchien-congkhai.include')
@include('voyager::nhaplieu-baocao.partials.nhandan-ban-va-quyetdinh-tructiep.include')
@include('voyager::nhaplieu-baocao.partials.nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh.include')
@include('voyager::nhaplieu-baocao.partials.nhandan-thamgia-ykien.include')
@include('voyager::nhaplieu-baocao.partials.ketqua-huydongvon-xaydung-hatangcoso.include')
@include('voyager::nhaplieu-baocao.partials.nhandan-kiemtra-giamsat.include')
@include('voyager::nhaplieu-baocao.partials.ketqua-hoatdong-cuabanthanhtra-nhandan.include')
@include('voyager::nhaplieu-baocao.partials.ketqua-hoatdong-cuabangiamsatdautu-cuacongdong.include')
@include('voyager::nhaplieu-baocao.partials.donthu-khieunai-tocao.include')
@include('voyager::nhaplieu-baocao.partials.ketqua-tochuchop-thonban-todanpho.include')
<link rel="stylesheet" href="/css/style.css">
@section('javascript')
    <script src="/js/app.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script>
        var isXemBaocao = true;
        $(document).ready(function() {
            OnChangeDonVi();
            $('#export-btn').click(function() {
                console.log(1)
                var wb = XLSX.utils.table_to_book(document.getElementById('exportContent6'), {
                    sheet: 'Sheet JS'
                });
                XLSX.writeFile(wb, 'ND_kiemtra_giamsat.xlsx');
            });
        });
        $('#donviIdHuyen').on('change', function() {
            var donviIdHuyen = document.getElementById('donviIdHuyen').value;

            console.log("donviIdHuyen===" + donviIdHuyen);

            if (document.getElementById('donviIdHuyen').value == 0) {
                document.getElementById('donviXa').style.display = 'none';
                document.getElementById('donviXalable').style.display = 'none';
            }

            var idHuyen = document.getElementById('donviIdHuyen').value;
            document.getElementById('donviXa').style.display = 'block';
            document.getElementById('donviXalable').style.display = 'block';

            $.ajax({
                type: 'post',
                url: '/pakn/khao-sat/don-vi',
                data: {
                    idHuyen: idHuyen,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    //console.log("response.data"+response.data);

                    var $select = $('#cbx-donvi');
                    $select.find('option').remove();

                    $donviIdHuyenText = $("#donviIdHuyen option:selected").text();

                    $select.append('<option value="0">--- Tất cả ---</option>');
                    $.each(response.data, function(i) {
                        $select.append('<option value=' + response.data[i].id + '>' + response
                            .data[i].ten_donvi + '</option>'); // return empty
                    });

                    OnChangeBaoCao();
                },
                error: function(err) {
                    console.log(err);
                    if (err.status == 403) {
                        toastr.error('Không tìm đơn vị con');
                    } else {
                        toastr.error('Lỗi tìm đơn vị con');
                    }
                }
            });


        });


        function OnChangeBaoCao() {
            ClearBaoCao();
            var loaiBaoCao = $('#cbx-baocao').val();
            if (loaiBaoCao != "0") {
                drawDsBaoCao(loaiBaoCao);
            }
        }

        function OnChangeDonVi() {
            ClearBaoCao();
            var loaiBaoCao = $('#cbx-baocao').val();
            if (loaiBaoCao != "0") {
                drawDsBaoCao(loaiBaoCao);
            }
        }

        function drawDsBaoCao(loaiBaoCao) {
            switch (loaiBaoCao) {
                case "1":
                    DrawKetQuaThucHienCongKhai();
                    break;
                case "2":
                    DrawNhanDanBanVaQuyetDinhTrucTiep();
                    break;
                case "3":
                    DrawNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh();
                    break;
                case "4":
                    DrawNhanDanThamGiaYKien();
                    break;
                case "5":
                    DrawKetQuaHuyDongVonXayDungHaTangCoSo();
                    break;
                case "6":
                    DrawNhanDanKiemTraGiamSat();
                    break;
                case "7":
                    DrawKetQuaHoatDongCuaBanThanhTraNhanDan();
                    break;
                case "8":
                    DrawKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong();
                    break;
                case "9":
                    DrawDonThuKhieuNaiToCao();
                    break;
                case "10":
                    DrawKetQuaToChucHopThonBanToDanPho();
                    break;
            }
        }

        function ShowModalThemMoiBaoCao() {
            var loaiBaoCao = $('#cbx-baocao').val();
            if (loaiBaoCao != "0") {
                DoShowModalThemMoiBaoCao(loaiBaoCao);
            } else {
                toastr.warning('Xin vui lòng chọn báo cáo');
            }
        }

        function DoShowModalThemMoiBaoCao(loaiBaoCao) {
            switch (loaiBaoCao) {
                case "1":
                    ShowModalThemMoiKetQuaThucHienCongKhai();
                    break;
                case "2":
                    ShowModalThemMoiNhanDanBanVaQuyetDinhTrucTiep();
                    break;
                case "3":
                    ShowModalThemMoiNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh();
                    break;
                case "4":
                    ShowModalThemMoiNhanDanThamGiaYKien();
                    break;
                case "5":
                    ShowModalThemMoiKetQuaHuyDongVonXayDungHaTangCoSo();
                    break;
                case "6":
                    ShowModalThemMoiNhanDanKiemTraGiamSat();
                    break;
                case "7":
                    ShowModalThemMoiKetQuaHoatDongCuaBanThanhTraNhanDan();
                    break;
                case "8":
                    ShowModalThemMoiKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong();
                    break;
                case "9":
                    ShowModalThemMoiDonThuKhieuNaiToCao();
                    break;
                case "10":
                    ShowModalThemMoiKetQuaToChucHopThonBanToDanPho();
                    break;
            }
        }

        function ClearBaoCao() {
            $("#content-ketqua-thuchien-congkhai").empty();
            $("#content-nhandan-ban-va-quyetdinh-tructiep").empty();
            $("#content-nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh").empty();
            $("#content-nhandan-thamgia-ykien").empty();
            $("#content-ketqua-huydongvon-xaydung-hatangcoso").empty();
            $("#content-nhandan-kiemtra-giamsat").empty();
            $("#content-ketqua-hoatdong-cuabanthanhtra-nhandan").empty();
            $("#content-ketqua-hoatdong-cuabangiamsatdautu-cuacongdong").empty();
            $("#content-donthu-khieunai-tocao").empty();
            $("#content-ketqua-tochuchop-thonban-todanpho").empty();
        }

        function exportTableToExcel(tableID, filename = '') {
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

            // Specify file name
            filename = filename ? filename + '.xls' : 'excel_data.xls';

            // Create download link element
            downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                var blob = new Blob(['\ufeff', tableHTML], {
                    type: dataType
                });
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }
        }

        function Export2Doc(element, filename = '') {
            var preHtml =
                "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
            var postHtml = "</body></html>";
            var html = preHtml + document.getElementById(element).innerHTML + postHtml;

            var blob = new Blob(['\ufeff', html], {
                type: 'application/msword'
            });

            // Specify link url
            var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);

            // Specify file name
            filename = filename ? filename + '.doc' : 'document.doc';

            // Create download link element
            var downloadLink = document.createElement("a");

            document.body.appendChild(downloadLink);

            if (navigator.msSaveOrOpenBlob) {
                navigator.msSaveOrOpenBlob(blob, filename);
            } else {
                // Create a link to the file
                downloadLink.href = url;

                // Setting the file name
                downloadLink.download = filename;

                //triggering the function
                downloadLink.click();
            }

            document.body.removeChild(downloadLink);
        }

        function saveDoc(element, filename) {

            if (!window.Blob) {
                alert('Your legacy browser does not support this action.');
                return;
            }

            var html, link, blob, url, css;

            // EU A4 use: size: 841.95pt 595.35pt;
            // US Letter use: size:11.0in 8.5in;

            css = ('\
                                                                                                        <style>\
                                                                                                        @page WordSection1{size: 841.95pt 595.35pt;mso-page-orientation: landscape;}\
                                                                                                        div.WordSection1 {page: WordSection1;}\
                                                                                                        h1 {font-family: "Times New Roman", Georgia, Serif; font-size: 16pt;}\
                                                                                                        p {font-family: "Times New Roman", Georgia, Serif; font-size: 14pt;}\
                                                                                                        </style>\
                                                                                                        ');

            var rightAligned = document.getElementsByClassName("sm-align-right");
            for (var i = 0, max = rightAligned.length; i < max; i++) {
                rightAligned[i].style = "text-align: right;"
            }

            var centerAligned = document.getElementsByClassName("sm-align-center");
            for (var i = 0, max = centerAligned.length; i < max; i++) {
                centerAligned[i].style = "text-align: center;"
            }

            html = document.getElementById(element).innerHTML;
            html =
                '\
                                                                                                        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">\
                                                                                                        <head>\
                                                                                                        <title>Báo cáo Người có công</title>\
                                                                                                        <xml>\
                                                                                                            <w:worddocument xmlns:w="#unknown">\
                                                                                                            <w:view>Print</w:view>\
                                                                                                            <w:zoom>90</w:zoom>\
                                                                                                            <w:donotoptimizeforbrowser />\
                                                                                                            </w:worddocument>\
                                                                                                        </xml>\
                                                                                                        </head>\
                                                                                                        <body lang=RU-ru style="tab-interval:.5in">\
                                                                                                        <div class="WordSection1">' +
                html + '</div>\
                                                                                                        </body>\
                                                                                                        </html>';

            blob = new Blob(['\ufeff', css + html], {
                type: 'application/msword'
            });

            url = URL.createObjectURL(blob);
            link = document.createElement('A');
            link.href = url;
            // Set default file name.
            // Word will append file extension - do not add an extension here.
            link.download = filename;

            document.body.appendChild(link);

            if (navigator.msSaveOrOpenBlob) {
                navigator.msSaveOrOpenBlob(blob, filename + '.doc'); // IE10-11
            } else {
                link.click(); // other browsers
            }

            document.body.removeChild(link);
        };
    </script>

@stop
