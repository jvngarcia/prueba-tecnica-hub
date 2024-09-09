<?php

namespace src\search\hub\domain;


class ArrayRooms
{

  private $id;
  private $rates;

  private function __construct(RoomId $id, Rates $rates)
  {
    $this->id = $id;
    $this->rates = $rates;
  }

  public static function create(int $id, Rates $rates): self
  {
    return new self(
      new RoomId($id),
      $rates
    );
  }

  public function id(): int
  {
    return $this->id->value();
  }

  public function rates(): Rates
  {
    return $this->rates;
  }
}
