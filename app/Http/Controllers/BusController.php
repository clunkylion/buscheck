<?php

namespace App\Http\Controllers;

use App\Bus;
use App\BusPhoto;
use App\Driver;
use App\Enterprise;
use App\Hour;
use App\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bus = DB::table('buses')->select('buses.*')->get();
        return response()->json([
            "data" => [
                "bus" => $bus,
            ],
            "status" =>Response::HTTP_OK
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
        $bus = Bus::create([
            "status" => $request->input('status'),
            "patent" => $request->input('patent'),
            "brand" => $request->input('brand'),
            "model" => $request->input('model'),
            "numSeats" => $request->input('numSeats'),
            "technicalReview" => $request->input('technicalReview'),
            "driverId" => $request->input('driverId'),
            "hourId" => $request->input('hourId'),
            "enterpriseId" => $request->input('enterpriseId')
        ]);
        $routePhoto = public_path().'/busPhotos/';
        foreach ($request->file('photo') as $photos) {
            $urlFoto = 'bus'.$bus->id.'.'.$photos->extension();
            $name = $photos->getClientOriginalName();
            $photos->move($routePhoto, $urlFoto);
            $photos = BusPhoto::create([
                "status" => "ok", 
                "photo" => $name,
                "busId" => $bus->id,
                "driverId" => $request->input('driverId'),
                "enterpriseId" => $request->input('enterpriseId') 
            ]);
        }
        $seatsCant = $request->input('numSeats');
        for ($i=1; $i <= (int)$seatsCant ; $i++) { 
            $seat = Seat::create([
                "number" => $i,
                "busId" => $bus->id,
                "driverId" => $bus->driverId,
                "enterpriseId" => $bus->enterpriseId
            ]);
        }
        return response()->json([
            "message" => "Nuevo Bus Registrado",
            "data" => [
                "bus" => $bus,
                "seat" => $seat,
                "photos" => [$photos]
            ],
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $bus = Bus::findOrFail($id);
        $driver = Driver::find($bus->driverId);
        $enterprise = Enterprise::find($bus->enterpriseId);
        $hour = Hour::find($bus->hourId);
        $seat = Seat::select('number', 'status')->where('busId', '=', $id)->get();
        return response()->json([
            "data" => [
                "bus" => $bus,
                "driver" => $driver,
                "enterprise" => $enterprise,
                "hour" => $hour,
                "seats" => [$seat]
            ],
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
        $bus = Bus::findOrFail($id);
        $bus->update($request->all());
        return response()->json([
            "message" => "Bus actualizado",
            "data" => [
                "bus" => $bus
            ],
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        //
    }
}
