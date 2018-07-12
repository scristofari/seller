<?php

namespace App\Controller;

use App\Entity\Idea;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        /* @todo use KnpPaginatorBundle to paginate. */
        $ideas = $this->getDoctrine()
          ->getRepository(Idea::class)
          ->findAll();

        return $this->render(
          'home/index.html.twig',
          [
            'ideas' => $ideas,
          ]
        );
    }
}
