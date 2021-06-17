<?php

namespace App\Controller;

use App\Repository\DowntimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        $downtime = $repository->getLastDowntime();
        dd($downtime);
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }
}
