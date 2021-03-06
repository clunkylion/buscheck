<?php

namespace App\Http\Controllers;

use App\Enterprise;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ticket = Ticket::join('users', 'users.id', '=', 'tickets.userId')
        ->select('tickets.*', 'users.username', 'users.role', 'users.busId')->get();
        return response()->json([
            "data" => $ticket,
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
        $ticket = Ticket::create($request->all());
        return response()->json([
            "message" => "Boleto generado correctamente",
            "data" => $ticket,
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::join('users', 'users.id', '=', 'tickets.userId')
        ->select('tickets.*', 'users.username', 'users.role', 'users.busId')
        ->where('tickets.id', '=', $id)->get();
        if ($ticket->isEmpty()) {
            return response()->json([
                "message" => "No encontrado", 
                "status" => Response::HTTP_NOT_FOUND
            ], Response::HTTP_NOT_FOUND);
        }else{
            return response()->json([
                "data" => [
                    "ticket" => $ticket
                ],
                "status" => Response::HTTP_OK
            ],Response::HTTP_OK);
        }    
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        //
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());
        return response()->json([
            "message" => "Boleto actualizado correctamente",
            "data" => $ticket,
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
