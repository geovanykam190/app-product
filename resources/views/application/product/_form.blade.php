@if ($errors->any())
<div class="row">
    <div class="col col-sm-12">
        <div class="alert alert-danger" role="alert">
            @foreach($errors->all() as $erro)
            {{ $erro }} <br>
            @endforeach
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-sm-6 col-xs-12">
        {!! Form::label('name', 'Nome*:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
    </div>
    <div class="col-sm-6 col-xs-12">
        {!! Form::label('description', 'Descrição:', ['class' => 'control-label']) !!}
        {!! Form::text('description', null, ['class'=>'form-control']) !!}
    </div>

    <div class="col-sm-3 col-xs-12">
        {!! Form::label('categories_id', 'Categoria:', ['class' => 'control-label']) !!}
        {!! Form::select('categories_id', $categories, null, ['class'=>'form-control']) !!}
    </div>

    <div class="col-sm-3 col-xs-12">
        {!! Form::label('status', 'Status:', ['class' => 'control-label']) !!}
        {!! Form::select('status', ["1"=>"Ativo", "0"=>"Inativo"], null, ['class'=>'form-control']) !!}
    </div>

    <hr class="w-100">

</div>
