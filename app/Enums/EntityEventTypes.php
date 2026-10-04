<?php

namespace App\Enums;

enum EntityEventTypes: int
{
    case none = 1;
    case birth = 2;
    case death = 3;
    case calendarDate = 4;
    case founded = 5;
}
