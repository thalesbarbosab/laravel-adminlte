<?php

return [
    'user' =>   [
        'field' =>  [
            //put array / key for the all user fields
        ],
        'enum'  =>  [
            'gender'    =>  [
                'male'      =>  'masculino',
                'female'    =>  'feminino',
            ],
            'status'    =>  [
                'actived'       =>  'ativo',
                'inactived'     =>  'inativo',
                'pre_registred' =>  'pre-cadastrado'
            ],
            'profile'    =>  [
                'administrator' =>  'administrador',
                'user'          =>  'usuário padrão',
            ],
        ],
    ],
];
