@extends('client.layouts.master')

@section('content')
<section class="w3l-grids-3 py-5">
    <div class="container py-md-5">
        <div class="title-content text-left mb-lg-5 mb-4">
            @include('Common.Error')
            <h3 class="hny-title">@lang('language.popular')</h3>
        </div>
        <div class="row bottom-ab-grids">
            <!--/row-grids-->
            @foreach ($tours as $tour)
                <div class="col-lg-6 subject-card mt-lg-0 mt-4">
                    <div class="subject-card-header p-4">
                        <a href="{{route('user.tour.show',$tour->tour_id)}}" class="card_title p-lg-4d-block">
                            <div class="row align-items-center">
                                <div class="col-sm-5 subject-img">
                                    <img src="upload/{{$tour->image}}" class="img-fluid" alt="">
                                </div>
                                <div class="col-sm-7 subject-content mt-sm-0 mt-4">
                                    <h4>{{$tour->name}}</h4>
                                    <p>{{trans('language.duration')}}: {{$tour->duration}}</p>
                                    <div class="dst-btm">
                                        <h6 class=""> {{trans('language.price')}} </h6>
                                        <span>${{$tour->price}}</span>
                                    </div>
                                    <ul class="list-unstyled list-inline rating mb-0">
                                        <li class="list-inline-item mr-0"><i class="fas fa-star"></i>
                                        </li>
                                        <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i>
                                        </li>
                                        <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i>
                                        </li>
                                        <li class="list-inline-item mr-0"><i class="fas fa-star amber-text"></i>
                                        </li>
                                        <li class="list-inline-item"><i class="fas fa-star-half-alt amber-text"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <p class="text-muted">4.5 (413)</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!--//row-grids-->
            @endforeach
        </div>
    </div>
</section>
@endsection


