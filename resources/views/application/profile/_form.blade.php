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
    <div class="col-sm-12 col-xs-12">
        {!! Form::label('name', 'Nome*:', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
    </div>
    
    <hr class="w-100">

    <div class="col-sm-12 col-xs-12">
        <h3>Permissões</h3>

        @foreach($menus AS $menu)
            @if($menu->link != "#" && $menu->link != "")
            @php $isCheck = isset($profil) && HelpFul::hasPermission($profil->id, $menu->id) ? 'checked' : ''; @endphp
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="check{{ $menu->id }}" name="permissions[]" value="{{$menu->id}}" {{$isCheck}}>
                <label class="form-check-label" for="check{{ $menu->id }}">{{ $menu->name }}</label>
            </div>
            @endif
        @endforeach

    </div>

</div>
