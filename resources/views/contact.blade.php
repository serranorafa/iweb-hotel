@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="card">
        <h1 class="card-header" style="text-align: center">{{ __('Contacta con nosostros') }}</h1>
        <div class="card-body row">
            <div class="col-md-6" style="float:left" >
                <iframe height="100%" width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d782.3124967187671!2d-0.4780088980260248!3d38.34319565332312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzjCsDIwJzM1LjYiTiAwwrAyOCc0NC4wIlc!5e0!3m2!1ses!2ses!4v1610987159709!5m2!1ses!2ses" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
                </iframe>
            </div>
            <div class="col-md-6" style="float:right;">
                <h4>{{ __('Dirección') }}</h4>Plaza Puerta del Mar, 3, 03001 Alicante
                <h4 class="mt-4">{{ __('Teléfono') }}</h4>+34 666 666 666
                <h4 class="mt-4">{{ __('Correo eléctrónico') }}</h4>info@iwebhotel.com
                <h4 class="mt-4">{{ __('Horario de atención') }}</h4>{{ __('Las 24 horas del día, todos los días de la semana') }}
                <div class="mt-4 row" style="text-align:center;">
                    <a class="col-sm m-3" href=#>
                        <img alt="twitter" src="https://openvisualfx.com/wp-content/uploads/2019/10/pnglot.com-twitter-bird-logo-png-139932.png" width="75" height="75">
                    </a>                    
                    <a class="col-sm m-3" href=#>
                        <img alt="instagram" src="https://geografiaehistoria.ucm.es/file/stunning-instagram-logo-vector-free-download-43-for-new-logo-with-instagram-logo-vector-free-download-1024x1024/?ver" width="75" height="75">
                    </a>
                    <a class="col-sm m-3" href=# >
                        <img alt="facebook" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAGworEjx1k8UyW8oewBDfjh-j1sXLkaJzxA&usqp=CAU" width="75" height="75">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
