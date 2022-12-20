<div>
    <head>
        <link rel="stylesheet" href="{{asset('css/modal.css')}}">
        <link rel="stylesheet" href="{{asset('css/tabla.css')}}">
    </head>
    <div class="card">
        <div class="card-header"> 
              <a class="btn btn-primary btb-sm" wire:click="crear()" >Registrar Modelo</a>    
        </div>
      </div>
    
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="dataTables_length" id="clientes_length">
                <label>
                  Ver: 
                  <select wire:model='cant' name="clientes_lenght" aria-controls="clientes" class="form-select form-select-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select>
                   Ordenar:
                   <select wire:model='ordenar' name="clientes_lenght" aria-controls="clientes" class="form-select form-select-sm">
                    <option value="asc">Ascendente</option>
                    <option value="desc">Descendente</option>
                  </select>
                </label>
              </div>
              
            </div>
            <div class="col-sm-12 col-md-6">
              <div id="clientes_filter" class="dataTables_filter">
                <label>
                  Buscar:
                  <input placeholder="Nombre del rubro" wire:model="search" type="search" class="form-control form-control-sm">
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <table class="table table-striped" id="clientes" >
              <thead>
                <tr>
                  <th scope="col">Codigo</th>
                  <th scope="col">Nombre del modelo</th>
                  <th scope="col" width="20%">Acciones</th>
                </tr>
              </thead>
              
              <tbody>
      
                @foreach ($modelos as $modelo)
                  <tr>
                    <td>{{$modelo->id}}</td>
                    <td>{{$modelo->model}}</td>
                    
                    <td >
                        <a class="btn btn-info btn-sm" wire:click="modalEdit('{{$modelo->id}}')">Ver o Editar</a> 
                          <button wire:click="modalDestroy('{{$modelo->id}}')" class="btn btn-danger btn-sm">Eliminar</button>
                    </td>    
                  </tr>
                @endforeach
              </tbody> 
      
            </table>
            
          </div>
          <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="clientes_paginate">
                  @if ($modelos->hasPages())
                      <div class="px-6 py-3">
                          {{ $modelos->links() }}
                      </div>
                  @endif
                </div>
              </div>
          </div>
          
        </div>
      </div>
      @if ($modalCrear)
    <div class="modald">
        <div class="modald-contenido">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Crear Rubro</h4>
                    </div>
                    <div class="modal-body">
                        <h5>Nombre del Modelo:</h5>
                        <input type="text" wire:model="model" class="form-control">
                        @error('model')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cancelar</button>
                        <button type="button" class="btn btn-primary" wire:click="store()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
  
      @if ($modalDestroy)
      <div class="modald">
        <div class="modald-contenido">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
  
            <div class="card-header">
                <div class="d-flex align-items-center text-center justify-content-center">
                  <h5>¿Estás seguro?</h5>
                </div>
            </div>
  
            <div class="modal-body">
                <div align="center">
                    <button type="button" class="btn btn-secondary btn-sm my-2 mx-2" wire:click="cancelar()">Cancelar</button>
                    <button wire:click="destroy()" class="btn btn-danger btn-sm my-2 mx-2">Eliminar</button>
                </div>
            </div>
            
          </div>
        </div>
        </div>  
      </div>
      @endif
  
      @if ($modalEdit)
      <div class="modald">
        <div class="modald-contenido">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">Crear Rubro</h4>
            </div>
            <div class="modal-body">
                <h5>Nombre del rubro:</h5>
                <input type="text" wire:model="model" class="form-control">
                @error('model')
                  <small class="text-danger">Campo Requerido</small>
                @enderror
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cancelar</button>
              <button type="button" class="btn btn-primary" wire:click="update()">Actualizar</button>
            </div>
          </div>
        </div>
      </div> 
      </div>  
      @endif
</div>
