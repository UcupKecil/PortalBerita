<?php

use Illuminate\Support\Facades\Route;


require_once('includes/auth.php');
require_once('includes/author.php');
require_once('includes/product.php');
require_once('includes/berita.php');
require_once('includes/kategori.php');
require_once('includes/pengguna.php');
require_once('includes/role.php');


Route::get('/', function () {
    return view('newsportal');
});





// Route::get('/news', function () {
//     return view('components/products/news');
// });

