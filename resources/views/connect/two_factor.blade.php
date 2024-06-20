@extends('connect.master')

@section('content_connect')

<div class="box">
    <div class="in">
        <div class="logo">
            <img src="{{url('/static/images/logo1.png')}}" alt="">
        </div>
        @if(Auth::check())
            <h3>Hola {{ explode(' ', Auth::user()->name)[0] }}</h3>
            <p>Hemos enviado un correo de autenticación de un solo uso a su correo electrónico.</p>
            <p>Es posible que debas revisar tu bandeja de entrada o de spam.</p>
            <div class="form mtop16">
                {!! Form::open(['url' => '/', 'id' => 'form_connect_two_auth']) !!}
                {!! Form::hidden('autocomplete', null, ['class'=> 'autocomplete']) !!}
                <label for="code">Código de autenticación:</label>
                {!! Form::number('code', null, ['class'=> 'disableac']) !!}
                {!! Form::submit('Ingresar', ['class'=> 'mtop16']) !!}
                {!! Form::close() !!}
                <div class="actions_right">
                    <a href="{{url('/connect/two/factor')}}" class="mtop16">Enviar de nuevo</a>
                </div>
            </div>
        @else
            <p>No has iniciado sesión.</p>
            <p>Por favor, inicia sesión para acceder a esta página.</p>
            <p>Puedes <a href="{{ url('/connect/login') }}">iniciar sesión aquí</a>.</p>
        @endif
    </div>
</div>

@endsection
