@extends('client.layouts.master') 

@section('content')
<div class="container">
  <!-- Card -->
  <div class="card card-cascade wider reverse">
    <!-- Card image -->
    <div class="view view-cascade overlay">
      <img class="card-img-top" src="upload/{{$tour->image}}" alt="Card image cap" />
      <a href="#!">
        <div class="mask rgba-white-slight"></div>
      </a>
    </div>
    <!-- Card content -->
    <div class="card-body card-body-cascade text-center">
      <!-- Title -->
      <h4 class="card-title"><strong>{{$tour->name}}</strong></h4>
      <!-- Subtitle -->
      <h6 class="font-weight-bold indigo-text py-2"></h6>
      <!-- Text -->
      <p class="card-text">
        {{$tour->des}}
      </p>
    </div>
  </div>
  <div class="col-md-12">
    <form action="{{route('booktour.store')}}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="tour_id" value="{{$tour->tour_id}}" />
      <div class="p-3 py-5">
        <div class="row mt-2">
          <div class="col-md-6">
            <label for="name"><b>{{trans('language.name')}}</b></label>
            <input type="text" name="name" class="form-control" value="{{$tour->name}}" readonly />
          </div>
          <div class="col-md-6">
            <label for=""><b>{{trans('language.place_from')}}</b></label>
            <input type="text" name="place_from" class="form-control" value="{{$tour->place_from}}" readonly />
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <label for="name"><b>{{trans('language.duration')}}</b></label>
            <input type="text" name="duration" class="form-control" value="{{$tour->duration}}" readonly />
          </div>
          <div class="col-md-6">
            <label for="name"><b>{{trans('language.place_to')}}</b></label>
            <input type="text" name="place_to" class="form-control" value="{{$tour->place_to}}" readonly />
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <label for="name"><b>{{trans('language.price')}}</b></label>
            <input type="text" id="price" name="price" class="form-control" value="{{$tour->price}}" readonly />
          </div>
          <div class="col-md-6">
            <label for="name"><b>{{trans('language.place_tobe')}}</b></label>
            <input type="text" name="place_tobe" class="form-control" value="{{$tour->place_tobe}}" readonly />
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-6">
            <label for="name"><b>{{trans('language.quantity_people')}}</b></label><br />
            <input type="number" class="form-control" id="quantity" onChange="updateTotalPrice(this)" name="quantity_people" min="1" max="{{$tour->quantity_people}}}" />
          </div>
          <div class="col-md-6">
            <label for="">{{trans('language.total_price')}}</label>
            <p id="total_price" class="text text-danger"></p>
            <input type="hidden" id="amount" name="amount" readonly />
            <input type="hidden" name="tour_id" value="{{$tour->tour_id}}" readonly />
          </div>
        </div>
        @include('Common.Error')
        <p class="text text-danger">{{ $errors->first('quantity_people') }}</p>
        @auth
        <div class="row mt-5 d-flex justify-content-center">
          <button type="submit" class="btn btn-success">{{trans('language.book_now')}}</button>
        </div>
        @endauth
      </div>
    </form>
  </div>
  <div class="col-md-12">
    <h4>{{trans('language.review')}}</h4>
    @if (count($reviews) > 0)
    <ul>
      @foreach ($reviews as $review)
      <li><a href="{{route('review.show',$review->cmr_id)}}">{{$review->title}}</a></li>
      @endforeach
    </ul>
    @else
    <p>{{trans('language.review_none')}}</p>
    @endif @auth
    <div class="mt-5">
      <a href="#reviewModal" data-toggle="modal"><button class="btn btn-success">{{trans('language.review_create')}}</button></a>
    </div>
    <div class="modal fade" id="reviewModal">
      <div class="modal-dialog modal-lg">
        <form action="{{route('review.store')}}" method="POST">
          {{ csrf_field() }}
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">{{trans('language.review_create')}}</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
              <input type="hidden" name="tour_id" value="{{$tour->tour_id}}" />
              <div class="form-group">
                <label for="title">{{trans('language.title')}}</label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}" />
                <p class="text text-danger">{{ $errors->first('title') }}</p>
              </div>
              <div class="form-group">
                <label for="content">{{trans('language.content')}}</label>
                <textarea name="content" class="form-control" cols="30" rows="10">{{old('content')}}</textarea>
                <p class="text text-danger">{{ $errors->first('content') }}</p>
              </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">{{trans('language.create')}}</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('language.close')}}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    @endauth
  </div>
  <!-- Card -->
  <div class="comment mt-5">
    <input type="hidden" id="tour_id" value="{{$tour->tour_id}}" />
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
    <div id="comments">
      {!! $comment_data !!}
    </div>
    <br />
    @auth
    <div class="new_comment">
      <textarea id="content0"></textarea>
      <button id="button0" data-url="{{route('comment.create')}}" onClick="submit(this)">{{trans('language.create')}}</button>
    </div>
    @endauth
  </div>
</div>
@endsection
