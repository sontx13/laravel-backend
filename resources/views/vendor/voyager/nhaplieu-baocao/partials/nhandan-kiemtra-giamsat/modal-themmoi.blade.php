     {{-- Nhân dân kiểm tra, giám sát --}}
     <div class="modal fade" id="themoiNhanDanKiemTraGiamSatModal" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-large-size modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <span class="modal-title">Thêm mới nhân dân kiểm tra giám sát</span>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-3">
                             <span>Nội dung giám sát</span>
                         </div>
                         <div class="col-sm-9">
                             <textarea type="text" id="txt-noidunggiamsat-6" class="form-control"></textarea>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-sm-3">
                             <span>Cơ quan thực hiện<span class="required">(*)</span></span>
                         </div>
                         <div class="col-sm-9">
                             <select id="txt-coquanthuchien-6" class="form-control">
                                 <option selected value="0">Ban thanh tra nhân dân</option>
                                 <option value="1">Ban giám sát đầu tư của cộng đồng</option>
                                 <option value="3">Khác</option>
                             </select>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-sm-3">
                             <span>Số kiến nghị sau giám sát Với cấp ủy</span>
                         </div>
                         <div class="col-sm-9">
                             <input type="number" id="txt-soykiencapuy-6" class="form-control"></input>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-sm-3">
                             <span>Số kiến nghị sau giám sát Với chính quyền</span>
                         </div>
                         <div class="col-sm-9">
                             <input type="text" id="txt-soykienchinhquyen-6" class="form-control"></input>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-sm-3">
                             <span>Số kiến nghị sau giám sát khác</span>
                         </div>
                         <div class="col-sm-9">
                             <input type="text" id="txt-soykienkhac-6" class="form-control"></input>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-sm-3">
                             <span>Ghi chú</span>
                         </div>
                         <div class="col-sm-9">
                             <textarea type="text" id="txt-ghichu-6" class="form-control"></textarea>
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
                             <select id="quarter-6" class="select2">
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
                             <select id="year-6" class="select2">
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
                         onclick="ThemMoiNhanDanKiemTraGiamSat()">Thêm</button>
                 </div>
             </div>
         </div>
     </div>
