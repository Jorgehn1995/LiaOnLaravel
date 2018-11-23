<?php

namespace App\Providers;

use App\Rol;
use App\Asignacion;
use App\Inscripcion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer(['*'], function ($view) {
            
            if (Auth::User()) {
                if(Auth::User()->idtipousuario==2){
                    $auth = Rol::where('idusuario', Auth::User()->idusuario)->where('idinstitucion', Auth::User()->idinstitucion)->first();
                    if (!$auth) {
                        $auth = new \stdClass;
                        $auth->admin = 0;
                        $auth->profesor = 0;
                    }
                    
                    $view->with("mainmenu", $auth);
                }
                if(Auth::User()->idtipousuario==3){
                    $auth = Rol::where('idusuario', Auth::User()->idusuario)->where('idinstitucion', Auth::User()->idinstitucion)->first();
                    if (!$auth) {
                        $auth = new \stdClass;
                        $auth->admin = 0;
                        $auth->profesor = 0;
                    }
                    $asignaciones = Asignacion::where('idusuario', Auth::User()->idusuario)->select('idasignatura')->groupBy('idasignatura')->get();
                    $asignaciones->each(function ($asignaciones) {
                        $asignaciones->asignatura;
                    });
                    $view->with("mainmenu", $auth)->with('mnuasignaturas', $asignaciones);
                }
                if(Auth::User()->idtipousuario==4){
                    $auth = Rol::where('idusuario', Auth::User()->idusuario)->where('idinstitucion', Auth::User()->idinstitucion)->first();
                    if (!$auth) {
                        $auth = new \stdClass;
                        $auth->admin = 0;
                        $auth->profesor = 0;
                    }
                    $asignaciones = Asignacion::where('idusuario', Auth::User()->idusuario)->select('idasignatura')->groupBy('idasignatura')->get();
                    $asignaciones->each(function ($asignaciones) {
                        $asignaciones->asignatura;
                    });
                    $notas = Inscripcion::where('idusuario', Auth::User()->idusuario)->where('idinstitucion', Auth::User())->orderBy('created_at', 'DESC')->first();
    
                    //dd($notas);
                    $view->with("mainmenu", $auth)->with('mnuasignaturas', $asignaciones)->with('notas', $notas);
                    
                }
                
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
