<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmMucCk extends Model
{

    public $table = 'dm_muc_ck';

    public $fillable = [
        'ms_nd',
        'ma_muc',
        'noi_dung',
        'id_nhom',
    ];

    protected $casts = [
        'ms_nd' => 'float',
        'ma_muc' => 'string',
        'noi_dung' => 'string',
        'id_nhom' => 'float',
    ];


}
