<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Báo cáo kết quả hướng dẫn người dân thực hiện khảo sát')

@section('page_header')
<div class=" card-baocao header zindex">
    <h1 class="title-baocao">
        Báo cáo kết quả hướng dẫn người dân thực hiện khảo sát
    </h1>
    <div>
        <div class="row select-baocao">
            @if ($lsDonViCha != null)
            <div class="col-sm-1 select-baocao-span">
                <span>Đơn vị </span>
            </div>
            <div class="col-sm-3">
                <select id="donviIdHuyen" class="form-control">
                    @if ($donvi_id == 1 || $donvi_id == 12){
                    <option value="0">--- Tất cả ---</option>

                    @foreach ($lsDonViCha as $donvi)
                    <option value="{{$donvi->id}}">{{$donvi->ten_donvi}}</option>
                    @endforeach

                    @endif


                    @if ($donvi_id > 1 && $donvi_id < 12){ @foreach ($tendonvi as $tendonvi) <option value="{{$donvi_id}}">{{$tendonvi->ten_donvi}}</option>
                        @endforeach
                        @endif

                        @if ($donvi_id > 12){
                        @foreach ($donvicha as $donvicha)
                        <option value="{{$donvicha->ma_donvi}}">{{$donvicha->ten_donvi}}</option>
                        @endforeach
                        @endif
                </select>
            </div>

            <div class="col-sm-1 select-baocao-span" id="donviXalable" style="display:none">
                <span>Đơn vị con</span>
            </div>
            <div class="col-sm-3" id="donviXa" style="display:none">
                <select id="cbx-donvi" class="select2" onchange="OnChangeDonVi()">
                    @if ($donvi_id > 12){
                    @foreach ($tendonvi as $tendonvi)
                    <option value="{{$donvi_id}}">{{$tendonvi->ten_donvi}}</option>
                    @endforeach
                    @endif
                    @if ($donvi_id < 13){ @foreach ($donvis as $donvi) <option value="{{$donvi->id}}">{{$donvi->ten_donvi}}</option>
                        @endforeach
                        @endif



                </select>
            </div>
            @endif
            <div class="col-sm-1 select-baocao-span">
                Từ ngày
            </div>
            <div class="date-index"> <input type="text" id="fromDate" onchange="OnChangeDonVi()"> </div>

            <div class="col-sm-1 select-baocao-span">
                Đến ngày
            </div>
            <div class="date-index"> <input type="text" id="toDate" onchange="OnChangeDonVi()"></div>
        </div>
        <div class="flex-end">
            <div class="">
                @can('add_ketqua_hotro_huongdan_motcua')
                <button class="btn btn-primary" onclick="ShowModalThemMoiBaoCao()">Thêm mới</button>
                @endcan
            </div>
        </div>
    </div>
</div>
@stop

@section('content')
<div class="baocao">
    {{-- Kết quả hỗ trợ hướng dẫn một cửa --}}
    <div id="ketqua-hotro-huongdan-motcua">
        <div id="content-ketqua-hotro-huongdan-motcua">
        </div>
    </div>
    <div id="modal-sua-ketquahotrohuongdanmotcua">
    </div>
    @include('voyager::ketqua-hotro-huongdan-motcua.modal-themmoi')
</div>
@stop

@include('voyager::ketqua-hotro-huongdan-motcua.include')
<link rel="stylesheet" href="/css/style.css">
@section('javascript')
<script src="/js/app.js"></script>
<script src="/js/sweetalert.min.js"></script>
<script>
    var isXemBaocao = false;
    var check = document.getElementById('donviIdHuyen').value;

    $(document).ready(function() {
        $('#toDate').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#fromDate').datetimepicker({

            format: 'YYYY-MM-DD',
        });
    });
    $("#toDate").on("dp.change", function() {
        DrawKetQuaHoTroHuongDanMotCua();
    });
    $("#fromDate").on("dp.change", function() {
        DrawKetQuaHoTroHuongDanMotCua();
    });

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
                    $select.append('<option value=' + response.data[i].id + '>' + response.data[i].ten_donvi + '</option>'); // return empty
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
    // init các thành phần của các modal thêm mới
    DrawKetQuaHoTroHuongDanMotCua();

    function OnChangeBaoCao() {
        ClearBaoCao();
        DrawKetQuaHoTroHuongDanMotCua();
    }

    function OnChangeDonVi() {
        ClearBaoCao();
        DrawKetQuaHoTroHuongDanMotCua();
    }

    function ShowModalThemMoiBaoCao() {
        DoShowModalThemMoiBaoCao();
        $('input.money').on('input', function() {
            getChange($(this));
        });

    }

    function DoShowModalThemMoiBaoCao() {
        ShowModalThemMoiKetQuaHoTroHuongDanMotCua();
    }

    function ClearBaoCao() {
        $("#content-ketqua-hotro-huongdan-motcua").empty();
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
        html = '\
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
            <div class="WordSection1">' + html + '</div>\
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

<script>
    function getChange(valueRef) {
        var str1 = valueRef.val();
        if (
            str1[str1.length - 1].charCodeAt() < 48 ||
            str1[str1.length - 1].charCodeAt() > 57
        ) {
            valueRef.val(str1.substring(0, str1.length - 1));
            return;
        }

        let str = valueRef.val().replace(/,/g, "");

        let value = +str;
        valueRef.val(value.toLocaleString('en-US', {
            maximumFractionDigits: 0
        }));

    }
</script>
@stop