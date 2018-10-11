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

use App\Entity\Particulier;

/**
 * Description of ParticulierFixtures
 *
 * @author julianbertrix
 */
class ParticulierFixtures extends Fixture implements OrderedFixtureInterface{
    //put your code here
    public function load(ObjectManager $manager) {
        $particulier = new Particulier();
        $particulier->setNombrePoint(0);
        $particulier->setUserId($this->getReference('user2'));
        $manager->persist($particulier);
        
        $particulier2 = new Particulier();
        $particulier2->setNombrePoint(0);
        $particulier2->setUserId($this->getReference('user3'));
        $manager->persist($particulier2);
        
        $particulier3 = new Particulier();
        $particulier3->setNombrePoint(0);
        $particulier3->setUserId($this->getReference('user4'));
        $manager->persist($particulier3);
        
        $particulier4 = new Particulier();
        $particulier4->setNombrePoint(0);
        $particulier4->setUserId($this->getReference('user5'));
        $manager->persist($particulier4);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 2;
    }
}
