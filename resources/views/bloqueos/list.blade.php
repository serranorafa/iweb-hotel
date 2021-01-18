@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="text-align: center">{{ __('Bloqueos') }}</h1>
            <div class="card" style="text-align: left">
                <div class="card-body">
                <h4 style="text-align: center">{{ __('Búsqueda') }}</h4>
                    <form method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="id" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('ID') }}</label>

                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="id" class="form-control" type="text" name="id" autocomplete="id" autofocus>
                            </div>
                            <label for="fecha_inicio" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha de inicio') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_inicio" class="form-control" type="date" name="fecha_inicio" autocomplete="fecha_inicio" autofocus>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="fecha_fin" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha de fin') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_fin" class="form-control" type="date" name="fecha_fin" autocomplete="fecha_fin" autofocus>
                            </div>
                            <label for="estancia_numero" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Nº de estancia') }}</label>

                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="estancia_numero" class="form-control" type="text" name="estancia_numero" autocomplete="estancia_numero" autofocus>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group row" style="text-align: center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-secondary" style="text-align: center"> 
                                    {{ __('Aplicar filtros') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div style="text-align: center">
               <a href="/bloqueos/create" class="btn btn-secondary">+ Nuevo bloqueo</a>
            </div>
            <br>
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
                        <td>{{$bloqueo->estancia->numero}}</td>
                        <td><a href="/bloqueos/{{$bloqueo->id}}">Detalles</a></td>
                        <td><a href="/bloqueos/{{$bloqueo->id}}/edit">Editar</a></td>
                        <td><a href="#">Eliminar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="align-items: center">
            <div style="width:max-content; margin:auto">
            {{$bloqueos->links()}}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection