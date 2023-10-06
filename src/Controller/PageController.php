<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(PostRepository $repository): Response
    {
        $posts = $repository->findAll();

        return $this->render('page/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
