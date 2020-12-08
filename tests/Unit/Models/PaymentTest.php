<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentTest extends TestCase
{
    protected $payment; 

    public function setUp()
    {
        parent::setUp();
        $this->payment = new Payment();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_model_configuration()
    {
        $this->assertEquals('payment', $this->payment->getTable());
        $this->assertEquals('payment_id', $this->payment->getKeyName());
        $this->assertEquals(['payment_method', 'payment_status', 'booktour_id', 'status'], $this->payment->getFillable());
    }

    public function test_payment_has_one_booktour()
    {
        $relation = $this->payment->booktour();
        $this->assertInstanceOf(HasOne::class, $relation);
        $this->assertEquals('booktour_id', $relation->getForeignKeyName());
        $this->assertEquals('payment.booktour_id', $relation->getQualifiedParentKeyName());
    }
}
