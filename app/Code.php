<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
	public function airport(){
		return $this->belongsTo('App\Airport','id');
	}
	protected $fillable = [
		'min_value', 'max_value'
	];
}
