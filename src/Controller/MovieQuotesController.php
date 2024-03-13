<?php

namespace App\Controller;

use App\Entity\Quote;
use App\Repository\QuoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class MovieQuotesController extends AbstractController
{
    #[Route(path: [
        'en' => '/home',
        'de' => '/startseite'
    ], name: 'home')]
    public function index(Request $request, QuoteRepository $quoteRepository): Response
    {
        $searchTerm = $request->query->get('search');
        $randomFlag = $request->query->get('random');

        if ($searchTerm) {
            $quotes = $quoteRepository->findBySearchTerm($searchTerm);
        } else {
            $quotes = $quoteRepository->findAll();
        }

        if ($randomFlag) {
            $quotes = $quoteRepository->getRandom();
        }

        return $this->render('./home.twig', [
            "quotes" => $quotes,
            "_locale" => $request->getLocale()
        ]);
    }

    #[Route(path: [
        'en' => '/delete-quote/{id}',
        'de' => '/zitat-loeschen/{id}'
    ], name: 'delete-quote')]
    public function deleteQuote(Quote $quote, EntityManagerInterface $manager, QuoteRepository $quoteRepository): Response
    {

        if ($quote) {
            $manager->remove($quote);
            $manager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
