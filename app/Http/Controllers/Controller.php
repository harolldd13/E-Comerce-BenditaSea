<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;
use Intervention\Image\Image;



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    //metodo para poder subir los archivos 
    public function postFileUploadCdn($field, $suggestion_name, $request, $thumbnails = null){
        $path = date('Y/m/d');
        $original_name =$request->file($field)->getClientOriginalName();

        //fillname

        if($suggestion_name):
            $final_name = Str::slug($suggestion_name).'_'.time().'.'.trim($request->file($field)->
            getClientOriginalExtension());
        else:
            $final_name = Str::slug($request->file($field)->getClientOriginalName()).'_'.time().'.'.trim($request->file($field)->
        getClientOriginalExtension());
        endif;

        //data response
        if($request->$field->storeAs($path, $final_name, 'cdn')):
            $data = json_encode(['upload'=> 'success', 'path'=> $path, 'original_name'=> $original_name,
             'final_name'=> $final_name]);
        else:
            $data = json_encode(['upload'=> 'error']);
        endif;

        //ruta para guardar os archivos llamando a filesystems.php y el cdn 
        $file_path = config('filesystems.disks.cdn.root').'/'.$path.'/'.$final_name;
        if($thumbnails):
            foreach($thumbnails as $thumb):
                $img = Image::make($file_path)->orientate();
                $img->fit($thumb[0], $thumb[1], function($constraint){
                    $constraint->aspectRatio();
                } );
                $img->save(config('filesystems.disks.cdn.root').'/'.$path.'/'.$thumb[2].'_'.$final_name);
            endforeach;
        endif;
        
        return $data;
    }
}
