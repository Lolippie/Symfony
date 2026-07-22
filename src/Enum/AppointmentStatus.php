<?php

namespace App\Enum;

enum AppointmentStatus : string {
   case PENDING = 'En attente';
    case CONFIRMED = 'Validé';
    case PASSED = 'Passé';

}