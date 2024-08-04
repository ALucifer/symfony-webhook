<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/test', name: 'index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/sent', name: 'sent')]
    public function send(HubInterface $hub): Response
    {
        $update = new Update(
            'test',
            json_encode(['message' => 'Hello world'])
        );
        $hub->publish($update);

        return $this->render('home/send.html.twig');
    }
}