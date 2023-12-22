    {{-- Kết quả huy động vốn xây dựng hạ tầng cơ sở --}}
    <div class="modal fade" id="themoiKetQuaHuyDongVonXayDungHaTangCoSoModal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-large-size modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title">Thêm mới kết quả huy động vốn xây dựng hạ tầng cơ sở</h5>
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
                            <textarea id="txt-tenxaphuong-5" readonly class="form-control">{!! auth()->user()->donvi->ten_donvi !!}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Tên công trình (cuộc vận động) <span class="required">(*)</span></span>
                        </div>
                        <div class="col-sm-9">
                            <textarea type="text" id="txt-tencongtrinh-5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Tổng giá trị </span>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="txt-tonggiatri-5" class="form-control money" placeholder="VNĐ" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Nhân dân đóng góp</span>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="txt-nhandandonggop-5" class="form-control money"
                                placeholder="VNĐ" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Nhà nước hỗ trợ</span>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="txt-nhanuochotro-5" class="form-control money"
                                placeholder="VNĐ" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <span>Ghi chú</span>
                        </div>
                        <div class="col-sm-9">
                            <textarea type="text" id="txt-ghichu-5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        < @php
                            $curMonth = date('m', time());
                            $curQuarter = ceil($curMonth / 3);
                        @endphp <div class="col-sm-3">
                            <span>Quý</span>
                    </div>
                    <div class="col-sm-9">
                        <select id="quarter-5" class="select2">
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
                        <select id="year-5" class="select2">
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
                    onclick="ThemMoiKetQuaHuyDongVonXayDungHaTangCoSo()">Thêm</button>
            </div>
        </div>
    </div>
    </div>
