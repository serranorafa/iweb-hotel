@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
            <h1 class="card-head" style="text-align: center">{{$servicio->nombre}}</h1>
                <div class="row card-body" style="text-align: center">
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            ID:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$servicio->id}}
                    </div>
                    <div class="col-md-6 col-12"></div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Nombre:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$servicio->nombre}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Descripción:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$servicio->descripcion}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Tarifa diaria:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        {{$servicio->tarifa}}€
                    </div>
                    <div class="col-12" style="text-align: center">
                        <a onclick="confirmar('{{ $servicio->id }}')" class="btn btn-danger" style="text-align: center">
                            {{ __('Eliminar') }}
                        </a>
                        <a href="/servicios/{{$servicio->id}}/edit" class="btn btn-secondary" style="text-align: center">
                            {{ __('Editar') }}
                        </a>
                    </div>
                </div>
            </div>
            <br />  
            <div style="text-align: center">
                <a href="/servicios" class="btn btn-secondary">
                    {{ __('Volver al listado') }}
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmar(servicio) {
        if (confirm("¿Confirmar el borrado?")) {
            window.location.href = "/borrarservicio/" + servicio;
        } else {
        }
    }   
</script>
@endsection