<?php

namespace src\search\hub\domain;


class Rooms
{

  private $value;

  private function __construct(array $rooms)
  {
    $this->assureIsValidArrayRooms($rooms);
    $this->value = $rooms;
  }

  public static function create(array $rooms): Rooms
  {
    return new self($rooms);
  }

  public function value(): array
  {
    return $this->value;
  }

  private function assureIsValidArrayRooms($rooms): void
  {
    foreach ($rooms as $room) {
      if (!($room instanceof ArrayRooms)) {
        throw new \InvalidArgumentException("Invalid ArrayRooms");
      }
    }
  }

  public function jsonStructure(): array
  {
    $data = [];
    foreach ($this->value as $room) {
      $data[] = [
        'roomId' => $room->id(),
        'rates' => $room->rates()->jsonStructure(),
      ];
    }

    return $data;
  }
}
