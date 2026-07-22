<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $hasher){}
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $admin->setPassword($this->hasher->hashPassword($admin, '1234'));
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setLastName('Admin');
        $admin->setFirstName('Admin');
        $admin->setPhone('0600000000');
        // $product = new Product();
        // $manager->persist($product);

        $manager->persist($admin);

        $manager->flush();
    }
}
