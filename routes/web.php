<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@authlogin')->name('authlogin');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/', 'LoginController@check')->name('logincheck');

/**
 * Rutas para registrarse
 */
Route::get('/registrar', 'RegistroController@index')->name('registrar.index');
Route::post('/registrar', 'RegistroController@store')->name('registrar.store');

Route::group(['prefix' => 'master', 'middleware' => 'auth'], function () {
    Route::resource('usuarios', 'UsuariosController');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    /**
     * RUTAS PRINCIPALES
     */
    Route::get('/', 'GraficasController@home')->name('admin.index');

    Route::get('/ajustes', function () {
        return view('admin.ajustes.index');
    })->name('ajustes.index');

    /**
     * RUTAS PROFESORES
     */
    Route::resource('profesores', 'ProfesoresController');
    Route::get('profesores/password/{id}', 'ProfesoresController@pass')->name('profesores.password');

    /**
     * RUTAS GRADOS
     */
    Route::resource('grados', 'GradosController');

    /**
     * RUTAS ASIGNATURAS
     */
    Route::get('asignaturas/{idgrado}', 'AsignaturasController@index')->name("asignaturas.index");
    Route::post('asignaturas/{idgrado}', 'AsignaturasController@store')->name("asignaturas.store");
    Route::delete('asignaturas/{idasignatura}', 'AsignaturasController@destroy')->name("asignaturas.destroy");
    Route::get('asignaturas/edit/{idasignatura}', 'AsignaturasController@edit')->name("asignaturas.edit");
    Route::put('asignaturas/edit/{idasignatura}', 'AsignaturasController@update')->name("asignaturas.update");

    /**
     * RUTAS PARA CUADROS
     */
    Route::resource('cuadros', 'CuadrosController');
    Route::post('cuadros/ordenar', 'CuadrosController@ordenar')->name('cuadros.ordenar'); //se envian los datos por post, se ordenan y se cuardan

    /**
     * RUTAS PARA BLOQUES
     */
    Route::resource('bloques', 'BloquesController');
    Route::post('bloques/estado', 'BloquesController@mostrar')->name('bloques.mostrar');

    /**
     * RUTAS RARA ALUMNOS
     */
    Route::resource('alumnos', 'AlumnosController');
    Route::get('alumnos/json/autocompletado/', 'AlumnosController@autocompletado')->name('alumnos.autocompletado');
    Route::get('alumnos/json/grados', 'AlumnosController@grados')->name('alumnos.grados');
    Route::get('alumnos/json/inscritos', 'AlumnosController@inscritos')->name('alumnos.inscritos');

    /**
     * RUTAS PARA GRAFICAS ADMIN DE INICIO
     */
    Route::get('graficas', 'GraficasController@index')->name('graficas.index');
    Route::get('graficas/cantidad', 'GraficasController@cantidad')->name('graficas.cantidad');
    Route::get('graficas/grados', 'GraficasController@grados')->name('graficas.grados');
    Route::get('graficas/edades', 'GraficasController@edades')->name('graficas.edades');
    Route::get('graficas/inscritosdia', 'GraficasController@inscritosdia')->name('graficas.inscritosdia');

    Route::resource('horarios', 'HorariosController');

    /************
    Rutas Json para ajax
     *************/
    Route::get('json/alumno/{codigo?}', 'JsonAjaxController@consultacodigo')->name('jsonConsultaCodigo');
    Route::get('json/grados', 'JsonAjaxController@grados')->name('jsonGrados');
    Route::get('json/seccion/{idgrado?}', 'JsonAjaxController@secciones')->name('jsonSecciones');
    Route::get('json/alumnos/inscritos/', 'JsonAjaxController@alumnosinscritos')->name('jsonInscritos');

});
