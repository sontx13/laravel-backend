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
                        <textarea type="text" id="txt-edit-tenxaphuong" readonly class="form-control">{{$item->ten_xaphuong}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Họ tên, chức vụ, đơn vị cán bộ, đoàn viên được phân công</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea rows="4" id="txt-edit-hoten" class="form-control">{{$item->ho_ten}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Ngày báo cáo</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" value="{{$item->date}}" id="datepicker">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số lượt người dân, tổ chức làm thủ tục tại bộ phận một cửa (trong ngày)</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" value="{{$item->so_luot}}" id="txt-edit-soluot" class="form-control"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số người, tổ chức tham gia đánh giá khảo sát (trong ngày)</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" value="{{$item->so_nguoi}}" id="txt-edit-songuoi" class="form-control"></input>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-them" onclick="CapNhatKetQuaHoTroHuongDanMotCua({{$item->id}})">Cập Nhật</button>
            </div>
        </div>
    </div>
</div>