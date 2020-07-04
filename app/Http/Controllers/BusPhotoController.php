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
        $bus = DB::table('buses')->join('drivers', 'drivers.id', '=', 'buses.driverId')
        ->join('hours', 'hours.id' ,'=' , 'buses.hourId')
        ->get();
        $driver = DB::table('drivers')->join('people','people.id', '=', 'drivers.peopleId')->get();
        return response()->json([
            "data" => [
                "driver" => $driver,
                "bus" => $bus
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
        //rescartar foto de formulario
        $rutaFoto = public_path('FotoBuses/Bus'.$bus->id);
        $fotoArray = $request->file('photo');
        $fotosCant = count($fotoArray);
        for ($i=0; $i <$fotosCant ; $i++) { 
            $urlFoto = 'bus/'.$bus->id.'.'.$fotoArray[$i]->extension();
            $fotoArray[$i]->move($rutaFoto, $urlFoto);
            $photos = BusPhoto::create([
                //"estado" => $request->input('estado'),
                "photo" => $fotoArray[$i],
                "busId" => $bus->id,
                "driverId" => $bus->driverId,
                "enterpriseId" => $bus->enterpriseId
                ]);
        }
        $seat = Seat::create([
            "number" => $request->input('number'),
            "busId" => $bus->id,
            "driverId" => $bus->idChofer,
            "enterpriseId" => $bus->idEmpresa
        ]);
        return response()->json([
            "message" => "Nuevo Bus Registrado",
            "data" => [
                "bus" => $bus,
                "seat" => $seat,
                "photos" =>$photos
            ],
            "status" => Response::HTTP_OK
        ], Response::HTTP_OK);
    }    
        /*$files = $request->file('image');

        foreach($files as $file){
            $this->modelo::create([
                'title' => $request->title,
                'product_id' => base64_decode($request->product_id),
                'image' => $upload->upload_global($file, 'productimage'),
                'create_uid' => Auth::user()->id,
                'write_uid' => Auth::user()->id
            ]);
        }
    
    function upload_global($file, $folder){ 
    
        $file_type = $file->getClientOriginalExtension(); 
        $folder = $folder; 
        $destinationPath = public_path() . '/uploads/'.$folder; 
        $destinationPathThumb = public_path() . '/uploads/'.$folder.'thumb'; 
        $filename = uniqid().'_'.time() . '.' . $file->getClientOriginalExtension();
        $url = '/uploads/'.$folder.'/'.$filename; 
    
        if ($file->move($destinationPath.'/' , $filename)) { 
            return $filename; 
        }
    }

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
        $bus = Bus::find($id);
        $driver = Driver::find($bus->idChofer);
        $enterprise = Enterprise::find($bus->idEmpresa);
        $hour = Hour::find($bus->idHorario);
        return response()->json([
            "data" => [
            "bus" => $bus,
            "driver" => $driver,
            "enterprise" => $enterprise,
            "hour" => $hour],
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
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
        $bus = Bus::find($id);
        $bus->update([
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
        /*$butaca = DB::table('users')([
            "numero" => $request->input('numeroButacas'),
            "idBus" => $bus->id,
            "idChofer" => $bus->idChofer,
            "idEmpresa" => $bus->idEmpresa
        ]);*/
        return response()->json([
            "message" => "Datos de bus actualizados",
            "data" => $bus, 
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
