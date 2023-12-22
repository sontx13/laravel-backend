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
</head>


<body>

<div class="container-fluid pakn">
    @csrf
    {{-- <div class="guipakn-container" style="margin-top: 10px;">
        <a class="btn btn-small btn-danger width-100" href="{{route('voyager.khao-sat.pakn-index')}}" style="color: yellow;">Gửi phản ánh kiến nghị</a>
    </div> --}}



        @isset($results)
            @if ($results->count() > 0)

                @php $sl = ($results->perPage() * $results->currentPage()) - ($results->perPage() - 1); @endphp
                @foreach($results as $p)
                    <div class="box box-mobile-form" style="background-color: #fcf8e3;margin-top: 10px;">
                        <div class="row">
                            <div class="col-sm-12" style="margin-bottom: 5px;">
                                <a style="color: red;" href="/pakn/pakn-chitiet/{{ $p->id }}"><span class="vande-pakn">{{ $sl }}.{{$p->tieu_de}}</span></a>
                            </div>
                            <div class="col-sm-6 col-xs-7">
                                <span class="ngay-gui-pakn">Ngày {{ Carbon\Carbon::parse($p->created_at)->format('H:i d/m/Y') }}</span>
                            </div>
                            <div class="col-sm-6 col-xs-5">
                                @if ($p->status == App\Enums\TrangThaiXuLyPAKNEnum::ChuaXuLy)
                                    <i class="glyphicon glyphicon-question-sign icon tt-chua-xuly" title="Chưa xử lý"></i><span> Chưa xử lý</span>
                                @elseif ($p->status == App\Enums\TrangThaiXuLyPAKNEnum::DangXuLy)
                                    <i class="glyphicon glyphicon-time icon tt-dang-xuly" title="Đang xử lý"></i><span> Đang xử lý</span>
                                @elseif ($p->status == App\Enums\TrangThaiXuLyPAKNEnum::DaXuLy)
                                    <i class="glyphicon glyphicon-ok-sign icon tt-da-xuly" title="Đã xử lý"></i><span> Đã xử lý</span>
                                @endif
                            </div>
                            <div class="col-sm-12">
                                <span class="span-nguoigui">Người gửi: </span><span class="nguoi-gui">{{$p->ten}}</span>
                            </div>
                            <div class="col-sm-12">
                                <span class="dia-chi-pakn">{{$p->dia_chi}}</span>
                            </div>
                        </div>
                    </div>
                    @php $sl++;
                    @endphp
                @endforeach

                {{ $results->links('pagination::bootstrap-4') }}
            @else
            <div class="box box-mobile-form">
                <div class="alert alert-warning">
                    Không có kết quả
                </div>
            </div>
            @endif
        @endisset
</div>

</body>

</html>
<style>
    html, body {
        overflow-x: hidden;
    }
    body {
        position: relative
    }
    .margintop-5 {
        margin-top: 5px;
    }

    .marginbot-5 {
        margin-bottom: 5px;
    }

    .width-100 {
        width: 100%;
    }
    .guipakn-container{
        margin-top: 10px;
    }

    .box-mobile-form {
        margin-top: 10px;
        padding: 10px !important;
    }

    .box-mobile-form .col-sm-12, .box-mobile-form .col-sm-6 {
        padding: 0px !important;
    }

    .ds-pakn .pagination li>a:hover {
        cursor: pointer !important;
    }
    .ds-pakn .box.box-mobile-form {
        background-color: #fcf8e3 !important;
    }
    .ds-pakn a {
        color: white !important;
    }

    .nguoi-gui {
        color: #000000;
        font-weight: bold;
    }
    .dia-chi-pakn {

    }
    .vande-pakn {
        font-size: 16px;
        font-weight: bold;
        color: #1d6cbb;
        font-style: normal;
    }
</style>
<script type="text/javascript">
    var isValid = 1;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.laymaxacnhan').on('click', function () {
        $.ajax({
            type: 'POST',
            url: "{{ route('voyager.khao-sat.guiotp') }}",
            data: {
                sodienthoai: $('#sodienthoai').val()
            },
            success: function (data) {
                alert(data.message);
            }
        });
    });
    $("#fileDinhKem").on("change", function () {
        if ($(this)[0].files.length > 2) {
            $(this).val(null);
            alert("Chọn tối đa 2 file đính kèm");
        }
    });
    $('#fm').submit(function (e) {
        if (isValid == 1) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{ route('voyager.khao-sat.checkotp') }}",
                data: {
                    sodienthoai: $('#sodienthoai').val(),
                    maxacnhan: $('#maxacnhan').val()
                },
                success: function (data) {
                    console.log(data);
                    if (data.error_code === 0) {
                        isValid = 0;
                        $('#fm').submit();
                    } else {
                        var result = '';
                        if (Array.isArray(data.message)) {
                            var arr = jQuery.unique(data.message);
                            arr.forEach(function (element) {
                                result += '- ' + element + '\n';
                            });
                        } else {
                            result = data.message;
                        }
                        alert(result);
                    }
                }
            });
        }
    });
</script>
