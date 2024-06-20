@extends('master')

@section('custom_js')
<script src="{{url('/static/css/account.js?v='.time())}}"></script>

@endsection

@section('content')
{!! Form::open(['url' => '#', 'autocomplete' => 'false', 'files' =>true, 'class'=> 'form', 
'id'=> 'form_profile_edit']) !!}
{!! Form::hidden('autocomplete', null, ['class'=> 'autocomplete']) !!}
<div class="row">
    <div class="col-md-3">
        <div class="panel mtop16 sh">
            <div class="panel-header">
                <div class="inside">
                    <h5><i class="bi bi-images"></i>Avatar</h5>
                </div>
            </div>
            <div class="panel-body">
                <div class="algin-center">
                    <div class="inside">
                        {!!Form::file('avatar', ['id'=>'profile_avatar', 'class'=> 'hide'=>
                        'image_prew', 'data-to-prew' => 'image_avatar'])!!}
    
                        @if(is_null(Auth::user()->avatar))
                             <img src="{{url('/static/images/default_avatar.png')}}" width="120"
                             height="120" class="rounded-circle" id="image_avatar"> 
                        @else  
                            <img src="{{getFileUrl(Auth::user()->avatar, '256')}}" width="120"
                            height="120" class="rounded-circle" id="image_avatar"> 
                        @endif
                        <div class="mtop16">
                            @include('component.file_input_mask', ['target'=>'profile_avatar',
                            'icon'=>'file-select-image.png'])
                        </div>
                    </div>

                </div>
               
            </div>
        </div>

    </div>
    <div class="col-md-9">
        <div class="panel mtop16 sh">
            <div class="panel-header">
                <div class="inside">
                    <h5><i class="bi bi-pencil-square"></i>Mi información </h5>
                </div>
            </div>
            <div class="panel-body">
                <div class="inside">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Nombre:</label>
                            {!!Form::text('name', $user->name, ['class'=> 'disableac', 'required'])!!}

                        </div>
                        <div class="col-md-4">
                            <label for="phone">Telefono:</label>
                            {!!Form::text('phone', $user->phone, ['class'=> 'disableac', 'required2'])!!}

                            
                        </div>
                        <div class="col-md-4">
                            <label for="gender">Género:</label>
                            {!!Form::select('gender', gender(), $user->gender, ['class'=> 'form-select'])!!}

                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-header">
                <div class="inside">
                    <h5><i class="bi bi-person-lock"></i>Cambiar contraseña </h5>
                </div>
            </div>
            <div class="panel-body">
                <div class="inside">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Nueva Contraseña:</label>
                            {!!Form::password('password', ['class'=> 'disableac',])!!}

                        </div>
                        <div class="col-md-4">
                            <label for="name">Confirmar Contraseña:</label>
                            {!!Form::password('cpassword', ['class'=> 'disableac',])!!}
                            
                        </div>
                      
                    </div>
                   
                </div>
                
            </div>
            <div class="panel-header">
                <div class="inside">
                    <h5><i class="bi bi-geo-alt-fill"></i>Dirección de envio </h5>
                </div>
            </div>
            <div class="panel-body">
                <div class="inside">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Ciudad:</label>
                            {!!Form::text('ciudad', ['class'=> 'disableac',])!!}

                        </div>
                        <div class="col-md-4">
                            <label for="name">Direccion:</label>
                            {!!Form::text('Direccion', ['class'=> 'disableac',])!!}
                            
                        </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-12">
                            {{!! Form::submit('Guardar'),['class' => 'btn btn-success mtop16']!!}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>


{!! Form::close() !!}
@endsection