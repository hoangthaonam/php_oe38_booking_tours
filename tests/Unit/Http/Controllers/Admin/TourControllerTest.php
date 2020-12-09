<?php

namespace Tests\Unit\Http\Controllers\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Tour;
use Mockery as m;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Admin\TourController;
use App\Http\Requests\TourRequest;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class TourControllerTest extends TestCase
{
    protected $controller;

    public function setUp() : void
    {
        parent::setUp();
        $this->controller = new TourController();
    }   

    public function test_login_required()
    {
        $response = $this->get('/admin/tour')->assertRedirect('/admin/login');
    }

    public function test_index_return_view()
    {
        $view = $this->controller->index();
        $this->assertEquals('admin.pages.tour.index', $view->getName());
        $this->assertArrayHasKey('tours', $view->getData());
    }

    public function test_create_return_view()
    {
        $view = $this->controller->create();
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
        $request = new TourRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($newTour));
        $response = $this->controller->store($request);
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
        $request = new TourRequest();
        $request->headers->set('content-type', 'application/json');
        $request->setJson(new ParameterBag($tour));
        $response = $this->controller->update($request, 5);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.tour.index'), $response->headers->get('Location'));
    }

    public function test_destroy_tour()
    {
        $tour = [ 
            'name' => 'NewTour',
            'slug' => 'newtour',
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
            'booking_number' => 10,  
        ];
        $newTour = Tour::create($tour);
        $response = $this->controller->destroy($newTour->tour_id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('admin.tour.index'), $response->headers->get('Location'));
    }
}
