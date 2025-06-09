<?php

namespace App\Enums;

enum RoomStatus: int
{
    case AVAILABLE = 1;
    case RESERVED = 2; // Assigned for a reservation but not yet checked in
    case OCCUPIED = 3;
    case MAINTENANCE = 4;
    case CLEANING = 5;
    case OUT_OF_ORDER = 6; // broken A/C
}
