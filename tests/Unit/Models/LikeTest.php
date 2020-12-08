<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LikeTest extends TestCase
{
    protected $likes;

    public function setUp()
    {
        parent::setUp();
        $this->likes = new Like();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_model_configuration()
    {
        $this->assertEquals('likes', $this->likes->getTable());
        $this->assertEquals('like_id', $this->likes->getKeyName());
        $this->assertEquals(['user_id', 'review_id', 'status'], $this->likes->getFillable());
    }

    public function test_like_belongsto_review(Type $var = null)
    {
        $relation = $this->likes->review();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('review_id', $relation->getForeignKey());
        $this->assertEquals('cmr_id', $relation->getOwnerKey());
    } 
    
    public function test_like_belongsto_user()
    {
        $relation = $this->likes->user();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKey());
        $this->assertEquals('user_id', $relation->getOwnerKey());
    }
}
