@extends('adminlte::page')
@section('title', 'Editar Marca')

@section('content')
<div class="container">
    <div class="p-2"></div>
    <div class="card"></div>
    <div class="card-header">
        <h3>Editar Marca</h3>
    </div>
    <div class="card-body">
        {!! Form::model($brand, ['route' => ['admin.brands.update', $brand], 'method' => 'PUT', 'files' => true]) !!}
        @include('admin.brands.template.form')
        <button type="submit" class="btn btn-primary">Actualizar</button>
         
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')

@stop