<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Driver;
use App\Enterprise;
use App\Hour;
use App\TotalSale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TotalSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $totalSale =  TotalSale::select('total_sales.*','buses.patent', 'buses.model', 'enterprises.enterpriseName', 'users.username', 'users.role', 'hours.hour')
        ->from('total_sales')
        ->join('buses', function($query){
            $query->on('buses.id', '=', 'total_sales.busId');
        })
        ->join('enterprises', function($query){
            $query->on('enterprises.id', '=', 'total_sales.enterpriseId');
        })
        ->join('users', function($query){
            $query->on('users.id', '=', 'total_sales.userId');
        })
        ->join('hours', function($query){
            $query->on('hours.id', '=', 'total_sales.hourId');
        })
        ->latest('total_sales.id')->get();
        //$totalSale = TotalSale::all();
        return response()->json([
            "message" => "Total de Ventas",
            "data" => $totalSale,
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
        $totalSale = TotalSale::create($request->all());
        return response()->json([
            "message" => "Total de venta creado",
            "data" => $totalSale,
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TotalSale  $totalSale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $totalSale = TotalSale::findOrFail($id);
        $user = User::findOrFail($totalSale->userId);
        $driver = Driver::findOrFail($totalSale->driverId);
        $bus = Bus::findOrFail($totalSale->busId);
        $enterprise = Enterprise::findOrFail($totalSale->enterpriseId);
        $hour = Hour::findOrFail($totalSale->hourId);
        return response()->json([
            "message" => "Total de Ventas N°".$id,
            "data" => [
                "totalSale" => $totalSale,
                "User" => $user,
                "driver" => $driver,
                "bus" => $bus,
                "enterprise" => $enterprise,
                "hour" => $hour,
            ],
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TotalSale  $totalSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TotalSale $totalSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TotalSale  $totalSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(TotalSale $totalSale)
    {
        //
    }
}
