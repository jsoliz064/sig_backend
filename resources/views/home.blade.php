@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')

@stop

@section('content')
{{--  <div class="center-div">
    <div class="centro-total">
      <div class="centrar-vertical">
        <div class="centrar-horizontal">
          <div class="titulo">
            <p>CRUZERO</p>
          </div>
        </div>
      </div>
    </div>
</div>  --}}
<div id="divfotoperdido" class="row d-flex justify-content-center">
        <div class="titulo">
            <p>CRUZERO</p>
        </div>
</div>
    <div id="divfotoperdido" class="row d-flex justify-content-center">
        <img src="https://fotos.perfil.com//2022/06/02/900/0/hino-1365848.jpg" alt="">
    </div>
@stop

@section('css')
 <link rel="stylesheet" href="{{asset('css/titulo.css')}}">
@stop

@section('js')
@stop