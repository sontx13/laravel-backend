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
                <div class="col-sm-3">
                    <input type="date" class="input-line" name="tungay" placeholder="Từ ngày"  id="tungayDate" onchange="OnChangeKhaoSat()"/>
                </div>

                <div class="col-sm-1">
                    <label>Đến ngày</label>
                </div>
                <div class="col-sm-3">
                    <input type="date" class="input-line" name="denngay" placeholder="Đến ngày"  id="denngayDate" onchange="OnChangeKhaoSat()"/>
                </div>

                <div class="col-sm-1">
                    <label>Sắp xếp</label>
                </div>
                <div class="col-sm-3">
                    <select id="cbx-sapxep" class="select2" onchange="OnChangeKhaoSat()">
                        <option value="3">Mặc định</option>
                        <option value="2">Giảm dần</option>
                        <option value="1">Tăng dần</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="baocaoks-form">
            <div class="baocaoks-title">
                <span>Chọn theo câu hỏi</span>
            </div>
            <div class="row select-baocao select-baocao-cauhoi-mobile">
                <div class="col-sm-12">
                    <select id="cbx-cauhoi" class="select2" onchange="LoadData()">
                        <option value="3: Ông/bà thấy như thế nào về thời gian chờ đợi, xếp hàng ở Bộ phận một cửa?">3: Ông/bà thấy như thế nào về thời gian chờ đợi, xếp hàng ở Bộ phận một cửa?</option>
                        <option value="3.1: Theo ông/bà, thời gian chờ đợi, xếp hàng rất lâu là vì lý do nào?">3.1: Theo ông/bà, thời gian chờ đợi, xếp hàng rất lâu là vì lý do nào?</option>
                        <option value="4: Ông/bà nhận xét như thế nào về thái độ của công chức bộ phận một cửa?">4: Ông/bà nhận xét như thế nào về thái độ của công chức bộ phận một cửa?</option>
                        <option value="5: Cách hướng dẫn của công chức bộ phận một cửa đối với ông/bà như thế nào?">5: Cách hướng dẫn của công chức bộ phận một cửa đối với ông/bà như thế nào?</option>
                        <option
                            value="6: Ông/bà đánh giá như thế nào về kỹ năng xử lý công việc của công chức bộ phận một cửa?">
                            6: Ông/bà đánh giá như thế nào về kỹ năng xử lý công việc của công chức bộ phận một cửa?</option>
                        <option
                            value="7: Thời gian giải quyết hồ sơ gần đây nhất của ông/bà như thế nào?">
                            7: Thời gian giải quyết hồ sơ gần đây nhất của ông/bà như thế nào?</option>
                        <option
                            value="7.1: Khi hồ sơ của ông/bà trễ hẹn có được thông báo không?">
                            7.1: Khi hồ sơ của ông/bà trễ hẹn có được thông báo không?</option>
                        <option
                            value="8: Trong quá trình giải quyết hồ sơ ông/bà có nhận được lời đề nghị hoặc gợi ý trả thêm chi phí để được giải quyết nhanh và nhận được kết quả sớm hơn quy định không?">
                            8: Trong quá trình giải quyết hồ sơ ông/bà có nhận được lời đề nghị hoặc gợi ý trả thêm chi phí để được giải quyết nhanh và nhận được kết quả sớm hơn quy định không?
                        </option>
                        <option
                            value="8.1: Ông/bà được gợi ý trả thêm chi phí thực hiện thủ tục hành chính ở lĩnh vực nào?">
                            8.1: Ông/bà được gợi ý trả thêm chi phí thực hiện thủ tục hành chính ở lĩnh vực nào?</option>
                    </select>
                </div>

                {{-- <div class="col-sm-1">
                    <span>L. vực</span>
                </div>
                <div class="col-sm-3">
                    <select id="cbx-linhvuc" class="select2" onchange="LoadData()">
                        <option value="-1">Tất cả</option>
                        <option value="Quản lý đất đai">Quản lý đất đai</option>
                        <option value="Chứng thực">Chứng thực</option>
                        <option value="Hộ tịch">Hộ tịch</option>
                        <option value="Người có công">Người có công</option>
                        <option value="Bảo trợ xã hội">Bảo trợ xã hội</option>
                        <option value="Lĩnh vực khác">Lĩnh vực khác</option>
                    </select>
                </div> --}}
            </div>
        </div>

        <div class="baocaoks-form" id="container-table">
        </div>

        <div class="baocaoks-form" >
            <div class="row">
                <div class="col-sm-12">
                    <div id="container">
                    </div>
                </div>
            </div>
        </div>


        <div class="baocaoks-form">
            <div class="baocaoks-title">
                <span>Chọn theo câu trả lời</span>
            </div>

            <div class="row select-baocao">
                <div class="col-sm-12">
                    <select id="cbx-traloi" class="select2" onchange="LoadDataTraloi()">
                        <option value="Bình thường, thực hiện theo thứ tự" selected>Bình thường, thực hiện theo thứ tự</option>
                        <option value="Chờ đợi rất lâu">Chờ đợi rất lâu</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="baocaoks-form" id="container-table-huyen">
        </div>

        <div class="baocaoks-form" >
            <div class="row">
                <div class="col-sm-12">
                    <div id="container-column">
                    </div>
                </div>
            </div>
        </div>


        <div class="baocaoks-form">
            <div class="baocaoks-title">
                <span>Chọn theo đơn vị</span>
            </div>

            <div class="row select-baocao">
                <div class="col-sm-12">
                    <select id="cbx-donvi" class="select2" onchange="LoadDataTraloi()">
                        <option value="0">Tất cả</option>
                        <option value="1">Tỉnh Bắc Giang</option>
                        @foreach ($donvis as $donvi)
                            <option value="{{$donvi->id}}">{{$donvi->ten_donvi}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="baocaoks-form" id="container-table-xa">
        </div>

        <div class="baocaoks-form" >
            <div class="row">
                <div class="col-sm-12">
                    <div id="container-donvi">
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>

<script>
    OnChangeKhaoSat();

    function OnChangeKhaoSat() {
        var khaosatid = $('#cbx-khaosat').val();
        var cauhoi = $('#cbx-cauhoi').val();

        var tungayDate = $('#tungayDate').val();
        var denngayDate = $('#denngayDate').val();
        var sapxep = $('#cbx-sapxep').val();

        LoadData();
    }

    function LoadData() {
        var khaosatid = $('#cbx-khaosat').val();
        var cauhoi = $('#cbx-cauhoi').val();
        var traloi  = $('#cbx-traloi').val();

        var tungayDate = $('#tungayDate').val();
        var denngayDate = $('#denngayDate').val();
        var sapxep = $('#cbx-sapxep').val();

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today =  yyyy + '-' +mm + '-' + dd ;

        if(tungayDate == null || tungayDate == ""){
            tungayDate = '2022-07-01';
        }

        if(denngayDate == null || denngayDate == ""){
            denngayDate = today;
        }

        GetTraloi(khaosatid, cauhoi, tungayDate, denngayDate, sapxep);

        GetDropDownTraloi(khaosatid, cauhoi, traloi, tungayDate, denngayDate, sapxep);

        GetDataByLoaiCauHoi(khaosatid, cauhoi, traloi, 0, tungayDate, denngayDate, sapxep);

    }


    function LoadDataTraloi() {
        var khaosatid = $('#cbx-khaosat').val();
        var cauhoi = $('#cbx-cauhoi').val();
        var traloi  = $('#cbx-traloi').val();

        var tungayDate = $('#tungayDate').val();
        var denngayDate = $('#denngayDate').val();
        var sapxep = $('#cbx-sapxep').val();

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today =  yyyy + '-' +mm + '-' + dd ;

        if(tungayDate == null || tungayDate == ""){
            tungayDate = '2022-07-01';
        }

        if(denngayDate == null || denngayDate == ""){
            denngayDate = today;
        }

        GetDropDownTraloi(khaosatid, cauhoi, traloi, tungayDate, denngayDate, sapxep);
    }

    function GetDataByLoaiCauHoi(khaosatid, cauhoi, traloi, type, tungayDate, denngayDate, sapxep) {
        //console.log("type == 1 traloi=="+traloi);
        showLoading();
        $.ajax({
            type: 'post',
            url: '/admin/baocao-tonghop-khaosat/data-chart',
            data: {
                "_token": "{{ csrf_token() }}",
                khaosatid: khaosatid,
                cauhoi: cauhoi,
                traloi: traloi,
                type: type,
                tungayDate: tungayDate,
                denngayDate: denngayDate,
                sapxep: sapxep
            },
            success: function(response) {
                hideLoading();
                if (type == 0) {
                    //console.log("type == 0 data.length=="+response.data.length);
                    drawPieChart(convertDataPieChart(response.data),cauhoi);
                }
                else if(type == 1){
                    //console.log("type == 1 data.length=="+response.data.length);
                    //drawColumnChart(convertDataColumnChart(response.data),cauhoi);
                    drawColumnCautraloiChart(convertCauhoiColumnChart(response.data),cauhoi, traloi)
                }
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

    function GetDataByDonvi(khaosatid, cauhoi, traloi, donvi, tungayDate, denngayDate, sapxep) {
        //console.log("type == 1 traloi=="+traloi);
        showLoading();
        $.ajax({
            type: 'post',
            url: '/admin/baocao-tonghop-khaosat/donvi-khaosat',
            data: {
                "_token": "{{ csrf_token() }}",
                khaosatid: khaosatid,
                cauhoi: cauhoi,
                traloi: traloi,
                donvi: donvi,
                tungayDate: tungayDate,
                denngayDate: denngayDate,
                sapxep: sapxep
            },
            success: function(response) {
                hideLoading();

                console.log("donvi data.length=="+response.data.length);
                //drawColumnChart(convertDataColumnChart(response.data),cauhoi);
                drawColumnDonviChart(convertCauhoiColumnChart(response.data),cauhoi, traloi)
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

    function GetTraloi(khaosatid,cauhoi, tungayDate, denngayDate, sapxep) {
        showLoading();
        $.ajax({
            type: 'post',
            url: '/admin/baocao-tonghop-khaosat/traloi-khaosat',
            data: {
                "_token": "{{ csrf_token() }}",
                khaosatid: khaosatid,
                cauhoi: cauhoi,
                tungayDate: tungayDate,
                denngayDate: denngayDate,
                sapxep: sapxep
            },
            success: function(response) {
                $("#container-table").html(response);
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

    function GetTraloiHuyen(khaosatid,cauhoi,traloi, tungayDate, denngayDate, sapxep) {

        //console.log("traloi=="+traloi);
        showLoading();
        $.ajax({
            type: 'post',
            url: '/admin/baocao-tonghop-khaosat/traloi-khaosat-huyen',
            data: {
                "_token": "{{ csrf_token() }}",
                khaosatid: khaosatid,
                cauhoi: cauhoi,
                traloi: traloi,
                tungayDate: tungayDate,
                denngayDate: denngayDate,
                sapxep: sapxep
            },
            success: function(response) {
                $("#container-table-huyen").html(response);
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


    function GetTraloiXa(khaosatid,cauhoi,traloi,donvi, tungayDate, denngayDate, sapxep) {

        //console.log("traloi=="+traloi);
        showLoading();
        $.ajax({
            type: 'post',
            url: '/admin/baocao-tonghop-khaosat/traloi-khaosat-xa',
            data: {
                "_token": "{{ csrf_token() }}",
                khaosatid: khaosatid,
                cauhoi: cauhoi,
                traloi: traloi,
                donvi: donvi,
                tungayDate: tungayDate,
                denngayDate: denngayDate,
                sapxep: sapxep
            },
            success: function(response) {
                $("#container-table-xa").html(response);
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


    function GetDropDownTraloi(khaosatid,cauhoi,traloi, tungayDate, denngayDate, sapxep) {
        showLoading();
        $.ajax({
            type: 'post',
            url: '/admin/baocao-tonghop-khaosat/dropdown-traloi',
            data: {
                "_token": "{{ csrf_token() }}",
                khaosatid: khaosatid,
                cauhoi: cauhoi,
                tungayDate: tungayDate,
                denngayDate: denngayDate,
                sapxep: sapxep
            },
            success: function(response) {
                // console.log("GetDropDownTraloi=="+response.data.length);
                $("#cbx-traloi").empty();
                response.data.forEach((element, index) => {
                    if(traloi == element.cau_tra_loi){
                        $("#cbx-traloi").append($("<option selected></option>").val(element.cau_tra_loi).text(element.cau_tra_loi));
                    }
                    else{
                        $("#cbx-traloi").append($("<option></option>").val(element.cau_tra_loi).text(element.cau_tra_loi));
                    }
                    //console.log("$val()=="+$("#cbx-traloi").val());
                });
                var traloi_1 = $('#cbx-traloi').val();
                //console.log("traloi_1=="+traloi_1);
                GetDataByLoaiCauHoi(khaosatid, cauhoi, traloi_1, 1, tungayDate, denngayDate, sapxep);

                GetTraloiHuyen(khaosatid, cauhoi, traloi_1, tungayDate, denngayDate, sapxep);

                var donvi = $('#cbx-donvi').val();
                console.log("donvi=="+donvi);
                GetDataByDonvi(khaosatid, cauhoi, traloi_1, donvi, tungayDate, denngayDate, sapxep);

                GetTraloiXa(khaosatid, cauhoi, traloi_1, donvi, tungayDate, denngayDate, sapxep);
            },
            error: function(err) {
                console.log(err);
                hideLoading();
                if (err.status == 403) {
                    toastr.error('Người dùng không có quyền thực hiện thao tác này');
                } else {
                    toastr.error('Cập nhật câu trả lời không thành công');
                }
            }
        });
    }

    function convertDataPieChart(data){
        series = [];
        data.forEach(element => {
            var obj = {
                name: element.cau_tra_loi,
                y: element.soluong
            };
            series.push(obj);
        });
        return series;
    }

    function convertCauhoiColumnChart(data){
        //console.log("data=="+data);
        series = [];
        data.forEach(element => {

            //console.log("element.ten_donvi=="+element.ten_donvi);
            //console.log("element.soluong=="+element.soluong);
            var dataSeries = [];
            dataSeries.push(parseInt(element.soluong));
                var obj = {
                name: element.ten_donvi_ct,
                data: dataSeries
            };
            series.push(obj);
        });

        return {
            series: series
        };
    }


    function convertDataColumnChart(data){
        series = [];
        linhvucs = [];
        cautralois = [];
        data.forEach(element => {
            if(linhvucs.indexOf(element.linhvuc) == -1 ) {
                linhvucs.push(element.linhvuc);
            }
            if(cautralois.indexOf(element.cau_tra_loi) == -1 ) {
                cautralois.push( element.cau_tra_loi);
            }
        });
        for (var indexCauTraLoi = 0; indexCauTraLoi <  cautralois.length; indexCauTraLoi++) {
            var obj = {
                name: cautralois[indexCauTraLoi]
            };
            var dataSeries = [];
            for(var indexLinhVuc = 0; indexLinhVuc < linhvucs.length;  indexLinhVuc ++) {
                var lsSoLuots = data.filter(x => x.cau_tra_loi == cautralois[indexCauTraLoi] && x.linhvuc == linhvucs[indexLinhVuc]);
                var dataSoLuot = lsSoLuots && lsSoLuots.length > 0 ? lsSoLuots[0].tong : 0;
                dataSeries.push(dataSoLuot);
            }
            obj.data = dataSeries;
            series.push(obj);
        }

        //console.log("===convertDataColumnChart obj.name==="+obj.name);
        //console.log("===convertDataColumnChart obj.data==="+obj.data);
        return {
            series: series,
            linhvucs: linhvucs
        };
    }
    function drawPieChart(data, cauhoi){
        Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: cauhoi,
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        exporting: {
                buttons: {
                    contextButton: {
                    menuItems: ["printChart", "downloadPNG"]
                }
                }
        },
        series: [{
                name: 'Brands',
                colorByPoint: true,
                data: data
            }]
        });
    }
    function drawColumnChart(data, cauhoi) {
        Highcharts.chart('container-column', {
            chart: {
                type: 'column'
            },
            title: {
                text: cauhoi
            },
            xAxis: {
                text: "xAxis",
                categories: data.linhvucs
            },
            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: 'Số lượt trả lời'
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' +
                    this.series.name + ': ' + this.y + '<br/>' +
                    'Total: ' + this.point.stackTotal;
                }
            },
            exporting: {
                    buttons: {
                        contextButton: {
                        menuItems: ["printChart", "downloadPNG"]
                    }
                    }
            },
            plotOptions: {
                column: {
                    stacking: 'normal'
                }
            },
            series: data.series
        });
    }


    function drawColumnCautraloiChart(data, titletext, traloi) {
        //console.log("data.series=="+data.series);
        Highcharts.chart('container-column', {
            chart: {
                type: 'column'
            },
            title: {
                text: titletext
            },
            xAxis: {
                categories: [
                    traloi
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Số lượng'
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

    function drawColumnDonviChart(data, titletext, traloi) {
        //console.log("data.series=="+data.series);
        Highcharts.chart('container-donvi', {
            chart: {
                type: 'column'
            },
            title: {
                text: titletext
            },
            xAxis: {
                categories: [
                    traloi
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Số lượng'
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
