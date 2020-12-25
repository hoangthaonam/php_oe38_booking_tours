<?php

namespace App\Repositories\User\BookTour;

interface BookTourRepositoryInterface{
    public function getOwnerBookTour();
    public function createNewBookTour($data);
    public function getBookingDetails($id);
}
?>
