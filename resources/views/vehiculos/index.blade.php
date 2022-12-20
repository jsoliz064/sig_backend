@extends('adminlte::page')

@section('title', 'Vehiculos')

@section('content_header')
@stop

@section('content')
    @livewire('vehiculos')
@stop

@section('css')
  @livewireStyles
@stop

@section('js')
  @livewireScripts
@stop