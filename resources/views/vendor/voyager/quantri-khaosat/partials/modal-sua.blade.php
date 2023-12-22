<div class="modal fade" id="suaKhaoSatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title">Sửa khảo sát</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-3">
                    <span>Trạng thái</span>
                </div>
                <div class="col-sm-9">
                    <select id="txt-edit-trangthai" class="form-control select2">
                        @if ($item->trang_thai == App\Enums\TrangThaiKhaoSatEnum::KhongHoatDong)
                            <option selected value="0">Không Hoạt Động</option>
                            <option value="1">Hoạt Động</option>
                        @else
                            <option value="0">Không Hoạt Động</option>
                            <option selected value="1">Hoạt Động</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Ngày Bắt Đầu</span>
                </div>
                <div class="col-sm-9">
                    <input type="datetime-local" id="txt-edit-ngaybatdau" class="form-control" value="{{$item->ngay_batdaustr}}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Ngày Kết Thúc</span>
                </div>
                <div class="col-sm-9">
                    <input type="datetime-local" id="txt-edit-ngayketthuc" class="form-control" value="{{$item->ngay_ketthucstr}}">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary btn-them" onclick="CapNhatKhaoSat({{$item->id}})">Cập nhật</button>
        </div>
      </div>
    </div>
</div>
