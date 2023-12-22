<div class="modal fade" id="themoiDonThuKhieuNaiToCaoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Thêm mới đơn thư khiếu nại tố cáo</span>
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
                        <textarea id="txt-tenxaphuong-9" readonly class="form-control">{!! auth()->user()->donvi->ten_donvi !!}</textarea>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số đơn thư khiếu nại tố cáo đã tiếp nhận trong kỳ báo cáo</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-sodonthudatiepnhantrongkybaocao-9" class="form-control"
                            required></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số đơn thư khiếu nại tố cáo đã tiếp nhận tính từ đầu năm</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-sodonthudatiepnhantinhtudaunam-9" class="form-control"
                            required></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số đơn thư khiếu nại tố cáo đã được giải quyết trong kỳ báo cáo</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-sodonthudagiaiquyettrongkybaocao-9" class="form-control"
                            required></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số đơn thư khiếu nại tố cáo đã được giải quyết tính từ đầu năm</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-sodonthudagiaiquyettinhtudaunam-9" class="form-control"
                            required></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Tổng số đơn thư khiếu nại, tố cáo chưa được giải quyết</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-tongsodonthuchuagiaiquyet-9" class="form-control"
                            required></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Ghi chú</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-ghichu-9" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="row">
                    @php
                        $curMonth = date('m', time());
                        $curQuarter = ceil($curMonth / 3);
                    @endphp
                    <div class="col-sm-3">
                        <span>Quý</span>
                    </div>
                    <div class="col-sm-9">
                        <select id="quarter-9" class="select2">
                            <option value="1" {{ $curQuarter == 1 ? 'selected' : '' }}>Quý 1</option>
                            <option value="2" {{ $curQuarter == 2 ? 'selected' : '' }}>Quý 2</option>
                            <option value="3" {{ $curQuarter == 3 ? 'selected' : '' }}>Quý 3</option>
                            <option value="4" {{ $curQuarter == 4 ? 'selected' : '' }}>Quý 4</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    @php
                        $years = range(2022, 2030);
                        $currentYear = date('Y'); // Lấy năm hiện tại
                    @endphp
                    <div class="col-sm-3">
                        <span>Năm</span>
                    </div>
                    <div class="col-sm-9">
                        @php
                            $years = range(2022, 2030);
                        @endphp
                        <select id="year-9" class="select2">
                            @foreach ($years as $year)
                                <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                    {{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btn-them" onclick="ThemMoiDonThuKhieuNaiToCao()">Thêm
                </button>
            </div>
        </div>
    </div>
</div>
