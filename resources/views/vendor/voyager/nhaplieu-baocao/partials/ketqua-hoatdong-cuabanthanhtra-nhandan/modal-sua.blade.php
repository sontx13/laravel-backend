<div class="modal fade" id="suaKetQuaHoatDongCuaBanThanhTraNhanDanModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title">Cập nhật kết quả hoạt động của ban thanh tra nhân dân</h5>
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
                    <textarea type="text" id="txt-edit-tenxaphuong-7" readonly class="form-control">{{$item->ten_xaphuong}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số cuộc giám sát</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-socuocgiamsat-7" class="form-control">{{$item->socuoc_giamsat}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Phát hiện số sai phạm/vụ việc </span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-phathiensosaipham-7" class="form-control">{{$item->phathien_sosaipham}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số vụ việc kiến nghị</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-sovuvieckiennghi-7" class="form-control">{{$item->sovuviec_kiennghi}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Thu hồi tiền (đồng)</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-thuhoitien-7" class="form-control">{{$item->thuhoi_tien}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Xử lý khác về tiền (đồng)</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-xulykhacvetien-7" class="form-control">{{$item->xulykhac_vetien}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Thu hồi đất (m2)</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-thuhoidat-7" class="form-control">{{$item->thuhoi_dat}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Xử lý khác về đất (m2)</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-xulykhacvedat-7" class="form-control">{{$item->xulykhac_vedat}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Kiến nghị xử lý bất cập, vướng mắc về quy định pháp luật (nêu cụ thể)</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-kiennghixulybatcap-7" class="form-control">{{$item->kiennghi_xulybatcap}}</textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary btn-them" onclick="CapNhatKetQuaHoatDongCuaBanThanhTraNhanDan({{$item->id}})">Cập Nhật</button>
        </div>
      </div>
    </div>
</div>
