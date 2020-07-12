<?php

namespace App\Http\Controllers;

use App\Driver;
use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver = Driver::join('people', 'people.id', '=', 'drivers.peopleId')
        ->select('drivers.id', 'people.rut', 'people.name', 'people.lastName', 'people.phone', 'people.email')->get();
        return response()->json([
            "data" => [
                "driver" => $driver,
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
        $people = People::create([
            "rut" => $request->input('rut'),
            "name" => $request->input('name'),
            "lastName" => $request->input('lastName'),
            "phone" => $request->input('phone'),
            "email" => $request->input('email'),
            "sex" => $request->input('sex'),
            "dateBirth" => $request->input('dateBirth'),
        ]);
        $driver = Driver::create([
            "driverStatus" => $request->input('driverStatus'),
            "enterpriseId" => $request->input('enterpriseId'),
            "peopleId" => $people->id
        ]);

        return response()->json([
            "message" => "Chofer creado correctamente",
            "data" => [
                "people" => $people,
                "driver" => $driver
            ],
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driver = Driver::join('people', 'people.id', '=' , 'drivers.peopleId')
        ->select('drivers.id', 'people.rut', 'people.name', 'people.lastName', 'people.phone', 'people.email', 'people.dateBirth')
        ->where('drivers.id', '=', $id)->get();
        return response()->json([
            "data" => [
                "driver" => $driver
            ],
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        //
        $driver = Driver::find($id);
        $peopleId = $driver->peopleId;
        $people = People::find($peopleId);
        $people->update([
            "rut" => $request->input('rut'),
            "name" => $request->input('name'),
            "lastName" => $request->input('lastName'),
            "phone" => $request->input('phone'),
            "email" => $request->input('email'),
            "sex" => $request->input('sex'),
            "dateBirth" => $request->input('dateBirth'),
        ]);
        $driver->update([
            "driverStatus" => $request->input('driverStatus'),
        ]);
        return response()->json([
            "message" => "Chofer actualizado correctamente",
            "data" => $driver,
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $driver = Driver::find($id);
        $peopleId = $driver->peopleId;
        $people = People::find($peopleId);
        $people->delete();
        $driver->delete();
        return response()->json([
            "message" => "Chofer eliminado Correctamente",
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }
}
