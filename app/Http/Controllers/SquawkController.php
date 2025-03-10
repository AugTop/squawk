<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Code;
use App\Whazzup;

use Illuminate\Http\Request;

class SquawkController extends Controller
{
	// function for find a squawk with callsign
	public function find(){
		$data = request()->validate([
			'callsign' => 'required'
		]);
		$callsign = request()->callsign;
		$flight = Whazzup::where('callsign', '=', $callsign)->first();
		if ($flight === null) {
			// ERROR : Aircraft not online
			return back()->witherrors('The aircraft is not connected, you may refresh');
		}
		$departure_airport = $flight->departure;
		$airport = Airport::where('oaci', '=', $departure_airport)->first();
		if ($airport === null) {
			// ERROR : Unrecognized airport
			return back()->witherrors('The airport '.$departure_airport.' has not definided you can use the button above to add it');
		}
		$codes = $airport->code;
		$final_code = $this->generate($codes);
		//Check if the code is prohibited
		while(in_array($final_code, array('7500','7600','7700','7777'))){
			$final_code = $this->generate($codes);
		}
		return view('detail',['flight'=> $flight, 'code'=>$final_code]);
	}
	//Function to generate code from a range array
	public function generate($codes){
		foreach ($codes as $key => $code) {
			$squawk_table[] = random_int($code->min_value,$code->max_value);
		}
		return $squawk_table[array_rand($squawk_table)];
	}
}
