@extends('adminlte::page')

@section('title', 'Sessiones')

@section('content_header')
  <h1>Bitacora</h1>
@stop

@section('content')

  <div class="card">
    <div class="card-body">
      <table class="table table-striped" id="clientes" >
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Fecha y hora</th>
            <th scope="col">Accion</th>
            <th scope="col">Mensaje</th>
          </tr>
        </thead>

        <tbody>

          @foreach ($sesions as $sesion)
            <tr>
              <td>{{$sesion->sab_id}}</td>
              <td>{{$sesion->date}}</td>
              <td> @if ($sesion->isLogin)
                    Iniciar Sesion 
                    @else
                    Cerrar Sesion
                    @endif
                </td>
              <td>{{$sesion->message}}</td>
            </tr>
          @endforeach
        </tbody>

      </table>
    </div>
  </div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
     $('#clientes').DataTable();
    } );
</script>
@stop
