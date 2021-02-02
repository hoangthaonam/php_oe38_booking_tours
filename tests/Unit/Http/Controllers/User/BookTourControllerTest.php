<?php

namespace Tests\Unit\Http\Controllers\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\User\BookTour\BookTourRepositoryInterface;
use App\Repositories\User\BookTour\BookTourRepository;
use App\Http\Controllers\User\BookTourController;
use App\Http\Requests\BookTourRequest;
use Symfony\Component\HttpFoundation\ParameterBag;
use Illuminate\Http\RedirectResponse;
use App\Models\BookTourDetails;
use App\Models\User;
use Mockery as m;

class BookTourControllerTest extends TestCase
{
    protected $bookTourRepositoryMock;
    
    public function setUp() : void
    {
        $this->bookTourRepositoryMock = m::mock(BookTourRepositoryInterface::class);
        parent::setUp();
    }

    public function tearDown() : void
    {
        unset($this->bookTourRepositoryMock);
        parent::tearDown();
    }

    public function test_index_return_view()
    {
        $this->bookTourRepositoryMock->shouldReceive('getOwnerBookTour');
        $controller = new BookTourController($this->bookTourRepositoryMock);
        $request = new BookTourRequest();
        $view = $controller->index();

        $this->assertEquals('client.layouts.mytour', $view->getName());
        $this->assertArrayHasKey('booktours', $view->getData());
    }

    public function test_store_new_booking_request()
    {
        $booktourDetail = new BookTourDetails();
        $this->bookTourRepositoryMock->shouldReceive('createNewBookTour')->andReturn($booktourDetail);
        $controller = new BookTourController($this->bookTourRepositoryMock);
        $request = new BookTourRequest();
        $response = $controller->store($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(route('booking.infor', ''), $response->headers->get('Location'));
    }

    public function test_display_information()
    {
        $this->bookTourRepositoryMock->shouldReceive('getBookingDetails')->once();
        $controller = new BookTourController($this->bookTourRepositoryMock);
        $request = new BookTourRequest();
        $view = $controller->displayBookingInformation($request);

        $this->assertEquals('client.layouts.booktour_detail', $view->getName());
        $this->assertArrayHasKey('booktourdetails', $view->getData());
    }
}
