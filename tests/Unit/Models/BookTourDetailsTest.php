<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\BookTourDetails;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class BookTourDetailsTest extends TestCase
{
    protected $booktourdetails;

    public function setUp() : void
    {
        parent::setUp();
        $this->booktourdetails = new BookTourDetails();
    }

    public function tearDown() : void
    {
        parent::tearDown();
    }

    public function test_model_configuration()
    {
        $this->assertEquals('booktourdetails', $this->booktourdetails->getTable());
        $this->assertEquals('booktourdetails_id', $this->booktourdetails->getKeyName());
        $this->assertEquals([ 'tour_id', 'booktour_id', 'tour_name', 
                              'quantity_people', 'price', 'status'], 
                              $this->booktourdetails->getFillable());
    }

    public function test_booktourdetails_belongsto_booktour()
    {
        $relation = $this->booktourdetails->booktour();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('booktour_id', $relation->getForeignKey());
        $this->assertEquals('booktour_id', $relation->getOwnerKey());
    }

    public function test_booktourdetails_belongsto_tour()
    {
        $relation = $this->booktourdetails->tour();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('tour_id', $relation->getForeignKey());
        $this->assertEquals('tour_id', $relation->getOwnerKey());
    }
}
