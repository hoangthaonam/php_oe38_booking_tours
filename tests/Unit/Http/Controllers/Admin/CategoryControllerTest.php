<?php

namespace Tests\Unit\Http\Controllers\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery as m;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Requests\CategoryRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Http\RedirectResponse;

class CategoryControllerTest extends TestCase
{
    protected $categoryRepositoryMock;

    public function setUp() : void
    {
        $this->categoryRepositoryMock = m::mock(CategoryRepositoryInterface::class);
        parent::setUp();
    }

    public function tearDown() : void
    {
        unset($this->categoryRepositoryMock);
        parent::tearDown();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_index_return_view()
    {
        $this->categoryRepositoryMock->shouldReceive('getAllCategory', 'findExceptCategory');
        $controller = new CategoryController($this->categoryRepositoryMock);
        $request = new CategoryRequest();
        $view = $controller->index($request);

        $this->assertEquals('admin.pages.category.list', $view->getName());
        $this->assertArrayHasKey('categories', $view->getData());
    }

    public function test_create_return_view()
    {
        $this->categoryRepositoryMock->shouldReceive('get')->once();
        $controller = new CategoryController($this->categoryRepositoryMock);
        $request = new CategoryRequest();
        $view = $controller->create($request);

        $this->assertEquals('admin.pages.category.create', $view->getName());
        $this->assertArrayHasKey('categories', $view->getData());
    }

    function test_edit_category_fail(){
        $this->categoryRepositoryMock->shouldReceive('checkCategoryExist', 'findExceptCategory')->andReturn(false);
        $controller = new CategoryController($this->categoryRepositoryMock);
        $request = new CategoryRequest();
        $response = $controller->edit($request);
        
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.category.index'), $response->headers->get('Location'));
    }

    function test_edit_category_success(){
        $this->categoryRepositoryMock->shouldReceive('checkCategoryExist', 'findExceptCategory')->andReturn(true);
        $controller = new CategoryController($this->categoryRepositoryMock);
        $request = new CategoryRequest();
        $view = $controller->edit($request);

        $this->assertEquals('admin.pages.category.edit_category', $view->getName());
    }

    public function test_update_category()
    {
        $category = [
            'name' => 'New Category',
            'parent_id' => 2,
            'status' => 0,
        ];
        $this->categoryRepositoryMock->shouldReceive('update', 'checkCategoryExist');
        $controller = new CategoryController($this->categoryRepositoryMock);
        $request = new CategoryRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($category));
        $response = $controller->update($request, 2);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.category.index'), $response->headers->get('Location'));
    }

    public function test_destroy_category()
    {
        $this->categoryRepositoryMock->shouldReceive('delete', 'checkCategoryExist');
        $controller = new CategoryController($this->categoryRepositoryMock);
        $request = new CategoryRequest();
        $response = $controller->destroy(2);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.category.index'), $response->headers->get('Location'));
    }
}
