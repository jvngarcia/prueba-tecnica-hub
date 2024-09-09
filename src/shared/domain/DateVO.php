<?php

namespace src\shared\domain;

class DateVO
{
  private $value;

  public function __construct(string $value)
  {
    $this->assureIsDate($value);
    $this->value = $value;
  }

  public function value(): string
  {
    return $this->value;
  }

  public function equals(DateVO $date): bool
  {
    return $this->value === $date->value();
  }

  public function isAfter(DateVO $date): bool
  {
    return $this->value > $date->value();
  }

  public function isBefore(DateVO $date): bool
  {
    return $this->value < $date->value();
  }

  public function quantityOfDaysUntil(DateVO $date): int
  {
    $date1 = new \DateTime($this->value);
    $date2 = new \DateTime($date->value());
    $diff = $date1->diff($date2);
    return $diff->days;
  }

  private function assureIsDate(string $date): void
  {
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
      throw new \InvalidArgumentException("Invalid date format");
    }
  }
}
