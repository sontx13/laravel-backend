<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KetquaThuchienCongkhaiNew extends Model
{
    use SoftDeletes;
    protected $table = 'ketqua_thuchien_congkhai_new';
    public function donvi()
    {
        return $this->belongsTo('App\Models\DonVi', 'donvi_id', 'id')->select('id', 'id_donvi_cha', 'ten_donvi');
    }
    public function nhom()
    {
        return $this->belongsTo('App\Models\DmNhomCk', 'nhom_congkhai', 'id')->select('id', 'noi_dung', 'ma_nhom');
    }
    public function muc()
    {
        return $this->belongsTo('App\Models\DmMucCk', 'muc_congkhai', 'id')->select('id', 'noi_dung', 'ma_muc', 'ms_nd');
    }
}
