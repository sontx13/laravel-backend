<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhandanThamgiaYkien extends Model
{
    use SoftDeletes;
    protected $table = 'nhandan_thamgia_ykien';
    public function donvi()
    {
        return $this->belongsTo('App\Models\DonVi', 'donvi_id', 'id')->select('id', 'id_donvi_cha', 'ten_donvi');
    }
    public function noidung()
    {
        return $this->belongsTo('App\Models\NoidungNhandanthamgiaykien', 'noidung_xinykien', 'muc')->select('muc', 'msnd', 'noidung');
    }
}
