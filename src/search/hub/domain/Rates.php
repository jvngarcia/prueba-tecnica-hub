<?php

namespace src\search\hub\domain;

class Rates
{
  private $value;

  private function __construct(array $value)
  {

    $this->assureIsValidPrimaryData($value);
    $this->value = $value;
  }

  public static function create(array $value): self
  {
    return new self($value);
  }

  public function value(): array
  {
    return $this->value;
  }

  private function assureIsValidPrimaryData($value): void
  {
    foreach ($value as $rate) {
      if (!($rate instanceof PrimaryData)) {
        throw new \InvalidArgumentException("Invalid PrimaryData");
      }
    }
  }

  public function jsonStructure(): array
  {
    $data = [];
    foreach ($this->value as $rate) {
      $data[] = [
        'mealPlanId' => $rate->mealPlanId(),
        'isCancellable' => $rate->isCancellable(),
        'price' => $rate->price(),
      ];
    }

    return $data;
  }
}
