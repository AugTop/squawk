<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Code;

use Illuminate\Http\Request;

class AirportsController extends Controller
{	
	public function index(){
		$airports = Airport::all();
		return view('airports.index', ['airports' => $airports]);	
	}


	public function add(Request $request){

		$data = request()->validate([
			'name' => 'required',
			'oaci' => 'required|unique:airports|max:4',
			'min' => 'required|array',
			'min.*' => ['max:9999','integer','gt:0010'],
			'max' => 'required|array',
			'max.*' => ['max:9999','integer','gte:min.*','lt:7777'],
		]);
		// Combine min_value and max_value in 1 array
		$codes = array_combine(request('min'), request('max'));
		$airport = new Airport();
		$airport->name = request('name');
		$airport->oaci = request('oaci');
		$airport->save();
		// Save codes with airport_id
		foreach ($codes as $min => $max) {
			$code = new Code();
			$code->min_value = $min;
			$code->max_value = $max;
			$code->airport_id = $airport->id;
			$code->save();
		}
		
		return redirect()->action('AirportsController@index')->with('status', 'The airport has indeed been added !');
	}

	public function edit($id){
		$airport = Airport::where('id',$id)->firstOrFail() ;
		return view('airports.edit', ['airport' => $airport]);
	}

	public function update(Airport $airport){

		$data = request()->validate([
			'name' => 'required',
			'oaci' => 'required|max:4',
			'min' => 'required|array',
			'min.*' => ['max:9999','integer','gt:0010'],
			'max' => 'required|array',
			'max.*' => ['max:9999','integer','gte:min.*','lt:7777'],
		]);
		
		$airport->update($data);
		$codes = array_combine(request('min'), request('max'));
		$code = new Code();
		// Deletion of existing data to avoid duplication
		$code->where('airport_id', $airport->id)->delete();
		foreach($codes as $min => $max) {
			$code = new Code();
			$code->min_value = $min;
			$code->max_value = $max;
			$code->airport_id = $airport->id;
			$code->save();
		}
		return redirect()->action('AirportsController@index')->with('status', 'The airport has indeed been modified !');
	}
	
	public function destroy(Airport $airport){
		$airport->delete();
		return redirect()->action('AirportsController@index')->with('status', 'The airport has indeed been deleted !');
	}
}
