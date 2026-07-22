<?php

namespace App\Event;

use App\Entity\Appointment;
use Symfony\Contracts\EventDispatcher\Event;


class AppointmentTakenEvent extends Event
{
    public function __construct(public readonly Appointment $appointment) {}
        
    public function getAppointment(): Appointment
    {
        return $this->appointment;
    }
}