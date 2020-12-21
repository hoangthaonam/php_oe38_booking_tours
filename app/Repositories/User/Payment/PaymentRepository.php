<?php

namespace App\Repositories\User\Payment;
use App\Repositories\BaseRepository;
use App\Repositories\User\Payment\PaymentRepositoryInterface;
use App\Models\Payment;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface{
    
    public function getModel()
    {
        return Payment::class;
    }

    public function getDataPayment($id)
    {
        $payment = Payment::with('booktour.user', 'booktour.booktourdetails.tour')->where('payment_id', $id)->first();
        if(!$payment){
            Session::flash('Error', trans('language.error.error_find'));

            return false;
        }

        return $payment;
    }
}
