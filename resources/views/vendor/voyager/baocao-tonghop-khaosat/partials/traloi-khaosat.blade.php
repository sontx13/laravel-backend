<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="{{ asset('/js/jquery.table2excel.js') }}"></script>

</head>
<body>
    <div class="row">
        <div class="col-sm-12">
            <!-- table -->
            <div class="text-center">
                <h4 class="title-table-report">BẢNG TỔNG HỢP CÂU TRẢ LỜI</h4>
            </div>
            <table class="table table-boder table-hover table2excel">
                <thead>
                    <tr class="detail-header">
                    <th class="text-center">STT</th>
                    <th>Câu trả lời</th>
                    <th class="text-center" width="200">Số lượng</th>
                    </tr>
                </thead>
                @foreach ($lsTraloi as $keyItem => $dataItem)
                <tbody>
                    <tr>
                        <td class="text-center" >{{$keyItem + 1}}</td>
                        <td>{{$dataItem->cau_tra_loi}}</td>
                        <td class="text-center" >{{$dataItem->soluong}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <button class="exportToExcel btn btn-success hidden-app">Xuất Excel</button>
        </div>
    </div>
</body>
</html>
<script>
    $(function() {
        $(".exportToExcel").click(function(e){
            var table = $(this).prev('.table2excel');
            if(table && table.length){
                var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
                $(table).table2excel({
                    exclude: ".noExl",
                    name: "Excel Document Name",
                    filename: "TonghopCautraloi_" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
                    fileext: ".xls",
                    exclude_img: true,
                    exclude_links: true,
                    exclude_inputs: true,
                    preserveColors: preserveColors
                });
            }
        });

    });
</script>
