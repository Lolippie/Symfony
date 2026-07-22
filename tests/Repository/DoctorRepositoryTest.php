<?php

namespace App\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\Doctor;
use Doctrine\ORM\EntityManagerInterface;


class DoctorRepositoryTest extends KernelTestCase
{
    private ?EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }

    /**
     * @return Doctor[]
     */
    public function testDoctorWithSpecialties(): void
    {
        $doctors = $this->entityManager->getRepository(Doctor::class)->findDoctorWithSpecialties();
        $specialties = $doctors[0]->getSpecialties();
        $this->assertTrue($specialties->isInitialized());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
