<!doctype html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<head>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('/js/tablesaw.jquery.js') }}"></script>
    <script src="{{ asset('/js/tablesaw-init.js') }}"></script>

    <!-- Css custom -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/tablesaw.css') }}"/>

    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('/js/highcharts.js') }}"></script>

    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <!-- optional -->
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
</head>


<body>

    <div class="baocao-khaosat">
        <div class="baocaoks-form">
            <div class="baocaoks-title">
                <span>Báo cáo số lượt khảo sát</span>
            </div>
            <div class="row select-baocao select-baocao-phieuks-mobile">
                <div class="col-sm-12">
                    <select id="cbx-khaosat" class="select2" onchange="OnChangeKhaoSat()">
                        @foreach ($dsKhaoSats as $khaosat)
                            <option value="{{$khaosat->id}}">{{$khaosat->ten_khaosat}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row" style="padding-bottom: 15px">
                <div class="col-sm-1">
                    <label>Từ ngày</label>
                </div>
                <div class="col-sm-2">
                    <input type="date" class="input-line" name="tungay" placeholder="Từ ngày"  id="tungayDate" onchange="OnChangeKhaoSat()"/>
                </div>

                <div class="col-sm-1">
                    <label>Đến ngày</label>
                </div>
                <div class="col-sm-2">
                    <input type="date" class="input-line" name="denngay" placeholder="Đến ngày"  id="denngayDate" onchange="OnChangeKhaoSat()"/>
                </div>

                <div class="col-sm-1">
                    <label>Sắp xếp</label>
                </div>
                <div class="col-sm-2">
                    <select id="cbx-sapxep" class="select2" onchange="OnChangeKhaoSat()">
                        <option value="3">Mặc định</option>
                        <option value="2">Giảm dần</option>
                        <option value="1">Tăng dần</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="baocaoks-form" id="soluot-ks">
        </div>

        <div class="baocaoks-form" >
            <div class="row">
                <div class="col-sm-12">
                        <div id="container-tonghop">
                        </div>
                </div>
            </div>
        </div>

        <div class="baocaoks-form">
            <div class="row" style="padding-top: 15px;padding-bottom: 15px;">
                <div class="col-sm-1">
                    <label>Chọn đơn vị</label>
                </div>
                <div class="col-sm-2">
                    <select id="cbx-donvi" class="select2" onchange="OnChangeKhaoSat()">
                        <option value="0">Tất cả</option>
                        <option value="1">Tỉnh Bắc Giang</option>
                        @foreach ($donvis as $donvi)
                            <option value="{{$donvi->id}}">{{$donvi->ten_donvi}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="baocaoks-form" id="soluot-ks-chitiet">
        </div>

    </div>

</body>
</html>

<script>
    OnChangeKhaoSat();

    function OnChangeKhaoSat() {
        var khaosatid = $('#cbx-khaosat').val();
        var cauhoi = $('#cbx-cauhoi').val();

        var donvi = $('#cbx-donvi').val();
        console.log("donvi==="+donvi);

        var tungayDate = $('#tungayDate').val();
        var denngayDate = $('#denngayDate').val();
        var sapxep = $('#cbx-sapxep').val();

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');

        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today =  yyyy + '-' +mm + '-' + dd +' 23:59:59';

        if(tungayDate == null || tungayDate == ""){
            tungayDate = '2022-07-01 00:00:00';
        }else{
            tungayDate = tungayDate+ ' 00:00:00';
        }

        if(denngayDate == null || denngayDate == ""){
            denngayDate = today;
        }else{
            denngayDate = denngayDate+ ' 23:59:59';
        }

        console.log("tungayDate=="+tungayDate);
        console.log("denngayDate=="+denngayDate);
        //console.log("sapxep=="+sapxep);
        GetSoLuotKhaoSatChitiet(khaosatid,tungayDate,denngayDate,sapxep,donvi);
        GetSoLuotKhaoSat(khaosatid,tungayDate,denngayDate,sapxep);
        GetDataTonghop(khaosatid,tungayDate,denngayDate,sapxep);
    }

    function GetSoLuotKhaoSatChitiet(khaosatid,tungayDate,denngayDate,sapxep,donvi) {
        showLoading();
        $.ajax({
            type: 'post',
            url: '/admin/baocao-tonghop-khaosat/soluot-khaosat-chitiet',
            data: {
                "_token": "{{ csrf_token() }}",
                khaosatid: khaosatid,
                tungayDate: tungayDate,
                denngayDate: denngayDate,
                sapxep: sapxep,
                donvi: donvi
            },
            success: function(response) {
                //console.log("response"+response);
                $("#soluot-ks-chitiet").html(response);
            },
            error: function(err) {
                console.log(err);
                hideLoading();
                if (err.status == 403) {
                    toastr.error('Người dùng không có quyền thực hiện thao tác này');
                } else {
                    toastr.error('Cập nhật không thành công');
                }
            }
        });
    }

    function GetSoLuotKhaoSat(khaosatid,tungayDate,denngayDate,sapxep) {
        showLoading();
        $.ajax({
            type: 'post',
            url: '/admin/baocao-tonghop-khaosat/soluot-khaosat',
            data: {
                "_token": "{{ csrf_token() }}",
                khaosatid: khaosatid,
                tungayDate: tungayDate,
                denngayDate: denngayDate,
                sapxep: sapxep
            },
            success: function(response) {
                $("#soluot-ks").html(response);
            },
            error: function(err) {
                console.log(err);
                hideLoading();
                if (err.status == 403) {
                    toastr.error('Người dùng không có quyền thực hiện thao tác này');
                } else {
                    toastr.error('Cập nhật không thành công');
                }
            }
        });
    }
    function GetDataTonghop(khaosatid,tungayDate,denngayDate,sapxep) {
        showLoading();
        $.ajax({
            type: 'post',
            url: '/admin/baocao-tonghop-khaosat/tong-hop-data-chart',
            data: {
                "_token": "{{ csrf_token() }}",
                khaosatid: khaosatid,
                tungayDate: tungayDate,
                denngayDate: denngayDate,
                sapxep: sapxep
            },
            success: function(response) {
                hideLoading();
                //console.log("tổng hợp=="+response.data);
                drawColumnTonghopChart(convertTonghopColumnChart(response.data),"Biểu đồ tổng hợp lượt khảo sát");
            },
            error: function(err) {
                console.log(err);
                hideLoading();
                if (err.status == 403) {
                    toastr.error('Người dùng không có quyền thực hiện thao tác này');
                } else {
                    toastr.error('Cập nhật không biểu đồ tổng hợp khảo sát không thành công');
                }
            }
        });
    }

    function convertTonghopColumnChart(data){
        series = [];
        data.forEach(element => {
            var dataSeries = [];
            dataSeries.push(parseInt(element.soluotks));
                var obj = {
                name: element.ten_donvi,
                data: dataSeries
            };
            series.push(obj);
        });

        return {
            series: series
        };
    }



    function drawColumnTonghopChart(data, titletext) {
        //console.log("data.series=="+data.series);
        Highcharts.chart('container-tonghop', {
            chart: {
                type: 'column'
            },
            title: {
                text: titletext
            },
            xAxis: {
                categories: [
                    '10 Huyện và trung tâm hành chính công'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Số lượt KS (lượt)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} lượt</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            exporting: {
                buttons: {
                    contextButton: {
                    menuItems: ["printChart", "downloadPNG"]
                }
                }
            },
            series:  data.series
            });
    }
</script>
<style>
.baocao-khaosat{
    background-image: linear-gradient(#94C4EA, #ffeb3b);
    border: 1px solid #efe4e4;
    padding: 10px;
    /* border-radius: 10px; */
}

.baocao-khaosat .baocaoks-form{
    margin-bottom: 10px;
    background-color: #F8FBEA;
    border-radius: 10px;
    text-align: center;
}

.baocao-khaosat .baocaoks-form table{
    background: #fff;
    color: #000;
}

.baocao-khaosat .baocaoks-form table th{
    background: #fff;
    color: rgb(180, 21, 21);
    text-align: center;
    font-weight: bold;
}

.baocao-khaosat .baocaoks-title{
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    background-color: #FF9700;
}

.baocao-khaosat .baocaoks-title span{
    font-size: 23px;
    color: #fff;
    font-weight: bold;
}

.baocao-khaosat .select-baocao{
    padding: 10px;
}

.baocao-khaosat .select-baocao .select2-selection__rendered{
    background: #fff;
    color: #000 !important;
    font-weight: bold;
}

.baocao-khaosat .select2-selection__rendered{
    border: 1px solid #767676;
}

.baocao-khaosat input ,.baocao-khaosat select{
    width: 100%;
}

.baocao-khaosat label {
    font-weight: bold;
}
</style>
