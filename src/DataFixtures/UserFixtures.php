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

use App\Entity\TypeUser;
use App\Entity\User;

/**
 * Description of UserFixtures
 *
 * @author julianbertrix
 */
class UserFixtures extends Fixture implements OrderedFixtureInterface{
    //put your code here
    public function load(ObjectManager $manager){
        $this->createTypeUser($manager);
        $this->createUser($manager);
    }
    
    public function createTypeUser($em){
        $type = new TypeUser();
        $type->setType("admin");
        $em->persist($type);
        $this->addReference('admin', $type);
        
        $type2 = new TypeUser();
        $type2->setType("particulier");
        $em->persist($type2);
        $this->addReference('particulier', $type2);
        
        $type3 = new TypeUser();
        $type3->setType("commercant");
        $em->persist($type3);
        $this->addReference('commercant', $type3);
        
        $em->flush();
    }
    public function createUser($em){
        $user = new User();
        $user->setNom("aaa");
        $user->setPrenom("aaa");
        $user->setEmail("email@eky.com");
        $user->setAdresse("01 rue hackathon, 34000 Montpellier");
        $user->setTelephone(0102030401);
        $user->setPassword("admin");
        $user->setUserCode("0001A");
        $user->setTypeUserId($this->getReference('admin'));
        $em->persist($user);
        $this->addReference('user', $user);
        
        $user2 = new User();
        $user2->setNom("particulier");
        $user2->setPrenom("particulier");
        $user2->setEmail("email2@eky.com");
        $user2->setAdresse("02 rue hackathon, 34000 Montpellier");
        $user2->setTelephone(0102030402);
        $user2->setPassword("mdp");
        $user2->setUserCode("0002A");
        $user2->setTypeUserId($this->getReference('particulier'));
        $em->persist($user2);
        $this->addReference('user2', $user2);
        
        $user3 = new User();
        $user3->setNom("particulier2");
        $user3->setPrenom("particulier2");
        $user3->setEmail("email3@eky.com");
        $user3->setAdresse("03 rue hackathon, 34000 Montpellier");
        $user3->setTelephone(0102030403);
        $user3->setPassword("mdp");
        $user3->setUserCode("0003A");
        $user3->setTypeUserId($this->getReference('particulier'));
        $em->persist($user3);
        $this->addReference('user3', $user3);
        
        $user4 = new User();
        $user4->setNom("particulier3");
        $user4->setPrenom("particulier3");
        $user4->setEmail("email4@eky.com");
        $user4->setAdresse("04 rue hackathon, 34000 Montpellier");
        $user4->setTelephone(0102030404);
        $user4->setPassword("mdp");
        $user4->setUserCode("0004A");
        $user4->setTypeUserId($this->getReference('particulier'));
        $em->persist($user4);
        $this->addReference('user4', $user4);
        
        $user5 = new User();
        $user5->setNom("particulier4");
        $user5->setPrenom("particulier4");
        $user5->setEmail("email5@eky.com");
        $user5->setAdresse("05 rue hackathon, 34000 Montpellier");
        $user5->setTelephone(0102030405);
        $user5->setPassword("mdp");
        $user5->setUserCode("0005A");
        $user5->setTypeUserId($this->getReference('particulier'));
        $em->persist($user5);
        $this->addReference('user5', $user5);
        
        $user6 = new User();
        $user6->setNom("commercant");
        $user6->setPrenom("commercant");
        $user6->setEmail("email6@eky.com");
        $user6->setAdresse("06 rue hackathon, 34000 Montpellier");
        $user6->setTelephone(0102030406);
        $user6->setPassword("mdp");
        $user6->setUserCode("0006A");
        $user6->setTypeUserId($this->getReference('commercant'));
        $em->persist($user6);
        $this->addReference('user6', $user6);
        
        $user7 = new User();
        $user7->setNom("commercant2");
        $user7->setPrenom("commercant2");
        $user7->setEmail("email7@eky.com");
        $user7->setAdresse("07 rue hackathon, 34000 Montpellier");
        $user7->setTelephone(0102030407);
        $user7->setPassword("mdp");
        $user7->setUserCode("0007A");
        $user7->setTypeUserId($this->getReference('commercant'));
        $em->persist($user7);
        $this->addReference('user7', $user7);
        
        $user8 = new User();
        $user8->setNom("commercant3");
        $user8->setPrenom("commercant3");
        $user8->setEmail("email8@eky.com");
        $user8->setAdresse("08 rue hackathon, 34000 Montpellier");
        $user8->setTelephone(0000000000);
        $user8->setPassword("mdp");
        $user8->setUserCode("0008A");
        $user8->setTypeUserId($this->getReference('commercant'));
        $em->persist($user8);
        $this->addReference('user8', $user8);
        
        $em->flush();
    }
    
    public function getOrder() {
        return 1;
    }
}
