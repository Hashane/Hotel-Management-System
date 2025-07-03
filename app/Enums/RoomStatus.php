<?php

namespace App\Enums;

enum RoomStatus: int
{
    case AVAILABLE = 1;
    case MAINTENANCE = 2;
    case CLEANING = 3;
    case OUT_OF_ORDER = 4; // broken A/C
}
