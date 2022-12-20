<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Coordinate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class BusController extends Controller
{
    public function index(){
        try {
            $data = Bus::where('status', true)->get();
            return response()->json($data, Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

    }
    public function show($id){
        try {
            $data = Bus::where('status', true)->where('id', $id)->get();
            return response()->json($data, Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function busesWithTheyPaths(){
        try {
            $buses = Bus::where('status', true)->get();
            $responseArray=array();
            foreach($buses as $bus){
                $ida = Coordinate::where('bus_id', $bus->id)->where('coming_back', 0)->get();
                $vuelta = Coordinate::where('bus_id', $bus->id)->where('coming_back', 1)->get();
                $data = array(
                    "bus" => $bus,
                    "paths" => array(
                        "ida" => $ida,
                        "vuelta" => $vuelta
                    )
                );
                array_push($responseArray,$data);
            }
            return response()->json($responseArray,Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
