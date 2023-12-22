<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KetquaHuydongvonXaydungHatangcoso extends Model
{
    use SoftDeletes;
    protected $table = 'ketqua_huydongvon_xaydung_hatangcoso';
    public function donvi()
    {
        return $this->belongsTo('App\Models\DonVi', 'donvi_id', 'id')->select('id','id_donvi_cha', 'ten_donvi');
    }
}
