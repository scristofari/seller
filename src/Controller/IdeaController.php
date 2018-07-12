<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Factory\UserFactory;
use App\Form\IdeaType;
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
    public function create(Request $request, Security $security)
    {
        $form = $this->createForm(IdeaType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \App\Entity\Idea $idea */
            $idea = $form->getData();

            /* @todo use FOS USER, will duplicate user. */
            $user = (new UserFactory())->create($security->getUser());
            $idea->setUser($user);

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
        $entityManager = $this->getDoctrine()->getManager();
        $idea = $entityManager
          ->getRepository(Idea::class)
          ->findOneBySlug($slug);

        $form = $this->createForm(IdeaType::class, $idea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            ;
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
