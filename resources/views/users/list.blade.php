@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="text-align: center">{{ __('Usuarios') }}</h1>
            <div class="card" style="text-align: center">
                <div class="card-body">
                    <form method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="nombre" class="col-lg-3 col-12 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-lg-3 col-12">
                                <input id="nombre" type="text" name="nombre" autocomplete="nombre" autofocus>
                            </div>
                            <label for="apellidos" class="col-lg-3 col-12 col-form-label text-md-right">{{ __('Apellidos') }}</label>
                            <div class="col-lg-3 col-12">
                                <input id="apellidos" type="text" name="apellidos" autocomplete="apellidos" autofocus>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="email" class="col-lg-3 col-12 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>

                            <div class="col-lg-3 col-12">
                                <input id="email" type="email" name="email" autocomplete="email" autofocus>
                            </div>
                            <label for="telefono" class="col-lg-3 col-12 col-form-label text-md-right">{{ __('Teléfono de contacto') }}</label>
                            <div class="col-lg-3 col-12">
                                <input id="telefono" type="tel" name="telefono" autocomplete="telefono" autofocus>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="rol" class="col-lg-3 col-12 col-form-label text-md-right">{{ __('Rol') }}</label>
                            <div class="col-lg-3 col-12">
                                <select id="rol" name="rol" autofocus>
                                    <option value="" selected>Cualquiera</option>
                                    <option value="CLIENTE">Cliente</option>
                                    <option value="RECEPCIONISTA">Recepcionista</option>
                                    <option value="WEBMASTER">Webmaster</option>
                                </select>
                            </div>
                        </div>
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
               <a class="btn btn-secondary">+ Nuevo usuario</a>
            </div>
            <br>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Correo electrónico</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->nombre}}</td>
                        <td>{{$user->apellidos}}</td>
                        <td>{{$user->email}}</td>
                        <td><a href="#">Detalles</a></td>
                        <td><a href="#">Eliminar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="align-items: center">
            <div style="width:max-content; margin:auto">
            {{$users->links()}}
            </div>
            </div>
        </div>
    </div>
</div>
@endsection