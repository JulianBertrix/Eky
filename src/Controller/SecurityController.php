<?php

namespace App\Controller;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $utils)
    {

        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){
        $this->addFlash('success', 'Vous êtes déconnecté!');
    }

    /**
     * @Route("/success", name="success")
     */
    public function success(){

        $usr = $this->get('security.token_storage')->getToken()->getUser();

        $session = new Session(new NativeSessionStorage(), new AttributeBag());
        $session->set('id', $usr->getId());
        $session->set('user_code', $usr->getUserCode());
        $session->set('role', $usr->getTypeUserId()->getId());

        $this->addFlash('success', 'Vous êtes desormais connecté');

        return $this->redirectToRoute('home');
    }
}
