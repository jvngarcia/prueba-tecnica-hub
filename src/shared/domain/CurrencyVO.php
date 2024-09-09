<?php


namespace src\shared\domain;

class CurrencyVO
{
  private $value;
  private $currencies = [
    'USD',
    'EUR',
  ];

  public function __construct(string $value)
  {
    $this->assureIsValidCurrency($value);
    $this->value = $value;
  }

  public function value(): string
  {
    return $this->value;
  }

  public function equals(CurrencyVO $currency): bool
  {
    return $this->value === $currency->value();
  }

  public function assureIsValidCurrency($value): void
  {
    if (!in_array($value, $this->currencies)) {
      throw new \InvalidArgumentException("Invalid currency");
    }
  }
}
