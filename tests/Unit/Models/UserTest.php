<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserTest extends TestCase
{
    protected $user; 

    public function setUp()
    {
        parent::setUp();
        $this->user = new User();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_model_configuration()
    {
        $this->assertEquals('users', $this->user->getTable());
        $this->assertEquals('user_id', $this->user->getKeyName());
        $this->assertEquals(['username', 'email', 'name', 'password', 'address',
                             'phone', 'image', 'role', 'status', 'provider', 'provider_id',
                            ], $this->user->getFillable());
        $this->assertEquals(['password', 'remember_token'], $this->user->getHidden());
    }

    public function test_user_has_many_ratings()
    {
        $relation = $this->user->ratings();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('users.user_id', $relation->getQualifiedParentKeyName());
    }

    public function test_user_has_many_booktours()
    {
        $relation = $this->user->booktours();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('users.user_id', $relation->getQualifiedParentKeyName());
    }

    public function test_user_has_many_commentreviews()
    {
        $relation = $this->user->commentreviews();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('users.user_id', $relation->getQualifiedParentKeyName());
    }

    public function test_user_has_many_likes()
    {
        $relation = $this->user->likes();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('users.user_id', $relation->getQualifiedParentKeyName());
    }
}
