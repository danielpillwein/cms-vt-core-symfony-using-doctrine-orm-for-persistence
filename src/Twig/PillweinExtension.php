<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\TwigTest;

class PillweinExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('formatQuote', [$this, 'formatQuote']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('checkReleaseYear', [$this, 'checkReleaseYear']),
        ];
    }

    public function getTests(): array
    {
        return [
            new TwigTest('isClassic', [$this, 'isClassic']),
        ];
    }

    public function formatQuote($quote): string
    {
        return sprintf('"%s"', $quote);
    }

    public function checkReleaseYear($releaseYear): string
    {
        $yearToCheck = 1991;
        if ($releaseYear > $yearToCheck) {
            return "Released after " . $yearToCheck;
        }
        return "Released before " . $yearToCheck;
    }

    public function isClassic($releaseYear): bool
    {
        $currentYear = date('Y');
        return $currentYear - $releaseYear >= 1;
    }
}