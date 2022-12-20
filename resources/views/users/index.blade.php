@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
@stop

@section('content')
    @livewire('choferes')
@stop

@section('css')
  @livewireStyles
@stop

@section('js')
  @livewireScripts
@stop