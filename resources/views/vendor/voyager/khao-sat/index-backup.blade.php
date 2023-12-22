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
<form class="container maxwidth" id="fm-khaosat" method="POST" action="#">
    @csrf
    <div class="box boxOne">
        <div class="backgroundSolid"></div>
        <label class="text-left h3">
            Phiếu khảo sát lấy ý kiến của người dân đối với công chức làm việc tại bộ phận tiếp nhận và trả kết quả
            Ủy ban nhân dân tỉnh Bắc Giang </label>
    </div>
    <div class="box">
        <p class="font-bold h4 text-red  ">
            Ý kiến của ông/bà có ý nghĩa rất quan trọng trong việc đánh giá đúng chất lượng phục vụ người dân tại bộ
            phận tiếp nhận và trả kết quả của ủy ban nhân dân các cấp. </p>
        <p class="font-italic h4">
            Xin ông/bà vui lòng cho biết ý kiến đánh giá của mình về một số nội dung dưới đây (thông tin của ông/bà
            cung cấp được bảo mật)
        </p>
    </div>
    <div class="box">
        <fieldset>
            @if ($donvi == null)
                <legend class="bold">Đơn vị <span class="text-danger"> * </span></legend>
                <div class="form-group">
                    <div>
                        <select id="donviId" class="form-control">
                            <option value="0" selected>Chọn đơn vị</option>
                            @foreach ($lsDonVis as $item)
                                <option value="{{$item->id}}">{{$item->ten_donvi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            <legend class="bold">1. Tìm hiểu thông tin, tiếp cận dịch vụ</legend>
            <div class="form-group single-question">
                <label class="cauhoi">1.1 Độ Tuổi </label>
                <div class="traloi" data-type="radio">
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.1" value="Dưới 25 tuổi">Dưới 25
                            tuổi</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.1" value="25-49 tuổi">25-49 tuổi</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.1" value="50-60 tuổi">50-60 tuổi</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.1" value="trên 60 tuổi">trên 60
                            tuổi</label>
                    </div>
                </div>

            </div>
            <div class="form-group single-question">
                <label class="cauhoi">1.2 Giới tính </label>
                <div class="traloi" data-type="radio">
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.2">Nam</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.2">Nữ</label>
                    </div>
                </div>
            </div>

            <div class="form-group single-question">
                <label class="cauhoi" id="question_1.3">1.3 Lĩnh vực giải quyết </label>
                <div class="traloi" data-type="radio">
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.3">Quản lý đất đai</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.3">Chứng thực</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.3">Hộ tịch</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.3">Người có công</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.3">Bảo trợ xã hội</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio1.3">Lĩnh vực khác</label>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="box">
        <div class="form-group single-question">
            <label class="cauhoi">2. Khi đi nộp hồ sơ, nhận kết quả giải quyết ông/bà thấy như thế nào về thời gian chờ
                đợi làm thủ tục?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio2">Rất nhanh gọn</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio2">Bình thường, thực hiện theo thứ
                        tự</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio2">Chờ đợi hơi lâu do công chức xử lý
                        chậm</label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" data-type="custom" name="optradio2" id="option2Khac">
                        <input type="text" class="input-line" name="optradio2" placeholder="Ý kiến khác"  id="option2YKienKhac"/>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="box">

        <div class="form-group single-question">
            <label class="cauhoi">3. Ông/bà nhận xét như thế nào về thái độ của công chức bộ phận một cửa khi giao
                tiếp?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio3">Rất lịch sự, thân thiện, dễ
                        gần</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio3">Giao tiếp bình thường</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio3">Thờ ơ, không thân thiện hoặc khó
                        chịu</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio3">Hách dịch, nhũng nhiễu</label>
                </div>
            </div>
        </div>

    </div>
    <div class="box">

        <div class="form-group single-question">
            <label class="cauhoi">4. Cách hướng dẫn của công chức bộ phận một cửa đối với ông/bà như thế nào?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio4">Hướng dẫn nhiệt tình, dễ
                        hiểu</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio4">Hướng dẫn bình thường, thực hiện
                        được</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio4">Hướng dẫn nhưng không rõ ràng, nhiệt
                        tình</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio4">Không hướng dẫn mà đề nghị tự tìm
                        hiểu lấy</label>
                </div>
            </div>
        </div>

    </div>
    <div class="box">

        <div class="form-group single-question">
            <label class="cauhoi">5. Ông/bà đánh giá như thế nào về mức độ thành thạo công việc của công chức bộ phận
                một
                cửa?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio5">Rất thành thạo, xử lý chuyên nghiệp</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio5">Thành thạo, xử lý bình
                        thường</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio5">Chưa thành thạo, còn lúng
                        túng</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio5">Xử lý công việc không thể chấp nhận
                        được</label>
                </div>
            </div>
        </div>

    </div>
    <div class="box">

        <div class="form-group single-question">
            <label class="cauhoi">6. Thời gian giải quyết hồ sơ của ông/bà như thế nào?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio6">Sớm hơn so với thời gian hẹn</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio6">Đúng ngày hẹn</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio6">Trễ hẹn, nhưng được thông báo lý do</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio6">Trễ hẹn, nhưng không được thông báo
                        lý do</label>
                </div>
            </div>
        </div>

    </div>
    <div class="box">

        <div class="form-group single-question">
            <label class="cauhoi">7. Trong quá trình giải quyết hồ sơ ông/bà có nội dung kiến nghị đối
                với cơ quan giải quyết thủ tục hành chính không?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio7">Không có kiến nghị gì</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio7">Có kiến nghị và được tiếp thu, sửa
                        đổi</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio7">Có kiến nghị, nhưng không được trả
                        lời kiến nghị</label>
                </div>
            </div>
        </div>

    </div>
    <div class="box">

        <div class="form-group single-question">
            <label class="cauhoi">8. Ông/bà vui lòng cho biết về mức độ hài lòng của mình
                đối với quá trình thực hiện giải quyết thủ tục hành chính?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio8">Rất hài lòng</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio8">Hài lòng</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio8">Bình thường</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio8">Không hài lòng</label>
                </div>
            </div>
        </div>

    </div>
    <div class="box">

        <div class="form-group single-question">
            <label class="cauhoi">9. Trong quá trình giải quyết hồ sơ, công chức có đề nghị hoặc gợi ý ông/bà
                trả thêm chi phí để được giải quyết nhanh và nhận kết quả sớm hơn quy định không?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio9">Có</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio9">Không</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-xs-6">
            @if ($sdt != null)
                <input type="hidden" class="form-control answer" id="sodienthoai" value="{{$sdt}}" disabled/>
            @else
                <label for="sodienthoai">Số điện thoại <span class="text-danger"> * </span></label>
                <input type="text" class="form-control answer" id="sodienthoai"/>
            @endif
        </div>
        @if (!auth()->check())
        <div class="col-md-2 col-xs-6">
            <a class="btn btn-info margintop-27 laymaxacnhan">Lấy mã xác nhận</a>
        </div>
        @endif
    </div>
    @if (!auth()->check())
        <div class="row margintop-5">
            <div class="col-md-4 col-xs-6">
                <label for="maxacnhan">Mã xác nhận <span class="text-danger"> * </span></label>
                <input type="text" class="form-control" id="maxacnhan"/>
            </div>
        </div>
    @endif

    <div class="row margintop-5">
        <div class="col-md-12 col-xs-12 margintop-5">
            <div class="alert alert-info">
                Trân trọng cảm ơn ông/bà!
            </div>
        </div>
    </div>

    <div class="row margintop-5">
        <div class="col-md-12 col-xs-12">
            <a class=" fullButton btn btn-primary" id="submit-khaosat">Gửi ý kiến</a>
        </div>
    </div>
    <hr/>
</form>

<div class="container maxwidth row margintop-5 hide thanh-cong">
    <div class="col-md-12 col-xs-12 margintop-5">
        <div class="alert alert-success">
            Trân trọng cảm ơn ông/bà đã tham gia khảo sát!
        </div>
    </div>
</div>

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
        if ($("#option2Khac").is(":checked") && ($("#option2YKienKhac").val() == '')) {
            alert('Xin vui lòng nhập ý kiến khác');
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
