<?php

namespace src\search\hub\domain;

class RequestHUB
{
  private $id;
  private $numberOfGuests;
  private $numberOfRooms;
  private $checkIn;
  private $checkOut;
  private $currency;

  public function __construct(NumberOfGuests $numberOfGuests, NumberOfRooms $numberOfRooms, CheckIn $checkIn, CheckOut $checkOut, HotelId $id, Currency $currency)
  {
    $this->numberOfGuests = $numberOfGuests;
    $this->numberOfRooms = $numberOfRooms;
    $this->checkIn = $checkIn;
    $this->checkOut = $checkOut;
    $this->id = $id;
    $this->currency = $currency;
  }

  static function create(int $numberOfGuests, int $numberOfRooms, string $checkIn, string $checkOut, int $id, string $currency): RequestHUB
  {
    return new self(
      new NumberOfGuests($numberOfGuests),
      new NumberOfRooms($numberOfRooms),
      new CheckIn($checkIn),
      new CheckOut($checkOut),
      new HotelId($id),
      new Currency($currency)
    );
  }

  public function id(): int
  {
    return $this->id->value();
  }

  public function currency(): string
  {
    return $this->currency->value();
  }

  public function numberOfGuests(): int
  {
    return $this->numberOfGuests->value();
  }

  public function numberOfRooms(): int
  {
    return $this->numberOfRooms->value();
  }

  public function checkIn(): string
  {
    return $this->checkIn->value();
  }

  public function checkOut(): string
  {
    return $this->checkOut->value();
  }

  public function numberOfDays(): int
  {
    return $this->checkIn->quantityOfDaysUntil($this->checkOut);;
  }
}
