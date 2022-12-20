<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\LicenseCategory;
use Livewire\WithPagination;

class Licencia extends Component
{
    use WithPagination;

    public $search = "";
    public $cant = 10;
    public $license;
    public $licencia_id;
    public $status;

    public $ordenar='desc';

    public $modalDestroy=false;
    public $modalEdit=false;
    public $modalCrear=false;

    public function render()
    {
        $licencias = LicenseCategory::where('license', 'like', '%' . $this->search . '%')
            ->orderBy('id', $this->ordenar)
            ->simplePaginate($this->cant);
        return view('livewire.licencia',compact('licencias'));
    }
    public function crear(){
        $this->modalCrear=true;
    }
    public function store()
    {

        $this->validate([
            'license'=>'required',
        ]);
        LicenseCategory::create([
            'license'=>$this->license,
        ]);
        $this->limpiar();
    }
    
    public function modalDestroy($id){
        $this->licencia_id=$id;
        $this->modalDestroy=true;
    }
    public function modalEdit($id){
        $this->modalEdit=true;
        $this->licencia_id=$id;
        $licencia=LicenseCategory::find($this->licencia_id);
        $this->license=$licencia->license;
        $this->status=$licencia->status;
    }

    public function update(){
        $this->validate([
            'license'=>'required',
            'status'=>'required',
        ]);
        $licencia=LicenseCategory::find($this->licencia_id);
        $licencia->license=$this->license;
        $licencia->status=$this->status;
        $licencia->save();

        $this->limpiar();
    }
    public function limpiar(){
        $this->license=null;
        $this->licencia_id=null;
        $this->status=null;
        $this->modalEdit=false;
        $this->modalDestroy=false;
        $this->modalCrear=false;
    }

    public function cancelar(){
        $this->limpiar();
    }
    public function destroy()
    {
        $licencia=LicenseCategory::find($this->licencia_id);
        $licencia->delete();
        $this->modalDestroy=false;
    }
}
