<?php

namespace App\Repositories\Admin\Payment;
use App\Repositories\BaseRepository;
use App\Repositories\Admin\Payment\PaymentRepositoryInterface;
use App\Models\Payment;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface{
    
    public function getModel()
    {
        return Payment::class;
    }

    public function getAllPayment(){
        return Payment::with('booktour.user', 'booktour.booktourdetails.tour')->get();
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

    public function checkPaymentExists($id)
    {
        $payment = Payment::find($id);
        if(!$payment){
            Session::flash('Error', trans('language.error.error_find'));
            return false;
        } else {
            return $payment;
        }
    }

    public function getOwnerPayment($payment){
        return $payment->booktour->user;
    }
}
?>
