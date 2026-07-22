<?php

namespace App\Tests\Entity;

use App\Entity\Doctor;
use PHPUnit\Framework\TestCase;


class DoctorTest extends TestCase
{
    public function testFullName(): void
    {
        $doctor = new Doctor();
        $doctor->setFirstName('John');
        $doctor->setLastName('Doe');
        $this->assertEquals('John Doe', $doctor->getFullName());
    }
}
