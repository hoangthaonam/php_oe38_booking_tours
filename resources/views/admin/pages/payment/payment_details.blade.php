@extends('admin.layouts.master')
@section('title')
{{trans('language.list_tour')}}
@endsection

@section('content')
<div class="mt-5">
  @include('Common.Success') 
  @include('Common.Error')
  <div class="p-3 py-5">
      <div class="row mt-2">
          <div class="col-md-6">
              <label for="name"><b>{{trans('language.tour_name')}}</b></label>
              <input type="text" name="name" class="form-control" value="{{$booktourdetails->tour_name}}" readonly />
          </div>
          <div class="col-md-6">
              <label for="name"><b>{{trans('language.price')}}</b></label>
              <input type="text" name="amount" class="form-control" value="{{$booktourdetails->price}}" readonly />
          </div>
      </div>
      <div class="row mt-2">
          <div class="col-md-6">
              <label for="name"><b>{{trans('language.customer')}}</b></label>
              <input type="text" name="customer" class="form-control" value="{{$payment->booktour->user->name}}" readonly />
          </div>
          <div class="col-md-6">
              <label for="name"><b>{{trans('language.address')}}</b></label>
              <input type="text" name="amount" class="form-control" value="{{$payment->booktour->user->address}}" readonly />
          </div>
      </div>
      <div class="row mt-2">
          <div class="col-md-6">
              <label for="name"><b>{{trans('language.payment_method')}}</b></label>
              <input type="text" name="payment_method" class="form-control"
                  value="
                    {{$payment->payment_method == config('app.banking') ? 
                    trans('language.banking') : trans('language.normal')}}
                    " readonly />
          </div>
          <div class="col-md-6">
              <label for="name"><b>{{trans('language.date_created')}}</b></label>
              <input type="text" name="date" class="form-control" value="{{$payment->created_at}}" readonly />
          </div>
      </div>
      <div class="row mt-2">
          <div class="col-md-6">
              <label for="name"><b>{{trans('language.quantity_people')}}</b></label>
              <input type="text" name="duration" class="form-control" value="{{$booktourdetails->quantity_people}}" readonly />
          </div>
          <div class="col-md-6">
              <label for="name"><b>{{trans('language.payment_status')}}</b></label>
              @if ($payment->payment_method == config('app.normal') && $payment->payment_status == config('app.unpaid'))
              <br />
                <form action="{{route('admin.payment.update',$payment->payment_id)}}" method="POST">
                  <select name="payment_status">
                    <option value="{{config('app.paid')}}" @if (config('app.paid') == $payment->payment_status)
                        selected = "selected"
                    @endif>{{trans('language.paid_status')}}</option>
                    
                    <option value="{{config('app.unpaid')}}" @if (config('app.unpaid') == $payment->payment_status)
                        selected = "selected"
                    @endif>{{trans('language.unpaid_status')}}</option>
                  </select>
              @else
                <input type="text" name="payment_status" class="form-control"
                    value="
                        {{ $payment->payment_status == config('app.paid') 
                        ? trans('language.paid_status') : trans('language.unpaid_status')}}"
                      readonly />
              @endif
          </div>
      </div>
      <div class="row mt-5 d-flex justify-content-center">
          @if ($payment->payment_method == config('app.normal') && $payment->payment_status == config('app.unpaid')) {{ csrf_field() }} {{ method_field('PUT') }}
            <button type="submit" class="btn btn-danger delete">{{trans('language.update')}}</button>
                </form> 
          @endif
      </div>
  </div>
</div>
{{$payment->payment_method}}
@endsection
