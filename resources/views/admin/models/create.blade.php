@extends('adminlte::page')
@section('title', 'Nuevo Modelo')

@section('content')
<div class="container">
    <div class="p-2"></div>
    <div class="card"></div>
    <div class="card-header">
        <h3>Nuevo Modelo</h3>
    </div>
    <div class="card-body">
        {!! Form::open(['route' => 'admin.models.store', 'method' => 'POST']) !!}
        @include('admin.models.template.form')
        <button type="submit" class="btn btn-primary">Registrar</button>
        
        {!! Form::close() !!}
    </div>
</div>
@endsection