<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class UserController
 */
class UserController extends Controller
{

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
          'user/login.html.twig',
          [
            'last_username' => $lastUsername,
            'error' => $error,
          ]
        );
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        // Handler for the logout system.
        // Empty. Just register the route.
    }
}