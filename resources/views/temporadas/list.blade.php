@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="text-align: center">{{ __('Temporadas') }}</h1>
            <br>
            <div style="text-align: center">
               <a class="btn btn-secondary">+ Nueva temporada</a>
            </div>
            <br>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha de inicio</th>
                    <th scope="col">Fecha de fin</th>
                    <th scope="col">Modificación del precio</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($temporadas as $temporada)
                    <tr>
                        <th scope="row">{{$temporada->id}}</th>
                        <td>{{$temporada->nombre}}</td>
                        <td>{{date('j F', strtotime($temporada->fecha_inicio))}}</td>
                        <td>{{date('j F', strtotime($temporada->fecha_fin))}}</td>
                        <td>{{$temporada->mod_temporada}}</td>
                        <td><a href="#">Detalles</a></td>
                        <td><a href="#">Eliminar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="align-items: center">
            <div style="width:max-content; margin:auto">
            {{$temporadas->links()}}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection