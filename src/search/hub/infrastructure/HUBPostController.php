<?php

namespace src\search\hub\infrastructure;

use App\Http\Requests\HubPostRequest;
use src\search\hub\application\RoomFinder;

class HUBPostController
{
  private $service;

  private $repositories = [
    HotelLegsRepository::class,
    ProveedorRepository::class
  ];

  public function __construct()
  {
    $this->service = new RoomFinder($this->repositories);
  }

  public function __invoke(HubPostRequest $request)
  {
    $rooms = $this->service->__invoke(
      $request->input('numberOfGuests'),
      $request->input('numberOfRooms'),
      $request->input('checkIn'),
      $request->input('checkOut'),
      $request->input('hotelId'),
      $request->input('currency')
    );


    return $rooms;
  }
}
