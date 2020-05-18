<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
	protected $fillable = ['name', 'oaci'];

	public function code(){
		return $this->hasMany('App\Code','airport_id');
	}
}
