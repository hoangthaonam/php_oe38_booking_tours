<?php

namespace App\Repositories\Admin\Payment;

interface PaymentRepositoryInterface {
    public function getAllPayment();
    public function getDataPayment($id);
    public function checkPaymentExists($id);
    public function getOwnerPayment($payment);
}
?>
