<?php


namespace src\search\hub\domain;

class PrimaryData
{

  private $mealPlanId;
  private $isCancellable;
  private $price;

  private function __construct(MealPlanId $mealPlanId, IsCancellable $isCancellable, Price $price)
  {
    $this->mealPlanId = $mealPlanId;
    $this->isCancellable = $isCancellable;
    $this->price = $price;
  }

  public static function create(int $mealPlanId, bool $isCancellable, float $price): self
  {
    return new self(
      new MealPlanId($mealPlanId),
      new IsCancellable($isCancellable),
      new Price($price)
    );
  }

  public function mealPlanId(): int
  {
    return $this->mealPlanId->value();
  }

  public function isCancellable(): bool
  {
    return $this->isCancellable->value();
  }

  public function price(): float
  {
    return $this->price->value();
  }
}
