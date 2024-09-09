<?php

namespace src\search\hub\application;

use src\search\hub\domain\IHUBRepository;
use src\search\hub\domain\RequestHUB;
use src\search\hub\domain\Rooms;

class RoomFinder
{
  private $repositories;
  public function __construct(array $repositories)
  {
    foreach ($repositories as $repository) {

      $class = new $repository();

      if (!($class instanceof IHUBRepository)) {
        throw new \InvalidArgumentException('Invalid repository');
      }
    }

    $this->repositories = $repositories;
  }

  public function __invoke(int $numberOfGuests, int $numberOfRooms, string $checkIn, string $checkOut, int $id, string $currency): array
  {
    $request = RequestHUB::create($numberOfGuests, $numberOfRooms, $checkIn, $checkOut, $id, $currency);

    $data = [];
    foreach ($this->repositories as $repository) {
      $class = new $repository();
      $rooms = $class->search($request);

      if (!empty($rooms)) {
        $data = array_merge($data, $rooms->jsonStructure());
      }
    }


    // foreach ($data as $value) {
    // }



    return [
      'rooms' => $data,
    ];
  }
}
