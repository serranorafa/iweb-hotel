@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="text-align: center">{{ __('Servicios') }}</h1>
            <div class="card" style="text-align: left">
                <h4 class="card-header" style="text-align: center">{{ __('Búsqueda') }}</h4>
                <div class="card-body">
                    <form action="{{url('servicios')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="id" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('ID') }}</label>

                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="id" class="form-control" type="number" name="id" autocomplete="id" autofocus value=<?php if(isset($_POST['id'])){ echo $_POST['id']; } ?>>
                            </div>
                            <label for="nombre" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Nombre') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="nombre" class="form-control" type="text" name="nombre" autocomplete="nombre" autofocus value=<?php if(isset($_POST['nombre'])){ echo $_POST['nombre']; } ?>>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="tarifa" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Tarifa') }}</label>
                            <div class="col-lg-2 col-12">
                                <select id="comparacion" name="comparacion" class="form-control" autofocus>
                                    <option value="<=">Hasta</option>
                                    <option value="=" <?php if(isset($_POST['comparacion']) && $_POST['comparacion'] == "="){ echo "selected"; } ?>>Igual a</option>
                                    <option value=">" <?php if(isset($_POST['comparacion']) && $_POST['comparacion'] == ">"){ echo "selected"; } ?>>Mayor a</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-12" style="padding-right: 10%">
                                <input id="tarifa" class="form-control" type="number" name="tarifa" autocomplete="tarifa" autofocus value=<?php if(isset($_POST['tarifa'])){ echo $_POST['tarifa']; } ?>>
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
            <div style="text-align: center">
               <a href="/servicios/create" class="btn btn-secondary">+ Nuevo servicio</a>
            </div>
            <br>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tarifa diaria</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios as $servicio)
                    <tr>
                        <th scope="row">{{$servicio->id}}</th>
                        <td>{{$servicio->nombre}}</td>
                        <td>{{$servicio->tarifa}}€</td>
                        <td><a href="/servicios/{{$servicio->id}}">Detalles</a></td>
                        <td><a href="/servicios/{{$servicio->id}}/edit">Editar</a></td>
                        <td><a onclick="confirmar('{{ $servicio->id }}')" href="#">Eliminar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="align-items: center">
            <div style="width:max-content; margin:auto">
            {{$servicios->appends(Request::all())->links()}}
            </div>
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

    function borrarFiltros() {
        document.getElementById("id").value = "";
        document.getElementById("nombre").value = "";
        document.getElementById("tarifa").value = "";   
    } 
</script>
@endsection