<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<head>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
    integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Script -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Css custom -->
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}" />

</head>

<body>
  <div class="chi-tiet-ks">
    <h4 class="name-survey">{{$khaosat->ten_khaosat}}</h4>
    <!-- table -->
    <h4 class="lable-survey">1.Bảng đánh giá theo đơn vị</h4>
      <table class="table table-donvi table-hover">
        <thead>
          <tr class="detail-header">
            <th> STT</th>
            <th> Mã ĐV</th>
            <th> Tên ĐV</th>
            <th> Số lượt đánh giá</th>
          </tr>
        </thead>
        @foreach ($lsDonViSoLuots as $keyItem => $dataItem)
        <tbody>
          <tr>
            <td>{{$keyItem + 1}}</td>
            <td>{{$dataItem->ma_donvi}}</td>
            <td>{{$dataItem->ten_donvi}}</td>
            <td>{{$dataItem->soluotks}}</td>
          </tr>

        </tbody>
        @endforeach
      </table>
     
    <!-- table -->
    <h4 class="lable-survey">2.Tổng hợp</h4>
    <!-- pie chart -->
    <div class="margin-bottom-10">
      <select class="form-control input-chart-question" name="cauhoi" id="cauhoi" onchange="OnChangeFilter()">
        <option
          value="2. Khi đi nộp hồ sơ, nhận kết quả giải quyết ông/bà thấy như thế nào về thời gian chờ đợi làm thủ tục?">
          2. Khi đi nộp hồ sơ, nhận kết quả giải quyết ông/bà thấy như thế nào về thời gian chờ đợi làm thủ tục?</option>
        <option value="3. Ông/bà nhận xét như thế nào về thái độ của công chức bộ phận một cửa khi giao tiếp?">3. Ông/bà
          nhận xét như thế nào về thái độ của công chức bộ phận một cửa khi giao tiếp?</option>
        <option value="4. Cách hướng dẫn của công chức bộ phận một cửa đối với ông/bà như thế nào?">4. Cách hướng dẫn của
          công chức bộ phận một cửa đối với ông/bà như thế nào?</option>
        <option value="5. Ông/bà đánh giá như thế nào về mức độ thành thạo công việc của công chức bộ phận một cửa?">5.
          Ông/bà đánh giá như thế nào về mức độ thành thạo công việc của công chức bộ phận một cửa?</option>
        <option value="6. Thời gian giải quyết hồ sơ của ông/bà như thế nào?">6. Thời gian giải quyết hồ sơ của ông/bà như
          thế nào?</option>
        <option
          value="7. Trong quá trình giải quyết hồ sơ ông/bà có nội dung kiến nghị đối với cơ quan giải quyết thủ tục hành chính không?">
          7. Trong quá trình giải quyết hồ sơ ông/bà có nội dung kiến nghị đối với cơ quan giải quyết thủ tục hành chính
          không?</option>
        <option
          value="8. Ông/bà vui lòng cho biết về mức độ hài lòng của mình đối với quá trình thực hiện giải quyết thủ tục hành chính?">
          8. Ông/bà vui lòng cho biết về mức độ hài lòng của mình đối với quá trình thực hiện giải quyết thủ tục hành
          chính?
        </option>
        <option
          value="9. Trong quá trình giải quyết hồ sơ, công chức có đề nghị hoặc gợi ý ông/bà trả thêm chi phí để được giải quyết nhanh và nhận kết quả sớm hơn quy định không?">
          9. Trong quá trình giải quyết hồ sơ, công chức có đề nghị hoặc gợi ý ông/bà trả thêm chi phí để được giải quyết
          nhanh và nhận kết quả sớm hơn quy định không?</option>
      </select>
    </div>
    <div class="margin-bottom-10">
      <select class="form-control input-chart" name="donvi" id="donvi" onchange="OnChangeFilter() ">
        <option value="-1">Tất cả đơn vị</option>
        @foreach ($lsDonVis as $keyItem => $dataItem)
        <option value="{{$dataItem->id}}">{{$dataItem->ten_donvi}}</option>
        @endforeach
      </select>
    </div>
   <div class="margin-bottom-10">
    <select class="form-control input-chart" name="linhvuc" id="linhvuc" onchange="OnChangeFilter()">
      <option value=" -1">Tất cả lĩnh vực</option>
      <option value="Quản lý đất đai">Quản lý đất đai</option>
      <option value="Chứng thực">Chứng thực</option>
      <option value="Hộ tịch">Hộ tịch</option>
      <option value="Người có công">Người có công</option>
      <option value="Bảo trợ xã hội">Bảo trợ xã hội</option>
      <option value="Lĩnh vực khác">Lĩnh vực khác</option>
    </select>
  </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <figure class="highcharts-figure ">
      <div id="container"></div>
    </figure>
    <!-- pie chart -->

  </div>
</body>

</html>
<script>
    var khaosatid = '<?php echo $khaosat->id; ?>';
    $(document).ready(function() {
      $("#cauhoi").select2();
      $("#donvi").select2();
      $("#linhvuc").select2();
    });
    OnChangeFilter();
    function OnChangeFilter() {
        var cauhoi = $('#cauhoi').val();
        var donvi = $('#donvi').val();
        var linhvuc = $('#linhvuc').val();
        if(cauhoi=='2. Khi đi nộp hồ sơ, nhận kết quả giải quyết ông/bà thấy như thế nào về thời gian chờ đợi làm thủ tục?'
            || cauhoi=='8. Ông/bà vui lòng cho biết về mức độ hài lòng của mình đối với quá trình thực hiện giải quyết thủ tục hành chính?') {
            GetFilterLinhVuc(cauhoi,donvi,linhvuc);
        }
        else
            GetFilterCauHoi(cauhoi,donvi,linhvuc);
        }
        function GetFilterCauHoi(cauhoi,donvi,linhvuc) {
            $.ajax({
                type: 'post',
                url: '/pakn/xem-khao-sat-webview/chi-tiet/filter1',
                data: {
                    "_token": "{{ csrf_token() }}",
                    khaosatid: khaosatid,
                    cauhoi: cauhoi,
                    donvi: donvi,
                    linhvuc: linhvuc,
                },
                success: function(response) {
                    drawPieChart(convertData(response.data),cauhoi);
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
        function GetFilterLinhVuc(cauhoi,donvi,linhvuc) {
            $.ajax({
                type: 'post',
                url: '/pakn/xem-khao-sat-webview/chi-tiet/filter2',
                data: {
                    "_token": "{{ csrf_token() }}",
                    khaosatid: khaosatid,
                    cauhoi: cauhoi,
                    donvi: donvi,
                    linhvuc: linhvuc,
                },
                success: function(response) {
                  drawColumnChart(convertDataLinhVuc(response.data),cauhoi);
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
   function convertData(data){
      sereis = [];
      data.forEach(element => {
        var obj = {
          name: element.cau_tra_loi,
          y: element.so_luot
        };
        sereis.push(obj);
      });
      return sereis;
   }
   function convertDataLinhVuc(data){
      sereis = [];
      linhvucs = [];
      cautralois = [];
      data.forEach(element => {
        if(linhvucs.indexOf(element.linhvuc) == -1 ){
          linhvucs.push(element.linhvuc);
        }
        if(cautralois.indexOf(element.cau_tra_loi) == -1 ){
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
        sereis.push(obj);
      }
      return {
        sereis: sereis,
        linhvuc: linhvucs
      };
   }
  function drawPieChart(data,cauhoi){
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
  series: [{
    name: 'Brands',
    colorByPoint: true,
    data: data
  }]
});
    }
    function drawColumnChart(data,cauhoi){
      Highcharts.chart('container', {

chart: {
  type: 'column'
},

title: {
  text: cauhoi
},

xAxis: {
  text: "xAxis",
  categories: data.linhvuc
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

plotOptions: {
  column: {
    stacking: 'normal'
  }
},

series: data.sereis
});
    }


</script>
