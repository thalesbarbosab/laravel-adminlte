<?php

return [
    'user' =>   [
        'field' =>  [
            //put array / key for the all user fields
        ],
        'enum'  =>  [
            'gender'    =>  [
                'male'      =>  'male',
                'female'    =>  'female',
            ],
            'status'    =>  [
                'actived'       =>  'actived',
                'inactived'     =>  'inactived',
                'pre_registred' =>  'pre registred'
            ],
            'profile'    =>  [
                'administrator' =>  'administrator',
                'user'          =>  'default user',
            ],
        ],
    ],
];
