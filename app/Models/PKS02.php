<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PKS02 extends Model
{
    use SoftDeletes;
    protected $table = 'ketqua_hotro_huongdan_motcua_pks02';
    public function donvi()
    {
        return $this->belongsTo('App\Models\DonVi', 'donvi_id', 'id')->select('id', 'id_donvi_cha', 'ten_donvi');
    }
}
