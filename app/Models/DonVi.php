<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonVi extends Model
{
    protected $table = 'don_vi';


    public function donvicha()
    {
        return $this->belongsTo('App\Models\DonVi', 'id_donvi_cha', 'id')->select('id', 'ten_donvi');
    }
}
