@php
    $edit = !is_null($dataTypeContent->getKey());
    $add = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.' . ($edit ? 'edit' : 'add')) . ' ' .
    $dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.' . ($edit ? 'edit' : 'add')) . ' ' . $dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form" class="form-edit-add"
                        action="{{ $edit ? route('voyager.' . $dataType->slug . '.update', $dataTypeContent->getKey()) : route('voyager.' . $dataType->slug . '.store') }}"
                        method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if ($edit)
                            {{ method_field('PUT') }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{$edit ? 'editRows' : 'addRows'};
                            @endphp
                            <div class="row">
                                <div class="col-md-2">
                                    <p style="margin-top:5px; color:black; font-weight:bold">Tên
                                        xã, phường,
                                        thị trấn <span style="color:red">(*)</span></p>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="" disabled
                                        value="{{ $ten_donvi->ten_donvi }}" />
                                    <input type="hidden" class="form-control" name="ten_xaphuong"
                                        value="{{ $ten_donvi->ten_donvi }}" />
                                    <input type="hidden" class="form-control" name="donvi_id"
                                        value="{{ $ten_donvi->ma_donvi }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <p style="margin-top:5px; color:black; font-weight:bold">Nội dung công khai <span
                                            style="color:red">(*)</span></p>
                                </div>
                                <div class="col-md-1">
                                    <p style="margin-top:5px; color:black; font-weight:bold">Nhóm <span
                                            style="color:red">(*)</span></p>
                                </div>
                                <div class="col-md-1">
                                    <input type="text" disabled class="form-control" name="nhom_congkhai_value"
                                        value="{{ old('nhom_congkhai', $dataTypeContent->nhom_congkhai ?? 'I') }}" />
                                    <input type="hidden" class="form-control" name="nhom_congkhai"
                                        value="{{ old('nhom_congkhai', $dataTypeContent->nhom_congkhai ?? '13') }}" />
                                </div>
                                <div class="col-md-1">
                                    <p style="margin-top:5px;color:black; font-weight:bold">Mục <span
                                            style="color:red">(*)</span></p>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control select2" id="muc_congkhai" name="muc_congkhai">
                                        @foreach ($listMuc as $item)
                                            <option @if ($item->id == $dataTypeContent->muc_congkhai) selected @endif
                                                value="{{ $item->id }}">{{ $item->ma_muc }} - {{ $item->noi_dung }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <p style="margin-top:5px; color:black; font-weight:bold">Tóm tắt
                                        thông tin công khai <span style="color:red">(*)</span></p>
                                </div>
                                <div class="col-md-10">
                                    <textarea class="form-control" id="noidung_congkhai" name="noidung_congkhai" rows="5"> {{ old('noidung_congkhai', $dataTypeContent->noidung_congkhai ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <p style="margin-top:5px; color:black; font-weight:bold">Thời
                                        gian công khai <span style="color:red">(*)</span></p>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control select2" name="tg_congkhai">
                                        <option value="thuongxuyen" @if ($dataTypeContent->tg_congkhai == 'thuongxuyen') selected @endif>Thường
                                            xuyên</option>
                                        <option value="30ngay"@if ($dataTypeContent->tg_congkhai == '30ngay') selected @endif>Tối thiểu 30
                                            ngày</option>
                                        <option value="90ngay" @if ($dataTypeContent->tg_congkhai == '90ngay') selected @endif>Tối thiểu
                                            90 ngày</option>
                                        <option value="khac" @if ($dataTypeContent->tg_congkhai == 'khac') selected @endif>Khác
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <p style="margin-top:5px; color:black; font-weight:bold">Thời
                                        điểm công khai <span style="color:red">(*)</span></p>
                                </div>
                                <div class="col-md-1">
                                    <p style="margin-top:5px; color:black; font-weight:bold">Bắt đầu <span
                                            style="color:red">(*)</span></p>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="ngay_bd_congkhai" class="form-control"
                                        value="@if (isset($dataTypeContent->ngay_bd_congkhai)) {{ \Carbon\Carbon::parse(old('ngay_bd_congkhai', $dataTypeContent->ngay_bd_congkhai))->format('d/m/Y ') }} @endif">
                                    <input type="hidden" name="ngay_bd_congkhai" class="form-control"
                                        value="@if (isset($dataTypeContent->ngay_bd_congkhai)) {{ \Carbon\Carbon::parse(old('ngay_bd_congkhai', $dataTypeContent->ngay_bd_congkhai))->format('d/m/Y ') }} @endif">
                                </div>
                                <div class="col-md-1">
                                    <p style="margin-top:5px;color:black; font-weight:bold">Kết thúc <span
                                            style="color:red">(*)</span></p>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="ngay_kt_congkhai" class="form-control"
                                        value="@if (isset($dataTypeContent->ngay_kt_congkhai)) {{ \Carbon\Carbon::parse(old('ngay_kt_congkhai', $dataTypeContent->ngay_kt_congkhai))->format('d/m/Y ') }} @endif">
                                    <input type="hidden" name="ngay_kt_congkhai" class="form-control"
                                        value="@if (isset($dataTypeContent->ngay_kt_congkhai)) {{ \Carbon\Carbon::parse(old('ngay_kt_congkhai', $dataTypeContent->ngay_kt_congkhai))->format('d/m/Y ') }} @endif">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <p style="margin-top:5px; color:black; font-weight:bold">Hình thức công khai <span
                                            style="color:red">(*)</span></p>
                                </div>
                                <div class="col-md-5" style="margin-left:1rem;">
                                    <div class="row">
                                        <label for="htct1" style="color:black; font-weight:bold">Niêm yết
                                            1 nơi</label>
                                        <input type="checkbox" id="check1" name="htct1" value="1">
                                    </div>
                                    <div class="row">
                                        <label style=" color:black; font-weight:bold" for="htct2">Niêm yết
                                            2 nơi</label>
                                        <input type="checkbox" id="check2" name="htct2" value="2">
                                    </div>
                                    <div class="row">
                                        <label style=" color:black; font-weight:bold" for="htct3">Đăng tải
                                            trên cổng thông tin</label>
                                        <input type="checkbox" id="check3" name="htct3" value="3">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input type="hidden" name="hinhthuc_congkhai"
                                        value="{{ old('hinhthuc_congkhai', $dataTypeContent->hinhthuc_congkhai ?? '') }}">
                                    <div class="row">
                                        <label style=" color:black; font-weight:bold" for="htct1">Loa
                                            truyền thanh</label>
                                        <input type="checkbox" id="check4" name="htct1" value="4">
                                    </div>
                                    <div class="row">
                                        <label style="color:black; font-weight:bold" for="htct2">Thông
                                            qua trưởng thôn, TDP</label>
                                        <input type="checkbox" id="check5" name="htct2" value="5">
                                    </div>
                                    <div class="row">
                                        <label style=" color:black; font-weight:bold" for="htct3">Hình
                                            thức khác</label>
                                        <input type="checkbox" id="htk" value="1">
                                        <textarea class="form-control" id="checkhtk" name="hinhthuc_khac" rows="5">{{ old('hinhthuc_khac', $dataTypeContent->hinhthuc_khac ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <p style="margin-top:5px; color:black; font-weight:bold">File văn bản công khai </p>
                                </div>
                                <div class="col-md-10">
                                </div>
                            </div>
                            <div class="" style="display:flex; align-item:center;">
                                <div class="" style="width:17%;">
                                    <p style="margin-top:5px; color:black; font-weight:bold">Kế hoạch công khai <span
                                            style="color:red">(*)</span></p>
                                </div>
                                <div class="">
                                    <input type="hidden" name="file_kh_congkhai_path"
                                        value="{{ old('file_kh_congkhai_path', $dataTypeContent->file_kh_congkhai_path ?? '') }}"
                                        class="form-control">
                                </div>
                                <div class="currentfile-1">
                                    <a class="listfile-1"
                                        href="{{ $dataTypeContent->file_kh_congkhai_path ? $dataTypeContent->file_kh_congkhai_path : '' }}"
                                        target="_blank">{{ $dataTypeContent->file_kh_congkhai_path ? $dataTypeContent->file_kh_congkhai_path : '' }}</a>
                                    <a href="javascript:void(0)" class="xoafile-1" title="Xóa"><i
                                            class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                                </div>

                                <div class="upload-1" id="editfile">
                                    <label for="txt-filecongkhai-1" class=" btn btn-success custom-file-upload">
                                        Chọn file
                                    </label>
                                    <input id="txt-filecongkhai-1" type="file" style="display:none;"
                                        onchange="ChonFileKeHoachCongKhaiUpload()" />
                                    <span id="txt-tenfilecongkhai-1" class="filename-upload">
                                    </span>
                                </div>
                            </div>
                            <div class="" style="display:flex; align-item:center;">
                                <div class="" style="width:17%;">
                                    <p style="margin-top:5px; color:black; font-weight:bold">Thông tin công khai <span
                                            style="color:red">(*)</span></p>
                                </div>
                                <div class="">
                                    <input type="hidden" name="filecongkhai_path"
                                        value='{{ old('filecongkhai_path', $dataTypeContent->filecongkhai_path ?? '') }}'
                                        class="form-control">
                                </div>
                                <div class="currentfile-2">
                                    <a class="listfile-2"
                                        href="{{ $dataTypeContent->filecongkhai_path ? $dataTypeContent->filecongkhai_path : '' }}"
                                        target="_blank">{{ $dataTypeContent->filecongkhai_path ? $dataTypeContent->filecongkhai_path : '' }}</a>
                                    <a href="javascript:void(0)" class="xoafile-2" title="Xóa"><i
                                            class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                                </div>
                                <div class="upload-2" id="editfile">
                                    <label for="txt-filecongkhai-2" class="btn btn-success custom-file-upload">
                                        Chọn file
                                    </label>
                                    <input id="txt-filecongkhai-2" type="file" style="display:none;"
                                        onchange="ChonFileCongKhaiUpload()" />
                                    <span id="txt-tenfilecongkhai-2" class="filename-upload">
                                    </span>
                                </div>
                            </div>
                        </div><!-- panel-body -->

                        <div class="panel-footer">
                        @section('submit-buttons')
                            <button type="submit" id="submit"
                                class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                        @stop
                        @yield('submit-buttons')
                    </div>
                </form>

                <div style="display:none">
                    <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
                    <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-danger" id="confirm_delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}
                </h4>
            </div>

            <div class="modal-body">
                <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                <button type="button" class="btn btn-danger"
                    id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
            </div>
        </div>
    </div>
</div>
<!-- End Delete File Modal -->
@stop
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script>
    var params = {};
    var $file;
    var fileExits = '{{ $dataTypeContent->file_kh_congkhai_path != null }}';
    var fileExits2 = '{{ $dataTypeContent->filecongkhai_path != null }}';

    function ChonFileKeHoachCongKhaiUpload() {


        var fileName = $('#txt-filecongkhai-1').val();
        var fileExtension = fileName.split('.').pop().toLowerCase();

        var allowedExtensions = ['pdf'];

        if ($.inArray(fileExtension, allowedExtensions) === -1) {
            toastr.warning('Chỉ chấp nhận file PDF');
            $('#txt-filecongkhai-1').val(''); // Xóa giá trị input file
        } else {
            var file = $('#txt-filecongkhai-1').prop('files');
            if (file.length > 0) {
                $('#txt-tenfilecongkhai-1').text(file[0].name);
            } else {
                $('#txt-tenfilecongkhai-1').text('');
            }
        }
    }

    function ChonFileCongKhaiUpload() {
        var fileName = $('#txt-filecongkhai-2').val();
        var fileExtension = fileName.split('.').pop().toLowerCase();

        var allowedExtensions = ['pdf'];

        if ($.inArray(fileExtension, allowedExtensions) === -1) {
            toastr.warning('Chỉ chấp nhận file PDF');
            $('#txt-filecongkhai-2').val(''); // Xóa giá trị input file
        } else {
            var file = $('#txt-filecongkhai-2').prop('files');
            if (file.length > 0) {
                $('#txt-tenfilecongkhai-2').text(file[0].name);
            } else {
                $('#txt-tenfilecongkhai-2').text('');
            }
        }

    }

    function deleteHandler(tag, isMulti) {
        return function() {
            $file = $(this).siblings(tag);

            params = {
                slug: '{{ $dataType->slug }}',
                filename: $file.data('file-name'),
                id: $file.data('id'),
                field: $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
        };
    }

    $('#htk').change(function() {
        if ($(this).is(':checked')) {
            $(`#checkhtk`).show();
            $(`#htk`).attr('type', 'hidden');
        }
    });
    $('#submit').click(function() {



        var isChecked = $('#check1').is(':checked');
        var isChecked2 = $('#check2').is(':checked');
        var isChecked3 = $('#check3').is(':checked');
        var isChecked4 = $('#check4').is(':checked');
        var isChecked5 = $('#check5').is(':checked');
        var value1 = '';
        var value2 = '';
        var value3 = '';
        var value4 = '';
        var value5 = '';
        if (isChecked) {
            value1 = $('#check1').val();
        }
        if (isChecked2) {
            value2 = $('#check2').val();
        }
        if (isChecked3) {
            value3 = $('#check3').val();
        }
        if (isChecked4) {
            value4 = $('#check4').val();
        }
        if (isChecked5) {
            value5 = $('#check5').val();
        }
        if (!$(`#noidung_congkhai`).val()) {
            console.log(!$(`#noidung_congkhai`).val())
            toastr.warning('Không để trống tóm tắt thông tin công khai');
            return false;
        }
        if (!$(`#ngay_bd_congkhai`).val()) {
            toastr.warning('Không để trống ngày bắt đầu');
            return false;
        }
        if (!$(`#ngay_kt_congkhai`).val()) {
            toastr.warning('Không để trống ngày kết thúc');
            return false;
        }
        if (!isChecked5 && !isChecked4 && !isChecked3 && !isChecked2 && !isChecked) {
            toastr.warning('Không để trống hình thức công khai');
            return false;
        }

        var value = value1 + ',' + value2 + ',' + value3 + ',' + value4 + ',' + value5;
        $(`input[name="hinhthuc_congkhai"]`).val(value);

        var bdDateTime = $(`#ngay_bd_congkhai`).val();
        var bdformatDateTime = moment(bdDateTime, "DD-MM-YYYY").format("YYYY-MM-DD");
        $(`input[name="ngay_bd_congkhai"]`).val(bdformatDateTime);

        var ktDateTime = $(`#ngay_kt_congkhai`).val();
        var ktformatDateTime = moment(ktDateTime, "DD-MM-YYYY").format("YYYY-MM-DD");
        $(`input[name="ngay_kt_congkhai"]`).val(ktformatDateTime);

        var startDate = new Date($('input[name="ngay_bd_congkhai"]').val());
        var endDate = new Date($('input[name="ngay_kt_congkhai"]').val());

        if (startDate > endDate) {
            toastr.warning('Ngày bắt đầu phải nhỏ hơn ngày kết thúc');
            return false;
        }
        if (!fileExits2) {
            var filecongkhai = $("#txt-filecongkhai-2").prop("files");
            if (filecongkhai.length <= 0) {
                toastr.warning('File thông tin công khai không được để trống');
                return false;
            }
            var fd = new FormData();
            for (var index = 0; index < filecongkhai.length; index++) {
                fd.append('file_' + index, filecongkhai[index]);
            }
            $.ajax({
                url: '/admin/file/upload',
                data: fd,
                processData: false,
                contentType: false,
                async: false,
                type: 'POST',
                success: function(response) {
                    if (response.error_code == '0') {
                        toastr.success('Upload file thành công');
                        $(`input[name="filecongkhai_path"]`).val(response.file_path);

                    } else {
                        toastr.success(response.message);
                    }
                },
                error: function(error) {
                    if (error.status == 403) {
                        toastr.error('Người dùng không có quyền thực hiện thao tác này');
                    } else {
                        toastr.error('Upload file không thành công');
                    }
                    // hideLoading();
                }
            });


        }
        if (!fileExits) {
            var filecongkhai = $("#txt-filecongkhai-1").prop("files");
            if (filecongkhai.length <= 0) {
                toastr.warning('File kế hoạch công khai không được để trống');
                return false;
            }
            var fd = new FormData();
            for (var index = 0; index < filecongkhai.length; index++) {
                fd.append('file_' + index, filecongkhai[index]);
            }
            $.ajax({
                url: '/admin/file/upload',
                data: fd,
                processData: false,
                contentType: false,
                async: false,
                type: 'POST',
                success: function(response) {
                    if (response.error_code == '0') {
                        toastr.success('Upload file thành công');
                        $(`input[name="file_kh_congkhai_path"]`).val(response.file_path);
                    } else {
                        toastr.success(response.message);
                    }
                },
                error: function(error) {
                    if (error.status == 403) {
                        toastr.error('Người dùng không có quyền thực hiện thao tác này');
                    } else {
                        toastr.error('Upload file không thành công');
                    }
                    // hideLoading();
                }
            });
        }

    })

    $('document').ready(function() {
        $(`#checkhtk`).hide();
        $('#ngay_bd_congkhai').datetimepicker({
            format: 'DD-MM-YYYY',
        });
        $('#ngay_kt_congkhai').datetimepicker({
            format: 'DD-MM-YYYY',
        });
        if ($(`input[name="hinhthuc_congkhai"]`).val()) {
            var hinhthuc = $(`input[name="hinhthuc_congkhai"]`).val()
            if (hinhthuc.includes('1')) {
                $('#check1').prop('checked', true);
            }
            if (hinhthuc.includes('2')) {
                $('#check2').prop('checked', true);
            }
            if (hinhthuc.includes('3')) {
                $('#check3').prop('checked', true);
            }
            if (hinhthuc.includes('4')) {
                $('#check4').prop('checked', true);
            }
            if (hinhthuc.includes('5')) {
                $('#check5').prop('checked', true);
            }
        }
        if ($(`#checkhtk`).val()) {
            $(`#checkhtk`).show();
            $(`#htk`).attr('type', 'hidden');
        }
        $('.toggleswitch').bootstrapToggle();

        //Init datepicker for date fields if data-datepicker attribute defined
        //or if browser does not handle date inputs
        $('.form-group input[type=date]').each(function(idx, elt) {
            if (elt.hasAttribute('data-datepicker')) {
                elt.type = 'text';
                $(elt).datetimepicker($(elt).data('datepicker'));
            } else if (elt.type != 'date') {
                elt.type = 'text';
                $(elt).datetimepicker({
                    format: 'L',
                    extraFormats: ['YYYY-MM-DD']
                }).datetimepicker($(elt).data('datepicker'));
            }
        });

        @if ($isModelTranslatable)
            $('.side-body').multilingual({
                "editing": true
            });
        @endif

        $('.side-body input[data-slug-origin]').each(function(i, el) {
            $(el).slugify();
        });

        $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
        $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
        $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
        $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

        $('#confirm_delete').on('click', function() {
            $.post('{{ route('voyager.' . $dataType->slug . '.media.remove') }}', params, function(
                response) {
                if (response &&
                    response.data &&
                    response.data.status &&
                    response.data.status == 200) {

                    toastr.success(response.data.message);
                    $file.parent().fadeOut(300, function() {
                        $(this).remove();
                    })
                } else {
                    toastr.error("Error removing file.");
                }
            });

            $('#confirm_delete_modal').modal('hide');
        });
        $('[data-toggle="tooltip"]').tooltip();


        $('#muc_congkhai').change(function() {
            $.ajax({
                type: 'post',
                url: '/admin/getNhom',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'idMuc': $(this).val()
                },
                success: function(response) {
                    $(`input[name="nhom_congkhai_value"]`).val(response.data.ma_nhom);
                    $(`input[name="nhom_congkhai"]`).val(response.data.id);
                },
                error: function(err) {
                    console.log(err);
                    toastr.error('Hiển thị danh sách không thành công');
                }
            });
        });
        if ($(`input[name="file_kh_congkhai_path"]`).val()) {
            console.log(1)
        }
    });

    if (fileExits) {
        $('.upload-1').hide();
    } else {
        $('.currentfile-1').hide();
    }
    if (fileExits2) {
        $('.upload-2').hide();
    } else {
        $('.currentfile-2').hide();
    }
    $('.xoafile-1').on('click', function() {
        var ok = confirm('Xóa file này?');
        if (ok) {
            fileExits = false;
            $('.currentfile-1').hide();
            $('.upload-1').show();
            $('#filecongkhai-path-1').val('');
        }
    });
    $('.xoafile-2').on('click', function() {
        var ok = confirm('Xóa file này?');
        if (ok) {
            fileExits2 = false
            $('.currentfile-2').hide();
            $('.upload-2').show();
            $('#filecongkhai-path-2').val('');
        }
    });
</script>
@stop
