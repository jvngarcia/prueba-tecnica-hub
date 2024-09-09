<?php

namespace src\search\hub\infrastructure;

use Illuminate\Support\Facades\Http;
use src\search\hub\domain\ArrayRooms;
use src\search\hub\domain\IHUBRepository;
use src\search\hub\domain\PrimaryData;
use src\search\hub\domain\Rates;
use src\search\hub\domain\RequestHUB;
use src\search\hub\domain\Rooms;

class ProveedorRepository implements IHUBRepository
{
  public function search(RequestHUB $request): ?Rooms
  {

    $dataTosearch = [
      "hotel" => $request->id(),
      "checkInDate" => $request->checkIn(),
      "numberOfNights" => $request->numberOfDays(),
      "guests" => $request->numberOfGuests(),
      "rooms" => $request->numberOfRooms(),
      "currency" => $request->currency()
    ];

    // TODO: Implementar búsqueda de hoteles a la api de HotelLegs
    // $url = env('HOTELLEGS_URL');
    // $response = Http::post($url, $dataTosearch);

    if ($request->id() != 1) {
      return null;
    }


    $fakeResponse = [
      "results" => [
        [
          "room" => 234789,
          "meal" => 1,
          "canCancel" => false,
          "price" => 123.48
        ],
        [
          "room" => 234789,
          "meal" => 1,
          "canCancel" => true,
          "price" => 150.00
        ],
        [
          "room" => 234789,
          "meal" => 1,
          "canCancel" => false,
          "price" => 148.25
        ],

        [
          "room" => 123412,
          "meal" => 2,
          "canCancel" => false,
          "price" => 165.38
        ],
        [
          "room" => 234234,
          "meal" => 1,
          "canCancel" => false,
          "price" => 123.48
        ],
        [
          "room" => 893475789,
          "meal" => 1,
          "canCancel" => true,
          "price" => 150.00
        ],
        [
          "room" => 354892789234,
          "meal" => 1,
          "canCancel" => false,
          "price" => 148.25
        ],

        [
          "room" => 234234,
          "meal" => 2,
          "canCancel" => false,
          "price" => 165.38
        ]
      ]
    ];

    $arrayRooms = [];
    $data = [];

    foreach ($fakeResponse['results'] as $value) {
      $roomsId[] = [$value['room'], PrimaryData::create($value['meal'], $value['canCancel'], $value['price'])];
    }

    foreach ($roomsId as $room) {
      $data[$room[0]][] = $room[1];
    }

    foreach ($data as $key => $value) {
      $arrayRooms[] = ArrayRooms::create($key, Rates::create($value));
    }

    $rooms = Rooms::create($arrayRooms);


    return $rooms;
  }
}
