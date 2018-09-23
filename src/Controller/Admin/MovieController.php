<?php

namespace App\Controller\Admin;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 * @Route("/admin")
 *
 * @author Dihcar <rachid.edjek@gmail.com>
 */
class MovieController extends AbstractController
{
    /**
     * @Route("/movies", name="movies")
     */
    public function index()
    {
        return new Response('salut');
    }

    /**
     * @Route("/new", name="new_movie")
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $movie = new Movie();

        $form = $this->createFormBuilder($movie)
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('picture', TextType::class)
            ->add('dateRelease', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movie = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->render('admin/new_movie.html.twig', array(
                'form' => $form->createView(),
                'movie' => $movie,
            ));
        }

        return $this->render('admin/new_movie.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
