<?php

namespace App\Http\Controllers;

use App\TotalSale;
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
        $totalSale =  DB::table('total_sales')
        ->join('drivers', 'drivers.id', '=', 'total_sales.driverId')
        ->join('buses', 'buses.id', '=', 'total_sales.busId')
        ->join('enterprises', 'enterprises.id', '=', 'total_sales.enterpriseId')
        ->join('hours', 'hours.id', '=', 'total_sales.hourId')
        ->get();
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
        //
        $totalSale =  DB::table('total_sales')
        ->join('drivers', 'drivers.id', '=', 'total_sales.driverId')
        ->join('buses', 'buses.id', '=', 'total_sales.busId')
        ->join('enterprises', 'enterprises.id', '=', 'total_sales.enterpriseId')
        ->join('hours', 'hours.id', '=', 'total_sales.hourId')
        ->where('total_sales.id'. '=', $id)
        ->get();
        return response()->json([
            "message" => "Total de Ventas :".$id,
            "data" => $totalSale,
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
