<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TourTest extends TestCase
{
    protected $tour; 

    public function setUp()
    {
        parent::setUp();
        $this->tour = new Tour();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_model_configuration()
    {
        $this->assertEquals('tours', $this->tour->getTable());
        $this->assertEquals('tour_id', $this->tour->getKeyName());
        $this->assertEquals(['name', 'image', 'slug', 'place_from', 'place_to','place_tobe', 
                             'duration', 'price','hotel_star','des', 'quantity_people',
                             'booking_number','category_id','status',
                            ], $this->tour->getFillable());
    }

    public function test_tour_has_many_bookdetails()
    {
        $relation = $this->tour->bookdetails();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('tour_id', $relation->getForeignKeyName());
        $this->assertEquals('tours.tour_id', $relation->getQualifiedParentKeyName());
    }

    public function test_tour_has_many_commentreviews()
    {
        $relation = $this->tour->commentreviews();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('tour_id', $relation->getForeignKeyName());
        $this->assertEquals('tours.tour_id', $relation->getQualifiedParentKeyName());
    }

    public function test_tour_has_many_ratings()
    {
        $relation = $this->tour->ratings();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('tour_id', $relation->getForeignKeyName());
        $this->assertEquals('tours.tour_id', $relation->getQualifiedParentKeyName());
    }

    public function test_tour_belongsto_category()
    {
        $relation = $this->tour->category();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('category_id', $relation->getForeignKey());
        $this->assertEquals('categories_id', $relation->getOwnerKey());
    }
}
