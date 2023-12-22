<div class="modal fade" id="AddEditKetQuaThucHienCongKhaiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span
                    class="modal-title">{{ $item ? 'Cập nhật kết quả thực hiện công khai' : 'Thêm mới kết quả thực hiện công khai' }}</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <span>Tên xã, phường, thị trấn </span>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="txt-tenxaphuong-1" class="form-control" disabled
                            value="{{ $tendonvi }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Nội dung công khai <span class="required">(*)</span></span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-noidungcongkhai-1" class="form-control" rows="6">{{ $item ? $item->noidung_congkhai : '' }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Cơ quan t.hiện công khai </span><span class="required"> (*)</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="txt-coquanthuchiencongkhai-1" class="form-control"
                            value="{{ $item ? $item->coquan_congkhai : '' }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Hình thức công khai</span>
                    </div>
                    <div class="col-sm-9">
                        @php
                            $arrhinhthuc = [];
                            if ($item != null) {
                                $arrhinhthuc = explode(',', $item->hinhthuc_congkhai);
                            }
                        @endphp
                        <select id="txt-hinhthuccongkhai-1" class="form-control select2" multiple="multiple">
                            @foreach ($lsHinhThucs as $value => $text)
                                @if (in_array($value, $arrhinhthuc))
                                    <option selected value="{{ $value }}">{{ $text }}</option>
                                @else
                                    <option value="{{ $value }}">{{ $text }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Văn bản công khai</span>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" id="txt-sokehoachcongkhai-1" class="form-control" placeholder="Số"
                            value="{{ $item ? $item->sokehoach_congkhai : '' }}" />
                    </div>
                    <div class="col-sm-3">
                        <input type="text" id="txt-kyhieukehoachcongkhai-1" class="form-control"
                            placeholder="Ký hiệu" value="{{ $item ? $item->kyhieukehoach_congkhai : '' }}" />
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <input type="datetime" class="form-control ngay" name="txt-ngayvanban-1"
                                id="txt-ngayvanban-1" placeholder="Ngày văn bản"
                                value="{{ $item ? ($item->ngay_vanban ? Carbon\Carbon::parse($item->ngay_vanban)->format('d/m/Y') : null) : Carbon\Carbon::now()->format('d/m/Y') }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="txt-coquanbanhanh-1" class="form-control"
                            placeholder="Cơ quan ban hành" value="{{ $item ? $item->coquan_banhanh : '' }}" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>File văn bản công khai</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="hidden" id="filecongkhai-path-1"
                            value="{{ $item ? $item->filecongkhai_path : null }}" />

                        <div class="currentfile-1">
                            <a class="listfile-1" href="{{ $item ? $item->filecongkhai_path : '' }}"
                                target="_blank">{{ $item ? $item->filecongkhai_path : '' }}</a>
                            <a href="javascript:void(0)" class="xoafile-1" title="Xóa"><i
                                    class="glyphicon glyphicon-trash icon icon-delete"></i></a>
                        </div>

                        <div class="upload-1">
                            <label for="txt-filecongkhai-1" class="custom-file-upload">
                                Chọn file
                            </label>
                            <input id="txt-filecongkhai-1" type="file" />
                            <span id="txt-tenfilecongkhai-1" class="filename-upload" />
                            <button type="button" class="btn btn-success" onclick="UploadFileCongKhai()">Tải lên
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Ghi chú</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-ghichu-1" class="form-control">{{ $item ? $item->ghi_chu : '' }}</textarea>
                    </div>
                </div>
                <div class="row">
                    @php
                        $curMonth = date('m', time());
                        $curQuarter = ceil($curMonth / 3);
                    @endphp
                    <div class="col-sm-3">
                        <span>Quý</span>
                    </div>
                    <div class="col-sm-9">
                        <select id="quarter-1" class="select2">
                            <option value="1" {{ $curQuarter == 1 ? 'selected' : '' }}>Quý 1</option>
                            <option value="2" {{ $curQuarter == 2 ? 'selected' : '' }}>Quý 2</option>
                            <option value="3" {{ $curQuarter == 3 ? 'selected' : '' }}>Quý 3</option>
                            <option value="4" {{ $curQuarter == 4 ? 'selected' : '' }}>Quý 4</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    @php
                        $years = range(2022, 2030);
                        $currentYear = date('Y'); // Lấy năm hiện tại
                    @endphp
                    <div class="col-sm-3">
                        <span>Năm</span>
                    </div>
                    <div class="col-sm-9">
                        @php
                            $years = range(2022, 2030);
                        @endphp
                        <select id="year-1" class="select2">
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-them"
                    onclick="AddEditKetQuaThucHienCongKhai({{ $item ? $item->id : 0 }})">{{ $item ? 'Cập nhật' : 'Thêm mới' }}
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    var fileExits = '{{ $item != null && $item->filecongkhai_path != null }}';

    if (fileExits) {
        $('.upload-1').hide();
    } else {
        $('.currentfile-1').hide();
    }
    $('.ngay').datetimepicker({
        locale: 'vi',
        format: 'DD/MM/YYYY'
    });
    $('.xoafile-1').on('click', function() {
        var ok = confirm('Xóa file này?');
        if (ok) {
            $('.currentfile-1').hide();
            $('.upload-1').show();
            $('#filecongkhai-path-1').val('');
        }
    });
</script>
