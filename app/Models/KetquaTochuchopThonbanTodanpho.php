<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KetquaTochuchopThonbanTodanpho extends Model
{
    use SoftDeletes;
    protected $table = 'ketqua_tochuchop_thonban_todanpho';
    public function donvi()
    {
        return $this->belongsTo('App\Models\DonVi', 'donvi_id', 'id')->select('id','id_donvi_cha', 'ten_donvi');
    }
}
