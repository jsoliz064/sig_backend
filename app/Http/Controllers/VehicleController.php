<?php

namespace App\Http\Controllers;

use App\Coordinate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Vehicle;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    public function index(){
        return view('vehiculos.index');
    }
    public function show($id){
        try {
            $data = Vehicle::find($id);
            return response()->json($data, Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }



    public function all(){
        try {
//            $data=DB::table('vehicles')
//            ->join('drivers','drivers.vehicle_id', '<>', 'vehicles.id')
//            ->where('vehicles.tken','=',0)
//            ->select('vehicles.id','vehicles.contact','vehicles.photo','vehicles.plate','vehicles.seats','vehicles.bus_id','vehicles.car_model_id')
//            ->get()->first();
            $data = Vehicle::all();
            $data->load('bus');
            return response()->json($data, Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function vehiculosuser($id){
        try {
          //  $data = Vehicle::find($id);
            $data=DB::table('vehicles')
            ->join('buses','buses.id', '=', 'vehicles.bus_id')
            ->join('drivers','drivers.vehicle_id', '=', 'vehicles.id')
            ->where('drivers.taken','=',0)
            ->where('drivers.status','=',1)
            ->where('drivers.user_id','=',$id)
            ->get();
            return response()->json($data, Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function ruta($id){
        $loValidator = Validator::make(['id'=>$id], [
            'id' => 'required',
        ]);
        $loResponseArr=array();
        if ($loValidator->fails()) {
            $loResponseArr['message'] = $loValidator->errors();
            return response()->json($loResponseArr,Response::HTTP_BAD_REQUEST);
        }
        $vehiculo=Vehicle::find($id);
        if ($vehiculo){
            $bus=$vehiculo->bus;
            $ida= Coordinate::select('id','latitude', 'longitude','coming_back')->where('bus_id', $bus->id)->where('coming_back',0)->get();
            $vuelta= Coordinate::select('id','latitude', 'longitude','coming_back')->where('bus_id', $bus->id)->where('coming_back',1)->get();
            return response()->json(['ida'=>$ida, 'vuelta'=>$vuelta],Response::HTTP_OK);
        }
        return response()->json(['message'=>'Vehiculo no encontrado'],Response::HTTP_NOT_FOUND);
    }
}
