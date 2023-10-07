<?php

declare(strict_types=1);

namespace App\Twig;

use App\Repository\UserRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function __construct(private UserRepository $repository) {}

    public function getFilters()
    {
        return [
            new TwigFilter('ellipsis', [$this, 'ellipsis']),
            new TwigFilter('username', [$this, 'username']),
        ];
    }

    public function ellipsis(?string $text): string
    {
        if (strlen($text) >= 128) {
            return substr($text, 0, 128) . '...';
        }

        return $text;
    }

    public function username(?int $userId): string
    {
        $user = $this->repository->findOneById($userId);

        return $user->getName();
    }
}
