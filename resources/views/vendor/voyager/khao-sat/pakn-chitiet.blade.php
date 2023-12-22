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

<div class="container-fluid pakn" style="min-height: 800px;">
    @csrf
    <div class="boxOne hidden-mobile marginbot-5">
        <div class="text-left h3 name-survey" style="width: 100%">
            Chi tiết phản ánh kiến nghị
        </div>
    </div>
    @php
        $doc = new DOMDocument();
    @endphp
    @if ($item != null && $item->is_public == App\Enums\TrangThaiCongKhaiPAKNEnum::CongKhai)
        <div class="box box-mobile-form" style="background-color: #fcf8e3;">
            <div class="row">
                <div class="col-sm-12">
                    <span class="span-vande">Vấn đề PAKN: </span><span class="vande-pakn" >{{$item->tieu_de}}</span>
                </div>
                <div class="col-sm-12">
                    <span class="span-nguoigui">Người gửi: </span><span class="nguoi-gui">{{$item->ten}}</span>
                </div>
                <div class="col-sm-12">
                    <span class="dia-chi-pakn">{{$item->dia_chi}}</span>
                </div>
                <div class="col-sm-12">
                    <span class="span-nguoigui">Nội dung chi tiết: </span>
                    @if ($item->noi_dung != null)
                        @php
                            $doc->loadHTML('<?xml encoding="utf-8" ?>'.$item->noi_dung);

                            echo $doc->saveHTML();
                        @endphp
                    @else
                        {{$item->noi_dung}}
                    @endif
                </div>
                @if ($item->files != null && $item->files->count() > 0)
                    <div class="col-sm-12">
                        <span class="span-nguoigui">Danh sách file đính kèm: </span>
                    </div>
                    @foreach($item->files as $file)
                        <div class="col-sm-12">
                            <a href="{{asset($file->file_path)}}">{{$file->file_name}}</a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="box box-mobile-form" style="background-color: #fcf8e3;">
            <div class="row">
                <div class="col-sm-12">
                    <span class="span-vande">Trả lời:</span>
                    <span class="vande-pakn">{!!html_entity_decode($item->tra_loi)!!}</span>
                </div>
            </div>
        </div>
    @else
        <div class="box box-mobile-form" style="background-color: #fcf8e3;">
            <div class="row">
                <div class="col-sm-12">
                    <span class="vande-pakn">Không có thông tin phản ánh kiến nghị</span>
                </div>
            </div>
        </div>
    @endif

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
