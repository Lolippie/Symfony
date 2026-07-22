<?php

namespace App\Tests\Entity;

use App\Entity\Appointment;
use App\Entity\Doctor;
use App\Enum\AppointmentStatus;
use PHPUnit\Framework\TestCase;

class AppointmentTest extends TestCase
{
    public function testAppointmentIsPendingWhenNoDoctorAndDateIsFuture(): void
    {
        $appointment = new Appointment();

        $futureDate = new \DateTime('+2 days');

        $appointment->setDate($futureDate);

        $this->assertEquals(
            AppointmentStatus::PENDING,
            $appointment->getStatus()
        );
    }


    public function testAppointmentIsConfirmedWhenDoctorIsAssigned(): void
    {
        $appointment = new Appointment();

        $futureDate = new \DateTime('+2 days');

        $appointment->setDate($futureDate);

        $doctor = new Doctor();

        $appointment->setDoctor($doctor);

        $this->assertEquals(
            AppointmentStatus::CONFIRMED,
            $appointment->getStatus()
        );
    }


    public function testAppointmentIsPassedWhenDateIsPast(): void
    {
        $appointment = new Appointment();

        $pastDate = new \DateTime('-2 days');

        $appointment->setDate($pastDate);

        $this->assertEquals(
            AppointmentStatus::PASSED,
            $appointment->getStatus()
        );
    }
}