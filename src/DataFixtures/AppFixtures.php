<?php

namespace App\DataFixtures;

use App\Repository\MovieRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use App\Entity\Quote;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Test movies data for data fixtures
        $movies = [
            [
                'name' => 'The Shawshank Redemption',
                'release_year' => 1994,
            ],
            [
                'name' => 'The Godfather',
                'release_year' => 1972,
            ],
            [
                'name' => 'Pulp Fiction',
                'release_year' => 1994,
            ],
            [
                'name' => 'Titanic',
                'release_year' => 1997,
            ],
            [
                'name' => 'The Lord of the Rings: The Fellowship of the Ring',
                'release_year' => 2001,
            ],
            [
                'name' => 'Forrest Gump',
                'release_year' => 1994,
            ],
            [
                'name' => 'The Silence of the Lambs',
                'release_year' => 1991,
            ],
            [
                'name' => 'Schindler\'s List',
                'release_year' => 1993,
            ],
            [
                'name' => 'Fight Club',
                'release_year' => 1999,
            ],
            [
                'name' => 'The Green Mile',
                'release_year' => 1999,
            ],
            // Add more movies as needed
        ];
        // Test movie quotes data for data fixtures
        $quotes = [
            [
                'quote' => 'I\'m gonna make him an offer he can\'t refuse.',
                'character' => 'Don Vito Corleone',
                'movie' => 'The Godfather',
            ],
            [
                'quote' => 'Say "what" again! I dare you, I double-dare you, motherf***er!',
                'character' => 'Jules Winnfield',
                'movie' => 'Pulp Fiction',
            ],
            [
                'quote' => 'I\'m the king of the world!',
                'character' => 'Jack Dawson',
                'movie' => 'Titanic',
            ],
            [
                'quote' => 'Even the smallest person can change the course of the future.',
                'character' => 'Galadriel',
                'movie' => 'The Lord of the Rings: The Fellowship of the Ring',
            ],
            [
                'quote' => 'Get busy living, or get busy dying.',
                'character' => 'Andy Dufresne',
                'movie' => 'The Shawshank Redemption',
            ],
            [
                'quote' => 'Life is like a box of chocolates. You never know what you\'re gonna get.',
                'character' => 'Forrest Gump',
                'movie' => 'Forrest Gump',
            ],
            [
                'quote' => 'A census taker once tried to test me. I ate his liver with some fava beans and a nice Chianti.',
                'character' => 'Hannibal Lecter',
                'movie' => 'The Silence of the Lambs',
            ],
            [
                'quote' => 'Whoever saves one life, saves the world entire.',
                'character' => 'Oskar Schindler',
                'movie' => 'Schindler\'s List',
            ],
            [
                'quote' => 'The first rule of Fight Club is: You do not talk about Fight Club.',
                'character' => 'Narrator',
                'movie' => 'Fight Club',
            ],
            [
                'quote' => 'I\'m sorry for what I am.',
                'character' => 'John Coffey',
                'movie' => 'The Green Mile',
            ],
            // Add more quotes as needed
        ];

        foreach ($movies as $movie) {
            $newMovie = new Movie();

            $newMovie->setName($movie['name']);
            $newMovie->setReleaseYear($movie['release_year']);

            foreach ($quotes as $quote) {
                if ($quote['movie'] != $movie['name'])
                    continue;

                $newQuote = new Quote();

                $newQuote->setQuote($quote['quote']);
                $newQuote->setCharacter($quote['character']);
                $newQuote->setMovie($newMovie);

                $manager->persist($newQuote);
            }

            $manager->persist($newMovie);
        }

        $manager->flush();
    }
}
