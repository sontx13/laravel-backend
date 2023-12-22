<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DmDoituong extends Model
{
	use SoftDeletes;
	protected $table = 'dm_doituong';
}
