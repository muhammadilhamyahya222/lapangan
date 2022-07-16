<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    // return $router->app->version();
    return str_random(40);
});

$router->post("/register", "UsersController@register");
$router->post("/login", "UsersController@login");

//Admin (Member)
$router->get('/member','UsersController@get');
$router->post('/member/find','UsersController@find');
$router->post('/member/save','UsersController@save');
$router->delete('/member/drop/{id}','UsersController@drop');

//Admin (Lapangan)
$router->get('/lapangan','LapanganController@get');
$router->post('/lapangan','LapanganController@find');
$router->post('/lapangan/save','LapanganController@save');
$router->delete('/lapangan/drop/{id}','LapanganController@drop');

//Admin (Sewa)
$router->get("/sewa", "SewaController@get");
$router->post("/sewa", "SewaController@find");
$router->post("/sewa/save", "SewaController@save");
$router->delete("/sewa/drop/{id}", "SewaController@drop");
$router->post("/sewa/used/{id}", "SewaController@used");
$router->post("/sewa/done/{id}", "SewaController@done");

//Client (Profil)
$router->get('/myprofil/{id}','UsersController@myProfil');
$router->post('/myprofil/save','UsersController@saveProfil');
$router->post('/myprofil/pwd','UsersController@savePwd');

//Client (Sewa)
$router->get('/myorder/{id}','SewaController@myOrder');