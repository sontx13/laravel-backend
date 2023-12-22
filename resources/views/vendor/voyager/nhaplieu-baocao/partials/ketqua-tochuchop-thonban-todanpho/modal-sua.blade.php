<div class="modal fade" id="suaKetQuaToChucHopThonBanToDanPhoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
          <span class="modal-title">Cập nhật kết quả tổ chức họp thôn bản tổ dân phố</h5>
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
                        <textarea type="text" id="txt-edit-tenxaphuong-10" readonly
                                  class="form-control">{{$item->ten_xaphuong}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Tổng số thôn, bản, tổ dân phố</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-edit-tongsothonban-10" class="form-control"
                               value="{{$item->tongso_thonban}}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số thôn, bản, tổ dân phố tổ chức họp toàn thể 1 năm/ lần</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-edit-sothonbanhop1nam1lan-10" class="form-control"
                               value="{{$item->sothonban_hop1nam1lan}}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số thôn, bản, tổ dân phố tổ chức họp toàn thể 1 năm/ 2 lần</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-edit-sothonbanhop1nam2lan-10" class="form-control"
                               value="{{$item->sothonban_hop1nam2lan}}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số thôn, bản, tổ dân phố tổ chức họp toàn thể khác</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-edit-sothonbanhopkhac-10" class="form-control"
                               value="{{$item->sothonban_hopkhac}}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Ghi chú</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-edit-ghichu-10" class="form-control">{{$item->ghi_chu}}</textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-them"
                        onclick="CapNhatKetQuaToChucHopThonBanToDanPho({{$item->id}})">Cập Nhật
                </button>
            </div>
        </div>
    </div>
</div>
