<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('ellipsis', [$this, 'ellipsis']),
        ];
    }
    public function ellipsis(?string $text): string
    {
        if (strlen($text) >= 32) {
            return substr($text, 0, 32) . '...';
        }

        return $text;
    }
}
