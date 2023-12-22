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

    <script src="https://cdn.tiny.cloud/1/atib60alfdxxxraj7a1jnon8c1p21r9yi7rg40lwhlbck70g/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
    <!-- Css custom -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}"/>
    <script>
        tinymce.init({
            selector: '#noi_dung',
            entity_encoding: "raw"
        });
    </script>
</head>


<body>

<div class="container-fluid pakn" style="min-height: 800px;">
    <form class="maxwidth" id="fm" method="POST" enctype="multipart/form-data"
          action="{{ route('pakn.tiepnhan.nguoidan') }}">
        @csrf
        <div class="boxOne hidden-mobile">
            <div class="text-left h3 name-survey" style="width: 100%">
                Phiếu tiếp nhận <br/> Phản ánh kiến nghị
            </div>
        </div>

        @if ($message != '')
            <div class="alert alert-success">
                {{$message}}
            </div>
        @endif
        @if ($message == '')
            <div class="box box-mobile-form">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4 hidden-mobile">
                        <label class="">Họ tên<span class="text-red"> *</span> </label>
                    </div>
                    <div class="col-sm-8">
                        <input class="input-full form-control" type="text" readonly name="ho_ten" id="ho_ten" value="{{ auth()->user()->name ?? '' }}"

                               onfocusout="KiemTraHoTen()" required>
                        <span id="validate_hoten" class="text-red"></span>
                    </div>
                </div>

                <div class="col-sm-12 form-group">

                    <div class="col-sm-4 hidden-mobile">
                        <label class="">Số điện thoại<span class="text-red"> *</span> </label>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control answer" id="sodienthoai" readonly name="sodienthoai" value="{{ auth()->user()->username ?? '' }}"/>
                    </div>

                    {{-- <div class="col-sm-12">
                        <a class="btn btn-info margintop-5 laymaxacnhan width-100" id="laymaxacnhan">Lấy mã xác
                            nhận</a>
                    </div>--}}

                </div>

                <div class="col-sm-12 form-group">
                    <div class="col-sm-4 hidden-mobile">
                        <label class="">Email</label>
                    </div>
                    <div class="col-sm-8">
                        <input class="input-full form-control" type="text" name="email" id="email" value="{{ auth()->user()->email ?? '' }}"

                               onfocusout="KiemTraEmail()">
                        <span id="validate_email" class="text-red"></span>
                    </div>
                </div>
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4 hidden-mobile">
                        <label class="" for="dia_chi">Địa chỉ</label>
                    </div>
                    <div class="col-sm-8">
                        <input class="input-full form-control" type="text" readonly name="dia_chi" id="dia_chi" value="{{ auth()->user()->dia_chi ?? '' }}"

                        >
                    </div>
                </div>
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4 hidden-mobile">
                        <label class="">Phản ánh kiến nghị về việc<span class="text-red"> *</span> </label>
                    </div>
                    <div class="col-sm-8">
                        <input class="input-full form-control" type="text" name="pakn_ve_viec" id="pakn_ve_viec"
                               value=""
                                onfocusout="KiemTraPAKNVeViec()" required>
                        <span id="validate_paknvevice" class="text-red"></span>
                    </div>
                </div>
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4 hidden-mobile">
                        <label class="">Nội dung<span class="text-red"> *</span> </label>
                    </div>
                    <div class="col-sm-8">
                            <textarea rows="10" class="noi-dung form-control" name="noi_dung" id="noi_dung"
                                      placeholder="Nội dung"></textarea>
                    </div>
                </div>
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4 hidden-mobile">
                        <label for="fileDinhKem">File đính kèm <span style="font-size: 0.7em;color: #d9570a;"> Chấp nhận định dạng ảnh và video </span></label>
                    </div>
                    <div class="col-sm-8">
                        <input type="file" name="fileDinhKem[]" id="fileDinhKem" accept="image/*,video/*" multiple>
                    </div>
                </div>
                {{-- <div class="" style="text-align: center;">
                    <label>.</label>
                </div> --}}

                {{-- <div class="col-sm-12 form-group">
                    <div class="col-sm-12">
                        <label for="maxacnhan">Mã xác nhận <span class="text-danger"> * </span></label>
                        <input type="text" class="form-control " id="maxacnhan"/>
                    </div>
                </div> --}}

            </div>
            <button type="submit" class="fullButton btn btn-primary" id="btn_tiepnhan">Gửi phản ánh</button>

        @endif

    </form>
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
    span.tox-statusbar__branding{
        display: none!important;
    }
    .margintop-5 {
        margin-top: 5px;
    }

    .width-100 {
        width: 100%;
    }
</style>
<script type="text/javascript">
    var isValid = 1;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $('.laymaxacnhan').on('click', function () {
    //     $.ajax({
    //         type: 'POST',
    //         url: "{{ route('voyager.khao-sat.guiotp') }}",
    //         data: {
    //             sodienthoai: $('#sodienthoai').val()
    //         },
    //         success: function (data) {
    //             alert(data.message);
    //         }
    //     });
    // });
    $("#fileDinhKem").on("change", function () {
        if ($(this)[0].files.length > 2) {
            $(this).val(null);
            alert("Chọn tối đa 2 file đính kèm");
        }
    });
    $('#fm').submit(function (e) {
        var message = '';
        var editorContent = tinymce.activeEditor.getContent();

        if (editorContent == '' || editorContent == null) {
            message = '- Vui lòng nhập nội dung \n';
            alert(message);
        } else {
            $('#noi_dung').text(editorContent);
            isValid = 0;
        }

        if (isValid == 0){
            $('#fm').submit();
        }else{
            e.preventDefault();
        }

        // if (isValid == 1) {
        //     e.preventDefault();
        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ route('voyager.khao-sat.checkotp') }}",
        //         data: {
        //             sodienthoai: $('#sodienthoai').val(),
        //             maxacnhan: $('#maxacnhan').val()
        //         },
        //         success: function (data) {
        //             if (data.error_code === 0 && message == '') {
        //                 isValid = 0;
        //                 $('#fm').submit();
        //             } else {
        //                 if (Array.isArray(data.message)) {
        //                     var arr = jQuery.unique(data.message);
        //                     arr.forEach(function (element) {
        //                         message += '- ' + element + '\n';
        //                     });
        //                 } else {
        //                     message = data.message;
        //                 }
        //                 alert(message);
        //             }
        //         }
        //     });
        // }

    });
</script>
<script>
    var C_hoten = false;
    var C_matinh = true;
    var C_mahuyen = false;
    var C_maxa = false;
    var C_sodienthoai = false;
    var C_email = true;
    var C_paknveviec = false;
    var C_noidung = false;
    var message = '{{$message}}';

    if (message == '') {
        $(document).ready(function () {
            initValidate();
            // initSelectTinh();
            // initSelectHuyen();
            // initSelectXa();
            // getDisable();

            $('#matinh').on('select2:close', function (e) {
                var x = document.getElementById("matinh");
                var y = document.getElementById("validate_tinh");
                if (x.value != '') {
                    y.innerHTML = "";
                    $("#validate_tinh").hide();
                    C_matinh = true;
                } else {
                    y.innerHTML = "Tỉnh không được để trống";
                    $("#validate_tinh").show();
                    C_matinh = false;
                }
                $("#mahuyen").val('').trigger('change');
                $("#maxa").val('').trigger('change');
            });

            $('#mahuyen').on('select2:close', function (e) {
                var x = document.getElementById("mahuyen");
                var y = document.getElementById("validate_huyen");
                if (x.value != '') {
                    y.innerHTML = "";
                    $("#validate_huyen").hide();
                    C_mahuyen = true;
                } else {
                    y.innerHTML = "Huyện không được để trống";
                    $("#validate_huyen").show();
                    C_mahuyen = false;
                }
                $("#maxa").val('').trigger('change');
            });

            $('#maxa').on('select2:close', function (e) {
                var x = document.getElementById("maxa");
                var y = document.getElementById("validate_phuongxa");
                if (x.value != '') {
                    y.innerHTML = "";
                    $("#validate_phuongxa").hide();
                    C_maxa = true;
                } else {
                    y.innerHTML = "Phường xã không được để trống";
                    $("#validate_phuongxa").show();
                    C_maxa = false;
                }
            });
        });
    }


    function getDisable() {
        if (C_hoten == true && C_matinh == true && C_mahuyen == true && C_maxa == true && C_sodienthoai == true &&
            C_email == true && C_paknveviec == true && C_noidung == true) {
            document.getElementById('btn_tiepnhan').disabled = false;
        } else {
            document.getElementById('btn_tiepnhan').disabled = false;
        }
    }

    function initValidate() {
        $("#validate_hoten").hide();
        $("#validate_tinh").hide();
        $("#validate_huyen").hide();
        $("#validate_phuongxa").hide();
        $("#validate_sodienthoai").hide();
        $("#validate_email").hide();
        $("#validate_paknvevice").hide();
        $("#validate_noidung").hide();
    }

    function initSelectTinh() {
        $('#matinh').select2({
            placeholder: "Tỉnh"
        });
    }

    function initSelectHuyen() {
        $('#mahuyen').select2({
            placeholder: "Huyện",
            language: {
                noResults: function () {
                    return "Không tìm thấy kết quả nào";
                },
                searching: function () {
                    return "Đang tìm kiếm ...";
                }
            },
            ajax: {
                url: '{{ route('voyager.danhsach.dmhuyen') }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term),
                        id_tinh: $('#matinh').val(),
                        "_token": "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
        });
    }

    function initSelectXa() {
        $('#maxa').select2({
            placeholder: "Xã - Phường",
            language: {
                noResults: function () {
                    return "Không tìm thấy kết quả nào";
                },
                searching: function () {
                    return "Đang tìm kiếm ...";
                }
            },
            ajax: {
                url: '{{ route('voyager.danhsach.dmphuongxa') }}',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term),
                        id_huyen: $('#mahuyen').val(),
                        "_token": "{{ csrf_token() }}"
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
        });
    }

    //-------------------------------------------------------------------------------------------------------------

    function KiemTraHoTen() {
        var format = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
        var x = document.getElementById("ho_ten");
        var y = document.getElementById("validate_hoten");
        var removeBank = x.value.split(' ').join('');
        var checkSpecialCharacter = format.test(removeBank);
        if (removeBank == null || removeBank == "") {
            y.innerHTML = "Họ tên không được để trống";
            $("#validate_hoten").show();
            C_hoten = false;
        } else if (removeBank.length < 6) {
            y.innerHTML = "Họ tên tối thiểu phải trên 6 ký tự.";
            $("#validate_hoten").show();
            C_hoten = false;
        } else if (checkSpecialCharacter == true) {
            y.innerHTML = "Họ tên không được có ký tự đặc biệt.";
            $("#validate_hoten").show();
            C_hoten = false;
        } else {
            y.innerHTML = "";
            $("#validate_hoten").hide();
            C_hoten = true;
        }

        getDisable();
    }

    function KiemTraSoDienThoai() {
        var format = /((09|03|07|08|05)+([0-9]{8})\b)/g;
        var x = document.getElementById("so_dien_thoai");
        var y = document.getElementById("validate_sodienthoai");
        var removeBank = x.value.split(' ').join('');
        if (removeBank !== '') {
            if (format.test(removeBank) == false) {
                y.innerHTML = "Số điện thoại của bạn không đúng định dạng!";
                $("#validate_sodienthoai").show();
                C_sodienthoai = false;
            } else {
                y.innerHTML = "Số điện thoại của bạn hợp lệ!";
                $("#validate_sodienthoai").hide();
                C_sodienthoai = true;
            }
        } else {
            y.innerHTML = "Bạn chưa điền số điện thoại!";
            $("#validate_sodienthoai").show();
            C_sodienthoai = false;
        }

        getDisable();
    }

    function KiemTraEmail() {
        var format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var x = document.getElementById("email");
        var y = document.getElementById("validate_email");
        var removeBank = x.value.split(' ').join('');
        if (removeBank !== '') {
            if (format.test(removeBank) == false) {
                y.innerHTML = "Email không đúng định dạng!";
                $("#validate_email").show();
                C_email = false;
            } else {
                y.innerHTML = "Email của bạn hợp lệ!";
                $("#validate_email").hide();
                C_email = true;
            }
        } else {
            y.innerHTML = "";
            $("#validate_email").hide();
            C_email = true;
        }

        getDisable();
    }

    function KiemTraPAKNVeViec() {
        var x = document.getElementById("pakn_ve_viec");
        var y = document.getElementById("validate_paknvevice");
        var removeBank = x.value.split(' ').join('');
        if (removeBank !== '') {
            y.innerHTML = "";
            $("#validate_paknvevice").hide();
            C_paknveviec = true;
        } else {
            y.innerHTML = "PAKN về việc không được để trống";
            $("#validate_paknvevice").show();
            C_paknveviec = false;
        }

        getDisable();
    }


</script>
