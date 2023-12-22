<div class="modal fade" id="themoiKetQuaToChucHopThonBanToDanPhoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Thêm mới kết quả tổ chức họp thôn bản tổ dân phố</h5>
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
                        <textarea id="txt-tenxaphuong-10" readonly class="form-control">{!! auth()->user()->donvi->ten_donvi !!}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Tổng số thôn, bản, tổ dân phố</span><strong> (1)</strong>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-tongsothonban-10" class="form-control"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số thôn, bản, tổ dân phố tổ chức họp toàn thể 1 năm/ lần</span><strong> (2)</strong>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-sothonbanhop1nam1lan-10" class="form-control"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số thôn, bản, tổ dân phố tổ chức họp toàn thể 1 năm/ 2 lần</span> <strong> (3)</strong>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-sothonbanhop1nam2lan-10" class="form-control"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số thôn, bản, tổ chức họp toàn thể khác</span> <strong> (4)</strong>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-sothonbanhopkhac-10" class="form-control"></input>
                        <span style="color: red">(*) Nếu có cần ghi rõ HÌNH THỨC HỌP vào mục GHI CHÚ</span>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Ghi chú</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-ghichu-10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    @php
                        $curMonth = date('m', time());
                        $curQuarter = ceil($curMonth / 3);
                    @endphp
                    {{-- <div class="col-sm-3">
                        <span>Quý</span>
                    </div>
                    <div class="col-sm-9">
                        <select id="quarter-10" class="select2">
                            <option value="1" {{ $curQuarter == 1 ? 'selected' : '' }}>Quý 1</option>
                            <option value="2" {{ $curQuarter == 2 ? 'selected' : '' }}>Quý 2</option>
                            <option value="3" {{ $curQuarter == 3 ? 'selected' : '' }}>Quý 3</option>
                            <option value="4" {{ $curQuarter == 4 ? 'selected' : '' }}>Quý 4</option>
                        </select>
                    </div> --}}
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
                        <select id="year-10" class="select2">
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
                    onclick="ThemMoiKetQuaToChucHopThonBanToDanPho()">Thêm
                </button>
            </div>
        </div>
    </div>
</div>
