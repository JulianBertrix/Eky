<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Particulier;
use App\Entity\Commercant;
use App\Entity\Coupon;

class CouponController extends AbstractController
{
    /**
     * @Route("/coupon", name="coupon")
     */
    public function index()
    {
        $particuliers = $this->getDoctrine()->getRepository(Particulier::class)->findAll();
        $commercants = $this->getDoctrine()->getRepository(Commercant::class)->find(random_int(1, 3));
        $coupons = null;
        
        foreach ($particuliers as $particulier){
            if ($particulier->getNombrePoint() >= 100){
                $coupon = new Coupon();
                $coupon->setCommercantId($this->getDoctrine()->getManager()->find(Commercant::class, $commercants->getId()));
                $coupon->setParticulierId($this->getDoctrine()->getManager()->find(Particulier::class, $particulier->getId()));
                $coupon->setCodePromo(random_int(1000, 9999));
                $coupon->setIsUsed(false);
                $this->getDoctrine()->getManager()->persist($coupon);
                
                $particulier->setNombrePoint($particulier->getNombrePoint() - 100);
                $this->getDoctrine()->getManager()->merge($particulier);
                
                $this->getDoctrine()->getManager()->flush();
                
                $coupons = $this->getDoctrine()->getRepository(Coupon::class)->findAll();
            }
        }
        
        return $this->render('coupon/index.html.twig', [
            'coupons' => $coupons,
            'particuliers' => $particuliers,
            'commercants' => $commercants,
        ]);
    }
}
