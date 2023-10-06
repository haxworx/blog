<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\PostType;
use App\Repository\PostRepository;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setUserId($user->getId());
            $post->setCreatedAt(new \DateTimeImmutable());

            $em = $doctrine->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('post/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/post/edit/{id}', name: 'app_post_edit')]
    public function edit(Request $request, PostRepository $repository, int $id): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $post = $repository->findOneById($id);
        if (!$post) {
            throw $this->createNotFoundException(
                'Post does not exist.'
            );
        }

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($post, true);
        }

        return $this->render('post/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/post/view/{id}', name: 'app_post_view')]
    public function view(Request $request, PostRepository $repository, int $id): Response
    {
        $post = $repository->findOneById($id);
        if (!$post) {
            throw $this->createNotFoundException(
                'Post does not exist.'
            );
        }

        return $this->render('post/view.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/post/delete/{id}', name: 'app_post_delete', methods: ['POST'])]
    public function remove(Request $request, PostRepository $repository, int $id): Response
    {
        $token = $request->request->get('token');

        if (!$this->isCsrfTokenValid('post-delete', $token)) {
            throw $this->createAccessDeniedException('Invalid CSRF token.');
        }

        $post = $repository->findOneById($id);
        if (!$post) {
            throw $this->createNotFoundException(
                'Post does not exist.'
            );
        }

        $repository->remove($post, true);

        return $this->redirectToRoute('app_index');
    }
}
