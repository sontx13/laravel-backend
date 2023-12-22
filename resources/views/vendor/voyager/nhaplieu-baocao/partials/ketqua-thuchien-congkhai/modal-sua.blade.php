<div class="modal fade" id="suaKetQuaThucHienCongKhaiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title">Cập nhật kết quả thực hiện công khai</h5>
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
                    <textarea type="text" id="txt-edit-tenxaphuong-1" readonly class="form-control">{{$item->ten_xaphuong}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Nội dung công khai <span class="required">(*)</span></span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-noidungcongkhai-1" class="form-control">{{$item->noidung_congkhai}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Cơ quan thực hiện công khai </span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-coquanthuchiencongkhai-1" class="form-control">{{$item->coquan_congkhai}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Hình thức công khai</span>
                </div>
                <div class="col-sm-9">
                    @php
                       $arrhinhthuc = explode(',', $item->hinhthuc_congkhai);
                    @endphp
                    <select id="txt-edit-hinhthuccongkhai-1" class="form-control select2" multiple>
                        @foreach ($lsHinhThucs as $value => $text)
                            @if (in_array($value, $arrhinhthuc))
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
                    <span>Công khai theo kế hoạch số</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-congkhaitheokehoachso-1" class="form-control">{{$item->sokehoach_congkhai}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Ghi chú</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-ghichu-1" class="form-control">{{$item->ghi_chu}}</textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary btn-them" onclick="CapNhatKetQuaThucHienCongKhai({{$item->id}})">Cập Nhật</button>
        </div>
      </div>
    </div>
</div>
