@extends('admin.layouts.master')
@section('title')
{{trans('language.list_tour')}}
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{trans('language.tour_booked')}}</h6>
    </div>
    <div class="card-body">
        @include('Common.Error')
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{trans('language.customer')}}</th>
                        <th>{{trans('language.tour_name')}}</th>
                        <th>{{trans('language.price')}}</th>
                        <th>{{trans('language.payment_method')}}</th>
                        <th>{{trans('language.payment_status')}}</th>
                        <th>{{trans('language.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $key => $payment)
                    @php
                        $price =  0;
                    @endphp                  
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$payment->booktour->user->name}}</td>
                        <td>
                            <ul>
                                @foreach ($payment->booktour->booktourdetails as $booktourdetails)
                                    <li>{{$booktourdetails->tour->name}}</li>
                                    @php
                                        $price += $booktourdetails->price;
                                    @endphp
                                @endforeach
                            </ul>
                        </td>
                        <td>{{$price}}</td>
                        <td>{{$payment->payment_method == config('app.banking') ? 
                        trans('language.banking') : trans('language.normal')}}</td>
                        <td>{{$payment->payment_status == config('app.paid') ? 
                        trans('language.paid_status') : trans('language.unpaid_status')}}</td>
                        <td>
                            <a href="{{route('admin.payment.show',$payment->payment_id)}}"><button class="btn btn-primary edit" ><i class="fas fa-edit"></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
