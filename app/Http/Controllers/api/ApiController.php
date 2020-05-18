<?php

namespace App\Http\Controllers;

use App\Airport;
use App\Code;
use App\Whazzup;

use Illuminate\Http\Request;

use App\Http\Resources\Api as ApiResource;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Whazzup::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function oaci($oaci)
    {
        $airport = Airport::where('oaci', '=', $oaci)->first();
        if ($airport === null) {
            return response()->json([
                'error' => 'Traffic not found'
            ], 404);        
        }else{
            return new ApiResource($airport->code);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $callsign)
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
        return reponse()->json($final_code);
    }

    public function generate($codes){
        foreach ($codes as $key => $code) {
            $squawk_table[] = random_int($code->min_value,$code->max_value);
        }
        return $squawk_table[array_rand($squawk_table)];
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

/*    *
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response*/

public function destroy($id)
{
        //
}
}
