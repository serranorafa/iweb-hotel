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
                                <input id="fecha_inicio" class="form-control" type="date" name="fecha_inicio" autocomplete="fecha_inicio" autofocus required 
                                    value="<?php if(isset($_POST['fecha_inicio'])){ echo $_POST['fecha_inicio']; } ?>">
                                @error('fecha_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="fecha_fin" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha salida') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="fecha_fin" class="form-control" type="date" name="fecha_fin" autocomplete="fecha_fin" autofocus required
                                    value="<?php if(isset($_POST['fecha_fin'])){ echo $_POST['fecha_fin']; } ?>">
                                @error('fecha_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br><hr />
                        <!-- HABITACIONES -->
                        <h4 class="pb-3" style="text-align: center">{{__('Elige habitaciones')}}</h4>
                        <div id="habitacionesElegidas" style="display: none">
                            <table id="listaHabitacionesElegidas" class="table">
                                <thead>
                                    <tr>   
                                    <th></th>
                                    <th scope="col">Plazas</th> 
                                    <th></th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody id="filasHabitaciones">
                                
                                </tbody>
                            </table>
                            <div class="form-group row" style="text-align: center">
                                <div class="col-md-12">
                                    <button type="button" onclick="hacerReserva()" class="btn btn-secondary">
                                        {{ __('Hacer reserva') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                        </div>
                        <div class="form-group row">
                            <label for="plazas" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Huéspedes') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <input id="plazas" class="form-control" type="number" name="plazas" autocomplete="plazas" autofocus
                                    value="<?php if(isset($_POST['plazas'])){ echo $_POST['plazas']; } ?>">
                                
                            </div>
                            <label for="vistas" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Vistas') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <select id="vistas" name="vistas" autofocus>
                                    <option value="">Cualquiera</option>
                                    <option value="Vistas al jardin" <?php if(isset($_POST['vistas']) && $_POST['vistas']=="Vistas al jardin") echo "selected";?>>Vistas al jardín</option>
                                    <option value="Vistas a la piscina" <?php if(isset($_POST['vistas']) && $_POST['vistas']=="Vistas a la piscina") echo "selected";?>>Vistas a la piscina</option>
                                    <option value="Vistas al mar" <?php if(isset($_POST['vistas']) && $_POST['vistas']=="Vistas al mar") echo "selected";?>>Vistas al mar</option>
                                    <option value="Vistas al aparcamiento" <?php if(isset($_POST['vistas']) && $_POST['vistas']=="Vistas al aparcamiento") echo "selected";?>>Vistas al aparcamiento</option>
                                </select>                          
                            </div>
                        </div>
                        <br>
                        <div class="form-group row" style="text-align: center">
                            <div class="col-md-12">
                                <button onclick="buscarHabitaciones()" type="button" class="btn btn-secondary">
                                    {{ __('Buscar habitaciones') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <table id="listaHabitaciones" class="table" style="display: none">
                        <thead>
                            <tr>   
                            <th scope="col">ID</th>                        
                            <th scope="col">Planta</th>
                            <th scope="col">Plazas</th>
                            <th scope="col">Tarifa base/noche</th>
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
    function anyadirHabitacion(habitacion) {
        console.log(habitacion);
        var objHabitacion = habitacion;

        var tabla = document.getElementById('filasHabitaciones');
        document.getElementById('habitacionesElegidas').style.display = 'block';
        document.getElementById(objHabitacion.id).style.display = 'none';

        var fila = tabla.insertRow(-1); 
        fila.setAttribute("id", "fila" + objHabitacion.id)
        var numHabitacion = fila.insertCell(0);
        var plazas = fila.insertCell(1);
        var btnDetalles = fila.insertCell(2);
        var btnEliminar = fila.insertCell(3);
        
        numHabitacion.innerHTML = "Habitación " + (tabla.childNodes.length - 1);
        plazas.innerHTML = objHabitacion.plazas;
        btnDetalles.innerHTML = '<a href="/estancias/' + objHabitacion.id + '" target="_blank" rel="noopener noreferrer">Detalles</a>';
        btnEliminar.innerHTML = '<a href="#" onclick="eliminarHabitacion(' + objHabitacion.id + ')">Eliminar</a>';
    }

    function eliminarHabitacion(id) {
        document.getElementById('fila' + id).remove();
        document.getElementById(id).style.display = 'table-row';

        if (document.getElementById('filasHabitaciones').childNodes.length == 1) {
            document.getElementById('habitacionesElegidas').style.display = 'none'
        }
    }

    async function hacerReserva() {
        var habitaciones = document.getElementById('filasHabitaciones').childNodes;
        var _fecha_inicio = document.getElementById('fecha_inicio').value;
        var _fecha_fin = document.getElementById('fecha_fin').value;

        var i = 0;
        habitaciones.forEach(habitacion => {            
            if (i != 0) {               
                var estancia = habitacion.getAttribute("id").slice(4, 6);
                console.log(estancia);
                var token = '{{csrf_token()}}';
                var data = { fecha_inicio: _fecha_inicio, fecha_fin: _fecha_fin, estancia_id: estancia, _token: token}

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

    function buscarHabitaciones() {
        var fecha_inicio = document.getElementById('fecha_inicio').value;
        var fecha_fin = document.getElementById('fecha_fin').value;
        var plazas = document.getElementById('plazas').value;
        var vistas = document.getElementById('vistas').value;
        var token = '{{csrf_token()}}';

        var data = { fecha_inicio: fecha_inicio, fecha_fin: fecha_fin, plazas: plazas, vistas: vistas, _token: token };

        $.ajax({
            type: "post",
            url: "{{url('reservas/buscarhabitacion')}}",
            data: data,
            success: function (_response) {

                if (_response.habitaciones.length > 0) {
                    document.getElementById('listaHabitaciones').style.display = 'table';
                    var tabla = document.getElementById('filasBusqueda');

                    _response.habitaciones.forEach(habitacion => {
                        console.log(habitacion);
                        var fila = tabla.insertRow(-1); 
                        fila.setAttribute("id", habitacion.id)
                        var idHabitacion = fila.insertCell(0);
                        var plantaHabitacion = fila.insertCell(1);
                        var plazasHabitacion = fila.insertCell(2);
                        var tarifaHabitacion = fila.insertCell(3);
                        var vistasHabitacion = fila.insertCell(4);
                        var btnDetalles = fila.insertCell(5);
                        var btnEliminar = fila.insertCell(6);

                        idHabitacion.innerHTML = habitacion.id;
                        plantaHabitacion.innerHTML = habitacion.planta;
                        plazasHabitacion.innerHTML = habitacion.plazas;
                        tarifaHabitacion.innerHTML = habitacion.tarifa_base + "€";
                        vistasHabitacion.innerHTML = habitacion.vistas;
                        btnDetalles.innerHTML = '<a href="/estancias/' + habitacion.id + '" target="_blank" rel="noopener noreferrer">Detalles</a>';
                        btnEliminar.innerHTML = '<a href="#" onclick="anyadirHabitacion(' + habitacion + ')">Elegir</a>';
                    })
                }
            }
        })

        
    }
</script>
@endsection
