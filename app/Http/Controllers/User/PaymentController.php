<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Models\Payment;
use App\Models\BookTour;
use App\Models\BookTourDetails;
use App\Repositories\User\Payment\PaymentRepositoryInterface;
use Session;
use Mail;

class PaymentController extends Controller
{
    protected $paymentRepo;

    public function __construct(PaymentRepositoryInterface $paymentRepo) {
        $this->paymentRepo = $paymentRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = $this->paymentRepo->getDataPayment($id);
        if($payment){

            return view('client.layouts.payment_details', compact('payment'));
        }

        return redirect()->route('booktour.index');
    }

    public function createNormalPayment(Request $request)
    {
        $payment = $request->only('payment_method', 'booktour_id');
        $payment['payment_status'] = config('app.unpaid');
        $payment = $this->paymentRepo->create($payment);
        NotificationController::notifyNewTourBooked($payment->payment_id);
        $this->sendEmail($payment->payment_id);
        return redirect()->route('payment.show',$payment->payment_id);
    }
    
    public function createBankingPayment()
    {
        $payment = Session::get('payment');
        Session::forget('payment');
        $payment = $this->paymentRepo->create($payment);
        NotificationController::notifyNewTourBooked($payment->payment_id);
        $this->sendEmail($payment->payment_id);

        return redirect()->route('payment.show',$payment->payment_id);
    }

    public function sendEmail($id)
    {   
        $payment = $this->paymentRepo->getDataPayment($id);
        if($payment){
            $name = $payment->booktour->user->name;
            Mail::send('client.layouts.bill', [
                'payment' => $payment,
            ], function($mail) use ($name){
                $mail->to(config('app.mail_test'), $name);
                $mail->subject(trans('language.email_subject')); 
            });
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
