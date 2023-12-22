<div class="modal fade" id="suaKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title">Cập nhật kết quả hoạt động của ban giám sát đầu tư của cộng đồng</h5>
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
                    <textarea type="text" id="txt-edit-tenxaphuong-8" readonly class="form-control">{{$item->ten_xaphuong}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số công trình, dự án trên địa bàn</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-socongtrinh-8" class="form-control">{{$item->so_congtrinh}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số cuộc giám sát</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-socuocgiamsat-8" class="form-control">{{$item->socuoc_giamsat}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Phát hiện số sai phạm/vụ việc </span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-phathiensosaipham-8" class="form-control">{{$item->phathien_sosaipham}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số vụ việc kiến nghị</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-sovuvieckiennghi-8" class="form-control">{{$item->sovuviec_kiennghi}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Thu hồi tiền (đồng)</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-thuhoitien-8" class="form-control">{{$item->thuhoi_tien}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Giảm trừ quyết toán (đồng)</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-giamtruquyettoan-8" class="form-control">{{$item->giamtru_quyettoan}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Xử lý khác (đồng)</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-xulykhac-8" class="form-control">{{$item->xuly_khac}}</textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary btn-them" onclick="CapNhatKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong({{$item->id}})">Cập Nhật</button>
        </div>
      </div>
    </div>
</div>
