{{-- Nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định --}}
<div class="modal fade" id="themoiNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinhModal" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Thêm mới nhân dân bàn, biểu quyết, cơ quan có thẩm quyền quyết định</h5>
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
                        <textarea id="txt-tenxaphuong-3" readonly class="form-control">{!! auth()->user()->donvi->ten_donvi !!}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Nội dung công việc <span class="required">(*)</span></span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-noidungcongviec-3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Cơ quan chủ trì </span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-coquanchutri-3" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Hình thức bàn</span>
                    </div>
                    <div class="col-sm-9">
                        <select id="txt-hinhthucban-3" class="form-control">
                            <option value="0">Hội nghị</option>
                            <option value="1">Phát phiếu</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Loại công việc</span>
                    </div>
                    <div class="col-sm-9">
                        <select id="txt-loaicongviec-3" class="form-control">
                            <option value="0">Hương ước, quy ước của thôn, tổ dân phố</option>
                            <option value="1">Bãi, miễn nhiệm, bãi nhiệm trưởng thôn, tổ trưởng tổ dân phố</option>
                            <option value="2">Bầu, bãi nhiệm thành viên Ban thanh tra nhân dân</option>
                            <option value="3">Bầu, bãi nhiệm Ban giám sát đầu tư của cộng đồng</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số phương án được chuẩn bị</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-sophuongan-3" class="form-control"></input>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Kết quả biểu quyết</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-ketquabieuquyet-3" class="form-control"></textarea>
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
                        <select id="quarter-3" class="select2">
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
                        <select id="year-3" class="select2">
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
                    onclick="ThemMoiNhanDanBanBieuQuyetCoQuanCoThamQuyenQuyetDinh()">Thêm</button>
            </div>
        </div>
    </div>
</div>
