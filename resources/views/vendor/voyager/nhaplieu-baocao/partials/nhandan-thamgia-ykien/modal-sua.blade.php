<div class="modal fade" id="suaNhanDanThamGiaYKienModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Cập nhật nhân dân tham gia ý kiến</h5>
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
                        <textarea type="text" id="txt-edit-tenxaphuong-4" readonly class="form-control">{{ $item->ten_xaphuong }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Nội dung xin ý kiến Nhân dân <span class="required">(*)</span></span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-edit-noidungxinykien-4" class="form-control">{{ $item->noidung_xinykien }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Tóm tắt nội dung</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-tomtat-4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Hình thức nhân dân tham gia ý kiến</span>
                    </div>
                    <div class="col-sm-9">
                        <select id="txt-edit-hinhthucthamgiaykien-4" class="form-control">
                            @foreach ($lsHinhThucs as $value => $text)
                                @if ($item->hinhthuc_ban == $value)
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
                        <span>Ghi chú</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-edit-ghichu-4" class="form-control">{{ $item->ghi_chu }}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-them"
                    onclick="CapNhatNhanDanThamGiaYKien({{ $item->id }})">Cập Nhật</button>
            </div>
        </div>
    </div>
</div>
