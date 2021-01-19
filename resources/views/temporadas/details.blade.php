@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
            <h1 class="card-head" style="text-align: center">{{$temporada->nombre}}</h1>
                <div class="row card-body" style="text-align: center">
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            ID:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$temporada->id}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Nombre:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$temporada->nombre}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Fecha de inicio:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{date('j F', strtotime($temporada->fecha_inicio))}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Fecha de fin:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        {{date('j F', strtotime($temporada->fecha_fin))}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Modificador:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        {{$temporada->mod_temporada}}
                    </div>
                    <div class="col-6"></div>
                    <div class="col-12" style="text-align: center">
                        <a onclick="confirmar('{{ $temporada->id }}')" class="btn btn-danger" style="text-align: center">
                            {{ __('Eliminar') }}
                        </a>
                        <a href="/temporadas/{{$temporada->id}}/edit" class="btn btn-secondary" style="text-align: center">
                            {{ __('Editar') }}
                        </a>
                    </div>
                </div>
            </div>
            <br />  
            <div style="text-align: center">
                <a href="/temporadas" class="btn btn-secondary">
                    {{ __('Volver al listado') }}
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmar(temporada) {
        if (confirm("¿Confirmar el borrado?")) {
            window.location.href = "/borrartemporada/" + temporada;
        } else {
        }
    }   
</script>
@endsection