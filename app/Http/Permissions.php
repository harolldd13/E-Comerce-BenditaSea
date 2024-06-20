<?php 
function user_permissions(){
    $p =[
        'general'=>[
            'icon'=> '<i class="bi bi-house-fill"></i>',
            'title'=> 'Global',
            'keys'=>[
                'all' =>'Acceso lilitado a todo el sistema',
                'dashboard'=> 'Puede ver el Dasboard'
            ]
        ],
        'platform'=>[
            'icon'=> '<i class="bi bi-rocket"></i>',
            'title'=> 'Sistema',
            'keys'=>[
                'platform_settings' =>'Configuracion de la plataforma',
            ]
        ],
        'users'=>[
            'icon'=> '<i class="bi bi-people-fill"></i>',
            'title'=> 'Usuarios',
            'keys'=>[
                'users_list' =>'Puede ver la lista de usuarios',
                'users_view' =>'Puede ver la informacion de un  usuarios',
                'users_edit' =>'Puede editar usuarios',
                'users_permissions' =>'Puede administrar permisos de los  usuarios',
                'users_add' =>'Puede crear nuevos  usuarios',
            ]
        ]
    
    ];
    return $p;
}