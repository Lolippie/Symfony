<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\OpeningHour;

class OpeningHourFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $days = [
            1 => "Lundi",
            2 => "Mardi",
            3 => "Mercredi",
            4 => "Jeudi",
            5 => "Vendredi",
            6 => "Samedi",
            7 => "Dimanche",
        ];


foreach ($days as $day => $name) {
    $openingHour = new OpeningHour();
    $openingHour->setDay($day);

    if ($day === 7) {
        $openingHour->setOpening(null);
        $openingHour->setClosing(null);
    } else {
        $openingHour->setOpening(new \DateTime('09:00'));
        $openingHour->setClosing(new \DateTime('17:00'));
    }

    $manager->persist($openingHour);
}

$manager->flush();

}}
