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
Route::post('/registrar','RegistroController@store')->name('registrar.store');




Route::group(['prefix'=>'master','middleware'=>'auth'],function(){
    Route::resource('usuarios','UsuariosController');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    
    /**
     * RUTAS PRINCIPALES
     */
    Route::get('/',function(){
        return view('admin.index');
    })->name('admin.index');
    Route::get('/ajustes',function(){
        return view('admin.ajustes.index');
    })->name('ajustes.index');

    /**
     * RUTAS PROFESORES
     */
    Route::resource('profesores', 'ProfesoresController');
    Route::get('profesores/password/{id}','ProfesoresController@pass')->name('profesores.password');

    /**
     * RUTAS GRADOS
     */
    Route::resource('grados', 'GradosController');
    
    /**
     * RUTAS ASIGNATURAS
     */
    Route::get('asignaturas/{idgrado}', 'AsignaturasController@index')->name("asignaturas.index");
    Route::post('asignaturas/{idgrado}','AsignaturasController@store')->name("asignaturas.store");
    Route::delete('asignaturas/{idasignatura}','AsignaturasController@destroy')->name("asignaturas.destroy");
    Route::get('asignaturas/edit/{idasignatura}','AsignaturasController@edit')->name("asignaturas.edit");
    Route::put('asignaturas/edit/{idasignatura}', 'AsignaturasController@update')->name("asignaturas.update");



    /**
     * RUTAS PARA CUADROS
     */
    Route::resource('cuadros', 'CuadrosController');
    Route::post('cuadros/ordenar','CuadrosController@ordenar')->name('cuadros.ordenar'); //se envian los datos por post, se ordenan y se cuardan
    
    
    Route::resource('horarios', 'HorariosController');
    Route::resource('alumnos', 'AlumnosController');
    Route::get('alumnos/inscripcion/{idalumno?}', 'AlumnosController@inscripcion')->name('alumnos.inscripcion');
    
    Route::POST('alumnos/inscribir/', 'AlumnosController@inscribir')->name('alumnos.inscribir');
    Route::get('alumnos/comprobante/{idinscripcion}', 'AlumnosController@comprobante')->name('alumnos.comprobante');
    Route::get('alumnos/claves/', 'ClavesController@index')->name('alumnos.claves');
    Route::post('alumnos/agregar/', 'AlumnosController@agregar')->name('alumnos.agregar');
    /************
     Rutas Json para ajax
     *************/
    Route::get('json/alumno/{codigo?}','JsonAjaxController@consultacodigo')->name('jsonConsultaCodigo');
    Route::get('json/grados','JsonAjaxController@grados')->name('jsonGrados');
    Route::get('json/seccion/{idgrado?}','JsonAjaxController@secciones')->name('jsonSecciones');
    Route::get('json/alumnos/inscritos/','JsonAjaxController@alumnosinscritos')->name('jsonInscritos');

});







