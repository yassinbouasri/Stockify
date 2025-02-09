<?php

namespace App\Enums;

enum Status: string
{
    case PENDING = 'pending';
    case DELIVERED = 'delivered';
    case CANCELED = 'canceled';
}
