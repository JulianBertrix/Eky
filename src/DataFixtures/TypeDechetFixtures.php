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

use App\Entity\TypeDechet;

/**
 * Description of TypeDechetFixtures
 *
 * @author julianbertrix
 */
class TypeDechetFixtures extends Fixture implements OrderedFixtureInterface{
    //put your code here
    public function load(ObjectManager $manager) {
        $type = new TypeDechet();
        $type->setType("Animal");
        $type->setConversion(20);
        $manager->persist($type);
        
        $type2 = new TypeDechet();
        $type2->setType("Végétal");
        $type2->setConversion(10);
        $manager->persist($type2);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 1;
    }
}
