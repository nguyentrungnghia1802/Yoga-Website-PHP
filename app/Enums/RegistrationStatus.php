<?php
namespace App\Enums;

enum RegistrationStatus:string {
    case PENDING   = 'PENDING';
    case CONFIRMED = 'CONFIRMED';
    case CANCELLED = 'CANCELLED';
}

