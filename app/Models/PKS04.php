<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PKS04 extends Model
{
    use SoftDeletes;
    protected $table = 'ketqua_hotro_huongdan_motcua_pks04';
    public function donvi()
    {
        return $this->belongsTo('App\Models\DonVi', 'donvi_id', 'id')->select('id', 'id_donvi_cha', 'ten_donvi');
    }
}
