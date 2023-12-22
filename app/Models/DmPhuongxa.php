<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DmPhuongxa extends Model
{
	use SoftDeletes;
	protected $table = 'dm_phuongxa';
}
