<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DmNhomCk extends Model
{

    public $table = 'dm_nhom_ck';

    public $fillable = [
        'ma_nhom',
        'noi_dung',
    ];

    protected $casts = [
        'ma_nhom' => 'string',
        'noi_dung' => 'string',
    ];


}
