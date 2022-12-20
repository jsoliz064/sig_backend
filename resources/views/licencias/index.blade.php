@extends('adminlte::page')

@section('title', 'Licencias')

@section('content_header')
@stop

@section('content')
    @livewire('licencia')
@stop

@section('css')
  @livewireStyles
@stop

@section('js')
  @livewireScripts
@stop