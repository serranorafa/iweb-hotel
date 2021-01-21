@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">            
            <div class="card">
                <h1 class="card-header" style="text-align: center">{{ __('Reserva') }}</h1>
                <div class="card-body" style="text-align: left">
                    <form action="{{url('reservas/habitacion')}}" method="POST">
                        @csrf
                        <!-- FECHAS -->
                        <h4 class="pb-3" style="text-align: center">{{__('Elige las fechas')}}</h4>
                        <div class="form-group row">
                            <label for="fecha_inicio" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha entrada') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_inicio" class="form-control" type="date" name="fecha_inicio" autocomplete="fecha_inicio" autofocus required >
                                @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="fecha_fin" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha salida') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_fin" class="form-control" type="date" name="fecha_fin" autocomplete="fecha_fin" autofocus required>
                                @error('fecha_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br><hr />
                        <!-- HABITACIONES -->
                        <h4 id="mishabitaciones" class="pb-3" style="text-align: center; display: none">{{__('Mis habitaciones')}}</h4>
                        <div id="habitacionesElegidas" style="display: none">
                            <table id="listaHabitacionesElegidas" class="table">
                                <thead>
                                    <tr>   
                                    <th></th>
                                    <th scope="col">Planta</th> 
                                    <th scope="col">Precio/noche</th>
                                    <th scope="col">Plazas</th> 
                                    <th></th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody id="filasHabitaciones">
                                </tbody>
                            </table>
                            <h4 class="pb-3 mt-5" style="text-align: center">{{__('Elige pensión')}}</h4>
                            <div class="row" style="text-align: center">
                                <div class="col-md-4 col-12">
                                    <select class="form-control" id="pension" name="pension" autofocus onchange="descripcionPension()">
                                        <option value="SA" selected>Solo alojamiento</option>
                                        <option value="AD">Alojamiento y desayuno</option>
                                        <option value="MP">Media pensión</option>
                                        <option value="PC">Pensión completa</option>
                                        <option value="TI">Todo incluido</option>
                                    </select>                          
                                </div>
                                <label class="col-md-8 col-12" id="descripcion" style="text-align: left"></label>
                            </div>
                            <div style="clear: both; height: 2vh">
                            </div>
                            @if(Auth::user()->rol == "RECEPCIONISTA" || Auth::user()->rol == "WEBMASTER")
                            <hr />
                            <h4 class="pb-3 mt-5" style="text-align: center">{{__('Usuario')}}</h4>
                            <div class="row" style="text-align: center">
                                <div class="col-12" style="text-align: center">
                                    <select class="form-control" id="usuario" name="usuario" style="width: 40%; display: inline" autofocus>
                                        <option value="" selected>-</option>
                                        <option value="anonimo">Anónimo</option>
                                        @foreach($usuarios as $usuario)
                                            <option value="{{$usuario->getId()}}">{{$usuario->getEmail()}}</option>
                                        @endforeach
                                    </select>                          
                                </div>
                            </div>
                            <br>
                            @endif
                            <div class="form-group row" style="text-align: center">
                                <div class="col-md-12">
                                    <button id="btnReserva" type="button" onclick="hacerReserva()" class="btn btn-primary btn-lg mb-2">
                                        {{ __('Hacer reserva') }}
                                    </button>
                                </div>
                            </div>
                            <label id="precioTotal"></label>
                            <hr>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="plazas" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Huéspedes') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="plazas" class="form-control" type="number" name="plazas" autocomplete="plazas" autofocus>
                                
                            </div>
                            <label for="vistas" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Vistas') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <select class="form-control" id="vistas" name="vistas" autofocus>
                                    <option value="">Cualquiera</option>
                                    <option value="Vistas al jardin">Vistas al jardín</option>
                                    <option value="Vistas a piscina">Vistas a piscina</option>
                                    <option value="Vistas al mar">Vistas al mar</option>
                                    <option value="Vistas al aparcamiento">Vistas al aparcamiento</option>
                                </select>                          
                            </div>
                        </div>
                        <div style="clear: both; height: 2vh">
                        </div>
                        <div class="form-group row" style="text-align: center">
                            <div class="col-md-12">
                                <button onclick="buscarHabitaciones()" type="button" class="btn btn-secondary mt-4">
                                    {{ __('Buscar habitaciones') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <h4 id="eligehabitaciones" class="pb-3" style="text-align: center; display: none">{{__('Elige habitaciones')}}</h4>
                    <table id="listaHabitaciones" class="table" style="display: none">
                        <thead>
                            <tr>                      
                            <th scope="col">Planta</th>
                            <th scope="col">Plazas</th>
                            <th scope="col">Precio/noche</th>
                            <th scope="col">Vistas</th>                         
                            <th scope="col"></th>                      
                            <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="filasBusqueda">
                        </tbody>
                    </table>
                    

                </div> <!-- card body -->
            </div>
        </div>
    </div>
</div>
<script>
    var precioTotal = 0;
    var modTemporada = 0;
    var numDias = 0;
    var precioServicio = 0;
    var tarifaHabitaciones = 0;
    var numHabitaciones = 0;
    document.addEventListener("DOMContentLoaded", descripcionPension());

    function anyadirHabitacion(habitacion) {
        var objHabitacion = habitacion;
        tarifaHabitaciones += objHabitacion.tarifa_base;
        precioTotal += (numDias * (objHabitacion.tarifa_base + precioServicio) * modTemporada);
        document.getElementById('btnReserva').innerHTML = "Hacer reserva por " + precioTotal.toFixed(2) + "€";

        var tabla = document.getElementById('filasHabitaciones');
        document.getElementById('habitacionesElegidas').style.display = 'block';
        document.getElementById('mishabitaciones').style.display = 'block';
        document.getElementById(objHabitacion.id).style.display = 'none';

        var fila = tabla.insertRow(-1); 
        fila.setAttribute("id", "fila" + objHabitacion.id)
        var numHabitacion = fila.insertCell(0);
        var planta = fila.insertCell(1);
        var tarifa = fila.insertCell(2);
        var plazas = fila.insertCell(3);
        var btnDetalles = fila.insertCell(4);
        var btnEliminar = fila.insertCell(5);
        
        numHabitaciones++;
        numHabitacion.innerHTML = "Habitación " + (tabla.childNodes.length - 1);
        plazas.innerHTML = objHabitacion.plazas;
        tarifaFinal = habitacion.tarifa_base * modTemporada;
        tarifa.innerHTML = tarifaFinal.toFixed(2) + "€";
        planta.innerHTML = objHabitacion.planta;
        btnDetalles.innerHTML = '<a href="/estancias/' + objHabitacion.id + '" target="_blank" rel="noopener noreferrer">Detalles</a>';
        btnEliminar.innerHTML = '<a href="#">Eliminar</a>';
        btnEliminar.onclick = function() {
            eliminarHabitacion(objHabitacion);
        }
    }

    function eliminarHabitacion(habitacion) {
        tarifaHabitaciones -= habitacion.tarifa_base;
        precioTotal -= (numDias * (habitacion.tarifa_base + precioServicio) * modTemporada);
        document.getElementById('btnReserva').innerHTML = "Hacer reserva por " + precioTotal.toFixed(2) + "€";
        document.getElementById('fila' + habitacion.id).remove();
        document.getElementById(habitacion.id).style.display = 'table-row';
        numHabitaciones--;

        if (document.getElementById('filasHabitaciones').childNodes.length == 1) {
            document.getElementById('habitacionesElegidas').style.display = 'none'
            document.getElementById('mishabitaciones').style.display = 'none'
        }
    }

    async function hacerReserva() {
        if (confirm("¿Confirmar la reserva?")) {
            var habitaciones = document.getElementById('filasHabitaciones').childNodes;
            var _fecha_inicio = document.getElementById('fecha_inicio').value;
            document.getElementById('fecha_inicio').setAttribute("disabled", true);
            var _fecha_fin = document.getElementById('fecha_fin').value;
            document.getElementById('fecha_fin').setAttribute("disabled", true);
            var servicio = document.getElementById('pension').value;
            @if(Auth::user()->rol == "RECEPCIONISTA" || Auth::user()->rol == "WEBMASTER")
                var usuario = document.getElementById('usuario').value;
            @else
                var usuario = "";
            @endif

            var i = 0;
            habitaciones.forEach(habitacion => { 
                if (i != 0) {               
                    var estancia = habitacion.getAttribute("id").slice(4);
                    var token = '{{csrf_token()}}';
                    var data = { fecha_inicio: _fecha_inicio, fecha_fin: _fecha_fin, estancia_id: estancia, servicio: servicio, usuario: usuario, _token: token };

                    $.ajax({
                        type: "post",
                        url: "{{url('reservacreada')}}",
                        data: data,
                        success: function(msg) {
                            console.log('asdf')
                        },
                        async: false
                    })
                }
                i++;
            })
            window.location.href = "/reservas/habitacion";
        }
    }

    function habitacionElegida(id) {
        var habitaciones = document.getElementById('filasHabitaciones').childNodes;

        var i = 0;
        for (const habitacion of habitaciones) {
            if (i != 0) {
                if (habitacion.getAttribute("id").slice(4) == id) {
                    return true;
                }
            }
            i++;
        }
        return false;
    }

    function fechaFinDespues() {
        var fecha_inicio = document.getElementById('fecha_inicio').value;
        var fecha_fin = document.getElementById('fecha_fin').value;
        return fecha_inicio <= fecha_fin;
    }

    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });

    function fechaInicioPosteriorAHoy() {
        var fecha_inicio = document.getElementById('fecha_inicio').value;
        var hoy = new Date().toDateInputValue();
        return fecha_inicio >= hoy;
    }

    function buscarHabitaciones() {
        if (document.getElementById('fecha_inicio').value == '' ||
            document.getElementById('fecha_fin').value == '') {
            alert("Faltan fechas por rellenar.");
            return;
        }
        if (!fechaFinDespues()) {
            alert("La fecha de salida debe ser posterior a la de entrada.");
            return;
        }
        if (!fechaInicioPosteriorAHoy()) {
            alert("La fecha de entrada debe ser posterior a hoy.");
            return;
        }
        document.getElementById('filasBusqueda').innerHTML = "";
        var fecha_inicio = document.getElementById('fecha_inicio').value;
        document.getElementById('fecha_inicio').setAttribute("disabled", true);
        document.getElementById('fecha_fin').setAttribute("disabled", true);
        var fecha_fin = document.getElementById('fecha_fin').value;
        var plazas = document.getElementById('plazas').value;
        var vistas = document.getElementById('vistas').value;
        var token = '{{csrf_token()}}';
        var data = { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, _token: token };

        $.ajax({
            type: "post",
            url: "{{url('reservas/modificador')}}",
            data: data,
            success: function (_response) {
                modTemporada = _response.modTemporada;
                numDias = _response.numDias;
            }
        })

        data = { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, plazas: plazas, vistas: vistas, _token: token };

        $.ajax({
            type: "post",
            url: "{{url('reservas/buscarhabitacion')}}",
            data: data,
            success: function (_response) {

                if (_response.habitaciones.length > 0) {
                    document.getElementById('eligehabitaciones').style.display = 'block';
                    document.getElementById('listaHabitaciones').style.display = 'table';
                    var tabla = document.getElementById('filasBusqueda');

                    _response.habitaciones.forEach(habitacion => {
                        var fila = tabla.insertRow(-1); 
                        fila.setAttribute("id", habitacion.id)
                        var plantaHabitacion = fila.insertCell(0);
                        var plazasHabitacion = fila.insertCell(1);
                        var tarifaHabitacion = fila.insertCell(2);
                        var vistasHabitacion = fila.insertCell(3);
                        var btnDetalles = fila.insertCell(4);
                        var btnAynadir = fila.insertCell(5);

                        plantaHabitacion.innerHTML = habitacion.planta;
                        plazasHabitacion.innerHTML = habitacion.plazas;
                        tarifaFinal = habitacion.tarifa_base * modTemporada;
                        tarifaHabitacion.innerHTML = tarifaFinal.toFixed(2) + "€";
                        vistasHabitacion.innerHTML = habitacion.vistas;
                        btnDetalles.innerHTML = '<a href="/estancias/' + habitacion.id + '" target="_blank" rel="noopener noreferrer">Detalles</a>';
                        btnAynadir.innerHTML = '<a href="#">Elegir</a>';
                        btnAynadir.onclick = function() {
                            anyadirHabitacion(habitacion);
                        }
                        if (habitacionElegida(habitacion.id) == true) {
                            document.getElementById(habitacion.id).style.display = 'none';
                        }
                    })
                }
            }
        })
    }

    function descripcionPension() {
        var pension = document.getElementById('pension').value;
        $.ajax({
            type: "get",
            url: "{{url('servicios')}}" + '/' + pension + '/descripcion',
            success: function(_response) {
                tarifaServicio = _response.tarifa * modTemporada;
                document.getElementById('descripcion').innerHTML = _response.descripcion + " (+" + tarifaServicio.toFixed(2) + "€/noche y habitación)";
                precioServicio = _response.tarifa;
                precioTotal = (numDias * (tarifaHabitaciones + precioServicio) * modTemporada);
                
                document.getElementById('btnReserva').innerHTML = "Hacer reserva por " + precioTotal.toFixed(2) + "€";
            }
        })
    }

    function confirmar() {
        if (confirm("¿Confirmar la reserva?")) {
            window.location.href = "/reservas/habitacion";
        } else {
        }
    }  
</script>
@endsection
