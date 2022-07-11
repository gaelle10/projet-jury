<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PageController extends AbstractController
{
    #[Route('/mention-legal', name: 'app_legal')]
    public function legal(): Response
    {
        return $this->render('page/legal.html.twig');
    }
}
