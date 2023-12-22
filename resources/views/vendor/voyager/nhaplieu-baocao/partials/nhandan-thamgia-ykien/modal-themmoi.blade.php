{{-- Nhân dân tham gia ý kiến --}}
<div class="modal fade" id="themoiNhanDanThamGiaYKienModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Thêm mới nhân dân tham gia ý kiến</h5>
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
                        <textarea id="txt-tenxaphuong-4" readonly class="form-control">{!! auth()->user()->donvi->ten_donvi !!}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Nội dung xin ý kiến Nhân dân </span>
                    </div>
                    <div class="col-sm-9">
                        <select class="select2" id='noidung' class="form-control">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Tóm tắt nội dung</span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-tomtat-4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Dự thảo xin ý kiến</span>
                        <div id="result"></div>
                    </div>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" accept=".pdf" id="txt-duthao-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Hình thức nhân dân tham gia ý kiến</span>
                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-check">
                                    <input class="form-check-input check-ykien" type="checkbox"
                                        value="Hội nghị tiếp xúc, đối thoại" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Hội nghị tiếp xúc, đối thoại
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input check-ykien" type="checkbox"
                                        value="Họp cộng đồng dân cư" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Họp cộng đồng dân cư
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input check-ykien" type="checkbox"
                                        value="Hòm thư, đường dây nóng" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Hòm thư, đường dây nóng
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input check-ykien" type="checkbox"
                                        value="Phát phiếu lấy ý kiến" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Phát phiếu lấy ý kiến
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="form-check">
                                    <input class="form-check-input check-ykien" type="checkbox"
                                        value="Thông qua Ban công tác Mặt trận và các tổ chức chính trị - xã hội"
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Thông qua Ban công tác MT và các tổ chức CT-XH
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input check-ykien" type="checkbox"
                                        value="Thông qua trang tin điện tử cấp xã" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Thông qua trang tin điện tử cấp xã
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input check-ykien" type="checkbox"
                                        value="Thông qua mạng viễn thông, mạng xã hội" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Thông qua mạng viễn thông, mạng xã hội
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input check-ykien" type="checkbox"
                                        value="Tổ chức đối thoại, lấy ý kiến công dân" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Tổ chức đối thoại, lấy ý kiến công dân
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Kế hoạch lấy ý kiến</span>
                        <div id="result"></div>
                    </div>
                    <div class="col-sm-9">
                        <form id="uploadForm" enctype="multipart/form-data">
                            <input type="file" class="form-control" accept=".pdf" id="txt-kehoach-4" />
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Thời gian lấy ý kiến</span>
                    </div>
                    <div class="col-sm-5" style="display: flex; align-items: center;">
                        <span style="width:25%">Từ ngày</span>
                        <input type="date" class="form-control" id="txt-tungay-4" />
                    </div>
                    <div class="col-sm-4" style="display: flex; align-items: center;">
                        <span style="width:25%">Đến ngày</span>
                        <input type="date" class="form-control" id="txt-denngay-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số ý kiến tham gia</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="txt-ykienthamgia-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số ý kiến tiếp thu</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="txt-ykientiepthu-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Báo cáo giải trình</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" accept=".pdf" id="txt-baocao-4" />
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
                        <select id="quarter-4" class="select2">
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
                        <select id="year-4" class="select2">
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
                    onclick="ThemMoiNhanDanThamGiaYKien()">Thêm</button>
            </div>
        </div>
    </div>
</div>
