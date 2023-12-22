<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhandanBanBieuquyetCoquanCothamquyenQuyetdinh extends Model
{
    use SoftDeletes;
    protected $table = 'nhandan_ban_bieuquyet_coquan_cothamquyen_quyetdinh';
    public function donvi()
    {
        return $this->belongsTo('App\Models\DonVi', 'donvi_id', 'id')->select('id','id_donvi_cha', 'ten_donvi');
    }
}
