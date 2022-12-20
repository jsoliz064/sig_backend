<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\LicenseCategory;
use App\User;
use App\Bus;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Vehicle;
use App\Driver;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Choferes extends Component
{
    use WithPagination,WithFileUploads;
   
    public $search = "";
    public $cant = 10;
    public $user=[];
    public $user_id;
    public $ordenar='desc';
    public $modalDestroy=false;
    public $modalEdit=false;
    public $modalCrear=false;
    public $modalVehiculo=false;
    public $vehiculo_id;
    public $vehiculos;
    public $novehiculos;

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', $this->ordenar)
            ->simplePaginate($this->cant);
        $licencias=LicenseCategory::all();
        $buses=Bus::all();
        
        return view('livewire.choferes',compact('users','licencias','buses'));
    }
    public function crear(){
        $this->user['gender']=1;
        $this->user['admin']=0;
        $this->modalCrear=true;
    }
    public function store()
    {
        $this->validate([
            'user.ci'=>'required',
            'user.email'=>'required',
            'user.name'=>'required',
            'user.license_category_id'=>'required',
            'user.gender'=>'required',
            'user.password'=>'required',
            ]);
        User::create([
            'admin'=>$this->user['admin'],
            'ci'=>$this->user['ci'],
            'email'=>$this->user['email'],
            'gender'=>$this->user['gender'],
            'name'=>$this->user['name'],
            'phone'=>$this->user['phone'],
            'license_category_id'=>$this->user['license_category_id'],
            'bus_id'=>$this->user['bus_id'],
            'password'=>Hash::make($this->user['password']),
        ]);
        $this->limpiar();
    }
    
    public function modalDestroy($id){
        $this->user['id']=$id;
        $this->modalDestroy=true;
    }
    public function modalEdit($id){
        $this->modalEdit=true;
        $this->user_id=$id;
        $this->user=User::find($id)->toArray();
    }
    public function modalVehiculo($id){
        $this->modalVehiculo=true;
        $this->user_id=$id;
        $this->novehiculos=Vehicle::whereNotIn('id',Driver::select('vehicle_id')->where('user_id',$this->user_id))->get();
        $this->vehiculos=Vehicle::whereIn('id',Driver::select('vehicle_id')->where('user_id',$this->user_id))->get();
    }
    public function storeDrive(){
        Driver::create([
            'inDate' =>Carbon::today()->format('Y-m-d'),
            'outDate' =>Carbon::today()->format('Y-m-d'),
            'taken' =>0,
            'status' =>1,
            'user_id' =>$this->user_id,
            'vehicle_id' =>$this->vehiculo_id,
        ]);
        $this->novehiculos=Vehicle::whereNotIn('id',Driver::select('vehicle_id')->where('user_id',$this->user_id))->get();
        $this->vehiculos=Vehicle::whereIn('id',Driver::select('vehicle_id')->where('user_id',$this->user_id))->get();
    }
    public function eliminarDrive($vehiculo_id){
        $driver = Driver::where('vehicle_id',$vehiculo_id)
                ->where('user_id',$this->user_id)
                ->get()->first();
        $driver->delete();
        $this->novehiculos=Vehicle::whereNotIn('id',Driver::select('vehicle_id')->where('user_id',$this->user_id))->get();
        $this->vehiculos=Vehicle::whereIn('id',Driver::select('vehicle_id')->where('user_id',$this->user_id))->get();
    }
        public function update(){
        $this->validate([
            'user.ci'=>'required',
            'user.email'=>'required',
            'user.gender'=>'required',
            'user.name'=>'required',
            'user.license_category_id'=>'required',
            'user.password'=>'required',
        ]);
        $user=User::find($this->user['id']);

        $user->admin=$this->user['admin'];
        $user->ci=$this->user['ci'];
        $user->email=$this->user['email'];
        $user->gender=$this->user['gender'];
        $user->name=$this->user['name'];
        $user->phone=$this->user['phone'];
        $user->license_category_id=$this->user['license_category_id'];
        $user->bus_id=$this->user['bus_id'];
        $user->password=Hash::make($this->user['password']);
        $user->save();
        $this->limpiar();
    }
    public function limpiar(){
        $this->user=[];
        $this->user_id=null;
        $this->modalEdit=false;
        $this->modalDestroy=false;
        $this->modalCrear=false;
        $this->modalVehiculo=false;
        $this->file=null;
    }

    public function cancelar(){
        $this->limpiar();
    }
    public function destroy()
    {
        $user=User::find($this->user['id']);
        
        $user->delete();
        $this->modalDestroy=false;
    }
}
