<div>
    <head>
        <link rel="stylesheet" href="{{asset('css/modal.css')}}">
        <link rel="stylesheet" href="{{asset('css/tabla.css')}}">
    </head>
    <div class="card">
        <div class="card-header"> 
              <a class="btn btn-primary btb-sm" wire:click="crear()" >Registrar Usuario</a>    
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
                  <input placeholder="nombre" wire:model="search" type="search" class="form-control form-control-sm">
                </label>
              </div>
            </div>
          </div>
          <div class="row">
            <table class="table table-striped" id="clientes" >
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">ci</th>
                  <th scope="col">email</th>
                  <th scope="col">nombre</th>
                  <th scope="col">telefono</th>
                  <th scope="col">cat. licencia</th>
                  <th scope="col" width="25%">Acciones</th>
                </tr>
              </thead>
              
              <tbody>
      
                @foreach ($users as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->ci}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->license->license}}</td>
                    <td >
                        <a class="btn btn-info btn-sm" wire:click="modalEdit('{{$user->id}}')">Ver o Editar</a> 
                        <a class="btn btn-primary btn-sm" wire:click="modalVehiculo('{{$user->id}}')">Vehiculos</a> 
                          <button wire:click="modalDestroy('{{$user->id}}')" class="btn btn-danger btn-sm">Eliminar</button>
                    </td>    
                  </tr>
                @endforeach
              </tbody> 
      
            </table>
            
          </div>
          <div class="row">
              <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers" id="clientes_paginate">
                  @if ($users->hasPages())
                      <div class="px-6 py-3">
                          {{ $users->links() }}
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
                        <h4 class="modal-title" id="exampleModalLabel">Registrar usuario</h4>
                    </div>
                    <div class="modal-body">
                        <h5>Rol:</h5>
                        <select wire:model="user.admin" aria-controls="clientes" class="form-select form-select-sm">
                          <option value="0">Chofer</option>
                          <option value="1">Administrador</option>
                        </select>

                        <h5>CI:</h5>
                        <input type="text" wire:model="user.ci" class="form-control">
                        @error('user.ci')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>email:</h5>
                        <input type="text" wire:model="user.email" class="form-control">
                        @error('user.email')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Contraseña:</h5>
                        <input type="password" wire:model="user.password" class="form-control">
                        @error('user.password')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Genero:</h5>
                        <select wire:model="user.gender" class="form-select form-select-sm">
                            <option value="1">Masculino</option>
                            <option value="0">Femenino</option>
                        </select>
                        @error('user.gender')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Nombre:</h5>
                        <input type="text" wire:model="user.name" class="form-control">
                        @error('user.name')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Telefono:</h5>
                        <input type="text" wire:model="user.phone" class="form-control">
                        @error('user.phone')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Categoria de Licencia:</h5>
                        <select wire:model="user.license_category_id" aria-controls="clientes" class="form-select form-select-sm">
                            <option value="">Seleccione un modelo</option>
                            @foreach ($licencias as $licencia)
                                <option value="{{$licencia->id}}">{{$licencia->license}}</option>
                            @endforeach
                        </select>
                        @error('user.license_category_id')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Linea:</h5>
                        <select wire:model="user.bus_id" aria-controls="clientes" class="form-select form-select-sm">
                            <option value="">Seleccione un modelo</option>
                            @foreach ($buses as $bus)
                                <option value="{{$bus->id}}">{{$bus->name}}</option>
                            @endforeach
                        </select>
                        @error('user.bus_id')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror
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
                <h5>Rol:</h5>
                        <select wire:model="user.admin" aria-controls="clientes" class="form-select form-select-sm">
                            <option value="1">Administrador</option>
                            <option value="0">Chofer</option>
                        </select>

                        <h5>CI:</h5>
                        <input type="text" wire:model="user.ci" class="form-control">
                        @error('user.ci')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>email:</h5>
                        <input type="text" wire:model="user.email" class="form-control">
                        @error('user.email')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Contraseña:</h5>
                        <input type="password" wire:model="user.password" class="form-control">
                        @error('user.password')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Genero:</h5>
                        <select wire:model="user.gender" class="form-select form-select-sm">
                            <option value="1">Masculino</option>
                            <option value="0">Femenino</option>
                        </select>
                        @error('user.gender')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Nombre:</h5>
                        <input type="text" wire:model="user.name" class="form-control">
                        @error('user.name')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Telefono:</h5>
                        <input type="text" wire:model="user.phone" class="form-control">
                        @error('user.phone')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Categoria de Licencia:</h5>
                        <select wire:model="user.license_category_id" aria-controls="clientes" class="form-select form-select-sm">
                            <option value="">Seleccione un modelo</option>
                            @foreach ($licencias as $licencia)
                                <option value="{{$licencia->id}}">{{$licencia->license}}</option>
                            @endforeach
                        </select>
                        @error('user.license_category_id')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror

                        <h5>Linea:</h5>
                        <select wire:model="user.bus_id" aria-controls="clientes" class="form-select form-select-sm">
                            <option value="">Seleccione un modelo</option>
                            @foreach ($buses as $bus)
                                <option value="{{$bus->id}}">{{$bus->name}}</option>
                            @endforeach
                        </select>
                        @error('user.bus_id')
                          <small class="text-danger">Campo Requerido</small>
                        @enderror
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

      @if ($modalVehiculo)
      <div class="modald">
        <div class="modald-contenido">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <form wire:submit.prevent="update" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel"><b>Agregar Vehiculo</b></h4>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center text-center justify-content-center">
                    <h5 class="mx-2">Buscar por placa:</h5>
                    <select wire:model="vehiculo_id" aria-controls="clientes" class="form-select form-select-sm mx-2">
                        <option value="">Seleccione un vehiculo</option>
                        @foreach ($novehiculos as $novehiculo)
                            <option value="{{$novehiculo->id}}">{{$novehiculo->plate}}</option>
                        @endforeach
                    </select>
                    @error('vehiculo_id')
                      <small class="text-danger">Campo Requerido</small>
                    @enderror
                    <button type="submit" class="btn btn-success btn-sm mx-2" wire:click="storeDrive()">Agregar</button>
                </div>
                <div class="my-2">
                  <h5><b>Ya ocupados:</b></h5>
                  <div class="" style="height:100px; overflow-y:auto;">
                      @foreach ($vehiculos as $vehiculo)
                        <div class="d-flex align-items-center text-center justify-content-center">
                            <h5>{{$vehiculo->plate}}</h5>
                            <button type="submit" class="btn btn-outline-danger btn-sm" style="border:none;"wire:click="eliminarDrive('{{$vehiculo->id}}')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                              <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                            </svg></button>
                        </div>
                      @endforeach
                  </div>
                 
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" wire:click="cancelar()">Salir</button>
            </div>
          </form>
          </div>
        </div>
      </div> 
      </div>  
      @endif
</div>
