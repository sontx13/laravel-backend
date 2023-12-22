<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DmHuyen extends Model
{
	use SoftDeletes;
	protected $table = 'dm_huyen';
}
