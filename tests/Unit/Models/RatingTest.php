<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RatingTest extends TestCase
{
    protected $rating; 

    public function setUp()
    {
        parent::setUp();
        $this->rating = new Rating();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_model_configuration()
    {
        $this->assertEquals('rating', $this->rating->getTable());
        $this->assertEquals('rating_id', $this->rating->getKeyName());
        $this->assertEquals(['name', 'user_id', 'tour_id', 'rating', 'status'], $this->rating->getFillable());
    }

    public function test_rating_belongsto_user()
    {
        $relation = $this->rating->user();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKey());
        $this->assertEquals('user_id', $relation->getOwnerKey());
    }

    public function test_rating_belongsto_tour()
    {
        $relation = $this->rating->tour();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('tour_id', $relation->getForeignKey());
        $this->assertEquals('tour_id', $relation->getOwnerKey());
    }
}
