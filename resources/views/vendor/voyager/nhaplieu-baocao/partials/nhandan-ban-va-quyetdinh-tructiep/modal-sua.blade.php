<div class="modal fade" id="suaNhanDanBanVaQuyetDinhTrucTiepModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Cập nhật nhân dân bàn và quyết định trực tiếp</h5>
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
                        <textarea type="text" id="txt-edit-tenxaphuong-2" readonly class="form-control">{{ $item->ten_xaphuong }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <span>Nội dung công việc <span class="required">(*)</span></span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-edit-noidungcongviec-2" class="form-control">{{ $item->noidung_congviec }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Tóm tắt nội dung <span class="required">(*)</span></span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-tomtatnoidung-2" class="form-control">{{ $item->tomtat_noidung }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Cơ quan chủ trì </span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-edit-coquanchutri-2" class="form-control">{{ $item->coquan_chutri }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Hình thức bàn</span>
                    </div>
                    <div class="col-sm-9">
                        <select id="txt-edit-hinhthucban-2" class="form-control">
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
                        <span>Số phương án được chuẩn bị</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-edit-sophuongan-2" class="form-control">{{ $item->so_phuongan }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3">
                        <span>Kết quả biểu quyết</span>
                    </div>
                    <div class="col-sm-3" style="display:flex;align-items: center;">
                        <span style="width:50%">Số phiếu</span>
                        <input type="text" id="txt-sophieu-2" value="{{ $item->sophieu }}"
                            onkeyup="formatInputNumber('txt-sophieu-2')" class="form-control">
                    </div>
                    <div class="col-sm-6"style="display:flex;align-items: center;">
                        <span style="width:60%">Tổng số hộ gia đình</span>
                        <input type="text" id="txt-tongso-2" value="{{ $item->tongso }}"
                            onkeyup="formatInputNumber('txt-tongso-2')" class="form-control">
                    </div>

                </div>
                <div class="card-giatri">
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Tổng giá trị</span>
                        </div>
                        <div class="col-sm-9 flex-algin">
                            <input type="text" id="txt-tonggiatri-2" value="{{ $item->tong_giatri }}"
                                class="form-control">
                            <span style="margin-left:1rem">VNĐ</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Nhân dân đóng góp</span>
                        </div>
                        <div class="col-sm-4 flex-algin">
                            <input type="text" id="txt-nddg-2" value="{{ $item->nddg }}"
                                onkeyup="formatInputNumber('txt-nddg-2')" class="form-control" />
                            <span style="margin-left:1rem">VNĐ</span>
                        </div>
                        <div class="col-sm-1">
                            <span>NSNN</span>
                        </div>
                        <div class="col-sm-4 flex-algin">
                            <input type="text" id="txt-nsnn-2" value="{{ $item->nsnn }}"
                                onkeyup="formatInputNumber('txt-nsnn-2')" class="form-control" />
                            <span style="margin-left:1rem">VNĐ</span>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Ngày công</span>
                        </div>
                        <div class="col-sm-4 flex-algin">
                            <input type="text" id="txt-ngaycong-2" value="{{ $item->ngay_cong }}"
                                class="form-control" onkeyup="formatInputNumber('txt-ngaycong-2')" />
                            <span style="margin-left:1rem">ngày</span>
                        </div>
                        <div class="col-sm-1">
                            <span>Khác</span>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" value="{{ $item->khac }}" id="txt-khac-2"
                                class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-them"
                    onclick="CapNhatNhanDanBanVaQuyetDinhTrucTiep({{ $item->id }})">Cập Nhật</button>
            </div>
        </div>
    </div>
</div>
<style>
    .flex-algin {
        display: flex;
    }

    .card-giatri {
        margin: 0.5rem 1rem;
        border: 1px solid #cdcdcd85;
        padding: 1rem;
    }
</style>
