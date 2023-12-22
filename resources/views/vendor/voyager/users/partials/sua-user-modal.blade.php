<div class="modal fade" id="suaUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-large-size modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title">Sửa người dùng</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-3">
                    <span>Họ tên </span><span class="required">(*)</span>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="txt-edit-hoten" class="form-control" value="{{$user->name}}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Tên đăng nhập</span><span class="required">(*)</span>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="txt-edit-tendangnhap" class="form-control" value="{{$user->username}}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Đơn vị</span><span class="required">(*)</span>
                </div>
                <div class="col-sm-9 width-full">
                    <select id="txt-edit-dvi" class="form-control select2">
                        @foreach ($donvis as $donvi)
                            @if ($user->donvi_id == $donvi->id)
                                <option selected value="{{$donvi->id}}">{{$donvi->ten_donvi}}</option>
                            @else
                                <option value="{{$donvi->id}}">{{$donvi->ten_donvi}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Đơn vị phụ</span>
                </div>
                <div class="col-sm-9 width-full">
                    <select id="txt-edit-donviphu" class="form-control" multiple="multiple">
                        @foreach ($donvis as $donvi)
                            @if (in_array($donvi->id, $donviphus))
                                <option selected value="{{$donvi->id}}">{{$donvi->ten_donvi}}</option>
                            @else
                                <option value="{{$donvi->id}}">{{$donvi->ten_donvi}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Vai trò </span><span class="required">(*)</span>
                </div>
                <div class="col-sm-9 width-full">
                    <select id="txt-edit-vaitro" class="form-control select2">
                        @foreach ($roles as $role)
                            @if ($user->role_id == $role->id)
                                <option selected value="{{$role->id}}">{{$role->display_name}}</option>
                            @else
                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Vai trò phụ</span>
                </div>
                <div class="col-sm-9 width-full">
                    <select id="txt-edit-vaitrophu" class="form-control select2" multiple="multiple">
                        @foreach ($roles as $role)
                            @if (in_array($role->id, $vaitrophus))
                                <option selected value="{{$role->id}}">{{$role->display_name}}</option>
                            @else
                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Địa chỉ</span>
                </div>
                <div class="col-sm-9 width-full">
                    <input type ="text" id="txt-edit-diachi" class="form-control" value="{{$user->dia_chi}}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <span>Là cán bộ</span>
                </div>
                <div class="col-sm-9 width-full">
                    <select id="txt-edit-iscanbo" class="form-control select2">
                        @if ($user->is_canbo == App\Enums\LoaiNguoiDungEnum::CanBo)
                            <option value="0">Không</option>
                            <option selected value="1">Có</option>
                        @else
                            <option selected value="0">Không</option>
                            <option value="1">Có</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-primary btn-them" onclick="UpdateUser({{$user->id}})">Lưu</button>
        </div>
      </div>
    </div>
</div>
