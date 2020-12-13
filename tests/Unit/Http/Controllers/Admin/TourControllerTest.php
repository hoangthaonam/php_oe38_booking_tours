<?php

namespace Tests\Unit\Http\Controllers\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Tour;
use Mockery as m;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Admin\TourController;
use App\Repositories\Tour\TourRepositoryInterface;
use App\Http\Requests\TourRequest;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
// use Faker;

class TourControllerTest extends TestCase
{
    protected $tourRepositoryMock;

    public function setUp() : void
    {
        $this->tourRepositoryMock = m::mock(TourRepositoryInterface::class);
        parent::setUp();
    }
    
    public function tearDown() : void
    {
        unset($this->tourRepositoryMock);
        parent::tearDown();
    }

    public function test_index_return_view()
    {
        $this->tourRepositoryMock->shouldReceive('display')->once();
        $controller = new TourController($this->tourRepositoryMock);
        $request = new TourRequest();
        $view = $controller->index($request);

        $this->assertEquals('admin.pages.tour.index', $view->getName());
        $this->assertArrayHasKey('tours', $view->getData());
    }

    public function test_create_return_view()
    {
        $this->tourRepositoryMock->shouldReceive('create', 'getCategory');
        $controller = new TourController($this->tourRepositoryMock);
        $request = new TourRequest();
        $view = $controller->create($request);

        $this->assertEquals('admin.pages.tour.create_tour', $view->getName());
        $this->assertArrayHasKey('categories', $view->getData());
    }

    public function test_store_new_tour()
    {
        $newTour = [
            'name' => 'NewTour',
            'place_from' => 'Ha Noi',
            'place_to' => 'Sai Gon',
            'place_tobe' => 'Da Lat',
            'des' => 'This is an amazing tour',
            'duration' => 4,
            'category_id' => 1,
            'image' => 'default.jpg',
            'price' => 2000,
            'hotel_star' => 4,
            'quantity_people' => 20,
        ];
        $this->tourRepositoryMock->shouldReceive('store', 'create');
        $controller = new TourController($this->tourRepositoryMock);
        $request = new TourRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($newTour));
        $response = $controller->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.tour.index'), $response->headers->get('Location'));
    }

    public function test_update_tour()
    {
        $tour = [
            'tour_id' => 1,
            'name' => 'NewTour',
            'place_from' => 'Ha Noi',
            'place_to' => 'Sai Gon',
            'place_tobe' => 'Da Lat',
            'des' => 'This is an amazing tour',
            'duration' => 4,
            'category_id' => 1,
            'image' => 'default.jpg',
            'price' => 2000,
            'hotel_star' => 4,
            'quantity_people' => 20,
        ];
        $this->tourRepositoryMock->shouldReceive('update');
        $controller = new TourController($this->tourRepositoryMock);
        $request = new TourRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($tour));
        $response = $controller->update($request, 5);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.tour.index'), $response->headers->get('Location'));
    }

    public function test_destroy_tour()
    { 
        $this->tourRepositoryMock->shouldReceive('delete', 'checkTourExist');
        $controller = new TourController($this->tourRepositoryMock);
        $response = $controller->destroy(4);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.tour.index'), $response->headers->get('Location'));
    }
}
