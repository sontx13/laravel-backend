<div class="modal fade" id="1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Cập nhật báo cáo kết quả hướng dẫn người dân thực hiện khảo sát</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>


            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <span>Tên xã phường, thị trấn</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-edit-tenxaphuong" readonly class="form-control">{{ $item->ten_xaphuong }}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số lượng cán bộ công chức thuộc cơ quan cấp xã</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" value="{{ $item->so_luong }}" id="txt-edit-soluot"
                            class="form-control"></input>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-them"
                    onclick="CapNhatKetQuaHoTroHuongDanMotCua({{ $item->id }})">Cập Nhật</button>
            </div>
        </div>
    </div>
</div>
