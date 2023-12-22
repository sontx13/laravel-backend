<!DOCTYPE html>
@extends('voyager::master')

@section('page_title', 'Quản trị phản ánh kiến nghị')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@section('content')

    <div class="modal-content">
        <div class="modal-header">
            <span class="modal-title">Quản trị PAKN ({{$item->tieu_de}})</span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-2">
                    <span>Người gửi</span>
                </div>
                <div class="col-sm-2">
                    <input type="text" id="ten" name="ten" class="input-full" value="{{ $item->ten }}"/>
                </div>
                <div class="col-sm-2">
                    <span>Số điện thoại</span>
                </div>
                <div class="col-sm-2">

                    <input type="text" id="so_dien_thoai" name="so_dien_thoai" class="input-full"
                           value="{{ $item->so_dien_thoai }}"/>
                </div>
                <div class="col-sm-2">
                    <span>Ngày gửi</span>
                </div>
                <div class="col-sm-2">
                    <input type="datetime" class="form-control ngaygio"
                           name="ngay_gui" id="ngay_gui" required
                           value="{{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <span>Nội dung</span>
                </div>
                <div class="col-sm-10">
                    <div id="editor1">
                        {!! $item->noi_dung !!}
                    </div>
                    <textarea rows="8" id="txt-noi_dung" style="display: none" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <span>Danh sách file đính kèm</span>
                </div>
                <div class="col-sm-10">
                    @if ($item->files != null && $item->files->count() > 0)
                        @foreach($item->files as $file)
                            <a href="{{asset($file->file_path)}}">{{$file->file_name}}</a>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">
                    <span>Trả lời</span>
                </div>
                <div class="col-sm-10">
                    <div id="editor">
                        {!! $item->tra_loi !!}
                    </div>
                    <textarea rows="8" id="txt-traloi" style="display: none" class="form-control"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <span>TT Xử lý</span>
                </div>
                <div class="col-sm-4">
                    <select id="cbx-trangthai-xuly-edit" class="select2 form-control">
                        @if ($item->status == App\Enums\TrangThaiXuLyPAKNEnum::ChuaXuLy)
                            <option selected value="0">Chưa xử lý</option>
                            <option value="1">Đang xử lý</option>
                            <option value="2">Đã xử lý</option>
                        @elseif ($item->status == App\Enums\TrangThaiXuLyPAKNEnum::DangXuLy)
                            <option value="0">Chưa xử lý</option>
                            <option selected value="1">Đang xử lý</option>
                            <option value="2">Đã xử lý</option>
                        @elseif ($item->status == App\Enums\TrangThaiXuLyPAKNEnum::DaXuLy)
                            <option value="0">Chưa xử lý</option>
                            <option value="1">Đang xử lý</option>
                            <option selected value="2">Đã xử lý</option>
                        @endif
                    </select>
                </div>
                <div class="col-sm-2">
                    <span>TT Công khai</span>
                </div>
                <div class="col-sm-4">
                    <select id="cbx-trangthai-congkhai-edit" class="select2 form-control">
                        @if ($item->is_public == App\Enums\TrangThaiCongKhaiPAKNEnum::KhongCongKhai)
                            <option selected value="0">Không công khai</option>
                            <option value="1">Công khai</option>
                        @elseif ($item->is_public == App\Enums\TrangThaiCongKhaiPAKNEnum::CongKhai)
                            <option value="0">Không công khai</option>
                            <option selected value="1">Công khai</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="btn btn-secondary" href="{{ url()->previous() }}">Quay lại</a>
            <button type="button" class="btn btn-primary btn-them" onclick="CapNhatPAKN({{$item->id}})">Cập
                nhật
            </button>
        </div>
    </div>

@stop
@section('javascript')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        var quill1 = new Quill('#editor1', {
            theme: 'snow'
        });

        $('.ngaygio').datetimepicker({
            locale: 'vi',
            format: 'DD/MM/YYYY'
        });

        function CapNhatPAKN(id) {

            var traloi = quill.root.innerHTML;
            var noidung = quill1.root.innerHTML;

            var ttxuly = $("#cbx-trangthai-xuly-edit").val();
            var ttcongkhai = $("#cbx-trangthai-congkhai-edit").val();

            var ten = $("#ten").val();
            var so_dien_thoai = $("#so_dien_thoai").val();
            var ngay_gui = $("#ngay_gui").val();


            $.ajax({
                type: 'post',
                url: '/admin/quan-tri-pakn/cap-nhap',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    traloi: traloi,
                    ttxuly: ttxuly,
                    ttcongkhai: ttcongkhai,
                    noidung: noidung,
                    ten: ten,
                    so_dien_thoai: so_dien_thoai,
                    ngay_gui: ngay_gui

                },
                success: function (response) {
                    if (response.error_code == "0") {
                        toastr.success('Cập nhật thành công');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (err) {
                    if (err.status == 403) {
                        toastr.error('Người dùng không có quyền thực hiện thao tác này');
                    } else {
                        toastr.error('Cập nhật không thành công');
                    }
                }
            });
        }
    </script>
@stop
