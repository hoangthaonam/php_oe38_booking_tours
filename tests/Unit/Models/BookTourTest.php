<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\BookTour;
use App\Models\BookTourDetails;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookTourTest extends TestCase
{
    protected $booktour; 

    public function setUp() : void
    {
        parent::setUp();
        $this->booktour = new BookTour();
    }
    
    public function tearDown() : void
    {
        parent::tearDown();
    }

    public function test_model_configuration()
    {
        $this->assertEquals('booktour', $this->booktour->getTable());
        $this->assertEquals('booktour_id', $this->booktour->getKeyName());
        $this->assertEquals(['user_id', 'payment_id', 'status'], $this->booktour->getFillable());
    }

    public function test_booktour_has_many_booking_details()
    {
        $relation = $this->booktour->booktourdetails();
        $booktour = new BookTour();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('booktour_id', $relation->getForeignKeyName());
        $this->assertEquals('booktour.booktour_id', $relation->getQualifiedParentKeyName());
    }

    public function test_booktour_belongsto_user()
    {
        $relation = $this->booktour->user();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKey());
        $this->assertEquals('user_id', $relation->getOwnerKey());
    }

    public function test_booktour_belongsto_payment()
    {
        $relation = $this->booktour->payment();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('booktour_id', $relation->getForeignKey());
        $this->assertEquals('booktour_id', $relation->getOwnerKey());
    }
}
