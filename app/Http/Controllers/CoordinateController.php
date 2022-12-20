<?php

namespace App\Http\Controllers;

use App\Coordinate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CoordinateController extends Controller
{
//    public function index(){
//        $data = Coordinate::where('status', true)->get();
//        return response()->json($data, Response::HTTP_OK);
//    }
    public function show($id, $comingback){
        try {
            $data = Coordinate::where('status', true)->where('bus_id', $id)->where('coming_back', $comingback)->get();
            return response()->json($data, Response::HTTP_OK);
        }catch (\Exception $e){
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
