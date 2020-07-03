<?php

namespace App\Http\Controllers;

use App\Destination;
use App\Hour;
use App\Origin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class HourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hour = DB::table('hours')
        ->join('origins', 'origins.id', '=', 'hours.originId')
        ->join('destinations', 'destinations.id', '=', 'hours.destinationId')
        ->select('*')->get();
        dd($hour);
        die();
        
        return response()->json([
            "message" => "Lista de Horarios",
            "data" => $hour,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
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
        $origin = Origin::create([
            "busStation" => $request->input('stationOrigin'),
            "city" => $request->input('cityOrigin')
        ]);
        $destination = Destination::create([
            "busStation" => $request->input('stationDestination'),
            "city" => $request->input('cityDestination')
        ]);
        $hour = Hour::create([
            "date" => $request->input('date'),
            "hour" => $request->input('hour'),
            "originId" => $origin->id,
            "destinationId" => $destination->id,
        ]);
        return response()->json([
            "message" => "Horario de Recorrido Creado",
            "data" => [
                "origin" => $origin,
                "destination" => $destination,
                "hour" => $hour
            ] ,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hour  $hour
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $hour = DB::table('hours')
        ->join('origins', 'origins.id', '=', 'hours.originId')
        ->join('destinations', 'destinations.id', '=', 'hours.destinationId')
        ->where('hours.id', '=', $id)->get();
        return response()->json([
            "data" => $hour,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hour  $hour
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
        $hour = Hour::find($id);
        $originId = $hour->originId;
        $destinationId = $hour->destinationId;
        $origin = Origin::find($originId);
        $destination = Destination::find($destinationId);
        $origin->update([
            "busStation" => $request->input('stationOrigin'),
            "city" => $request->input('cityOrigin')
        ]);
        $destination->update([
            "busStation" => $request->input('stationDestination'),
            "city" => $request->input('cityDestination')
        ]);
        $hour->update([
            "date" => $request->input('date'),
            "hour" => $request->input('hour'),
            "originId" => $origin->id,
            "destinationId" => $destination->id,
        ]);
        return response()->json([
            "message" => "Horario de Recorrido Actualizado",
            "data" => [
                "origin" => $origin,
                "destination" => $destination,
                "hour" => $hour
            ],
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hour  $hour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hour $hour)
    {
        //
    }
}
