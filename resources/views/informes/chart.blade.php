@extends('layouts.app')

@section('content')
<script src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    google.charts.load('current', {packages: ['bar']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      // Define the chart to be drawn.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Mes');
      data.addColumn('number', '{{$label}}');
      data.addRows([
        @foreach($entradas as $mes => $valor)
        ['{{$mes}}', {{$valor}}],
        @endforeach
      ]);

      // Instantiate and draw the chart.
      var chart = new google.charts.Bar(document.getElementById('informe'));
      chart.draw(data, {bars: 'vertical'});
    }
  </script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="text-align: center">{{ __('Informes') }}</h1>
            <div class="card" style="text-align: left">
                <h4 class="card-header" style="text-align: center">{{ __('Filtros') }}</h4>
                <div class="card-body">
                    <form action="{{url('informes')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="tipo" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Tipo') }}</label>
                            <div class="col-lg-4 col-12" style="padding-right: 10%">
                                <select id="tipo" name="tipo" class="form-control" autofocus>
                                    <option value="RESERVAS"   <?php if(isset($_POST['tipo']) && $_POST['tipo'] == "RESERVAS"){ echo "selected"; } ?>>Beneficio mensual</option>
                                    <option value="OCUPACION"  <?php if(isset($_POST['tipo']) && $_POST['tipo'] == "OCUPACION"){ echo "selected"; } ?>>% de ocupación mensual</option>
                                    <option value="REGISTROS"  <?php if(isset($_POST['tipo']) && $_POST['tipo'] == "REGISTROS"){ echo "selected"; } ?>>Nuevos usuarios mensuales</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="fecha_inicio" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha de inicio') }}</label>
                            <div class="col-lg-2 col-12">
                                <select id="mes_inicio" name="mes_inicio" class="form-control" autofocus>
                                    <option value="01" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "01"){ echo "selected"; } ?>>Enero</option>
                                    <option value="02" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "02"){ echo "selected"; } ?>>Febrero</option>
                                    <option value="03" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "03"){ echo "selected"; } ?>>Marzo</option>
                                    <option value="04" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "04"){ echo "selected"; } ?>>Abril</option>
                                    <option value="05" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "05"){ echo "selected"; } ?>>Mayo</option>
                                    <option value="06" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "06"){ echo "selected";} ?>>Junio</option>
                                    <option value="07" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "07"){ echo "selected";} ?>>Julio</option>
                                    <option value="08" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "08"){ echo "selected";} ?>>Agosto</option>
                                    <option value="09" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "09"){ echo "selected";} ?>>Septiembre</option>
                                    <option value="10" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "10"){ echo "selected";} ?>>Octubre</option>
                                    <option value="11" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "11"){ echo "selected";} ?>>Noviembre</option>
                                    <option value="12" <?php if(isset($_POST['mes_inicio']) && $_POST['mes_inicio'] == "12"){ echo "selected";} ?>>Diciembre</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-12" style="padding-right: 10%">
                                <select id="anyo_inicio" name="anyo_inicio" class="form-control" autofocus>
                                    @for ($i = 1970; $i <= date("Y"); $i++)
                                        <option value={{$i}} <?php if(isset($_POST['anyo_inicio']) && $_POST['anyo_inicio'] == $i){ echo "selected";} ?>>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <label for="fecha_fin" class="col-lg-2 col-12 col-form-label text-md-right">{{ __('Fecha de fin') }}</label>
                            <div class="col-lg-2 col-12">
                                <select id="mes_fin" name="mes_fin" class="form-control" autofocus>
                                    <option value="01" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "01"){ echo "selected";} ?>>Enero</option>
                                    <option value="02" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "02"){ echo "selected";} ?>>Febrero</option>
                                    <option value="03" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "03"){ echo "selected";} ?>>Marzo</option>
                                    <option value="04" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "04"){ echo "selected";} ?>>Abril</option>
                                    <option value="05" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "05"){ echo "selected";} ?>>Mayo</option>
                                    <option value="06" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "06"){ echo "selected";} ?>>Junio</option>
                                    <option value="07" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "07"){ echo "selected";} ?>>Julio</option>
                                    <option value="08" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "08"){ echo "selected";} ?>>Agosto</option>
                                    <option value="09" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "09"){ echo "selected";} ?>>Septiembre</option>
                                    <option value="10" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "10"){ echo "selected";} ?>>Octubre</option>
                                    <option value="11" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "11"){ echo "selected";} ?>>Noviembre</option>
                                    <option value="12" <?php if(isset($_POST['mes_fin']) && $_POST['mes_fin'] == "12"){ echo "selected";} ?>>Diciembre</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-12" style="padding-right: 10%">
                                <select id="anyo_fin" name="anyo_fin" class="form-control" autofocus>
                                    @for ($i = 1970; $i <= date("Y"); $i++)
                                        <option value={{$i}} <?php if(isset($_POST['anyo_fin']) && $_POST['anyo_fin'] == $i){ echo "selected";} ?>>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row" style="text-align: center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-secondary" style="text-align: center"> 
                                    {{ __('Generar informes') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="informe" style="margin-top: 10vh"></div>
            </div>
            <br>
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
</script>
@endsection