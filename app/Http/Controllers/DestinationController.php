<?php

namespace App\Http\Controllers;

use App\Destination;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $destination = Destination::all();
        return response()->json([ 
            "data" => $destination,
            "status" => Response::HTTP_OK,
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
        $destination = Destination::create($request->all());
        return response()->json([
            "message" => "Destino creada correctamente",
            "data" => $destination,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        //
        return response()->json([
            "data" => $destination,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        //
        $destination = Destination::findOrFail($id);
        $destination->update($request->all());
        return response()->json([
            "message" => "Datos del Destino actualizados",
            "data" => $destination,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {
        //
        $destination->delete();
        return response()->json([
            "message" => "Datos del Destino eliminados",
            "data" => $destination,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
}
