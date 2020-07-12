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
        $hour = Hour::select('hours.id', 'hours.hour', 'origins.id','origins.originStation', 'origins.originCity',
                'destinations.id','destinations.destinationStation', 'destinations.destinationCity')
                ->from('hours')
                ->join('origins', function($query){
                    $query->on('origins.id', '=', 'hours.originId');
                })
                ->join('destinations', function($query){
                    $query->on('destinations.id', '=', 'hours.destinationId');
                })->get();
        return response()->json([
            "message" => "Lista de Horarios",
            "data" => [
                "hour" => $hour
            ],
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
            "originStation" => $request->input('stationOrigin'),
            "originCity" => $request->input('cityOrigin')
        ]);
        $destination = Destination::create([
            "destinationStation" => $request->input('stationDestination'),
            "destinationCity" => $request->input('cityDestination')
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
        $hour = Hour::select('hours.id', 'hours.hour', 'origins.id','origins.originStation', 'origins.originCity',
            'destinations.id','destinations.destinationStation', 'destinations.destinationCity')
            ->from('hours')
            ->join('origins', function($query){
                $query->on('origins.id', '=', 'hours.originId');
            })
            ->join('destinations', function($query){
                $query->on('destinations.id', '=', 'hours.destinationId');
            })
            ->where('hours.id', '=', $id)->get();
        if ($hour->isEmpty()) {
            return response()->json([
                "message" => "No encontrado", 
                "status" => Response::HTTP_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }else{
            return response()->json([
                "data" => [
                    "hour" => $hour
                ],
                "status" => Response::HTTP_OK
            ], Response::HTTP_OK);
        };
        
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
        $hour = Hour::findOrFail($id);
        $originId = $hour->originId;
        $destinationId = $hour->destinationId;
        $origin = Origin::find($originId);
        $destination = Destination::find($destinationId);
        $origin->update([
            "originStation" => $request->input('stationOrigin'),
            "originCity" => $request->input('cityOrigin')
        ]);
        $destination->update([
            "destinationStation" => $request->input('stationDestination'),
            "destinationCity" => $request->input('cityDestination')
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
