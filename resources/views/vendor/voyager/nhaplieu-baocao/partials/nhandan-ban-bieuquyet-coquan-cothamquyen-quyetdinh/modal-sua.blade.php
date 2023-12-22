<div class="modal fade" id="suaNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title">Cập nhật nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định</h5>
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
                    <textarea type="text" id="txt-edit-tenxaphuong-3" readonly class="form-control">{{$item->ten_xaphuong}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Nội dung công việc <span class="required">(*)</span></span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-noidungcongviec-3" class="form-control">{{$item->noidung_congviec}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Cơ quan chủ trì </span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-coquanchutri-3" class="form-control">{{$item->coquan_chutri}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Hình thức bàn</span>
                </div>
                <div class="col-sm-9">
                    <select id="txt-edit-hinhthucban-3" class="form-control">
                        @foreach ($lsHinhThucs as $value => $text)
                            @if ($item->hinhthuc_ban == $value)
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
                    <span>Số phương án được chuẩn bị</span>
                </div>
                <div class="col-sm-9">
                    <input type="number" id="txt-edit-sophuongan-3" class="form-control">{{$item->so_phuongan}}</input>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Kết quả biểu quyết</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-ketquabieuquyet-3" class="form-control">{{$item->ketqua_bieuquyet}}</textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary btn-them" onclick="CapNhatNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh({{$item->id}})">Cập Nhật</button>
        </div>
      </div>
    </div>
</div>
