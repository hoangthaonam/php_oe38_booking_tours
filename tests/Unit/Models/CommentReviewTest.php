<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\CommentReview;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CommentReviewTest extends TestCase
{
    protected $commentReview;

    public function setUp() : void
    {
        parent::setUp();
        $this->commentReview = new CommentReview();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_model_configuration()
    {
        $this->assertEquals('commentreviews', $this->commentReview->getTable());
        $this->assertEquals('cmr_id', $this->commentReview->getKeyName());
        $this->assertEquals(['user_id', 'tour_id', 'title', 'content', 
                            'type', 'parent_id', 'status'], 
                            $this->commentReview->getFillable());
    }
    
    public function test_commentReview_belongsto_parent_commentReview()
    {
        $relation = $this->commentReview->parent();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('parent_id', $relation->getForeignKey());
        $this->assertEquals('cmr_id', $relation->getOwnerKey());
    }

    public function test_commentReview_has_many_children_commentReview()
    {
        $relation = $this->commentReview->children();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('parent_id', $relation->getForeignKeyName());
        $this->assertEquals('commentreviews.cmr_id', $relation->getQualifiedParentKeyName());
    }

    public function test_commentReview_has_many_likes()
    {
        $relation = $this->commentReview->likes();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('review_id', $relation->getForeignKeyName());
        $this->assertEquals('commentreviews.cmr_id', $relation->getQualifiedParentKeyName());
    }

    public function test_commentReview_belongsto_user()
    {
        $relation = $this->commentReview->user();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKey());
        $this->assertEquals('user_id', $relation->getOwnerKey());
    }

    public function test_commentReview_belongsto_tour()
    {
        $relation = $this->commentReview->tour();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('tour_id', $relation->getForeignKey());
        $this->assertEquals('tour_id', $relation->getOwnerKey());
    }
}
