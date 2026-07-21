<?php

namespace App\DataFixtures;

use App\Entity\Specialty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpecialtyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $specialtiesNames = [
            'homeopathe' => 'Homéopathe',
            'osteopathe' => 'Ostéopathe',
            'medecin_generaliste' => 'Médecin Généraliste',
            'dentiste' => 'Dentiste',
            'infirmier' => 'Infirmier'
        ];

        foreach ($specialtiesNames as $reference => $specialtyName) {
            $specialty = new Specialty();
            $specialty->setName($specialtyName);
            $manager->persist($specialty);
            $this->addReference($reference, $specialty);
        }

        $manager->flush();
    }
}