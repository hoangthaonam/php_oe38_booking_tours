@extends('client.layouts.master')

@section('content')
@include('client.layouts.slide')
@include('Common.Error')
<div class="container">
  <div class="mt-5">
      <h4>{{trans('language.my_tour')}}</h4>
      <div class="list-group mt-5">
          @foreach ($booktours as $booktour) 
            @if ($booktour->payment!==Null)
              <a href="{{route('payment.show',$booktour->payment->payment_id)}}" class="list-group-item">
              {{trans('language.book_tour')}}: {{$booktour->payment->updated_at}}</a>
              <br />
            @endif 
          @endforeach
      </div>
  </div>
</div>
@endsection
