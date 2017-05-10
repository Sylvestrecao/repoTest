<?php
// src/AppBundle/DataFixtures/ORM/LoadUserData.php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Bird;
class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $bird = new Bird();
        $bird->setNom("Pigeon");
        $bird->setFamille("piaf");
        $bird->setOrdre("Passeriformes");

        $bird2 = new Bird();
        $bird2->setNom("martinet");
        $bird2->setFamille("piaf");
        $bird2->setOrdre("Passeriformes");

        $manager->persist($bird);
        $manager->persist($bird2);
        $manager->flush();

    }
}