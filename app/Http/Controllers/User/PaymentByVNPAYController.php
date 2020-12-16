<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class PaymentByVNPAYController extends Controller
{
    protected $vnp_HashSecret;

    public function __construct() {
        $this->vnp_HashSecret = config('app.vnp_HashSecret');
    }

    public function create(Request $request)
    {
        Session::put('tour_id',$request->tour_id);
        Session::put('booktourdetails_id',$request->booktourdetails_id);
        Session::put('booktour_id',$request->booktour_id);
        $vnp_TmnCode = config('app.vnp_TmnCode'); //Mã website tại VNPAY 
        $vnp_HashSecret = $this->vnp_HashSecret; //Chuỗi bí mật
        $vnp_Url = config('app.vnp_Url');
        $vnp_Returnurl = "http://127.0.0.1:8000/payment/return";
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->input('amount') * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }

    public function return(Request $request)
    {
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = $request->all();
        foreach ($_GET as $key => $value) {
            $inputData[$key] = $value;
        }
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }

        $secureHash = hash('sha256',$this->vnp_HashSecret . $hashData);
        $booktourdetails_id = Session::get('booktourdetails_id');
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $booktour_id = Session::get('booktour_id');
                Session::flash('Success', trans('booking_success'));
                $payment = [
                    'payment_method' => config('app.banking'),
                    'payment_status' => config('app.paid'),
                    'booktour_id' => $booktour_id,
                ] ;
                Session::put('payment', $payment);
                return redirect()->route('payment.banking');
            } else {
                Session::flash('Error', trans('booking_failed'));
                return redirect()->route('booking.infor', $booktour_id);
            }
        } else {
            Session::flash('Error', trans('booking_error'));
            return redirect()->route('booking.infor', $booktour_id);
        }
    }
}
