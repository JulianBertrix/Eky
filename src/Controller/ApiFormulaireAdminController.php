<?php

namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\TypeDechet;
use App\Entity\Particulier;
use App\Entity\Dechet;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class ApiFormulaireAdminController extends AbstractController
{
    /**
     * @Route("/api/formulaire/dechet/add", name="api_formulaire_admin")
     * @Method({"POST"})
     */
    public function create(Request $request)
    {
//        $post = $request->request->all();
//        
//        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(["user_code"=>$post['user']]);
//        $particulier = $this->getDoctrine()->getRepository(Particulier::class)->findOneBy(['user_id'=>$user->getId()]);
//        $type = $this->getDoctrine()->getRepository(TypeDechet::class)->find($post['type']);
//        
//        $dechet = new Dechet();
//        $dechet->setQuantiteUtilise(0);
//        $dechet->setQuantite($post['qte']);
//        $dechet->setTypeDechetId($this->getDoctrine()->getManager()->find(TypeDechet::class, $type->getId()));
//        $dechet->setParticulierId($this->getDoctrine()->getManager()->find(Particulier::class, $particulier->getId()));
//        $dechet->setDate(date('Y-m-d'));
//        $this->getDoctrine()->getManager()->persist($dechet);
//        $this->getDoctrine()->getManager()->flush();
        
        $typeDechets = $this->getDoctrine()->getRepository(TypeDechet::class)->findAll();
        $retour = $this->json(JSON_encode($typeDechets)); 
        //print_r($retour);
        return new \Symfony\Component\HttpFoundation\JsonResponse(['data' => $typeDechets]);
    }
}
