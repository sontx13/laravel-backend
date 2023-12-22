<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TiepNhanPakn extends Model
{
    use SoftDeletes;

    protected $table = 'tiep_nhan_pakn';

    public function huyen()
    {
        return $this->belongsTo(DmHuyen::class, 'ma_huyen', 'id');
    }

    public function tinh()
    {
        return $this->belongsTo(DmTinh::class, 'ma_tinh', 'id');
    }

    public function xa()
    {
        return $this->belongsTo(DmPhuongxa::class, 'ma_huyen', 'id');
    }

    public function files()
    {
        return $this->hasMany('App\Models\PaknFile', 'id_pakn', 'id');
    }
}
