<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Khảo Sát</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Css custom -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}"/>

    <style>
        body {
            font-family: 'Nunito';
            font-size: 16px;
            overflow-x: hidden;
        }
    </style>
</head>

<body class="antialiased">
<form class="container maxwidth" id="fm-khaosat" class="xemlai-ks" method="POST" action="#">
    @csrf
    @php
        $tenKS = null;
        $uuid = null;
        $donvi = null;
    @endphp
    @if (count($lsKetQuas) > 0)
        @foreach($lsKetQuas as $khaosat) 
            @if ($tenKS == null)
                <div class="box boxOne">
                    <div class="backgroundSolid"></div>
                    <label class="text-left h3">
                        {{$khaosat->ten_khaosat}}</label>
                </div>
                @php
                    $tenKS = $khaosat->ten_khaosat;
                @endphp
            @endif
            @if ($donvi != $khaosat->donvi_id)
                <div class="box boxOne">
                    <div class="backgroundSolid"></div>
                    <label class="text-left h3">
                        {{$khaosat->ten_donvi}}</label>
                </div>
                @php
                    $donvi = $khaosat->donvi_id;
                @endphp
            @endif
            @if ($uuid != $khaosat->uuid)
                <div class="border-top-dash"></div>
                @php
                    $uuid = $khaosat->uuid;
                @endphp
            @endif
            <div class="box">
                <fieldset>
                    <div class="form-group single-question">
                        <label class="cauhoi">{{$khaosat->cau_hoi}}</label>
                        <div class="traloi" style="color: #3a52ff !important;">
                            <label>{{$khaosat->cau_tra_loi}}</label>
                        </div>
                    </div>
                </fieldset>
            </div>
        @endforeach   
    @else
        <span>Không tìm thấy kết quả khảo sát</span>
    @endif
    

    <hr/>
</form>
</body>

</html>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    var donviParam = '<?php echo $donvi; ?>';
    $("#fm-khaosat").submit(function(e){
        e.preventDefault();
    });

    $('#submit-khaosat').on('click', function () {
        var donviId = donviParam && donviParam > 0 ? donviParam : $('#donviId').val();
        if (!donviId || donviId <= 0) {
            alert('Xin vui lòng chọn đơn vị');
            return;
        }
        var cauhoiArr = [];
        $('.single-question').each(function () {
            var cauhoi = $(this).find(".cauhoi").text().replace(/\n/g, '').replace(/\s\s+/g, ' ');

            var traloiInput = $(this).find("input[type='radio']:checked");

            var traloi = traloiInput.parent().text().replace(/\n/g, '').replace(/\s\s+/g, ' ');

            if (traloiInput.attr('data-type') == 'custom') {
                traloi = traloiInput.parent().find("input[type='text']").val();
            }

            var obj = {};
            obj['cauhoi'] = cauhoi;
            obj['traloi'] = traloi;

            cauhoiArr.push(obj);
        });


        var data = {
            sodienthoai: $('#sodienthoai').val(),
            maxacnhan: $('#maxacnhan').val(),
            donvi: donviId,
            cauhois: cauhoiArr
        };

        $.ajax({
            type: 'POST',
            url: "{{ route('voyager.khao-sat.guikhaosat') }}",
            data: data,
            success: function (data) {
                if (data.error_code != 0) {
                    var result = '';
                    if (Array.isArray(data.message)){
                        var arr = jQuery.unique(data.message);
                        arr.forEach(function (element) {
                            result += '- ' + element + '\n';
                        });
                    }else{
                        result = data.message;
                    }
                    alert(result);
                }else{
                    $('form').hide();
                    $('.thanh-cong').removeClass('hide');
                }
            }
        });
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

    $("input[type='text']").focus(function () {
        $(this).parent().children("input[type='radio']").prop("checked", true);
    });

    function unique(list) {
        var result = [];
        $.each(list, function(i, e) {
            if ($.inArray(e, result) == -1) result.push(e);
        });
        return result;
    }
</script>

<style>
    legend {
        margin-bottom: 15px;
    }

    .input-line {
        border: 0;
        border-bottom: 1px solid silver;
    }

    .margintop-25 {
        margin-top: 25px;
    }

    .margintop-5 {
        margin-top: 5px;
    }

    .margintop-27 {
        margin-top: 27px;
    }

    .bold {
        font-weight: bold;
    }

    .alert-info {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
</style>
