<?php

namespace src\search\hub\domain;

interface IHUBRepository
{
  public function search(RequestHUB $request): ?Rooms;
}
