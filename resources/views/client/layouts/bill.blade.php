<div class="p-3 py-5">
    @foreach ($payment->booktour->booktourdetails as $booktourdetail)
        <div class="row mt-2">
            <div class="col-md-6">
                <label for="name"><b>{{trans('language.tour_name')}}</b></label>
                <input type="text" name="name" class="form-control" value="{{$booktourdetail->tour_name}}" readonly />
            </div>
            <div class="col-md-6">
                <label for="name"><b>{{trans('language.place_to')}}</b></label>
                <input type="text" name="amount" class="form-control" value="{{$booktourdetail->tour->place_to}}" readonly />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <label for="name"><b>{{trans('language.quantity_people')}}</b></label>
                <input type="text" name="duration" class="form-control" value="{{$booktourdetail->quantity_people}}" readonly />
            </div>
            <div class="col-md-6">
                <label for="name"><b>{{trans('language.price')}}</b></label>
                <input type="text" id="price" name="amount" class="form-control" value="{{$booktourdetail->price}}" readonly />
            </div>
        </div>
        <br/>
    @endforeach
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="name"><b>{{trans('language.customer')}}</b></label>
            <input type="text" name="customer" class="form-control" value="{{$payment->booktour->user->name}}" readonly />
        </div>
        <div class="col-md-6">
            <label for="name"><b>{{trans('language.address')}}</b></label>
            <input type="text" id="price" name="amount" class="form-control" value="{{$payment->booktour->user->address}}" readonly />
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="name"><b>{{trans('language.created_at')}}</b></label>
            <input type="text" name="duration" class="form-control" value="{{$payment->created_at}}" readonly />
        </div>
        <div class="col-md-6">
            <label for="name"><b>{{trans('language.payment_status')}}</b></label>
            <input type="text" name="payment_status" class="form-control"
                value="
                  {{ $payment->payment_status == config('app.paid') 
                  ? trans('language.paid_status') : trans('language.unpaid_status')}}"
                readonly/>
        </div>
    </div>
</div>
