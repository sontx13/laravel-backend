<div class="modal fade" id="themoiKetQuaHoTroHuongDanMotCuaModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Thêm mới báo cáo kết quả hướng dẫn người dân thực hiện khảo sát</h5>
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
                        <textarea id="txt-tenxaphuong" readonly class="form-control">{!! auth()->user()->donvi->ten_donvi !!}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Họ tên, chức vụ, đơn vị cán bộ, đoàn viên được phân công</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea rows="5" id="txt-hoten" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Ngày báo cáo</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="datepicker">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số lượt người dân, tổ chức làm thủ tục tại bộ phận một cửa (trong ngày)</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-soluot" class="form-control"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số người, tổ chức tham gia đánh giá khảo sát (trong ngày)</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-songuoi" class="form-control"></input>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-them" onclick="ThemMoiKetQuaHoTroHuongDanMotCua()">Thêm
                </button>
            </div>
        </div>
    </div>
</div>