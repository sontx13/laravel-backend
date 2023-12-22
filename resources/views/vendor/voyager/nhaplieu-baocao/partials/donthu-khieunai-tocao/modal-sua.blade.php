<div class="modal fade" id="suaDonThuKhieuNaiToCaoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title">Cập nhật đơn thư khiếu nại tố cáo</h5>
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
                    <textarea type="text" id="txt-edit-tenxaphuong-9" readonly class="form-control">{{$item->ten_xaphuong}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số đơn thư khiếu nại tố cáo đã tiếp nhận trong kỳ báo cáo</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-sodonthudatiepnhantrongkybaocao-9" class="form-control">{{$item->sodonthu_datiepnhan_trongkybaocao}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số đơn thư khiếu nại tố cáo đã tiếp nhận tính từ đầu năm</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-sodonthudatiepnhantrongtinhtudaunam-9" class="form-control">{{$item->sodonthu_datiepnhan_tinhtudaunam}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số đơn thư khiếu nại tố cáo đã được giải quyết trong kỳ báo cáo</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-sodonthudagiaiquyettrongkybaocao-9" class="form-control">{{$item->sodonthu_dagiaiquyet_trongkybaocao}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Số đơn thư khiếu nại tố cáo đã được giải quyết tính từ đầu năm</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-sodonthudagiaiquyettinhtudaunam-9" class="form-control">{{$item->sodonthu_dagiaiquyet_tinhtudaunam}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Tổng số đơn thư khiếu nại, tố cáo chưa được giải quyết</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-tongsodonthuchuagiaiquyet-9" class="form-control">{{$item->tongso_donthu_chuaduocgiaiquyet}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Ghi chú</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-ghichu-9" class="form-control">{{$item->ghi_chu}}</textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary btn-them" onclick="CapNhatDonThuKhieuNaiToCao({{$item->id}})">Cập Nhật</button>
        </div>
      </div>
    </div>
</div>
