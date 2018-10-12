<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TypeDechet;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $types = $this->getDoctrine()->getRepository(TypeDechet::class)->findAll();
        dump($types);
        return $this->render('admin/index.html.twig', [
            'types' => $types,
        ]);
    }
}
