<?php

return [

    /*
     *
     */
    'route' => '/api/documents',

    /*
     *
     */
    'events' => [
        \Ueberdosis\HocuspocusLaravel\HocuspocusLaravel::EVENT_ON_CHANGE,
        \Ueberdosis\HocuspocusLaravel\HocuspocusLaravel::EVENT_ON_CONNECT,
        \Ueberdosis\HocuspocusLaravel\HocuspocusLaravel::EVENT_ON_DISCONNECT,
        \Ueberdosis\HocuspocusLaravel\HocuspocusLaravel::EVENT_ON_CREATE_DOCUMENT,
    ],

    /*
     *
     */
    'secret' => env('HOCUSPOCUS_SECRET', ''),

    /*
     *
     */
    'access_token_parameter' => 'access_token',

    /*
     *
     */
    'policy_method_name' => 'update',

];
