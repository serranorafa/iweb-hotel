@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card">
            <h1 class="card-header" style="text-align: center">Reserva {{$reserva->id}}</h1>
                <div class="row card-body" style="text-align: center">
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            ID:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$reserva->id}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Nº estancia:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$reserva->getEstancia->numero}}
                    </div>     

                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Tipo estancia:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$reserva->getEstancia->tipo}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Planta:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$reserva->getEstancia->planta}}
                    </div> 

                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Fecha de inicio:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        {{date('j/m/Y', strtotime($reserva->fecha_inicio))}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Fecha de fin:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        {{date('j/m/Y', strtotime($reserva->fecha_fin))}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Hora de inicio:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        {{date('H:i', strtotime($reserva->fecha_inicio))}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Hora de fin:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        {{date('H:i', strtotime($reserva->fecha_fin))}}
                    </div>
                    <!-- USUARIO -->
                    <hr>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Nombre usuario:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$reserva->getUsuario->nombre}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Apellidos usuario:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$reserva->getUsuario->apellidos}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            ID usuario:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$reserva->getUsuario->id}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Correo usuario:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$reserva->getUsuario->email}}
                    </div>
                    <!-- FECHA CREACIÓN -->
                    <hr>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Fecha de creación:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{date('j/m/Y', strtotime($reserva->created_at))}}
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Hora de creación:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                        {{date('H:i', strtotime($reserva->created_at))}}
                    </div>
                    <!-- PRECIO -->
                    <hr>
                    <div class="col-md-3 col-12" style="text-align: left">
                        <h4 style="font-weight: 900">
                            Precio:
                        </h4>
                    </div>
                    <div class="col-md-3 col-12" style="text-align: left">
                            {{$reserva->precio_total}} €
                    </div>


                    <div style="clear: both; height: 2vh">
                    </div>
                    @if(Auth::user()->rol == "RECEPCIONISTA" || Auth::user()->rol == "WEBMASTER")
                    <div class="col-12" style="text-align: center">
                        <a onclick="confirmar('{{ $reserva->id }}')" class="btn btn-danger" style="text-align: center">
                            {{ __('Eliminar') }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            <br />  
            <div style="text-align: center">
                <a href="/reservas" class="btn btn-secondary">
                    {{ __('Volver al listado') }}
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmar(reserva) {
        if (confirm("¿Confirmar el borrado?")) {
            window.location.href = "/borrarreserva/" + reserva;
        } else {
        }
    }   
</script>
@endsection