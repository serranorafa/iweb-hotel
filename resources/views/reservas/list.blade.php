@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="text-align: center">{{ __('Reservas') }}</h1>
            <div class="card" style="text-align: left">
                <h4 class="card-header" style="text-align: center">{{ __('Búsqueda') }}</h4>
                <div class="card-body">
                    <form action="{{url('reservas')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="id" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('ID') }}</label>

                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="id" class="form-control" type="number" name="id" autocomplete="id" autofocus value=<?php if(isset($_POST['id'])){ echo $_POST['id']; } ?>>
                            </div>
                            <label for="fecha_inicio" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha de inicio') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_inicio" class="form-control" type="date" name="fecha_inicio" autocomplete="fecha_inicio" autofocus value=<?php if(isset($_POST['fecha_inicio'])){ echo $_POST['fecha_inicio']; } ?>>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="precio_total" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Precio') }}</label>
                            <div class="col-lg-2 col-12">
                                <select id="comparacion" name="comparacion" class="form-control" autofocus>
                                    <option value="<=" >Hasta</option>
                                    <option value="=" <?php if(isset($_POST['comparacion']) && $_POST['comparacion'] == "="){ echo "selected"; } ?>>Igual que</option>
                                    <option value=">" <?php if(isset($_POST['comparacion']) && $_POST['comparacion'] == ">"){ echo "selected"; } ?>>Mayor que</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-12" style="padding-right: 10%">
                                <input id="precio_total" class="form-control" type="number" name="precio_total" autocomplete="precio_total" autofocus value=<?php if(isset($_POST['precio_total'])){ echo $_POST['precio_total']; } ?>>
                            </div>
                            <label for="fecha_fin" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha de fin') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_fin" class="form-control" type="date" name="fecha_fin" autocomplete="fecha_fin" autofocus value=<?php if(isset($_POST['fecha_fin'])){ echo $_POST['fecha_fin']; } ?>>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group row" style="text-align: center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-secondary" style="text-align: center"> 
                                    {{ __('Aplicar filtros') }}
                                </button>
                                <button type="button" class="btn btn-danger" style="text-align: center" onclick="borrarFiltros()"> 
                                    {{ __('Borrar filtros') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            @if(Auth::user()->rol == "WEBMASTER")
            <div style="text-align: center">
               <a href="/reservas/create" class="btn btn-secondary">+ Nueva reserva</a>
            </div>
            <br>
            @endif
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha inicio</th>
                    <th scope="col">Fecha fin</th>
                    <th scope="col">Hora inicio</th>
                    <th scope="col">Hora fin</th>
                    <th scope="col">Precio</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservas as $reserva)
                    <tr>
                        <th scope="row">{{$reserva->id}}</th>
                        <td>{{date('j/m/Y', strtotime($reserva->fecha_inicio))}}</td>
                        <td>{{date('j/m/Y', strtotime($reserva->fecha_fin))}}</td>
                        <td>{{date('H:i', strtotime($reserva->fecha_inicio))}}</td>
                        <td>{{date('H:i', strtotime($reserva->fecha_fin))}}</td>
                        <td>{{$reserva->precio_total}}€</td>
                        <td><a href="/reservas/{{$reserva->id}}">Detalles</a></td>
                        <td><a href="/reservas/{{$reserva->id}}/edit">Editar</a></td>
                        <td><a onclick="confirmar('{{ $reserva->id }}')" href="#">Eliminar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="align-items: center">
            <div style="width:max-content; margin:auto">
            {{$reservas->appends(Request::all())->links()}}
            </div>
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

    function borrarFiltros() {
        document.getElementById("id").value = "";
        document.getElementById("fecha_inicio").value = "";
        document.getElementById("precio_total").value = "";
        document.getElementById("fecha_fin").value = "";    
    }
</script>
@endsection