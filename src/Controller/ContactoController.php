<?php
// src/Controller/ContactoController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactoController extends AbstractController
{
    public function showForm(): Response
    {
        $number = 980;
        return $this->render('contacto.html.twig', [
            'number' => $number,
        ]);
    }
}
