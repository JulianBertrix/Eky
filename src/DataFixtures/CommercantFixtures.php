<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use App\Entity\Commercant;
/**
 * Description of CommercantFixtures
 *
 * @author julianbertrix
 */
class CommercantFixtures extends Fixture implements OrderedFixtureInterface{
    //put your code here
    public function load(ObjectManager $manager) {
        $commercant = new Commercant();
        $commercant->setSiret(1234567000);
        $commercant->setLogo("logo1.jpg");
        $commercant->setDenomination("Boulangerie");
        $commercant->setAdresseSiege(null);
        $commercant->setUserId($this->getReference('user6'));
        $manager->persist($commercant);
        
        $commercant2 = new Commercant();
        $commercant2->setSiret(1234567001);
        $commercant2->setLogo("logo3.jpg");
        $commercant2->setDenomination("Epicerie");
        $commercant2->setAdresseSiege(null);
        $commercant2->setUserId($this->getReference('user7'));
        $manager->persist($commercant2);
        
        $commercant3 = new Commercant();
        $commercant3->setSiret(1234567002);
        $commercant3->setLogo("logo4.jpg");
        $commercant3->setDenomination("Primeur");
        $commercant3->setAdresseSiege(null);
        $commercant3->setUserId($this->getReference('user8'));
        $manager->persist($commercant3);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}
