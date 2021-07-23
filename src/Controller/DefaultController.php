<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index(): Response
    {
        $msg = "Bienvenidos!";

        return $this->render('home.html.twig', [
            'msg' => $msg,
        ]);
    }
}