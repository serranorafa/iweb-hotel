@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div style="text-align: center">
            <div id="carouselHome" class="carousel slide carousel-fade" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselHome" data-slide-to="0" class="active"></li>
    <li data-target="#carouselHome" data-slide-to="1" class=""></li>
    <li data-target="#carouselHome" data-slide-to="2" class=""></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="https://via.placeholder.com/1000x600" />
    </div>
    <div class="carousel-item">
    <img src="https://via.placeholder.com/1000x600"/>
    </div>
    <div class="carousel-item">
    <img src="https://via.placeholder.com/1000x600"/>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselHome" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselHome" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
        </div>
    </div>
</div>
@endsection
