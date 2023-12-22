<div class="modal fade" id="suaNhanDanKiemTraGiamSatModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title">Cập nhật nhân dân kiểm tra giám sát</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-3">
                    <span>Nội dung giám sát</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-noidunggiamsat-6" class="form-control">{{$item->noidung_giamsat}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Cơ quan thực hiện</span>
                </div>
                <div class="col-sm-9">
                    <select id="txt-edit-coquanthuchien-6" class="form-control">
                        @foreach ($lsCoQuanThucHiens as $value => $text)
                            @if ($item->coquan_thuchien == $value)
                                <option selected value="{{$value}}">{{$text}}</option>
                            @else
                                <option value="{{$value}}">{{$text}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số ý kiến sau giám sát Với cấp ủy</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-soykiencapuy-6" class="form-control">{{$item->soykien_capuy}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số ý kiến sau giám sát Với chính quyền</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-soykienchinhquyen-6" class="form-control">{{$item->soykien_chinhquyen}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số ý kiến sau giám sát khác</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-soykienkhac-6" class="form-control">{{$item->soykien_khac}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Ghi chú</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-ghichu-6" class="form-control">{{$item->ghi_chu}}</textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary btn-them" onclick="CapNhatNhanDanKiemTraGiamSat({{$item->id}})">Cập Nhật</button>
        </div>
      </div>
    </div>
</div>
