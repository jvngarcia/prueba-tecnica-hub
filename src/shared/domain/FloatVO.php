<?php


namespace src\shared\domain;

class FloatVO
{
  private $value;

  public function __construct(float $value)
  {
    $this->value = $value;
  }

  public function value(): float
  {
    return $this->value;
  }

  public function equals(FloatVO $float): bool
  {
    return $this->value === $float->value();
  }
}
