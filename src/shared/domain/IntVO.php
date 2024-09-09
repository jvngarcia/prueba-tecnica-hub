<?php


namespace src\shared\domain;

class IntVO
{
  private $value;

  public function __construct(int $value)
  {
    $this->value = $value;
  }

  public function value(): int
  {
    return $this->value;
  }

  public function equals(IntVO $int): bool
  {
    return $this->value === $int->value();
  }
}
