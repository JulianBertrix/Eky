<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Particulier;
use App\Entity\Commercant;
use App\Entity\Dechet;
use App\Entity\Coupon;

class CouponController extends AbstractController
{
    /**
     * @Route("/coupon", name="coupon")
     */
    public function index()
    {
        $particuliers = $this->getDoctrine()->getRepository(Particulier::class)->findAll();
        $commercant = $this->getDoctrine()->getRepository(Commercant::class)->findAll();
        $dechets = $this->getDoctrine()->getRepository(Dechet::class)->findAll();
        
        foreach ($particuliers as $particulier){
            foreach ($dechets as $dechet){
                if ($dechet.getParticulierId()->getId() === $particulier->getId() && $particulier->getNombrePoint() >= 100){
                    
                }
            }
        }
        
        return $this->render('coupon/index.html.twig', [
            'controller_name' => 'CouponController',
        ]);
    }
}
