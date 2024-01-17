<?php

namespace App\Controller;

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
    public function index(Request $request, QuoteRepository $quoteRepository, TranslatorInterface $translator): Response
    {
        return $this->render('./home.twig', [
            "quotes" => $quoteRepository->findAll(),
            "_locale" => $request->getLocale()
        ]);
    }

    #[Route(path: [
        'en' => '/delete-quote/{quoteId}',
        'de' => '/zitat-loeschen/{quoteId}'
    ], name: 'delete-quote')]
    public function deleteQuote(int $quoteId, EntityManagerInterface $manager, QuoteRepository $quoteRepository): Response
    {
        $quote = $quoteRepository->find($quoteId);

        if ($quote) {
            $manager->remove($quote);
            $manager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
