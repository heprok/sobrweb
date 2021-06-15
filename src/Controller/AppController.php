<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Tlc\ManualBundle\Repository\DowntimeRepository;

class AppController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

    #[Route('/debag', name: 'app1')]
    public function debug(DowntimeRepository $repository): Response
    {
        $downtime = $repository->findAll();
        dd($downtime);
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }
}
