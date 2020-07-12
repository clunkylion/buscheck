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

class BusPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $photos = BusPhoto::join('buses', 'buses.id', '=', 'bus_photos.busId')
        ->select('bus_photos.*', 'buses.patent', 'buses.brand', 'buses.model')->get();
        return response()->json([
            "photos" => [$photos],
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
        $bus = Bus::find($request->idBus);
        $routePhoto = public_path('busPhotos/'.$bus->id);
        foreach ( $request->file('photo') as $photos){
            $urlFoto = 'bus/'.$bus->id.'.'.$photos->extension();
            $photos->move($routePhoto, $urlFoto);
            $photos = BusPhoto::create([
                "photo" => $photos,
                "busId" => $bus->id,
                "driverId" => $bus->driverId,
                "enterpriseId" => $bus->enterpriseId
            ]);
        }
        return response()->json([
            "message" => "Fotos Agregadas Correctamente",
            "photos" => [$photos], 
            "status" => Response::HTTP_OK
        ], 200);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\BusPhoto  $busPhoto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $photos = BusPhoto::join('buses', 'buses.id', '=', 'bus_photos.busId')
        ->select('bus_photos.*', 'buses.patent', 'buses.brand', 'buses.model')
        ->where('bus_photos.id', '=', $id)->get();
        if ($photos->isEmpty()) {
            return response()->json([
                "message" => "No encontrado", 
                "status" => Response::HTTP_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }else{    
            return response()->json([
                "data" => $photos,
                "status" => Response::HTTP_OK
            ], Response::HTTP_OK);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusPhoto  $busPhoto
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
        $routePhoto = public_path('/busPhotos'.'/');
        $newPhoto = BusPhoto::find($id);
        $bus = Bus::findOrFail($request->idBus);
        foreach ( $request->file('photo') as $photos){
            $urlFoto = time().'-bus'.$bus->id.'.'.$photos->extension();
            $photos->move($routePhoto, $urlFoto);
            $newPhoto->update([
                "foto" => $photos,
                "idBus" => $bus->id,
                "idChofer" => $bus->driverId,
                "idEmpresa" => $bus->enterpriseid
            ]);
        }
        return response()->json([
            "message" => "Fotos Agregadas Correctamente",
            "fotosData" => [$photos],
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusPhoto  $busPhoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusPhoto $busPhoto)
    {
        //
    }
}
