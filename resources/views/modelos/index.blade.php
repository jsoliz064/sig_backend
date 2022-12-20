@extends('adminlte::page')

@section('title', 'Modelos')

@section('content_header')
@stop

@section('content')
    @livewire('modelos')
@stop

@section('css')
  @livewireStyles
@stop

@section('js')
  @livewireScripts
@stop