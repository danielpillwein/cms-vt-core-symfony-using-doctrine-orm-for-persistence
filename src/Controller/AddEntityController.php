<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Quote;
use App\Form\QuoteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\MovieType;

class AddEntityController extends AbstractController
{
    #[Route('/add-movie', name: 'add_movie')]
    public function newMovie(Request $request, EntityManagerInterface $manager): Response
    {
        $movie = new Movie();

        $form = $this->createForm(MovieType::class,$movie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $movie = $form->getData();

            $manager->persist($movie);
            $manager->flush();

            return $this->redirectToRoute('home');

            //return $this->redirectToRoute('/add/quote');
        }

        return $this->render('./addMovie.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/add-quote', name: 'add_quote')]
    public function newQuote(Request $request, EntityManagerInterface $manager): Response
    {
        $quote = new Quote();

        $form = $this->createForm(QuoteType::class,$quote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $quote = $form->getData();

            $manager->persist($quote);
            $manager->flush();

            return $this->redirectToRoute('home');

            //return $this->redirectToRoute('/add/quote');
        }

        return $this->render('./addMovie.twig', [
            'form' => $form,
        ]);
    }
}