<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\UserSettings;
use App\Form\UserSettingsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserSettingsController extends AbstractController
{
    #[Route('/user/settings', name: 'app_user_settings')]
    public function index(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser();

        $settings = new UserSettings();

        $form = $this->createForm(UserSettingsType::class, $settings);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($passwordHasher->isPasswordValid($user, $settings->getOldPassword())) {
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $settings->getPlainPassword(),
                );
                $user->setPassword($hashedPassword);
                $em = $doctrine->getManager();
                $em->persist($user);
                $em->flush();
            }
        }

        return $this->render('user_settings/index.html.twig', [
            'form' => $form,
        ]);
    }
}
