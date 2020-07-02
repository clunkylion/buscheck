<?php

namespace App\Http\Controllers;

use App\Enterprise;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnterpriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $enterprise = Enterprise::all();
        return response()->json([ 
            "data" => $enterprise,
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
        $enterprise = Enterprise::create($request->all());
        return response()->json([
            "message" => "Empresa creada correctamente",
            "data" => $enterprise,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function show(Enterprise $enterprise)
    {
        //
        return $enterprise;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enterprise $enterprise)
    {
        //
        $enterprise->update($request->all());
        return response()->json([
            "message" => "Datos de empresa actualizados",
            "data" => $enterprise,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enterprise  $enterprise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enterprise $enterprise)
    {
        //
        $enterprise->delete();
        return response()->json([
            "message" => "Datos de empresa eliminados",
            "data" => $enterprise,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
}
