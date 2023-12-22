<div class="modal fade" id="suaKetQuaHuyDongVonXayDungHaTangCoSoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title">Cập nhật kết quả huy động vốn xây dựng hạ tầng cơ sở</h5>
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
                    <textarea type="text" id="txt-edit-tenxaphuong-5" readonly class="form-control">{{$item->ten_xaphuong}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Tên công trình (cuộc vận động) <span class="required">(*)</span></span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-tencongtrinh-5" class="form-control">{{$item->ten_congtrinh}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Tổng giá trị </span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-tonggiatri-5" class="form-control">{{$item->tong_giatri}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Nhân dân đóng góp </span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-nhandandonggop-5" class="form-control">{{$item->nhandan_donggop}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <span>Nhà nước hỗ trợ </span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-nhanuochotro-5" class="form-control">{{$item->nhanuoc_hotro}}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <span>Ghi chú</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-edit-ghichu-5" class="form-control">{{$item->ghi_chu}}</textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary btn-them" onclick="CapNhatKetQuaHuyDongVonXayDungHaTangCoSo({{$item->id}})">Cập Nhật</button>
        </div>
      </div>
    </div>
</div>
