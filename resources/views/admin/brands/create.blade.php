@extends('adminlte::page')
@section('title', 'Nueva Marca')

@section('content')
<div class="container">
    <div class="p-2"></div>
    <div class="card"></div>
    <div class="card-header">
        <h3>Nueva Marca</h3>
    </div>
    <div class="card-body">
        {!! Form::open(['route' => 'admin.brands.store', 'method' => 'POST']) !!}
        @include('admin.brands.template.form')
        <button type="submit" class="btn btn-primary">Registrar</button>
        
        {!! Form::close() !!}
    </div>
</div>
@endsection