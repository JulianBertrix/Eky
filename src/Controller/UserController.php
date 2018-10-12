<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Particulier;
use App\Entity\Commercant;
use App\Entity\TypeUser;
use App\Form\ParticulierType;
use App\Form\CommercantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig');
    }

    /**
     * @Route("/register", name="register")
     */
    public function showRegister(Request $request, UserPasswordEncoderInterface $passwordEncoder, AuthenticationUtils $utils){
        $user = new User();

        $form = $this->createForm(ParticulierType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getVerifPassword());
            $user->setPassword($password);

            $uniqid = uniqid();
            $rand_start = rand(1,5);
            $rand_char = substr($uniqid,$rand_start,5);

            $user->setUserCode($rand_char);

            if($user->getIsPro()){
                $type = $this->getDoctrine()
                ->getRepository(TypeUser::class)
                ->find(3);
            } else  {
                $type = $this->getDoctrine()
                ->getRepository(TypeUser::class)
                ->find(2);
            }
            $user->setTypeUserId($type);

            $user = $form->getData();
            dump($user->getIsPro());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            
            $particulier = new Particulier();
            $particulier->SetUserId($user);
            $particulier->SetNombrePoint(0);
            $entityManager->persist($particulier);
            
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Vous êtes désormais enregistrer!'
            );

            if($user->getIsPro()){
                return $this->redirectToRoute('commercant', [
                    'id' => $user->getId()
                ]);
            } else {
                return $this->redirectToRoute('login');
            }
            
        }

        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();
    
        return $this->render('user/register.html.twig', array(
            'form' => $form->createView(),
            'error' => $error,
            'last_username' => $lastUsername
        ));
    }

    /**
     * @Route("/register/commercant/{id}", name="commercant")
     */
    public function showCommercant(Request $request, UserPasswordEncoderInterface $passwordEncoder, Int $id){
        $com = new Commercant();

        $form = $this->createForm(CommercantType::class, $com);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $com = $form->getData();

            $file = $form->get('logo')->getData();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('logo_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $com->setLogo($fileName);

            $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);
            $com->setUserId($user);

            dump($com);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($com);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Inscription terminé, vous pouvez vous connecter'
            );

            return $this->redirectToRoute('login');
            
        }
    
        return $this->render('user/commercant.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
