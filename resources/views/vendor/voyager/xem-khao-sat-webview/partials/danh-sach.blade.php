<!doctype html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<head>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Css custom -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}" />
</head>


<body>
    <div class="container-fluid xem-khao-sat">
        {{-- @foreach ($lsKhaoSats as $khaosat)
            <div class="box-khaosat">
                <div class="flex-box-survey">
                    <img class="img-khaosat-box" src="/images/khaosat.png" alt="khaosat" />
                    <a href="{{url('/pakn/xem-khao-sat-webview/chi-tiet/'.$khaosat->id)}}" class="name-survey">
        {{$khaosat->ten_khaosat}}
        </a>
    </div>
    </div>
    @endforeach --}}
    <div class="box-khaosat">
        <div class="flex-box-survey">
            <img class="img-khaosat-box" src="/images/khaosat.png" alt="khaosat" />
            <a href="{{url('/admin/baocao-ks-tonghop')}}" class="name-survey">
                Báo cáo tổng hợp
            </a>
        </div>

        <div class="flex-box-survey">
            <img class="img-khaosat-box" src="/images/khaosat.png" alt="khaosat" />
            <a href="{{url('/admin/baocao-ks-chitiet')}}" class="name-survey">
                Báo cáo chi tiết
            </a>
        </div>
        <div class="flex-box-survey">
            <img class="img-khaosat-box" src="/images/khaosat.png" alt="khaosat" />
            <a href="{{url('/admin/ketqua_hotro_huongdan_motcua-webview')}}" class="name-survey">
                Báo cáo kết quả hướng dẫn
            </a>
        </div>
    </div>

    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $("box-khaosat").hover(function() {
            $("survey-submit").css("visibility", "inherit");
        });
    });
</script>