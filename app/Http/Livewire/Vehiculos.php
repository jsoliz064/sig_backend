<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Vehicle;
use App\Bus;
use App\CarModel;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Vehiculos extends Component
{
    
    use WithPagination,WithFileUploads;
    public $file;
    public $search = "";
    public $cant = 10;
    public $vehiculo=[];
    public $vehiculo_id;
    public $ordenar='desc';
    public $modalDestroy=false;
    public $modalEdit=false;
    public $modalCrear=false;

    public function render()
    {
        $vehiculos = Vehicle::where('plate', 'like', '%' . $this->search . '%')
            ->orderBy('id', $this->ordenar)
            ->simplePaginate($this->cant);
        $lineas=Bus::all();
        $modelos=CarModel::all();
        return view('livewire.vehiculos',compact('vehiculos','lineas','modelos'));
    }
    public function crear(){
        $this->modalCrear=true;
    }
    public function store()
    {
        $this->validate([
            'vehiculo.contact'=>'required',
            'vehiculo.plate'=>'required',
            'vehiculo.seats'=>'required',
            'vehiculo.bus_id'=>'required',
            'vehiculo.car_model_id'=>'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        $imagenes = $this->file->store('files', 'public');
        $this->vehiculo['photo'] =Storage::url($imagenes);
        Vehicle::create($this->vehiculo);
        $this->limpiar();
    }
    
    public function modalDestroy($id){
        $this->vehiculo['id']=$id;
        $this->modalDestroy=true;
    }
    public function modalEdit($id){
        $this->modalEdit=true;
        $this->vehiculo_id=$id;
        $this->vehiculo=Vehicle::find($id)->toArray();
    }

    public function update(){
        $this->validate([
            'vehiculo.contact'=>'required',
            'vehiculo.plate'=>'required',
            'vehiculo.seats'=>'required',
            'vehiculo.bus_id'=>'required',
            'vehiculo.car_model_id'=>'required',
        ]);
        $vehiculo=Vehicle::find($this->vehiculo['id']);
        if ($this->file!==null){
            $ruta = "public".$vehiculo->photo;
            if (file_exists("../".$ruta)){
                unlink("../".$ruta);
            }
            $imagenes = $this->file->store('files', 'public');
            $vehiculo->photo =Storage::url($imagenes);
        }
        
        $vehiculo->contact=$this->vehiculo['contact'];
        $vehiculo->plate=$this->vehiculo['plate'];
        $vehiculo->seats=$this->vehiculo['seats'];
        $vehiculo->bus_id=$this->vehiculo['bus_id'];
        $vehiculo->car_model_id=$this->vehiculo['car_model_id'];
        $vehiculo->save();

        $this->limpiar();
    }
    public function limpiar(){
        $this->vehiculo=[];
        $this->modalEdit=false;
        $this->modalDestroy=false;
        $this->modalCrear=false;
        $this->file=null;
    }

    public function cancelar(){
        $this->limpiar();
    }
    public function destroy()
    {
        $vehiculo=Vehicle::find($this->vehiculo['id']);
        $ruta = "public".$vehiculo->photo;
            if (file_exists("../".$ruta)){
                unlink("../".$ruta);
            }
        $vehiculo->delete();
        $this->modalDestroy=false;
    }

    
}
