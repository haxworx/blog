<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Scripture;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ScriptureController extends AbstractController
{
    #[Route('/scripture', name: 'app_scripture', methods: ['GET'])]
    public function index(Scripture $scripture): JsonResponse
    {
        $text = $scripture->getVerse();
        return $this->json(['text' => $text]);
    }
}
