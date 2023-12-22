<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NhandanBanVaQuyetdinhTructiep extends Model
{
    use SoftDeletes;
    protected $table = 'nhandan_ban_va_quyetdinh_tructiep';
    public function donvi()
    {
        return $this->belongsTo('App\Models\DonVi', 'donvi_id', 'id')->select('id','id_donvi_cha', 'ten_donvi');
    }
}
