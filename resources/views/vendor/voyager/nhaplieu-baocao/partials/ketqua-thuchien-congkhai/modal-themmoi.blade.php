{{------- Modal -------------------}}
{{--  Kết quả thực hiện công khai--}}
<div class="modal fade" id="themoiKetQuaThucHienCongKhaiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <span class="modal-title">Thêm mới kết quả thực hiện công khai</h5>
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
                    <input type="text" id="txt-tenxaphuong-1" class="form-control" disabled value="{{$tendonvi}}"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Nội dung công khai <span class="required">(*)</span></span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-noidungcongkhai-1" class="form-control" rows="6"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Cơ quan t.hiện công khai </span><span class="required"> (*)</span>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="txt-coquanthuchiencongkhai-1" class="form-control"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Hình thức công khai</span>
                </div>
                <div class="col-sm-9">
                    <select id="txt-hinhthuccongkhai-1" class="form-control select2" multiple="multiple">
                        <option value="0">Niêm yết</option>
                        <option value="1">Loa truyền thanh</option>
                        <option value="2">Qua trưởng thôn, TDP</option>
                        <option value="3">Khác</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Văn bản công khai</span>
                </div>
                <div class="col-sm-3">
                    <input type="text" id="txt-sokehoachcongkhai-1" class="form-control" placeholder="Số"/>
                </div>
                <div class="col-sm-3">
                    <input type="text" id="txt-kyhieukehoachcongkhai-1" class="form-control" placeholder="Ký hiệu"/>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <div class='input-group date' id='txt-ngayvanban-1'>
                           <input type='text' class="form-control" placeholder="dd/mm/yyyy"/>
                           <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                        </div>
                     </div>
                </div>
                <div class="col-sm-3">
                </div>
                <div class="col-sm-9">
                    <input type="text" id="txt-coquanbanhanh-1" class="form-control" placeholder="Cơ quan ban hành"/>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Ngày công khai</span>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <div class='input-group date' id='txt-ngaycongkhai-1' data-date-format="dd/mm/yyyy">
                           <input type='text' class="form-control" placeholder="dd/mm/yyyy"/>
                           <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                        </div>
                     </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>File KH công khai</span>
                </div>
                <div class="col-sm-9">
                    <label for="txt-filecongkhai-1" class="custom-file-upload">
                        Chọn file
                    </label>
                    <input id="txt-filecongkhai-1" type="file" style="display:none;" onchange="ChonFileKeHoachCongKhaiUpload()"/>
                    <span id="txt-tenfilecongkhai-1" class="filename-upload">
                    </span>
                    <button type="button" class="btn btn-success" onclick="UploadFileCongKhai()">Tải lên</button>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Ghi chú</span>
                </div>
                <div class="col-sm-9">
                    <textarea type="text" id="txt-ghichu-1" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary btn-them" onclick="ThemMoiKetQuaThucHienCongKhai()">Thêm</button>
        </div>
        </div>
    </div>
</div>
