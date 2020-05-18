<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Whazzup extends Model
{
    protected $fillable = [
        'vid',
		'callsign',
		'aircraft',
		'departure_time',
		'route',
		'rmk',
		'lat',
		'lng',
		'departure',
		'destination'
        ];
    }
