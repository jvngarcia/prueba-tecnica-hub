<?php


namespace src\shared\domain;

class StrVO
{
  private $value;

  public function __construct(string $value)
  {
    $this->value = $value;
  }

  public function value(): string
  {
    return $this->value;
  }

  public function equals(StrVO $str): bool
  {
    return $this->value === $str->value();
  }
}
