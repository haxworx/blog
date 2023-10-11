<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\EntropyType;
use App\Service\EntropyGenerator;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
        ]);
    }

    #[Route('/blog', name: 'app_blog')]
    public function blog(PostRepository $repository): Response
    {
        $posts = $repository->findAll();

        return $this->render('page/blog.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/entropy', name: 'app_entropy', methods: ['GET'])]
    public function entropy(Request $request): Response
    {
        return $this->render('page/entropy.html.twig', [
        ]);
    }
}
