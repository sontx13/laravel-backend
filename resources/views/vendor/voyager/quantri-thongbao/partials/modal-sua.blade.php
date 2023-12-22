<div class="modal fade" id="suaThongBaoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title">Sửa thông báo</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-3">
                    <span>Tiêu đề </span>
                </div>
                <div class="col-sm-9">
                    <textarea id="txt-edit-tieude" class="form-control">{{$item->tieu_de}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Nội dung </span>
                </div>
                <div class="col-sm-9">
                    <textarea id="txt-edit-noidung" class="form-control">{{$item->noi_dung}}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Dữ liệu </span>
                </div>
                <div class="col-sm-9">
                    <textarea id="txt-edit-dulieu" class="form-control">{{$item->du_lieu}}</textarea>
                </div>
            </div>
            <!--
            <div class="row">
                <div class="col-sm-3">
                    <span>Danh sách người nhận </span>
                </div>
                <div class="col-sm-9 cbx-nguoinhan">
                    <select id="txt-edit-dsnguoinhan" class="form-control select2" multiple="multiple">
                        @foreach ($lsUsers as $user)
                            @if (in_array($user->id, $dsNguoiNhan))
                                <option selected value="{{$user->id}}">{{$user->name}}</option>
                            @else
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
             -->
            <div class="row">
                <div class="col-sm-3">
                    <span>Danh sách nhóm nhận </span>
                </div>
                <div class="col-sm-9 edit-dsnhomnhan">
                    @foreach ($lsRoles as $role)
                    <div>
                        @if(in_array($role->name, $dsNhomNhan))
                            <input type="checkbox" role="{{$role->name}}" checked/>{{$role->display_name}}
                        @else
                            <input type="checkbox" role="{{$role->name}}"/>{{$role->display_name}}
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <button type="button" class="btn btn-primary btn-them" onclick="CapNhatThongBao({{$item->id}})">Cập nhật</button>
        </div>
      </div>
    </div>
</div>
