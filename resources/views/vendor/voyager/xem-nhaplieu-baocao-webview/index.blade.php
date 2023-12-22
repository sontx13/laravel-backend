<!DOCTYPE html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Báo cáo nhập số liệu</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

<body>
    <div class="form-baocao">
        <div class="card card-baocao-nhaplieu">
            <div class="text-center">
                <h3 class="title-baocao">Báo cáo nhập liệu</h3>
            </div>
            <div>
                @if ($lsDonViCha == null)
                    <div class="row">
                        <div class="col-sm-12 margin-bottom-card">
                            <select id="cbx-donvi" class="select2" onchange="OnChangeBaoCao()">
                                <option value="0">--- Toàn tỉnh ---</option>
                                @foreach ($donvis as $donvi)
                                    <option value="{{ $donvi->id }}">{{ $donvi->ten_donvi }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                @if ($lsDonViCha != null)
                    <div class="row">
                        <div class="col-sm-12 margin-bottom-card">
                            <select id="donviIdHuyen" class="form-control" onchange="huyenCheck()">
                                <option value="0">--- Toàn tỉnh ---</option>
                                @foreach ($lsDonViCha as $donvi)
                                    <option value="{{ $donvi->id }}">{{ $donvi->ten_donvi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-12 margin-bottom-card" id="donviXa" style="display:none">
                            <select id="cbx-donvi" class="form-control" onchange="OnChangeBaoCao()">
                            </select>
                        </div>
                    </div>
                @endif

                <div class="row">
                    <div class="col-sm-12 margin-bottom-card">
                        <select id="cbx-baocao" class="select2" onchange="OnChangeBaoCao()">
                            {{-- <option value="1">I. Kết quả thực hiện công khai</option> --}}
                            <option value="2">II. Nhân dân bàn và quyết định trực tiếp</option>
                            {{-- <option value="3">III. Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định</option> --}}
                            <option value="4">III. Nhân dân tham gia ý kiến</option>
                            {{-- <option value="5">V. Kết quả huy động vốn xây dựng hạ tầng cơ sở</option> --}}
                            <option value="6">IV. Nhân dân kiểm tra giám sát</option>
                            <option value="7">V. Kết quả hoạt động của ban thanh tra nhân dân</option>
                            <option value="8">VI. Kết quả hoạt động của ban giám sát đầu tư của cộng đồng
                            </option>
                            <option value="9">VII. Đơn thư khiếu nại, tố cáo</option>
                            <option value="10">VIII. Kết quả tổ chức họp thôn, bản, tổ dân phố</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 margin-bottom-card">
                        @php
                            $curMonth = date('m', time());
                            $curQuarter = ceil($curMonth / 3);
                        @endphp
                        <select id="quarter" class="select2 form-control" name="quarter" onchange="OnChangeBaoCao()">
                            <option value="0">-- Chọn quý --</option>
                            <option value="1" {{ $curQuarter == 1 ? 'selected' : '' }}>Quý 1</option>
                            <option value="2" {{ $curQuarter == 2 ? 'selected' : '' }}>Quý 2</option>
                            <option value="3" {{ $curQuarter == 3 ? 'selected' : '' }}>Quý 3</option>
                            <option value="4" {{ $curQuarter == 4 ? 'selected' : '' }}>Quý 4</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 margin-bottom-card">
                        @php
                            $years = range(2022, 2030);
                        @endphp
                        <select id="year" class="select2 form-control" name="year" onchange="OnChangeBaoCao()">
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="baocao baocao-nhaplieu-mobile">
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
            <div id="ketqua-huydongvon-xaydung-hatangcoso">
                <div id="content-ketqua-huydongvon-xaydung-hatangcoso">
                </div>
            </div>
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
    </div>
</body>

@include('voyager::loading.spin')
@include('voyager::xem-nhaplieu-baocao-webview.partials.ketqua-thuchien-congkhai.include')
@include('voyager::xem-nhaplieu-baocao-webview.partials.nhandan-ban-va-quyetdinh-tructiep.include')
@include('voyager::xem-nhaplieu-baocao-webview.partials.nhandan-ban-bieuquyet-coquan-cothamquyen-quyetdinh.include')
@include('voyager::xem-nhaplieu-baocao-webview.partials.nhandan-thamgia-ykien.include')
@include('voyager::xem-nhaplieu-baocao-webview.partials.ketqua-huydongvon-xaydung-hatangcoso.include')
@include('voyager::xem-nhaplieu-baocao-webview.partials.nhandan-kiemtra-giamsat.include')
@include('voyager::xem-nhaplieu-baocao-webview.partials.ketqua-hoatdong-cuabanthanhtra-nhandan.include')
@include('voyager::xem-nhaplieu-baocao-webview.partials.ketqua-hoatdong-cuabangiamsatdautu-cuacongdong.include')
@include('voyager::xem-nhaplieu-baocao-webview.partials.donthu-khieunai-tocao.include')
@include('voyager::xem-nhaplieu-baocao-webview.partials.ketqua-tochuchop-thonban-todanpho.include')
<link rel="stylesheet" href="/css/style.css">
<script src="/js/app.js"></script>
<script src="/js/sweetalert.min.js"></script>
<script>
    function huyenCheck() {
        var donviIdHuyen = document.getElementById('donviIdHuyen').value;

        console.log("donviIdHuyen===" + donviIdHuyen);

        if (document.getElementById('donviIdHuyen').value != 0) {

            var idHuyen = document.getElementById('donviIdHuyen').value;
            document.getElementById('donviXa').style.display = 'block';

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
                        $select.append('<option value=' + response.data[i].id + '>' + response.data[
                            i].ten_donvi + '</option>'); // return empty
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
        } else {
            document.getElementById('donviXa').style.display = 'none';
        }
    }

    function OnChangeBaoCao() {
        ClearBaoCao();
        var loaiBaoCao = $('#cbx-baocao').val();
        if (loaiBaoCao != "0") {
            drawDsBaoCao(loaiBaoCao);
        }
    }

    OnChangeBaoCao();

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

    $(document).ready(function() {
        $('#cbx-baocao').select2();
        $('#cbx-donvi').select2();
    });
</script>
