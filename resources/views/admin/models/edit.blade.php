@extends('adminlte::page')
@section('title', 'Editar Modelo')

@section('content')
<div class="container">
    <div class="p-2"></div>
    <div class="card"></div>
    <div class="card-header">
        <h3>Editar Modelo</h3>
    </div>
    <div class="card-body">
        {!! Form::model($model, ['route' => ['admin.models.update', $model], 'method' => 'PUT', 'files' => true]) !!}
        @include('admin.models.template.form')
        <button type="submit" class="btn btn-primary">Actualizar</button>
         
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')

@stop