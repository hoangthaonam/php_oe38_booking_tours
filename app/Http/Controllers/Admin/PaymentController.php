<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\BookTour;
use App\Repositories\Admin\Payment\PaymentRepositoryInterface;
use App\Http\Controllers\NotificationController;
use Session;
use DB;
use Auth;

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
        $payments = $this->paymentRepo->getAllPayment();
        return view('admin.pages.payment.index', compact('payments'));
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
        $noti = '';
        $notifications = Auth::user()->notifications;
        foreach($notifications as $notification){
            if($notification->data['payment_id']==$id){
                $noti = $notification;
            };
        }
        if($noti !='' && $noti['read_at'] == null){
            $noti->markAsRead();
        }
        $payment  = $this->paymentRepo->getDataPayment($id);
        return view('admin.pages.payment.payment_details', compact('payment'));   
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
        $payment = $this->paymentRepo->checkPaymentExists($id);
        if($payment){
            $data['payment_status'] = $request->payment_status;
            $this->paymentRepo->update($id, $data);
            $paymentOwner = $this->paymentRepo->getOwnerPayment($payment);
            NotificationController::notifyStatusTourBooked($payment->payment_id, $paymentOwner);
            Session::flash('Success', trans('language.update_success'));
        }

        return redirect()->route('admin.payment.show',$id);
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
