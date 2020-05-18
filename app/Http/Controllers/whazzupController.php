<?php

namespace App\Http\Controllers;

use App\Whazzup;
use Session;

use Illuminate\Http\Request;

class WhazzupController extends Controller
{
	//Function to retrieve whazzup data
	public function refresh(){
		
		$file = file_get_contents("http://api.ivao.aero/getdata/whazzup/whazzup.txt", "r");
		$rows1 = explode("!CLIENTS", $file);
		$rows = explode("!AIRPORTS", $rows1[1]);
		$users_online = explode("\n", $rows[0]);
		foreach ($users_online as $user) {
			$users[] = explode(":", $user);
		}
		//Deletion of previous data
		whazzup::truncate();
		//Removes the title of the section
		unset($users[0]);
		array_pop($users);
		//foreach of all users
		foreach ($users as $pilot) {
			//we check if the customer is a pilot
			if($pilot[3] == "PILOT"){
				//I process the data in hours to add to it.
				$flight_time = strtotime($pilot[24].':'.$pilot[25]);
				$departure_time = strtotime($pilot[22]);
				$arrival_time = date('Hi',$departure_time+$flight_time);
				//new record 
				$entry = new whazzup();
				$entry->create([
					'vid' => $pilot[1],
					'callsign' => $pilot[0],
					'aircraft' => $pilot[9],
					'rule' => $pilot[21],
					'departure_time' => $pilot[22],
					'destination_time' => $arrival_time,
					'route' => $pilot[30],
					'rmk' => $pilot[29],
					'lat' => $pilot[5],
					'lng' => $pilot[6],
					'departure' => $pilot[11],
					'destination' => $pilot[13],
					'alternate' => $pilot[28],
				]);	
			}

		}
		//We redirect to the home with a flash validation message
		Session::flash('status', "All is up-date !");
		return redirect()->back();

	}


}
