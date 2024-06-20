<?php

namespace App\Http\Controllers\ApiJS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ConnectController extends Controller
{
    public function postLogin(Request $request)
    {
        $ac = $request->input('autocomplete');

        $rules = [
            'email_'.$ac => 'required|email',
            'password_'.$ac => 'required',
        ];
        $messages = [
            'email_'.$ac.'.required' => 'Su correo electrónico es requerido.',
            'email_'.$ac.'.email' => 'El formato del correo es erróneo.',
            'password_'.$ac.'.required' => 'Su contraseña es requerida.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            $data = ['type' => 'error', 'title' => 'Ha ocurrido un error', 'msg' => 'Complete la información', 'msgs' => json_encode($validator->errors()->all())];
            return response()->json($data);
        else:
            if (Auth::attempt(['email' => $request->input('email_'.$ac), 'password' => $request->input('password_'.$ac)])): 
                $data = ['type' => 'success'];
                return response()->json($data);
            else:
                $data = ['type' => 'error', 'title' => 'Ha ocurrido un error', 'msg' => 'Correo electrónico o contraseña incorrecta'];
                return response()->json($data);
            endif;
        endif;
    }
    public function postTwoFactor(Request $request){
        $ac = $request->input('autocomplete');

        $rules = [
            'code_'.$ac => 'required|min:6',
     
        ];
        $messages = [
            'code_'.$ac.'.required' => 'Ingrese el código de seguridad enviado a su correo.',
            'code_'.$ac.'.min' => 'El código debe de tener al menos 6 dígitos.',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            $data = ['type' => 'error', 'title' => 'Ha ocurrido un error', 'msg' => 'Complete la información', 'msgs' => json_encode($validator->errors()->all())];
            return response()->json($data);
        else:
            $user_code = Auth::user()->auth_code;

            if($user_code != $request->input('code_'.$ac)):
                $data = ['type' => 'error', 'title' => 'Ha ocurrido un error', 'msg' => 'El códig de seguridad es incorrecto'];
                return response()->json($data);
            else:
                $data = ['type' => 'success'];
                $user = User::find(Auth::id());
                $user->auth_code = null;
                $user->save();
                return response()->json($data)->withCookie(cookie('browser_trusted', '1', 10080));
                
            endif;
        endif;

    }
}

