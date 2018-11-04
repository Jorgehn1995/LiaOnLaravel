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
Route::get('/registrar',function(){
    return view('register');
})->name('register.index');
Route::post('/registrar','InstitucionesController@store')->name('registrar.store');




Route::group(['prefix'=>'master','middleware'=>'auth'],function(){
    Route::resource('usuarios','UsuariosController');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    
    Route::get('/',function(){
        
        return view('admin.index');
    })->name('admin.index');
    Route::get('/ajustes',function(){
        return view('admin.ajustes.index');
    })->name('ajustes.index');
    Route::resource('niveles', 'NivelesController');
    Route::resource('grados', 'GradosController');
    Route::resource('secciones', 'SeccionesController');
    Route::resource('profesores', 'ProfesoresController');
    Route::resource('asesores', 'AsesoresController');
    Route::resource('cuadros', 'CuadrosController');
    Route::resource('modelos', 'ModelosController');
    Route::get('modelos/create/{idnivel}', 'ModelosController@create');
    Route::resource('asignaturas', 'AsignaturasController');
    Route::get('asignaturas/create/{idgrado}', 'AsignaturasController@create');
    Route::resource('asignaciones', 'AsignacionesController');
    Route::get('asignaciones/create/{idgrado}', 'AsignacionesController@create');
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







