<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutreController extends AbstractController
{
    #[Route('/autre', name: 'app_autre')]
    public function index(): Response
    {
        return $this->render('autre/index.html.twig', [
            'controller_name' => 'AutreController',
            'user' => $this->getUser()
        ]);
    }

}
