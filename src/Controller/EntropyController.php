<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\EntropyGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EntropyController extends AbstractController
{
    #[Route('/entropy', name: 'app_entropy_post', methods: ['POST'])]
    public function index(
        Request $request,
        EntropyGenerator $entropy,
    ): JsonResponse
    {
        $length = intval($request->request->get('length'));
        $text = $request->request->get('text');
        
        if ((!is_int($length)) || (!is_string($text))) {
            throw new \InvalidArgumentException('Invalid Arguments');
        }
    
        $entropy->setLength($length);
        $message = $entropy->create($text);

        return $this->json(['message' => $message]);
    }
}
