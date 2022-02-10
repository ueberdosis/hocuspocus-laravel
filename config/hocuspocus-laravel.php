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
        \Hocuspocus\HocuspocusLaravel::EVENT_ON_CHANGE,
        \Hocuspocus\HocuspocusLaravel::EVENT_ON_CONNECT,
        \Hocuspocus\HocuspocusLaravel::EVENT_ON_DISCONNECT,
        \Hocuspocus\HocuspocusLaravel::EVENT_ON_CREATE_DOCUMENT,
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
