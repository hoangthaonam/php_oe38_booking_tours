@extends('client.layouts.master') 

@section('content')
<div class="container">
    <div class="mt-5">
        @include('Common.Error')
        <form action="{{route('vnpay.create')}}" id="book_form" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="tour_id" value="{{$booktourdetails->tour_id}}" />
            <input type="hidden" name="booktour_id" value="{{$booktourdetails->booktour_id}}" />
            <input type="hidden" name="booktourdetails_id" value="{{$booktourdetails->booktourdetails_id}}" />
            <div class="p-3 py-5">
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="name"><b>{{trans('language.name')}}</b></label>
                        <input type="text" name="name" class="form-control" value="{{$booktourdetails->tour_name}}" readonly />
                    </div>
                    <div class="col-md-6">
                        <label for="name"><b>{{trans('language.price')}}</b></label>
                        <input type="text" id="price" name="amount" class="form-control" value="{{$booktourdetails->price}}" readonly />
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label for="name"><b>{{trans('language.quantity_people')}}</b></label>
                        <input type="text" name="duration" class="form-control" value="{{$booktourdetails->quantity_people}}" readonly />
                    </div>
                    <div class="col-md-6">
                        <label for="name"><b>{{trans('language.payment_method')}}</b></label>
                        <br />
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" data-url="{{route('payment.normal')}}" value="{{config('app.normal')}}" onClick="changePaymentMethod(this)" id="defaultUnchecked" name="payment_method" />
                            <label class="custom-control-label" for="defaultUnchecked">{{trans('language.normal')}}</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" data-url="{{route('vnpay.create')}}" value="{{config('app.banking')}}" onClick="changePaymentMethod(this)" id="defaultChecked" name="payment_method" checked />
                            <label class="custom-control-label" for="defaultChecked">{{trans('language.banking')}}</label>
                        </div>
                    </div>
                </div>
                @include('Common.Error')
                <div class="row mt-5 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">{{trans('language.paid')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
