<div>
    <head>
        <link rel="stylesheet" href="{{asset('css/modal.css')}}">
        <link rel="stylesheet" href="{{asset('css/tabla.css')}}">
    </head>
    <div class="card">
        <div class="card-header"> 
              <a class="btn btn-primary btb-sm" wire:click="crear()" >Registrar Vehiculo</a>    
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
                  <input placeholder="placa" wire:model="search" type="search" class="form-control form-control-sm">
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <table class="table table-striped" id="clientes" >
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Contacto</th>
                  <th scope="col">Placa</th>
                  <th scope="col">Asientos</th>
                  <th scope="col">Linea</th>
                  <th scope="col">Modelo</th>
                  <th scope="col" width="20%">Acciones</th>
                </tr>
              </thead>
              
              <tbody>
      
                @foreach ($vehiculos as $vehiculo)
                  <tr>
                    <td>{{$vehiculo->id}}</td>
                    <td>{{$vehiculo->contact}}</td>
                    <td>{{$vehiculo->plate}}</td>
                    <td>{{$vehiculo->seats}}</td>
                    <td>{{$vehiculo->bus->name}}</td>
                    <td>{{$vehiculo->model->model}}</td>

                    <td>
                        <a class="btn btn-info btn-sm" wire:click="modalEdit('{{$vehiculo->id}}')">Ver o Editar</a> 
                          <button wire:click="modalDestroy('{{$vehiculo->id}}')" class="btn btn-danger btn-sm">Eliminar</button>
                    </td>    
                  </tr>
                @endforeach
              </tbody> 
      
            </table>
            
          </div>
          <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="clientes_paginate">
                  @if ($vehiculos->hasPages())
                      <div class="px-6 py-3">
                          {{ $vehiculos->links() }}
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
                  <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Registrar vehiculo</h4>
                    </div>
                    <div class="modal-body">
                        <h5>Contacto:</h5>
                        <input type="text" wire:model="vehiculo.contact" name="contact" class="form-control">
                        @error('vehiculo.contact')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Placa:</h5>
                        <input type="text" wire:model="vehiculo.plate" name="contact" class="form-control">
                        @error('vehiculo.plate')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Asientos:</h5>
                        <input type="text" wire:model="vehiculo.seats" name="seats"  class="form-control">
                        @error('vehiculo.seats')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Linea:</h5>
                        <select wire:model='vehiculo.bus_id' name="bus_id" aria-controls="clientes" class="form-select form-select-sm">
                            <option value="">Seleccione una linea</option>
                            @foreach ($lineas as $linea)
                                <option value="{{$linea->id}}">{{$linea->name}}</option>
                            @endforeach
                        </select>
                        @error('vehiculo.bus_id')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Modelo:</h5>
                        <select wire:model='vehiculo.car_model_id' name="car_model_id" aria-controls="clientes" class="form-select form-select-sm">
                            <option value="">Seleccione un modelo</option>
                            @foreach ($modelos as $modelo)
                                <option value="{{$modelo->id}}">{{$modelo->model}}</option>
                            @endforeach
                        </select>
                        @error('vehiculo.car_model_id')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Imagen:</h5>
                        <input type="file"  wire:model='file' name="file" id="url" accept="image/*" class="form-control" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cancelar</button>
                        <button type="submit" class="btn btn-primary" >Guardar</button>
                    </div>
                  </form>
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
            <form wire:submit.prevent="update" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">Editar Vehiculo</h4>
            </div>
            <div class="modal-body">
                <h5>Contacto:</h5>
                <input type="text" wire:model="vehiculo.contact" class="form-control">
                @error('vehiculo.contact')
                  <small class="text-danger">Campo Requerido</small>
                @enderror

                <h5>Placa:</h5>
                <input type="text" wire:model="vehiculo.plate" class="form-control">
                @error('vehiculo.plate')
                  <small class="text-danger">Campo Requerido</small>
                @enderror

                <h5>Asientos:</h5>
                <input type="text" wire:model="vehiculo.seats" class="form-control">
                @error('vehiculo.seats')
                  <small class="text-danger">Campo Requerido</small>
                @enderror

                <h5>Linea:</h5>
                <select wire:model='vehiculo.bus_id' name="clientes_lenght" aria-controls="clientes" class="form-select form-select-sm">
                    @foreach ($lineas as $linea)
                        <option value="{{$linea->id}}">{{$linea->name}}</option>
                    @endforeach
                </select>
                @error('vehiculo.bus_id')
                <small class="text-danger">Campo Requerido</small>
                @enderror

                <h5>Modelo:</h5>
                <select wire:model='vehiculo.car_model_id' name="clientes_lenght" aria-controls="clientes" class="form-select form-select-sm">
                    @foreach ($modelos as $modelo)
                        <option value="{{$modelo->id}}">{{$modelo->model}}</option>
                    @endforeach
                </select>
                @error('vehiculo.car_model_id')
                  <small class="text-danger">Campo Requerido</small>
                @enderror
                <div class="row d-flex justify-content-center">
                  <img src="{{asset($this->vehiculo['photo'])}}" alt="" width="20%" height="20%">
                </div>

                <h5>Cambiar imagen:</h5>
                <input type="file"  wire:model='file' name="file" id="url" accept="image/*" class="form-control" >
                    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cancelar</button>
              <button type="submit" class="btn btn-primary" wire:click="update()">Actualizar</button>
            </div>
          </form>
          </div>
        </div>
      </div> 
      </div>  
      @endif
</div>
