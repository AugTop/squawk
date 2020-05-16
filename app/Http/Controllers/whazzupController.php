<?php

namespace App\Http\Controllers;

use App\Whazzup;

use Illuminate\Http\Request;

class WhazzupController extends Controller
{
	public function refresh(){
		
		$file = file_get_contents("http://api.ivao.aero/getdata/whazzup/whazzup.txt", "r");
		$rows1 = explode("!CLIENTS", $file);
		$rows = explode("!AIRPORTS", $rows1[1]);
		$users_online = explode("\n", $rows[0]);
		foreach ($users_online as $user) {
			$users[] = explode(":", $user);
		}
		whazzup::truncate();
		unset($users[0]);
		array_pop($users);
		foreach ($users as $pilot) {
			if($pilot[3] == "PILOT"){
				if(strlen($pilot[22])<=3){
					$pilot[22] = str_pad($pilot[22], 4, "0", STR_PAD_LEFT);
				}
				$entry = new Whazzup();
				$entry->create([
					'vid' => $pilot[1],
					'callsign' => $pilot[0],
					'aircraft' => $pilot[9],
					'departure_time' => $pilot[22],
					'route' => $pilot[30],
					'rmk' => $pilot[29],
					'lat' => $pilot[5],
					'lng' => $pilot[6],
					'departure' => $pilot[11],
					'destination' => $pilot[13],
				]);	
			}

		}
		
		return view('refresh');
	}


}
