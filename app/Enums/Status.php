<?php

namespace App\Enums;

enum Status: string
{
    case PENDING = 'PENDING';
    case DELIVERED = 'DELIVERED';
    case CANCELED = 'CANCELED';
}
