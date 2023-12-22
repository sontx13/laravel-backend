<div class="modal fade" id="themoiKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDongModal" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Thêm mới kết quả hoạt động của ban giám sát đầu tư của cộng đồng</h5>
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
                        <textarea id="txt-tenxaphuong-8" readonly class="form-control">{!! auth()->user()->donvi->ten_donvi !!}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số công trình, dự án trên địa bàn</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-socongtrinh-8" class="form-control"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số cuộc giám sát</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-socuocgiamsat-8" class="form-control"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Phát hiện số sai phạm</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-phathiensosaipham-8" class="form-control"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số vụ việc kiến nghị</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-sovuvieckiennghi-8" class="form-control"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Thu hồi tiền (đồng)</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="txt-thuhoitien-8" class="form-control money"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Giảm trừ quyết toán (đồng)</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="txt-giamtruquyettoan-8" class="form-control money"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Xử lý khác (đồng)</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-xulykhac-8" class="form-control money"></input>
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
                        <select id="quarter-8" class="select2">
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
                        <select id="year-8" class="select2">
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
                <button type="button" class="btn btn-primary btn-them"
                    onclick="ThemMoiKetQuaHoatDongCuaBanGiamSatDauTuCuaCongDong()">Thêm</button>
            </div>
        </div>
    </div>
</div>
