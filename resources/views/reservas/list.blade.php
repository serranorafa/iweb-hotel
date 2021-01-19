@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="text-align: center">{{ __('Reservas') }}</h1>
            <div class="card" style="text-align: left">
                <div class="card-body">
                <h4 style="text-align: center">{{ __('Búsqueda') }}</h4>
                    <form action="{{url('reservas')}}" method="POST">
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
                            <label for="precio_total" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Precio') }}</label>
                            <div class="col-lg-2 col-12">
                                <select id="comparacion" name="comparacion" class="form-control" autofocus>
                                    <option value="<=" selected>Hasta</option>
                                    <option value="=">Igual que</option>
                                    <option value=">">Mayor que</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-12" style="padding-right: 10%">
                                <input id="precio_total" class="form-control" type="number" name="precio_total" autocomplete="precio_total" autofocus>
                            </div>
                            <label for="fecha_fin" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha de fin') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_fin" class="form-control" type="date" name="fecha_fin" autocomplete="fecha_fin" autofocus>
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
               <a href="/reservas/create" class="btn btn-secondary">+ Nueva reserva</a>
            </div>
            <br>
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
</script>
@endsection