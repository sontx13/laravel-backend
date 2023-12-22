<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonthuKhieunaiTocao extends Model
{
    use SoftDeletes;
    protected $table = 'donthu_khieunai_tocao';
    public function donvi()
    {
        return $this->belongsTo('App\Models\DonVi', 'donvi_id', 'id')->select('id','id_donvi_cha', 'ten_donvi');
    }
}
