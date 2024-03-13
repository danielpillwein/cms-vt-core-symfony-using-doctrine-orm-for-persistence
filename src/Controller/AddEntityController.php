<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Quote;
use App\Form\QuoteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\MovieType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class AddEntityController extends AbstractController
{
    #[Route(path: [
        'en' => '/add-movie',
        'de' => '/film-hinzufuegen'
    ],
        name: 'add_movie',
    )]
    public function newMovie(Request $request, EntityManagerInterface $manager, TranslatorInterface $translator, ValidatorInterface $validator): Response
    {
        $movie = new Movie();

        $form = $this->createForm(MovieType::class, $movie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $movie = $form->getData();

            $errors = $validator->validate($movie);

            if (count($errors) > 0) {

                return $this->render('./addEntity.twig', [
                    'form' => $form,
                    'title' => $translator->trans("Add Movie"),
                    "_locale" => $request->getLocale()
                ]);
            }


            $manager->persist($movie);
            $manager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('./addEntity.twig', [
            'form' => $form,
            'title' => $translator->trans("Add Movie"),
            "_locale" => $request->getLocale()
        ]);
    }

    #[Route(
        path: [
            'en' => '/add-quote',
            'de' => '/zitat-hinzufuegen'
        ],
        name: 'add_quote'
    )]
    public function newQuote(Request $request, EntityManagerInterface $manager, TranslatorInterface $translator, ValidatorInterface $validator): Response
    {
        $quote = new Quote();

        $form = $this->createForm(QuoteType::class, $quote);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $quote = $form->getData();

            $errors = $validator->validate($quote);

            if (count($errors) > 0) {

                return $this->render('./addEntity.twig', [
                    'form' => $form,
                    'title' => $translator->trans("Add Movie"),
                    "_locale" => $request->getLocale()
                ]);
            }


            $manager->persist($quote);
            $manager->flush();

            return $this->redirectToRoute('home');

            //return $this->redirectToRoute('/add/quote');
        }

        return $this->render('./addEntity.twig', [
            'form' => $form,
            'title' => $translator->trans("Add Quote"),
            "_locale" => $request->getLocale()
        ]);
    }
}