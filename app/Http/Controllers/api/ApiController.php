<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Code;
use App\Whazzup;


use App\Http\Resources\Api as ApiResource;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //GET ALL TRAFFICS IN DATABASE
    public function index()
    {
        return Whazzup::all();
    }

    // GET range of an a airport
    public function oaci($oaci)
    {
        $airport = Airport::where('oaci', '=', $oaci)->first();
        if ($airport === null) {
            return response()->json([
                'error' => 'Traffic not found'
            ], 404);        
        }else{
            return response()->json($airport->code);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($callsign)
    {
        $flight = Whazzup::where('callsign', '=', $callsign)->first();
        if ($flight === null) {
            return response()->json([
            'error' => 'Traffic not found'
        ], 404);
        }
        $departure_airport = $flight->departure;
        $airport = Airport::where('oaci', '=', $departure_airport)->first();
        if ($airport === null) {
            return response()->json([
            'error' => 'Airport not found'
        ], 404);
        }
        $codes = $airport->code;
        $final_code = $this->generate($codes);
        while(in_array($final_code, array('7500','7600','7700','7777'))){
            $final_code = $this->generate($codes);
        }
        return response()->json(['code' =>$final_code]);
    }
    //generating random code
    public function generate($codes){
        foreach ($codes as $key => $code) {
            $squawk_table[] = random_int($code->min_value,$code->max_value);
        }
        return $squawk_table[array_rand($squawk_table)];
    }

}
