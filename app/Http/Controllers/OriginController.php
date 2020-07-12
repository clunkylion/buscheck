<?php

namespace App\Http\Controllers;

use App\Origin;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OriginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $origin = Origin::all();
        return response()->json([ 
            "data" => $origin,
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
        $origin = Origin::create($request->all());
        return response()->json([
            "message" => "Origen creada correctamente",
            "data" => $origin,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function show(Origin $origin)
    {
        //
        return response()->json([
            "data" => $origin,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
        $origin=Origin::findOrFail($id);
        $origin->update($request->all());
        return response()->json([
            "message" => "Datos del origen actualizados",
            "data" => $origin,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Origin $origin)
    {
        //
        $origin->delete();
        return response()->json([
            "message" => "Datos del origen eliminados",
            "data" => $origin,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
}
