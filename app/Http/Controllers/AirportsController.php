<?php

namespace App\Http\Controllers;

use App\Airports;

use Illuminate\Http\Request;

class AirportsController extends Controller
{
	public function index(){
		$airports = Airports::all();
		return view('airports.index', ['airports' => $airports]);	
	}
	public function add(Request $request){
		$data = request()->validate([
			'name' => 'required',
			'oaci' => 'required|unique:airports|max:4',
			'min' => 'required|array',
			'min.*' => 'max:9999|integer|not_in:between:5000,7000',
			'max' => 'required|array',
			'max.*' => 'max:9999|integer|gte:min.*',
		]);
		$codes = array_combine(request('min'), request('max'));
		foreach ($codes as $min => $max) {
			var_dump($min, $max);
		}
		
		/*Airports::create($data);*/
		/*return redirect()->action('AirportsController@index')->with('status', 'The airport has indeed been added !');*/
	}

	public function edit($id){
		$airport = Airports::where('id',$id)->firstOrFail();;
		return view('airports.edit', compact('airport'));
	}

	public function update(Airports $airport){

		$data = request()->validate([
			'name' => 'required',
			'oaci' => 'required|max:4'
		]);
		
		var_dump($airport->update($data));

		return redirect()->action('AirportsController@index')->with('status', 'The airport has indeed been modified !');
	}

	public function destroy(Airports $airport){
		$airport->delete();
		return redirect()->action('AirportsController@index')->with('status', 'The airport has indeed been deleted !');
	}
}
