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
        <div class="box tab">
            <div class="box boxOne">
                <div class="backgroundSolid"></div>
                <div >

                    @if ($donvi_obj != null)
                        <label class="h4">Khảo sát đánh giá công chức một cửa UBND @if ($donvi_obj != null) {{$donvi_obj[0]->ten_donvi}} @endif </label>
                    @else
                        <label class="h4">Khảo sát đánh giá công chức một cửa UBND các cấp</label>
                    @endif

                    <p class="font-italic h4">
                        Ý kiến của ông/bà có ý nghĩa rất quan trọng trong việc đánh giá đúng chất lượng phục vụ người dân tại bộ
                        phận tiếp nhận và trả kết quả của ủy ban nhân dân các cấp. </p>
                    <p class="font-italic h4">
                        Xin ông/bà vui lòng cho biết ý kiến đánh giá của mình về một số nội dung dưới đây (thông tin của ông/bà
                        cung cấp được bảo mật)
                    </p>
                </div>
            </div>
        </div>

        <fieldset>
        @if ($donvi == null)
            <div class="box tab">
                    <div id="boxdonvi">
                        <legend class="bold">Đơn vị </legend>
                        <div class="form-group" id="donviHuyen">
                            <div>
                                <label>Chọn huyện <span class="text-danger"> * </span></label>
                                <select id="donviIdHuyen" class="form-control" onchange="huyenCheck()">
                                    <option value="0" selected>Chọn huyện</option>
                                    @foreach ($lsDonVis as $item)
                                        <option value="{{$item->id}}">{{$item->ten_donvi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="donviXa" style="display:none">
                            <div>
                                <label>Chọn đơn vị<span class="text-danger"> * </span></label>
                                <select id="donviId" class="form-control">
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
        @else
            @if ($sdt == null)
                <div class="box tab">
                    <legend class="bold" >Nhập thông tin người khảo sát</legend>
                    <div id="box_sdt">
                        <label id="lbl_sdt">Số điện thoại</label>
                        <div class="form-group">
                            <label><input type="index" data-type="default" id="so_dien_thoai" name="so_dien_thoai"></label>
                        </div>
                    </div>
                    {{-- <div id="box_email">
                        <label id="lbl_email">Email</label>
                        <div class="form-group">
                            <label><input type="index" data-type="default"  id="email" name="email"></label>
                        </div>
                    </div> --}}
                </div>
            @endif
        @endif

        <div class="box tab">
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
        </div>
        <div class="box tab">
            <div class="form-group single-question">
                <label class="cauhoi" id="question2">2: Lĩnh vực thủ tục hành chính đã giải quyết</label>
                <div class="traloi" data-type="radio">
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio2">Quản lý đất đai</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio2">Chứng thực</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio2">Hộ tịch</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio2">Người có công</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio2">Bảo trợ xã hội</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" data-type="default" name="optradio2">Lĩnh vực khác</label>
                    </div>
                </div>
            </div>
        </div>
        </fieldset>

    <div class="box tab">
        <div class="form-group single-question">
            <label class="cauhoi">3: Ông/bà thấy như thế nào về thời gian chờ đợi, xếp hàng ở Bộ phận một cửa?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" onclick="javascript:optradio3Check();" data-type="default" name="optradio3">Nhanh gọn</label>
                </div>
                <div class="radio">
                    <label><input type="radio" onclick="javascript:optradio3Check();" data-type="default" name="optradio3">Bình thường, thực hiện theo thứ
                        tự</label>
                </div>
                <div class="radio">
                    <label><input type="radio" onclick="javascript:optradio3Check();" id="ratlauCheck" data-type="default" name="optradio3">Chờ đợi rất lâu</label>
                </div>
            </div>
        </div>
        <div class="form-group single-question" id="if_optradio3" style="display:none">
            <label class="cauhoi">3.1: Theo ông/bà, thời gian chờ đợi, xếp hàng rất lâu là vì lý do nào?</label>
            <div class="traloi" data-type="checkbox">
                <div class="checkbox">
                    <input type="checkbox" data-type="default" name="checkbox3.1.1"><label>Số lượng người dân làm thủ tục quá đông</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" data-type="default" name="checkbox3.1.2"><label>Công chức xử lý chậm</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" data-type="default" name="checkbox3.1.3"><label>Thủ tục rườm rà, không cần thiết chậm</label>
                </div>
            </div>
        </div>
    </div>
    <div class="box tab">

        <div class="form-group single-question">
            <label class="cauhoi">4: Ông/bà nhận xét như thế nào về thái độ của công chức bộ phận một cửa?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio4">Lịch sự, thân thiện</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio4">Bình thường</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio4">Thờ ơ, không thân thiện, hách dịch</label>
                </div>
            </div>
        </div>

    </div>
    <div class="box tab">

        <div class="form-group single-question">
            <label class="cauhoi">5: Cách hướng dẫn của công chức bộ phận một cửa đối với ông/bà như thế nào?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio5">Nhiệt tình, hướng dẫn dễ hiểu</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio5">Bình thường, thực hiện được</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio5">Hướng dẫn qua loa, không rõ ràng</label>
                </div>
            </div>
        </div>

    </div>
    <div class="box tab">

        <div class="form-group single-question">
            <label class="cauhoi">6: Ông/bà đánh giá như thế nào về kỹ năng xử lý công việc của công chức bộ phận một cửa?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio6">Thành thạo, chuyên nghiệp</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio6">Bình thường, chấp nhận được</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio6">Chưa thành thạo, còn lúng túng</label>
                </div>
            </div>
        </div>

    </div>
    <div class="box tab">

        <div class="form-group single-question">
            <label class="cauhoi">7: Thời gian giải quyết hồ sơ gần đây nhất của ông/bà như thế nào?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" onclick="javascript:optradio7Check();" id="somhenCheck" data-type="default" name="optradio7">Sớm hơn so với thời gian hẹn</label>
                </div>
                <div class="radio">
                    <label><input type="radio" onclick="javascript:optradio7Check();" id="dunghenCheck" data-type="default" name="optradio7">Đúng hẹn</label>
                </div>
                <div class="radio">
                    <label><input type="radio" onclick="javascript:optradio7Check();" id="trehenCheck" data-type="default" name="optradio7">Trễ hẹn</label>
                </div>
            </div>
        </div>


        <div class="form-group single-question" id="if_optradio7" style="display:none">
            <label class="cauhoi">7.1: Khi hồ sơ của ông/bà trễ hẹn có được thông báo không?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio7.1.1">Có</label>
                </div>
                <div class="radio">
                    <label><input type="radio" data-type="default" name="optradio7.1.1">Không</label>
                </div>
            </div>
        </div>


    </div>
    <div class="box tab">
        <div class="form-group single-question">
            <label class="cauhoi">8: Trong quá trình giải quyết hồ sơ ông/bà có nhận được lời đề nghị hoặc gợi ý trả thêm chi phí để được giải quyết nhanh và nhận được kết quả sớm hơn quy định không?</label>
            <div class="traloi" data-type="radio">
                <div class="radio">
                    <label><input type="radio" onclick="javascript:optradio8Check();" id="coCheck" data-type="default" name="optradio8">Có</label>
                </div>
                <div class="radio">
                    <label><input type="radio" onclick="javascript:optradio8Check();" data-type="default" name="optradio8">Không</label>
                </div>
            </div>
        </div>

        <div class="form-group single-question" id="if_optradio8" style="display:none">
            <label class="cauhoi">8.1: Ông/bà được gợi ý trả thêm chi phí thực hiện thủ tục hành chính ở lĩnh vực nào?</label>
            <div class="traloi" data-type="checkbox">
                <div class="checkbox">
                    <input type="checkbox" data-type="default" name="checkbox8.1.1">
                    <label>Quản lý đất đai</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" data-type="default" name="checkbox8.1.2">
                    <label>Hộ tịch</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" data-type="default" name="checkbox8.1.3">
                    <label>Bảo trợ xã hội</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" data-type="default" name="checkbox8.1.4">
                    <label>Chứng thực</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" data-type="default" name="checkbox8.1.5">
                    <label>Người có công</label>
                </div>
                <div class="checkbox">
                    <input type="checkbox" data-type="custom" name="checkbox8.1.6" id="checkbox8.1.6">
                    <label>
                        Lĩnh vực khác:
                        <input type="text" class="input-line" name="checkboxother" placeholder="......."  id="checkboxother"/>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="box tab" style="padding: 30px 20px;">
        {{-- <div class="row">
            <div class="col-md-4 col-xs-6">
                    <label for="sodienthoai">Số điện thoại <span class="text-danger"> * </span></label>
                    <input type="text" class="form-control answer" id="sodienthoai" value="{{ $sodienthoai ?? '' }}" />
            </div>
            <div class="col-md-2 col-xs-6">
                <a class="btn btn-info margintop-27 laymaxacnhan">Lấy mã xác nhận</a>
            </div>
        </div>
            <div class="row margintop-5">
                <div class="col-md-4 col-xs-6">
                    <label for="maxacnhan">Mã xác nhận <span class="text-danger"> * </span></label>
                    <input type="text" class="form-control" id="maxacnhan"/>
                </div>
            </div> --}}

        <div class="row margintop-5" >
            <div class="col-md-12 col-xs-12 margintop-5">
                <div>
                    Xin mời ấn "Gửi ý kiến" để hoàn thành khảo sát!
                </div>
            </div>
        </div>

        <div class="row margintop-5">
            <div class="col-md-12 col-xs-12">
                <a class=" fullButton btn btn-primary" id="submit-khaosat">Gửi ý kiến</a>
            </div>
        </div>
    </div>

    <div style="overflow:auto;padding-top: 10px;">
        <div style="float:right;">
            <button type="button" class="btn btn-warning" id="prevBtn" onclick="nextPrev(-1)">Lùi lại</button>
            <button type="button" class="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Tiếp tục</button>
        </div>
    </div>

    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
        <span class="step"></span>
        @if ($donvi == null)
            <span class="step"></span>
        @else
            @if($sdt == null)
                <span class="step"></span>
            @endif
        @endif
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
    <hr/>
</form>

<div class="container maxwidth row margintop-5 hide thanh-cong">
    <div class="col-md-12 col-xs-12 margintop-5 thanh-cong-div">
        <div class="alert alert-success">
            @if ($donvi_obj != null)
                <label class="h4">Trân trọng cảm ơn bạn đã tham gia khảo sát đánh giá công chức một cửa UBND @if ($donvi_obj != null) {{$donvi_obj[0]->ten_donvi}} @endif </label>
            @else
                <label class="h4">Trân trọng cảm ơn bạn đã tham gia khảo sát đánh giá công chức một cửa UBND các cấp</label>
            @endif
        </div>
    </div>
</div>

</body>

</html>


<style>
.thanh-cong{
    height: 400px;
    position: relative;
    padding-right:0px !important;
    padding-left:0px !important;
}

.thanh-cong-div{
    position: absolute;
    top: 50%;
}
</style>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    var donviParam = '<?php echo $donvi; ?>';

    var sdtParam = '<?php echo $sdt; ?>';

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
            so_dien_thoai: $('#so_dien_thoai').val(),
            email: $('#email').val(),
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
<script>

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
    document.getElementById("nextBtn").style.display = "inline";
  }

  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").style.display = "none";
  } else {
    document.getElementById("nextBtn").innerHTML = "Tiếp tục";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}



function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:

  console.log("currentTab=="+currentTab);
  if (n == 1 && !validateForm() && currentTab !=0) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;


  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("nextBtn").style.display = "none";
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields

  console.log("donviParam="+donviParam );

  var x, y,z, i,j, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByClassName("single-question");
  //console.log("y.length=="+y.length );

  var validFalse = [];
  for (j = 0; j < y.length; j++) {
    console.log("j=="+j );
    z = y[j].getElementsByTagName("input");

    //var getSelectedValue = document.querySelector('input:checked');
    // A loop that checks every input field in the current tab:
    var questionRadio = [];
    var questionCheckbox = [];
    var numberRadio = [];
    var numberCheckbox = [];
    for (i = 0; i < z.length; i++) {
        console.log("-----i=="+i );

        if (z[i].type == "radio") {
            numberRadio.push(z[i]);
            if (z[i].checked) {
                questionRadio.push(z[i]);
            }
        }
        if((document.getElementById('somhenCheck').checked||document.getElementById('dunghenCheck').checked) && j==1) {
            questionRadio.push(z[i]);
        }

        if (z[i].type == "checkbox") {
            numberCheckbox.push(z[i]);
            if (z[i].checked) {
                questionCheckbox.push(z[i]);
            }
        }
    }
    y[j].classList.remove("invalid");


    //document.getElementById('trehenCheck').checked
    console.log("-----numberRadio.length=="+numberRadio.length);
    console.log("-----questionRadio.length=="+questionRadio.length);
    console.log("-----numberCheckbox.length =="+numberCheckbox.length);
    console.log("-----questionCheckbox.length =="+questionCheckbox.length);

        // If a field is empty...
    if ((numberRadio.length > 0 && questionRadio.length < 1)
    || (document.getElementById('ratlauCheck').checked && numberCheckbox.length > 0 && questionCheckbox.length == 0)
    || (document.getElementById('coCheck').checked && numberCheckbox.length > 0 && questionCheckbox.length == 0)
    ) {
         //console.log("-----invalid-----------");
            // add an "invalid" class to the field:
            y[j].className += " invalid";
            // and set the current valid status to false:
            validFalse.push(y[j]);
    }


  }

  if(validFalse.length > 0){
        valid = false;
  }

  if(donviParam === undefined || donviParam == null || donviParam.length <= 0){
    var donvi = document.getElementById("donviId");
    var boxdonvi = document.getElementById("boxdonvi");
    boxdonvi.classList.remove("donviinvalid");
    console.log("donvi="+donvi.value );
    if(donvi.value==0){
        boxdonvi.className += "donviinvalid";
        valid = false;
    }
  }else {
    if(sdtParam === undefined || sdtParam == null || sdtParam.length <= 0){
        var so_dien_thoai = document.getElementById("so_dien_thoai").value;
        //var email= document.getElementById("email").value;

        box_sdt.classList.remove("sdt_invalid");
        //box_email.classList.remove("email_invalid");

        var phone_regex = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;
        //var email_regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        console.log("so_dien_thoai="+so_dien_thoai);
        //console.log("email="+email);

        if(!so_dien_thoai.match(phone_regex)){
            box_sdt.className += "sdt_invalid";
            valid = false;
        }

        if(currentTab == 0){
            box_sdt.classList.remove("sdt_invalid");
        }

        // if(!email.match(email_regex)){
        //     box_email.className += "email_invalid";
        //     valid = false;
        // }
    }
  }

    // if(document.getElementById('trehenCheck').checked == false && validFalse.length > 0){
    //     valid = true;
    // }


  //console.log("valid="+valid );
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>

<script type="text/javascript">

function huyenCheck() {
    var donviIdHuyen  = document.getElementById('donviIdHuyen').value;

    console.log("donviIdHuyen==="+donviIdHuyen);

    if (document.getElementById('donviIdHuyen').value != 0) {

        var idHuyen = document.getElementById('donviIdHuyen').value;
        document.getElementById('donviXa').style.display = 'block';

        $.ajax({
            type: 'post',
            url: '/pakn/khao-sat/don-vi',
            data: {
                idHuyen: idHuyen,
            },
            success: function(response) {
                //console.log("response.data"+response.data);

                var $select = $('#donviId');
                $select.find('option').remove();

                $donviIdHuyenText  = "Bộ phận 1 cửa " + $("#donviIdHuyen option:selected").text();

                $select.append('<option value=' + donviIdHuyen + '>' + $donviIdHuyenText  + '</option>');
                $.each (response.data, function (i) {
                    $select.append('<option value=' + response.data[i].id + '>' + response.data[i].ten_donvi + '</option>'); // return empty
                });
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
    }
    else {
        document.getElementById('donviXa').style.display = 'none';
    }
}

function optradio3Check() {
    if (document.getElementById('ratlauCheck').checked) {
        document.getElementById('if_optradio3').style.display = 'block';
    }
    else {
        document.getElementById('if_optradio3').style.display = 'none';
        document.querySelector('input[name="checkbox3.1.1"]').checked = false;
        document.querySelector('input[name="checkbox3.1.2"]').checked = false;
        document.querySelector('input[name="checkbox3.1.3"]').checked = false;
    }
}


function optradio7Check() {
    if (document.getElementById('trehenCheck').checked) {
        document.getElementById('if_optradio7').style.display = 'block';
    }
    else {
        document.getElementById('if_optradio7').style.display = 'none';
        document.querySelector('input[name="optradio7.1.1"]').checked = false;
    }
}

function optradio8Check() {
    if (document.getElementById('coCheck').checked) {
        document.getElementById('if_optradio8').style.display = 'block';
    }
    else {
        document.getElementById('if_optradio8').style.display = 'none';
        document.querySelector('input[name="checkbox8.1.1"]').checked = false;
        document.querySelector('input[name="checkbox8.1.2"]').checked = false;
        document.querySelector('input[name="checkbox8.1.3"]').checked = false;
        document.querySelector('input[name="checkbox8.1.4"]').checked = false;
        document.querySelector('input[name="checkbox8.1.5"]').checked = false;
        document.querySelector('input[name="checkbox8.1.6"]').checked = false;
    }
}

</script>


<style>

.donviinvalid select{
    background: #e5bdbd;
}

.donviinvalid legend::after{
    content: " *Chưa chọn đơn vị";
    color: red;
    font-style: italic;
    font-size: 14px;
}

.sdt_invalid  #lbl_sdt::after{
    content: " *Chưa nhập Số điện thoại theo đúng định dạng";
    color: red;
    font-style: italic;
    font-size: 14px;
}

.sdt_invalid input{
    background: #e5bdbd;
}

.email_invalid #lbl_email::after{
    content: " *Chưa Email theo đúng định dạng";
    color: red;
    font-style: italic;
    font-size: 14px;
}

.email_invalid input{
    background: #e5bdbd;
}

.invalid .traloi label{
    color: red;
}

.invalid .cauhoi::after{
    content: " *Chưa chọn câu trả lời";
    color: red;
    font-style: italic;
    font-size: 14px;
}
/* Hide all steps by default: */
.tab {
  display: none;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
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

    #fm-khaosat {
        margin-top: 15px;
    }

    .tab .checkbox label{
        padding-left: 0px !important;
    }

    .tab .checkbox{
        margin-left: 20px;
    }

</style>


