@extends('connect.master')
@section('content_connect')
<div class="box">
    <div class="in">
        <div class="logo">
            <img src="{{ url('/static/images/logo1.png') }}" alt="">
        </div>
        <h3>Bienvenido {{ config('cms.app_name') }}</h3>
        <p>Ingresa a tu cuenta</p>
        <div class="form mtop16">
            {!! Form::open(['url' => '/', 'id' => 'form_connect_login']) !!}
            {!! Form::hidden('autocomplete', null, ['class'=> 'autocomplete']) !!}
            <label for="email">Correo Electrónico:</label>
            {!! Form::text('email', null, ['class'=> 'disableac']) !!}
            <label for="password" class="mtop8">Contraseña:</label>
            {!! Form::password('password', ['class'=> 'disableac']) !!}
            {!! Form::submit('Ingresar', ['class'=> 'mtop16']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
