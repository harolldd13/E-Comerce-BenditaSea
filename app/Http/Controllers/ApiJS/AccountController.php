<?php

namespace App\Http\Controllers\ApiJS;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user.status');
        $this->middleware('IsAdmin');
        $this->middleware( 'user.two.factor');
    }
    public function postProfileUpdate (Request $request){
        $logout = false;
        $ac = $request->input('autocomplete');

        $rules =[
            'name_'.$ac => 'required',
            'phone'.$ac => 'required',
        ];
        $messages =[
            'name_'.$ac.'required'=> 'su nombre es requerido',
            'phone'.$ac.'required'=> 'su telefono es requerida',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()):
            $data = ['type'=> 'error', 'title' => 'Ha ocurrido un error', 'msg'=> 'completa la informacion', 
            'msg'=> json_encode($validator->errors()->all())];
            return response()->json($data);
        else:
            $user = User::find(Auth::id());
            $user->name = $request->input('name_'.$ac);
            $user->phone = $request->input('phone_'.$ac);
            $user->gender = $request->input('gender_'.$ac);
      //validar si se quiere cambiar la contraseña 
            if($request->input('password_'.$ac) && $request->input('cpassword_'.$ac)):
                if($request->input('password_'.$ac) == $request->input('cpassword_'.$ac)):
                    $user->password = Hash::make($request->input('password_'.$ac));
                    $logout = true;
                else:
                    $data = ['type'=> 'error', 'title' => 'Ha ocurrido un error', 'msg'=> 'Las contraseñas no coinciden '];
                    return response()->json($data);
                endif;

            endif;
            //avatar
            if($request->hasFile('avatar')):
                $user->avatar = $this->postFileUploadCdn('avatar', null, $request, [[256,256,'256'], [64,64,'64']]);
            endif;

            if($user->save()):
                if($logout):
                    Auth::logout();
                endif;

                $actions = [
                    [
                        'url' => url('/'),
                        'name'=>'seguir',
                        'type'=>'primary sl'
                    ]
                ];
                $data = [ 'type'=> 'success', 'title'=> config('cms.app_name'), 'msg'=> 'Información actulizada con exito',
                'actions' => json_encode($actions), 'aditional'=> json_encode(['hideclose'=>true])];
                return response()->json($data);
            endif;
        endif;


    }
}
 