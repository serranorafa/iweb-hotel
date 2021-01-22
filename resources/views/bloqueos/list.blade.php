@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="text-align: center">{{ __('Bloqueos') }}</h1>
            <div class="card" style="text-align: left">
                <h4 class="card-header" style="text-align: center">{{ __('Búsqueda') }}</h4>
                <div class="card-body">
                    <form action="{{url('bloqueos')}}" method="POST">
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
                            <label for="fecha_fin" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha de fin') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_fin" class="form-control" type="date" name="fecha_fin" autocomplete="fecha_fin" autofocus value=<?php if(isset($_POST['fecha_fin'])){ echo $_POST['fecha_fin']; } ?>>
                            </div>
                            <label for="estancia_numero" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Nº de estancia') }}</label>

                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="estancia_numero" class="form-control" type="number" name="estancia_numero" autocomplete="estancia_numero" autofocus value=<?php if(isset($_POST['estancia_numero'])){ echo $_POST['estancia_numero']; } ?>>
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
               <a href="/bloqueos/create" class="btn btn-secondary">+ Nuevo bloqueo</a>
            </div>
            <br>
            @endif
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fecha de inicio</th>
                    <th scope="col">Fecha de fin</th>
                    <th scope="col">Hora de inicio</th>
                    <th scope="col">Hora de fin</th>
                    <th scope="col">Nº de estancia</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bloqueos as $bloqueo)
                    <tr>
                        <th scope="row">{{$bloqueo->id}}</th>
                        <td>{{date('j/m/Y', strtotime($bloqueo->fecha_inicio))}}</td>
                        <td>{{date('j/m/Y', strtotime($bloqueo->fecha_fin))}}</td>
                        <td>{{date('H:i', strtotime($bloqueo->fecha_inicio))}}</td>
                        <td>{{date('H:i', strtotime($bloqueo->fecha_fin))}}</td>
                        <td>{{$bloqueo->getEstancia->numero}}</td>
                        <td><a href="/bloqueos/{{$bloqueo->id}}">Detalles</a></td>
                        <td><a href="/bloqueos/{{$bloqueo->id}}/edit">Editar</a></td>
                        <td><a onclick="confirmar('{{ $bloqueo->id }}')" href="#">Eliminar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="align-items: center">
            <div style="width:max-content; margin:auto">
            {{$bloqueos->appends(Request::all())->links()}}
            </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmar(bloqueo) {
        if (confirm("¿Confirmar el borrado?")) {
            window.location.href = "/borrarbloqueo/" + bloqueo;
        } else {
        }
    }   

    function borrarFiltros() {
        document.getElementById("id").value = "";
        document.getElementById("fecha_inicio").value = "";
        document.getElementById("fecha_fin").value = "";   
        document.getElementById("estancia_numero").value = "";
    }
</script>
@endsection