<div class="form-group">
    {!! Form::label('name', 'Nombre de la Marca') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la marca', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción de la Marca') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la descripción de la marca', 'rows' => 4]) !!}
</div>
