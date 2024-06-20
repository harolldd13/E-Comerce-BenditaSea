<?php 

function kvfj($json, $key){
    if($json == null):
        return null;
    else: 
        $json = $json;
        $json = json_decode($json, true);
        if(array_key_exists($key, $json)):
            return $json[$key];
        else: 
            return null;
        endif;
    endif;
}

function getPermissions($json, $key){
    if($json == null):
        return null;
    else: 
        $json = $json;
        $json = json_decode($json, true);
        if(array_key_exists('all', $json)):
            if($json['all']):
                return true;
            endif;
        endif;

        if(array_key_exists($key, $json)):
            return $json[$key];
        else: 
            return null;
        endif;
    endif;
}

function user_role($id = null){
    $a =[
        '1'=> 'Administrador',
        '2'=> 'colaborador',
        '3'=> 'Driver',
        '4'=> 'Comercio-provedor',
    ];
    if(!is_null($id)):
        return $a[$id];
    else:
        return $a;
    endif;

}
function gender($id = null){
    $a =[
        '0'=> 'No especificado',
        '1'=> 'Masculino',
        '2'=> 'Femenino',

    ];
    if(!is_null($id)):
        return $a[$id];
    else:
        return $a;
    endif;

}
function getFileUrl($data, $prefix = null){
    $data = json_decode($data, true);
    if($prefix):
        $url = config('cms.cdn').'/uploads/'.$data['path'].'/'.$prefix.'_'.$data['final_name'];
    else:
        $url = config('cms.cdn').'/uploads/'.$data['path'].'/'.$data['final_name'];
    endif;
    return $url;
}