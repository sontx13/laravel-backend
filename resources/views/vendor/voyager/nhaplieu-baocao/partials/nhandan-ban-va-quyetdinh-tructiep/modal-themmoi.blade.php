{{-- Nhân dân bàn và quyết định trực tiếp --}}
<div class="modal fade" id="themoiNhanDanBanVaQuyetDinhTrucTiepModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Thêm mới nhân dân bàn và quyết định trực tiếp</h5>
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
                        <textarea id="txt-tenxaphuong-2" readonly class="form-control">{!! auth()->user()->donvi->ten_donvi !!}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Nội dung <span class="required">(*)</span></span>
                    </div>
                    <div class="col-sm-9">
                        <select id="txt-noidungcongviec-2" class="form-control">
                            <option value="Chủ trương, mức đóng góp xây dựng cơ sở hạ tầng, công trình công cộng">Chủ
                                trương, mức đóng góp xây dựng cơ sở hạ tầng, công trình công cộng</option>
                            <option value="Việc thu, chi, quản lý khoản đóng góp của Nhân dân">Việc thu, chi, quản lý
                                khoản đóng góp của Nhân dân</option>
                            <option value="Việc thu, chi, quản lý các khoản kinh phí, tài sản được giao quản lý">Việc
                                thu, chi, quản lý các khoản kinh phí, tài sản được giao quản lý</option>
                            <option
                                value="Việc thu, chi, quản lý các khoản kinh phí, tài sản được tiếp nhận từ các nguồn thu, tài trợ, ủng hộ hợp pháp khác">
                                Việc thu, chi, quản lý các khoản kinh phí, tài sản được tiếp nhận từ các nguồn thu,
                                tài trợ, ủng hộ hợp pháp khác</option>
                            <option value="Các công việc tự quản khác">Các công việc tự quản khác</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Tóm tắt nội dung <span class="required">(*)</span></span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-tomtatnoidung-2" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Cơ quan chủ trì </span>
                    </div>
                    <div class="col-sm-9">
                        <textarea type="text" id="txt-coquanchutri-2" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Hình thức bàn</span>
                    </div>
                    <div class="col-sm-9">
                        <select id="txt-hinhthucban-2" class="form-control">
                            <option value="0">Hội nghị</option>
                            <option value="1">Phát phiếu</option>
                            <option value="2">Biểu quyết</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Số phương án được chuẩn bị</span>
                    </div>
                    <div class="col-sm-9">
                        <input type="number" id="txt-sophuongan-2" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <span>Kết quả biểu quyết</span>
                    </div>
                    <div class="col-sm-3" style="display:flex;align-items: center;">
                        <span style="width:50%">Số phiếu</span>
                        <input type="text" id="txt-sophieu-2" onkeyup="formatInputNumber('txt-sophieu-2')"
                            class="form-control">
                    </div>
                    <div class="col-sm-6"style="display:flex;align-items: center;">
                        <span style="width:60%">Tổng số hộ gia đình</span>
                        <input type="text" id="txt-tongso-2" onkeyup="formatInputNumber('txt-tongso-2')"
                            class="form-control">
                    </div>

                </div>
                <div class="card-giatri">
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Tổng giá trị</span>
                        </div>
                        <div class="col-sm-9 flex-algin">
                            <input type="text" id="txt-tonggiatri-2" onkeyup="formatInputNumber('txt-tonggiatri-2')"
                                class="form-control"><span style="margin-left:1rem">VNĐ</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Nhân dân đóng góp</span>
                        </div>
                        <div class="col-sm-4 flex-algin">
                            <input type="text" id="txt-nddg-2" onkeyup="formatInputNumber('txt-nddg-2')"
                                class="form-control" />
                            <span style="margin-left:1rem">VNĐ</span>
                        </div>
                        <div class="col-sm-1">
                            <span>NSNN</span>
                        </div>
                        <div class="col-sm-4 flex-algin">
                            <input type="text" id="txt-nsnn-2" onkeyup="formatInputNumber('txt-nsnn-2')"
                                class="form-control" />
                            <span style="margin-left:1rem">VNĐ</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Ngày công đóng góp</span>
                        </div>
                        <div class="col-sm-4 flex-algin">
                            <input type="text" id="txt-ngaycong-2" class="form-control"
                                onkeyup="formatInputNumber('txt-ngaycong-2')" />
                            <span style="margin-left:1rem"> ngày</span>
                        </div>
                        <div class="col-sm-1">
                            <span>Khác</span>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" id="txt-khac-2" class="form-control" />
                        </div>
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
                        <select id="quarter-2" class="select2">
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
                        <select id="year-2" class="select2">
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
                    onclick="ThemMoiNhanDanBanVaQuyetDinhTrucTiep()">Thêm</button>
            </div>
        </div>
    </div>
</div>
<style>
    .flex-algin {
        display: flex;
    }

    .card-giatri {
        margin: 0.5rem 1rem;
        border: 1px solid #cdcdcd85;
        padding: 1rem;
    }
</style>
