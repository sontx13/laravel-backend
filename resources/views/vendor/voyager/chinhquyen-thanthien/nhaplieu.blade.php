<!DOCTYPE html>
@extends('voyager::master')
@section('css')
    <link rel="stylesheet" href="/css/style.css">

    <style>
        .card-baocao .col-logo {
            margin-top: 10px;
            text-align: center;
        }

        .logo {
            position: absolute;
            right: 1.5em;
        }

        .card-baocao hr {
            border-top: 1px solid #1f4091;
        }

        .card-baocao .title {
            font-weight: bold;
            font-family: Arial;
            color: #134895;
        }

        .card-baocao #boxdonvi {
            padding: 15px;
        }

        .card-baocao .bold {
            font-weight: bold;
        }

        .card-baocao #boxdonvi,
        #ketqua_congkhai {
            padding: 15px 10px;
        }

        .card-baocao #boxdonvi ul {
            width: 100%;
            margin: 0;
        }

        .card-baocao #boxdonvi ul li {
            margin-bottom: 5px;
            font-weight: bold;
            font-family: Arial;
            margin-top: 5px;
            font-size: 16px;
            list-style-type: none;
            width: 25%;
            float: left;
            padding-left: 15px;
        }

        .card-baocao #boxdonvi ul li a {
            color: #000;
        }

        .card-baocao #boxdonvi .tilte-huyen,
        #boxdonvi .tilte-xa,
        #ketqua_congkhai .tilte-ketqua {
        }

        .card-baocao .tintieubieu {
            height: 175px;

        }

        .card-baocao .tintieubieu .portlet-title {
            font-weight: bold;
            font-family: Arial;
            color: #1d6cbb;
            border-bottom: 1px solid #1d6cbb;
        }

        .card-baocao .tintieubieu li {
            text-align: justify;
            border-bottom: 1px dotted #8c8c8c;
            padding: 5px 5px 5px 15px;
            line-height: 20px;
            list-style-type: none;
            background: url(https://qcdc.bacgiang.gov.vn/HiepHoi-DoanhNghiep-theme/theme-images/bullet-news.png) no-repeat center left;
        }

        .card-baocao .tintieubieu li:last-child {
            border: 0px !important;
        }

        .card-baocao .tintieubieu li a {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .card-baocao .margin-30 {
            margin-top: 30px;
        }

        .card-baocao .center {
            text-align: center;
        }

        .card-baocao {
            margin-left: 25px;
            padding: 15px;
        }

        .normal-row {
            text-align: left;
            font-weight: normal;
            vertical-align: middle !important;
        }

        .title-row {
            vertical-align: middle !important;
        }

        .custom-file-upload {
            padding: 2px 9px !important;
            float: left;
        }

        .currentfile {
            margin-left: 5.5em;
        }

        .icon-delete {
            font-size: 13px;
        }

        .select2-container {
            border: 1px solid;
        }

        .diem-tucham {
            text-align: center;
        }
    </style>

@stop
@section('page_title', 'Nhập liệu báo cáo')

@section('page_header')
    <div class="card card-baocao header">
        <div class="row tilte-huyen">
            <div class="col-sm-11 center margin-30">
                <h4 class="title" style="font-size:17px !important; text-align: left; text-transform: uppercase;">
                    UBND {{ $tendonvi }}
                </h4>

                <h4 class="title" style="font-size:17px !important;">
                    NHẬP HỒ SƠ
                </h4>
                <h4 class="title" style="font-size:17px !important;text-transform: uppercase;">
                    Đề nghị công nhận đạt chuẩn chính quyền thân thiện
                </h4>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-1">
                        <h4 class="title" style="font-size:17px !important;">
                            NĂM
                        </h4>
                    </div>
                    <div class="col-sm-2">
                        <select id="year" class="select2" name="year">
                            @foreach ($lsYears as $year1)
                                <option value="{{ $year1 }}" {{ $year1 == $year ? 'selected' : '' }}>
                                    {{ $year1 }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


            </div>
            <div class="col-sm-1 col-logo margin-30">
                <a class="logo" href="https://bacgiang.gov.vn">
                    <img alt="TTĐT BG" height="100"
                         src="https://qcdc.bacgiang.gov.vn/documents/11619891/16766933/1683621983161_2.+Lo+go+QCDC.png"
                         width="100">
                </a>
            </div>


        </div>
        <div class="row">
            <table class="table table-bordered" border="1">
                <thead>
                <tr>
                    <th class="text-center bold" style="width: 50px">TT</th>
                    <th class="text-center bold">Tên văn bản</th>
                    <th class="text-center bold" style="width: 20%">Tài liệu minh chứng</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="bold">I</td>
                    <td class="text-left bold">HỒ SƠ ĐỀ NGHỊ</td>
                    <td class="bold"></td>
                </tr>
                <tr class="add-row">
                    <td class="normal-row center">1</td>
                    <td class="normal-row">Tờ trình của UBND cấp xã</td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-11" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-11" type="file" style="display:none;" accept=".pdf"
                                   data-type="1"
                                   class="input-file-1" data-id="11"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="11" data-type="1">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="add-row">
                    <td class="normal-row center">2</td>
                    <td class="normal-row">Báo cáo kết quả xây dựng chính quyền thân thiện</td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">

                            <label for="txt-filecongkhai-12" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-12" type="file" style="display:none;" accept=".pdf"
                                   data-type="1"
                                   class="input-file-1" data-id="12"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="12" data-type="1">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="add-row">
                    <td class="normal-row center">3</td>
                    <td class="normal-row">Bảng tự chấm điểm</td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-13" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-13" type="file" style="display:none;" accept=".pdf"
                                   data-type="1"
                                   class="input-file-1" data-id="13"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="13" data-type="1">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="add-row">
                    <td class="normal-row center">4</td>
                    <td class="normal-row">Bản đăng kí xây dựng mô hình</td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-14" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-14" type="file" style="display:none;" accept=".pdf"
                                   data-type="1"
                                   class="input-file-1" data-id="14"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="14" data-type="1">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr class="add-row">
                    <td class="normal-row center">5</td>
                    <td class="normal-row">Văn bản phê duyệt mô hình đăng kí năm của BCĐ cấp huyện</td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-15" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-15" type="file" style="display:none;" accept=".pdf"
                                   data-type="1"
                                   class="input-file-1" data-id="15"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="15" data-type="1">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>


                </tbody>
            </table>
        </div>
        <div class="row">
            <table class="table table-bordered" border="1">
                <thead>
                <tr>
                    <th class="text-center title-row bold" style="width: 50px">TT</th>
                    <th class="text-center title-row bold">Tên văn bản</th>
                    <th class="text-center title-row bold" style="width: 15%">File mục lục tài liệu</th>
                    <th class="text-center title-row bold" style="width: 15%">File tài liệu minh chứng</th>
                    <th class="text-center title-row bold">Điểm chuẩn</th>
                    <th class="text-center title-row bold" style="width: 8%">Điểm tự chấm</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="bold">II</td>
                    <td class="text-left bold">TÀI LIỆU MINH CHỨNG</td>
                    <td class="bold"></td>
                    <td class="bold"></td>
                    <td class="bold"></td>
                    <td>
                    </td>
                </tr>
                <tr class="add-row">
                    <td class="normal-row center">1</td>
                    <td class="normal-row">Công tác xây dựng và thực hiện quy chế dân chủ ở cơ sở; tuyên truyền về
                        “Chính quyền thân thiện”
                    </td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-211" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-211" type="file" style="display:none;" accept=".pdf"
                                   data-type="2"
                                   class="input-file-1" data-id="21"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="21" data-type="2">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-212" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-212" type="file" style="display:none;" accept=".pdf"
                                   data-type="1"
                                   class="input-file-1" data-id="21"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="21" data-type="1">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="normal-row center">20</td>
                    <td class="normal-row">
                        <input type="number" class="form-control diem-tucham" value="0" data-id="21"/>
                    </td>

                </tr>
                <tr class="add-row">
                    <td class="normal-row center">2</td>
                    <td class="normal-row">Công tác cải cách hành chính
                    </td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-221" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-221" type="file" style="display:none;" accept=".pdf"
                                   data-type="2"
                                   class="input-file-1" data-id="22"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="22" data-type="2">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-222" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-222" type="file" style="display:none;" accept=".pdf"
                                   data-type="1"
                                   class="input-file-1" data-id="22"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="22" data-type="1">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="normal-row center">25</td>
                    <td class="normal-row"><input type="number" class="form-control diem-tucham" value="0" data-id="22"/>
                    </td>
                </tr>
                <tr class="add-row">
                    <td class="normal-row center">3</td>
                    <td class="normal-row">Thực hiện văn minh, văn hóa công sở và Quy tắc ứng xử của cán bộ, công chức
                    </td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-231" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-231" type="file" style="display:none;" accept=".pdf"
                                   data-type="2"
                                   class="input-file-1" data-id="23"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="23" data-type="2">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-232" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-232" type="file" style="display:none;" accept=".pdf"
                                   data-type="1"
                                   class="input-file-1" data-id="23"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="23" data-type="1">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="normal-row center">20</td>
                    <td class="normal-row"><input type="number" class="form-control diem-tucham" value="0" data-id="23"/>
                    </td>
                </tr>
                <tr class="add-row">
                    <td class="normal-row center">4</td>
                    <td class="normal-row">Tổ chức tiếp xúc, đối thoại và giải quyết đơn thư khiếu nại, tố cáo
                    </td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-241" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-241" type="file" style="display:none;" accept=".pdf"
                                   data-type="2"
                                   class="input-file-1" data-id="24"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="24" data-type="2">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-242" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-242" type="file" style="display:none;" accept=".pdf"
                                   data-type="1"
                                   class="input-file-1" data-id="24"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="24" data-type="1">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="normal-row center">15</td>
                    <td class="normal-row"><input type="number" class="form-control diem-tucham" value="0" data-id="24"/>
                    </td>
                </tr>
                <tr class="add-row">
                    <td class="normal-row center">5</td>
                    <td class="normal-row">Mức độ hài lòng của cán bộ, công chức, người dân, tổ chức và doanh nghiệp
                    </td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-251" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-251" type="file" style="display:none;" accept=".pdf"
                                   data-type="2"
                                   class="input-file-1" data-id="25"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="25" data-type="2">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="normal-row">
                        <div class="upload" id="editfile">
                            <label for="txt-filecongkhai-252" class="btn-sm btn-success custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-252" type="file" style="display:none;" accept=".pdf"
                                   data-type="1"
                                   class="input-file-1" data-id="25"/>
                            <div class="currentfile" style="display: none">
                                <a class="listfile" href="javascript:void(0)" target="_blank">Xem file</a>
                                <a href="javascript:void(0)" class="xoafile-1" title="Xóa" data-id="25" data-type="1">
                                    <i class="glyphicon glyphicon-trash icon icon-delete"></i>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="normal-row center">20</td>
                    <td class="normal-row"><input type="number" class="form-control diem-tucham" value="0" data-id="25"/>
                    </td>
                </tr>
                <tr>
                    <td class="normal-row center"></td>
                    <td class="normal-row bold">TỔNG ĐIỂM
                    </td>
                    <td class="normal-row"></td>
                    <td class="normal-row"></td>
                    <td class="normal-row center bold">100</td>
                    <td class="normal-row center bold tongdiem">98</td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="row" style="float: right">
            <a class="btn btn-success luu-diem">Lưu điểm</a>
        </div>
    </div>
@stop

@section('content')
    <div class="baocao">

    </div>
@stop
@include('voyager::loading.spin')

<link rel="stylesheet" href="/css/style.css">
@section('javascript')
    <script src="/js/app.js"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script>
        function loadViewData() {
            changeEdited();
            showLoading();
            var urlParams = new URLSearchParams(window.location.search);
            var donvi_id = urlParams.get('donvi_id');
            var formData = new FormData();
            formData.append('year', $('#year').val());
            formData.append('donvi_id', donvi_id);
            $.ajax({
                url: '{{ route('voyager.chinhquyen-thanthien.load') }}',
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                type: 'POST',
                success: function (response) {
                    bindingData(response.lsData);
                    hideLoading();
                },
                error: function (error) {
                    toastr.error('Có lỗi xảy ra');
                    hideLoading();
                }
            });
        }

        function bindingData(data) {
            var idArray1 = [11, 12, 13, 14, 15, 21, 22, 23, 24, 25];
            $.each(idArray1, function (index, id) {
                var curParent = $('*[data-id="' + id + '"][data-type="1"]').parent();
                if (data.length == 0) {
                    curParent.find('div.currentfile').hide();
                }
                var result = $.grep(data, function (element) {
                    return element.chitieu_id === id;
                });
                if (result.length > 0) {
                    var foundItem = result[0];
                    if (foundItem.tl_minhchung !== null) {
                        curParent.find('div.currentfile').show();
                        curParent.find('a.listfile').attr('href', foundItem.tl_minhchung);
                    } else {
                        curParent.find('div.currentfile').hide();
                    }
                } else {
                    curParent.find('div.currentfile').hide();
                }
            });

            var idArray2 = [21, 22, 23, 24, 25];
            var tongdiem = 0;
            $.each(idArray2, function (index, id) {
                var curParent = $('*[data-id="' + id + '"][data-type="2"]').parent();
                if (data.length == 0) {
                    curParent.find('div.currentfile').hide();
                }
                var result = $.grep(data, function (element) {
                    return element.chitieu_id === id;
                });
                if (result.length > 0) {
                    var foundItem = result[0];
                    if (foundItem.tl_mucluc !== null) {
                        curParent.find('div.currentfile').show();
                        curParent.find('a.listfile').attr('href', foundItem.tl_mucluc);
                    } else {
                        curParent.find('div.currentfile').hide();
                    }

                    $('input.diem-tucham[data-id="' + id + '"]').val(foundItem.diem_tucham);

                    tongdiem += foundItem.diem_tucham;
                } else {
                    curParent.find('div.currentfile').hide();
                    $('input.diem-tucham[data-id="' + id + '"]').val('');
                }
            });

            $('.tongdiem').text(tongdiem);
        }

        function changeEdited() {
            var isEdit = @json($isEdit);
            if (!isEdit) {
                $('.custom-file-upload').hide();
                $('.xoafile-1').hide();
                $('.huong-dan').hide();
                $('.diem-tucham').prop('disabled', true);
                $('.currentfile').css('margin-left', '0');
                $('.luu-diem').hide();
            }
        }

        $(document).ready(function () {
            loadViewData();
            $('.diem-tucham').keypress(function (e) {
                if (e.which == 13) {
                    e.preventDefault();
                    var formData = new FormData();
                    formData.append('chitieu_id', $(this).attr('data-id'));
                    formData.append('year', $('#year').val());
                    formData.append('diem', $(this).val());

                    $.ajax({
                        url: '{{ route('voyager.chinhquyen-thanthien.savediem') }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        async: false,
                        type: 'POST',
                        success: function (response) {
                            if (response.error_code == '0') {
                                toastr.success('Lưu thành công');
                                loadViewData();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function (error) {
                            toastr.error('Lưu không thành công');
                        }
                    });
                }
            });

            $('.luu-diem').on('click', function (e) {
                var listDiem = [];
                $('.diem-tucham').each(function () {
                    var objDiem = {diem: $(this).val(), chitieu_id: $(this).attr('data-id'), year: $('#year').val()};
                    listDiem.push(objDiem);
                });

                $.ajax({
                    url: '{{ route('voyager.chinhquyen-thanthien.savediemmulti') }}',
                    method: 'POST',
                    data: { data: JSON.stringify(listDiem) },
                    dataType: 'json',
                    success: function(response) {
                        if (response.error_code == '0') {
                            toastr.success('Lưu thành công');
                            loadViewData();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Lưu không thành công');
                    }
                });

            });

            $('.xoafile-1').on('click', function (e) {
                var result = confirm("Bạn có chắc muốn xóa file này không?");
                var type = $(this).attr('data-type');
                if (result === true) {
                    var formData = new FormData();
                    formData.append('chitieu_id', $(this).attr('data-id'));
                    formData.append('year', $('#year').val());
                    formData.append('type', type);
                    $.ajax({
                        url: '{{ route('voyager.chinhquyen-thanthien.delete') }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        async: false,
                        type: 'POST',
                        success: function (response) {
                            toastr.success('Xóa file thành công');
                            loadViewData();
                        },
                        error: function (error) {
                            toastr.error('Xóa file không thành công');
                        }
                    });
                }

            });

            $('.input-file-1').on('change', function (e) {
                showLoading();
                var selectedFile = e.target.files[0];
                var type = $(this).attr('data-type');
                if (selectedFile) {
                    var formData = new FormData();
                    formData.append('file', $(this)[0].files[0]);
                    formData.append('chitieu_id', $(this).attr('data-id'));
                    formData.append('year', $('#year').val());
                    formData.append('type', type);

                    $.ajax({
                        url: '{{ route('voyager.chinhquyen-thanthien.upload') }}',
                        data: formData,
                        processData: false,
                        contentType: false,
                        async: true,
                        type: 'POST',
                        success: function (response) {
                            if (response.error_code == '0') {
                                toastr.success('Upload file thành công');
                                loadViewData();
                            } else {
                                toastr.error(response.message);
                            }
                            hideLoading();
                        },
                        error: function (error) {
                            toastr.error('Upload file không thành công');
                            hideLoading();
                        }
                    });
                }
            });
        });

        $('#year').on('change', function (e) {
            loadViewData();
        });
    </script>

@stop
