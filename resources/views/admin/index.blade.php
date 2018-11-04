@extends('admin.layout') 
@section('title', "Inicio") 
@section('content')
<div class="col-md-4">
    <div class="widget-simple text-center ">
        <h3 class="text-success counter font-bold mt-0">400</h3>
        <p class="text-muted mb-0">Alumnos Inscritos</p>
    </div>
</div>
<div class="col-md-4">
    <div class="widget-simple text-center">
        <h3 class="text-primary counter font-bold mt-0">100</h3>
        <p class="text-muted mb-0">Hombres</p>
    </div>
</div>
<div class="col-lg-4 col-md-6">
    <div class="widget-simple text-center ">
        <h3 class="text-pink counter font-bold mt-0">300</h3>
        <p class="text-muted mb-0">Mujeres</p>
    </div>
</div>

@endsection