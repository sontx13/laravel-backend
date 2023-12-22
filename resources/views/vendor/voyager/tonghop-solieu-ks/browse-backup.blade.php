@extends('voyager::master')


@section('page_header')
    <div class=" card-baocao header zindex">
        <div>
            <form method="get" class="form-search">
                <div class="row select-baocao">
                    @if ($lsDonViCha != null)
                        <div class="col-sm-1 select-baocao-span">
                            <span>Đơn vị </span>
                        </div>
                        <div class="col-sm-3">
                            <select id="donviIdHuyen" name="donvi_huyen" class="form-control">
                                @if ($donvi_id == 1 || $donvi_id == 12){
                                    <option value="0">--- Tất cả ---</option>

                                    @foreach ($lsDonViCha as $donvi)
                                        <option @if ($dvh != 0 && $dvh == $donvi->id) selected @endif
                                            value="{{ $donvi->id }}">{{ $donvi->ten_donvi }}</option>
                                    @endforeach

                                @endif


                                @if ($donvi_id > 1 && $donvi_id < 12){ @foreach ($tendonvi as $tendonvi)
                                        <option @if ($dvh != 0 && $dvh == $donvi_id) selected @endif
                                            value="{{ $donvi_id }}">{{ $tendonvi->ten_donvi }}</option>
                                    @endforeach
                                @endif

                                @if ($donvi_id > 12){
                                    @foreach ($donvicha as $donvicha)
                                        <option @if ($dvh != 0 && $dvh == $donvicha->ma_donvi) selected @endif
                                            value="{{ $donvicha->ma_donvi }}">{{ $donvicha->ten_donvi }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endif
                    <div class="col-sm-1">
                        <span>Báo cáo</span>
                    </div>
                    <div class="col-sm-2 ">
                        <select name="baocao" id='baocao' class="select2">
                            <option value="1" @if ($baocao == 1) selected @endif>II.NHÂN DÂN BÀN VÀ
                                QUYẾT
                                ĐỊNH TRỰC TIẾP</option>
                            {{-- <option value="2" @if ($baocao == 2) selected @endif>II.NHÂN DÂN BÀN, BIỂU
                                QUYẾT, CƠ QUAN CÓ THẨM QUYỀN QUYẾT ĐỊNH</option> --}}
                            <option value="3" @if ($baocao == 3) selected @endif>III.NHÂN DÂN THAM GIA
                                Ý KIẾN</option>
                            {{-- <option value="4"@if ($baocao == 4) selected @endif>IV.KẾT QUẢ HUY ĐỘNG VỐN
                                XÂY DỰNG HẠ TẦNG CƠ SỞ</option> --}}
                            <option value="5" @if ($baocao == 5) selected @endif>IV.NHÂN DÂN KIỂM TRA
                                GIÁM SÁT</option>
                            <option value="6" @if ($baocao == 6) selected @endif>V.KẾT QUẢ HOẠT ĐỘNG
                                CỦA BAN THANH TRA NHÂN DÂN</option>
                            <option value="7"@if ($baocao == 7) selected @endif>VI.KẾT QUẢ HOẠT ĐỘNG
                                CỦA BAN GIÁM SÁT ĐẦU TƯ CỘNG ĐỒNG</option>
                            <option value="8"@if ($baocao == 8) selected @endif>VII.ĐƠN THƯ KHIẾU
                                NẠI, TỐ CÁO</option>
                            <option value="9"@if ($baocao == 9) selected @endif>VIII.KẾT QUẢ TỔ CHỨ HỌP
                                THÔN, BẢN, TỔ DÂN PHỐ</option>

                        </select>
                    </div>
                    <div class="col-sm-1 select-baocao-span">
                        Quý
                    </div>
                    <div class="col-sm-2 ">
                        <select name="quy" class="select2">
                            <option value="1" @if ($quy == 1) selected @endif>Quý 1</option>
                            <option value="2" @if ($quy == 2) selected @endif>Quý 2</option>
                            <option value="3" @if ($quy == 3) selected @endif>Quý 3</option>
                            <option value="4" @if ($quy == 4) selected @endif>Quý 4</option>
                        </select>
                    </div>
                    <div class="col-sm-1 select-baocao-span">
                        Năm
                    </div>
                    <div class="col-sm-2 ">
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
                </div>
                <div style="display: flex; justify-content: center; margin-bottom:1rem;">
                    <button type="submit" class="btn btn-sm btn-success " style="margin-right:1rem;">
                        <i class="voyager-search"></i> <span class="hidden-xs hidden-sm">Tìm kiếm</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('content')
    {{-- <div class="in" style="float: right;">
        <a href="#" class="btn btn-success btn-small" onclick="window.print()">
            <span class="glyphicon glyphicon-print"></span> In báo cáo
        </a>
        <a href="#" class="btn btn-info btn-small"
            onclick="saveDoc('exportContent11', 'KẾT QUẢ HỖ TRỢ HƯỚNG DẪN NGƯỜI DÂN TỔ CHỨC THỰC HIỆN THỦ TỤCH ÀNH CHÍNH TẠI BỘ PHẬN MỘT CỬA');">
            <span class="glyphicon glyphicon-download"></span> Tải word
        </a>
    </div> --}}
    @include('voyager::tonghop-nhapsolieu.partials.tong-hop')
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">

    <style>
        .card-baocao .col-logo {
            margin-top: 10px;
            text-align: center;
        }

        .card-baocao hr {
            border-top: 1px solid #1f4091;
        }

        .card-baocao .title {
            font-weight: bold;
            font-family: Arial;
            color: #134895;
        }

        .card-baocao #boxdonvi {
            padding: 15px;
        }

        .card-baocao .bold {
            font-weight: bold;
        }

        .card-baocao #boxdonvi,
        #ketqua_congkhai {
            padding: 15px 10px;
        }

        .card-baocao #boxdonvi ul {
            width: 100%;
            margin: 0;
        }

        .card-baocao #boxdonvi ul li {
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

        .card-baocao #boxdonvi ul li a {
            color: #000;
        }

        .card-baocao #boxdonvi .tilte-huyen,
        #boxdonvi .tilte-xa,
        #ketqua_congkhai .tilte-ketqua {}

        .card-baocao .tintieubieu {
            height: 175px;

        }

        .card-baocao .tintieubieu .portlet-title {
            font-weight: bold;
            font-family: Arial;
            color: #1d6cbb;
            border-bottom: 1px solid #1d6cbb;
        }

        .card-baocao .tintieubieu li {
            text-align: justify;
            border-bottom: 1px dotted #8c8c8c;
            padding: 5px 5px 5px 15px;
            line-height: 20px;
            list-style-type: none;
            background: url(https://qcdc.bacgiang.gov.vn/HiepHoi-DoanhNghiep-theme/theme-images/bullet-news.png) no-repeat center left;
        }

        .card-baocao .tintieubieu li:last-child {
            border: 0px !important;
        }

        .card-baocao .tintieubieu li a {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .card-baocao .margin-30 {
            margin-top: 30px;
        }

        .card-baocao .center {
            text-align: center;
        }
    </style>

@stop

@section('javascript')
    <!-- DataTables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#export-btn').click(function() {
                var wb = XLSX.utils.table_to_book(document.getElementById('my-table'), {
                    sheet: 'Sheet JS'
                });
                XLSX.writeFile(wb, 'KQ_ThucHien_Congkhai.xlsx');
            });
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

            $('.select_all').on('click', function(e) {
                $('input[name="row_id"]').prop('checked', $(this).prop('checked')).trigger('change');
            });
        });




        // $('input[name="row_id"]').on('change', function() {
        //     var ids = [];
        //     $('input[name="row_id"]').each(function() {
        //         if ($(this).is(':checked')) {
        //             ids.push($(this).val());
        //         }
        //     });
        //     $('.selected_ids').val(ids);
        // });
        var check = document.getElementById('donviIdHuyen').value;
        if (check != 0 && check != 12) {
            $('#donviIdHuyen').ready(function() {
                document.getElementById('donviXa').style.display = 'block';
                document.getElementById('donviXalable').style.display = 'block';
            });
        }
        $('#donviIdHuyen').on('change', function() {
            var donviIdHuyen = document.getElementById('donviIdHuyen').value;

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
    </script>
@stop
