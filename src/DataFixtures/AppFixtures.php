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
            // Add more quotes as needed
        ];

        foreach ($movies as $movie) {
            $newMovie = new Movie();

            $newMovie->setName($movie['name']);
            $newMovie->setReleaseYear($movie['release_year']);

            foreach ($quotes as $quote) {
                if ($quote['movie']!=$movie['name'])
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
