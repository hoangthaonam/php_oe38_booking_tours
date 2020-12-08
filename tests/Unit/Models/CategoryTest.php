<?php

namespace Tests\Unit\Model;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;

class CategoryTest extends TestCase
{    
    protected $category;

    public function setUp() : void
    {
        parent::setUp();
        $this->category = new Category();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_model_configuration()
    {
        $this->assertEquals('categories', $this->category->getTable());
        $this->assertEquals('categories_id', $this->category->getKeyName());
        $this->assertEquals(['name', 'parent_id', 'status'], $this->category->getFillable());
    }

    public function test_category_has_many_tours(Type $var = null)
    {
        $relation = $this->category->tours();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('category_id', $relation->getForeignKeyName());
        $this->assertEquals('categories.categories_id', $relation->getQualifiedParentKeyName());
    }

    public function test_category_belongsto_parent_category()
    {
        $relation = $this->category->parent();
        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('parent_id', $relation->getForeignKey());
        $this->assertEquals('categories_id', $relation->getOwnerKey());
    }

    public function test_category_has_many_children_category()
    {
        $relation = $this->category->children();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('parent_id', $relation->getForeignKeyName());
        $this->assertEquals('categories.categories_id', $relation->getQualifiedParentKeyName());
    }
}
