<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(PostRepository $repository): Response
    {
        $posts = $repository->findAll();
        return $this->render('index/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
