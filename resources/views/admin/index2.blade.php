@extends('admin.layout') 
@section('title', "Inicio") 
@section('content')


<style>
    .cropimg {
        width: 100%;
    }
</style>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">

            <label class="label" data-toggle="tooltip" title="Click aqui para cambiar la foto">
                                  <img class="rounded" id="avatar" src="https://avatars0.githubusercontent.com/u/3456749?s=160" alt="avatar">
                                  <input type="file" class="sr-only" id="input" name="image" accept="image/*">
                                </label>
            <div class="progress-wrapper pb">
                <div class="progress-info">
                    <div class="progress-label">
                        <span>Subido</span>
                    </div>
                    <div class="progress-percentage">
                        <span>0%</span>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-default" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                </div>
            </div>
            <div class="alert" role="alert"></div>
        </div>


        <div class="col-md-4 ic">
            <div class="img-container">
                <img id="image" class="cropimg" src="https://avatars0.githubusercontent.com/u/3456749">
            </div>
            <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="crop">Crop</button>
            
        </div>
    </div>
</div>
@endsection
 
@section('js')

<script>
    subirfotoperfil();

</script>
@endsection