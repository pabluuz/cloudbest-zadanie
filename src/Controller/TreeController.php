<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TreeController extends AbstractController
{
    #[Route('/tree', name: 'tree')]
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository("NodeRepository");
        $nodes = $repository->findAll();
        //In our case parent has always highest ID, but let's pretend that it's not the case
        $root = $repository->findOneBy(['parent' => null]);
        return $this->render('tree/index.html.twig', [
            'nodes' => $nodes,
            'root' => $root
        ]);
    }
}
