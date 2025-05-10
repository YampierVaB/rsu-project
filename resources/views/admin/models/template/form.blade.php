<div class="form-group">
    {!! Form::label('model_name', 'Nombre del Modelo') !!}
    {!! Form::text('model_name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del modelo', 'required']) !!}
</div>  

<div class="form-group">
    {!! Form::label('brand_id', 'Marca') !!}
    {!! Form::select('brand_id', $brands, null, ['class' => 'form-control', 'placeholder' => 'Seleccione una marca', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción del Modelo') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la descripción del modelo', 'rows' => 4]) !!}
</div>
