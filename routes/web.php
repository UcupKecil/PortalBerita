<?php

use Illuminate\Support\Facades\Route;

require_once('includes/auth.php');

Route::group([
    'middleware' => 'auth',
], function() {
    require_once('includes/product.php');
    require_once('includes/berita.php');
    require_once('includes/kategori.php');
});
