<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\CarModel;
use Livewire\WithPagination;

class Modelos extends Component
{
    use WithPagination;

    public $search = "";
    public $cant = 10;
    public $model;
    public $modelo_id;
    public $ordenar='desc';

    public $modalDestroy=false;
    public $modalEdit=false;
    public $modalCrear=false;

    public function render()
    {
        $modelos = CarModel::where('model', 'like', '%' . $this->search . '%')
            ->orderBy('id', $this->ordenar)
            ->simplePaginate($this->cant);
        return view('livewire.modelos',compact('modelos'));
    }
    public function crear(){
        $this->modalCrear=true;
    }
    public function store()
    {

        $this->validate([
            'model'=>'required',
        ]);
        //$id=CarModel::all()->last()->rub_id;
        CarModel::create([
            'model'=>$this->model,
        ]);
        $this->limpiar();
    }
    
    public function modalDestroy($id){
        $this->modelo_id=$id;
        $this->modalDestroy=true;
    }
    public function modalEdit($id){
        $this->modalEdit=true;
        $this->modelo_id=$id;
        $modelo=CarModel::find($this->modelo_id);
        $this->model=$modelo->model;
    }

    public function update(){
        $this->validate([
            'model'=>'required',
        ]);
        $modelo=CarModel::find($this->modelo_id);
        $modelo->model=$this->model;
        $modelo->save();

        $this->limpiar();
    }
    public function limpiar(){
        $this->model=null;
        $this->modelo_id=null;
        $this->modalEdit=false;
        $this->modalDestroy=false;
        $this->modalCrear=false;
    }

    public function cancelar(){
        $this->limpiar();
    }
    public function destroy()
    {
        $modelo=CarModel::find($this->modelo_id);
        $modelo->delete();
        $this->modalDestroy=false;
    }
}
