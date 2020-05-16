<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airports extends Model
{
	protected $fillable = ['name', 'oaci'];
}
