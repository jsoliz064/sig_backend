<?php

namespace App\Http\Controllers;
use App\Driver;
use App\User;
use App\Vehicle;
use App\Bus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    public function login(Request $request){
        $loValidator = Validator::make($request->all(), [
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);
        $loResponseArr=array();
        if ($loValidator->fails()) {
            $loResponseArr['data']=[];
            $loResponseArr['message'] = $loValidator->errors();
            return response()->json($loResponseArr,Response::HTTP_BAD_REQUEST);
        }

        $loUser=User::where('email',$request->email)->get()->first();
        $buses = Vehicle::whereIn('id', Driver::select('vehicle_id')->where('user_id',$loUser->id)->where('taken',false)->get())->get();

        if ($loUser->admin == 1){
            $loResponseArr['data']=[];
            $loResponseArr['message'] = '¡Este no es un login para administradores!';
        }
        else{
            if (Hash::check($request->password, $loUser->password)){
                $loResponseArr['message'] = '¡El usuario se ha loggeado correctamente!';
                //$loResponseArr['token'] = $loUser->createToken('myapptoken')->plainTextToken;
                $loResponseArr['user'] = $loUser;
                $loResponseArr['Bus'] = Bus::where('id', $loUser->bus_id)->first();
                $loResponseArr['vehiculos'] =Vehicle::whereIn('id',Driver::select('vehicle_id')->where('user_id',$loUser->id)->where('taken',false))->get();
                return response()->json($loResponseArr,Response::HTTP_OK);
            }
            else{
                $loResponseArr['data']=[];
                $loResponseArr['message'] = '¡La credenciales es incorrectas!';
            }
        }
        return response()->json($loResponseArr,Response::HTTP_UNAUTHORIZED);
    }

    public function adminLogin(Request $request){
        $loValidator = Validator::make($request->all(), [
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);
        $loResponseArr=array();
        if ($loValidator->fails()) {
            $loResponseArr['data']=[];
            $loResponseArr['message'] = $loValidator->errors();
            return response()->json($loResponseArr,Response::HTTP_BAD_REQUEST);
        }

        $loUser=User::where('email',$request->email)->get()->first();

        if ($loUser->admin == 0){
            $loResponseArr['data']=[];
            $loResponseArr['message'] = '¡Este es un login para administradores!';
        }
        else{
            if (Hash::check($request->password, $loUser->password)){
                $loResponseArr['message'] = '¡El usuario se ha loggeado correctamente!';
                //$loResponseArr['token'] = $loUser->createToken('myapptoken')->plainTextToken;
                $loResponseArr['data'] = $loUser;

                return response()->json($loResponseArr,Response::HTTP_OK);
            }
            else{
                $loResponseArr['data']=[];
                $loResponseArr['message'] = '¡La credenciales es incorrectas!';
            }
        }
        return response()->json($loResponseArr,Response::HTTP_UNAUTHORIZED);
    }


}
