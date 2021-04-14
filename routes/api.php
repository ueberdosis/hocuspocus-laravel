<?php

use Ueberdosis\HocuspocusLaravel\HocuspocusLaravel;

Route::post(config('hocuspocus-laravel.route'), [HocuspocusLaravel::class, 'handleWebhook']);
