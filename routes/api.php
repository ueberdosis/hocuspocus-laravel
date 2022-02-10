<?php

use Hocuspocus\HocuspocusLaravel;

Route::post(config('hocuspocus-laravel.route'), [HocuspocusLaravel::class, 'handleWebhook']);
