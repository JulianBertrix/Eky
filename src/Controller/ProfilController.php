<?php

namespace App\Controller;

use App\Entity\Dechet;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index()
    {

        //je récupère l'uttilisateur courant (à remplacer)
        $currentUser = $this->getDoctrine()->getRepository(User::class)->find(2);

        //je stocke son ID
        $curentId = $currentUser->getId();

        //je recupere tous mes dechets
        $dechets = $this->getDoctrine()->getRepository(Dechet::class)->findAll();

        $entityManager = $this->getDoctrine()->getManager();

        $totalPoint = 0;
        $totalReste = 0;
        foreach ($dechets as $value)
        {

            //si l'id de l'uttilisateur correspondont à ma clé etrangère de ma table dechet
            // alors se sont les bon dechet

            if ($curentId === $value->getParticulierId()->getId()) {

                //je recupere le type
                $typeDechet = $value->getTypeDechetId()->getType();
                //je récupere la valeur à diviser
                $convertion = $value->getTypeDechetId()->getConversion();


                //je recupere le poids

                $poid = $value->getQuantiteUtilise();


                //si le type de dechet est de type animal
                if ($typeDechet === "Animal")
                {

//j'efectue le calcul de mes poinds
                    $point = $poid / $convertion;

                    //j'arrondi mes points au plus bas
                    $pointArrondie = floor($point);

                    //je recupere les restes après virgule
                    $reste = $point - $pointArrondie;

                    $totalPoint += $pointArrondie;

                    $totalReste += $reste;

                    //si j'arrive a faire un point avec ce qu'il me reste alors je le rajoute a mon total de point

                        if ($totalReste >= 1)
                        {
                        dump("total reste =" . $totalReste);

                        $totalPoint += floor($totalReste);

                        }


                    //je convertir les gramme restant pour les stocker en bdd
                    $resteGramme = $reste * $convertion;

                    $value->setQuantite($resteGramme);

                    //je sauvegarde mon entité en db
                    $entityManager->persist($value);
                    $entityManager->flush();

                }
                else
                    {


                    $point = $poid / $convertion;
                    $pointArrondie = floor($point);
                    $reste = $point - $pointArrondie;
                    //dump($pointArrondie);
                    $resteGramme = $reste * $convertion;
                    $value->setQuantite($resteGramme);

                    //je sauvegarde mon entité en db
                    $entityManager->persist($value);
                    $entityManager->flush();

                        //si j'arrive a faire un point avec ce qu'il me reste alors je le rajoute a mon total de point
                    if ($totalReste >= 1)
                    {

                        $totalPoint += floor($totalReste);

                    }

                    $totalPoint += $pointArrondie;
                    $totalReste += $reste;

                }

            }

        }


        //si mon total des restes est supérieur a 1 ,c'est que
        // je peut ajouter un point suplémentaire à mon total des points


        $currentUser->getParticulier()->setNombrePoint($totalPoint);

        $entityManager->persist($currentUser);
        $entityManager->flush();

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'pointUser'=> $totalPoint
        ]);
    }
}
