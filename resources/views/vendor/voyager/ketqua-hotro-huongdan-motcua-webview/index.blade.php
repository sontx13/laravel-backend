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
                <div class="row">
                    <div class="col-sm-12 margin-bottom-card">
                        <input type="text" style="width:100%" id="fromDate">
                    </div>
                    <div class="col-sm-12 margin-bottom-card">
                        <input type="text" style="width:100%" id="toDate">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<div class="baocao">
    {{-- Kết quả hỗ trợ hướng dẫn một cửa --}}
    <div id="ketqua-hotro-huongdan-motcua-webview">
        <div id="content-ketqua-hotro-huongdan-motcua-webview">
        </div>
    </div>
    <div id="modal-sua-ketquahotrohuongdanmotcua-webview">
    </div>
</div>
@include('voyager::loading.spin')
@include('voyager::ketqua-hotro-huongdan-motcua-webview.include')
<link rel="stylesheet" href="/css/style.css">
<script src="/js/app.js"></script>
<script src="/js/sweetalert.min.js"></script>

<script>
    var isXemBaocao = true;
    var check = document.getElementById('donviIdHuyen').value;
    $(document).ready(function() {
        $('#toDate').datetimepicker({
            format: 'YYYY-MM-DD ',
        });
        $('#fromDate').datetimepicker({

            format: 'YYYY-MM-DD ',
        });
    });
    $("#toDate").on("dp.change", function() {
        DrawKetQuaHoTroHuongDanMotCuaWebview();
    });
    $("#fromDate").on("dp.change", function() {
        DrawKetQuaHoTroHuongDanMotCuaWebview();
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

    function OnChangeBaoCao() {
        DrawKetQuaHoTroHuongDanMotCuaWebview();
    }

    OnChangeBaoCao();
</script>