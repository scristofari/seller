<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Factory\UserFactory;
use App\Form\IdeaType;
use App\Manager\IdeaManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Class IdeaController.
 */
class IdeaController extends Controller
{

    /**
     * @Route("/ideas/create", name="idea_create")
     */
    public function create(Request $request, Security $security) {
        $form = $this->createForm(IdeaType::class);
        $form->handleRequest($request);

        /* @todo create a service for the form / Single responsibility */
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \App\Entity\Idea $idea */
            $idea = $form->getData();
            $idea->setUser($security->getUser());

            /* @todo create a service to save / update an idea. */
            $em = $this->getDoctrine()->getManager();
            $em->persist($idea);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render(
          'idea/create.html.twig',
          [
            'form' => $form->createView(),
          ]
        );
    }

    /**
     * @Route("/ideas/update/{slug}", name="idea_update")
     */
    public function update(Request $request, $slug)
    {
        /* @TODO Use param converter to handle this. */
        $entityManager = $this->getDoctrine()->getManager();
        $idea = $entityManager
          ->getRepository(Idea::class)
          ->findOneBySlug($slug);
        if (null === $idea) {
            $this->createNotFoundException("Idea not found.");
        }

        $form = $this->createForm(IdeaType::class, $idea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();;
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render(
          'idea/update.html.twig',
          [
            'form' => $form->createView(),
          ]
        );
    }
}
