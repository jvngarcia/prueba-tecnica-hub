<?php

namespace src\shared\domain;

class BoolVO
{
  private $value;

  public function __construct(bool $value)
  {
    $this->value = $value;
  }

  public function value(): bool
  {
    return $this->value;
  }

  public function equals(IntVO $int): bool
  {
    return $this->value === $int->value();
  }
}
