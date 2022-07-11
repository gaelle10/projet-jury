<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    #[Route('/profile/compte', name: 'app_compte')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('compte/index.html.twig', [
            'commandes' => $user->getCommandes()
        ]);
    }
}