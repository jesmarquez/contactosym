<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Contacto;

class DefaultController extends AbstractController
{
    public function index(): Response
    {
        $msg = "Bienvenidos!";

        return $this->render('home.html.twig', [
            'msg' => $msg,
        ]);
    }

    public function showDate($date): Response
    { 

        $date1 = new \DateTime($date);
        $date1->setTime(0,0,0);

        $date2 = new \DateTime($date);
        $date2->setTime(23,59,59);

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT c
            FROM App\Entity\Contacto c
            WHERE c.creado BETWEEN :date1
            AND :date2
            ORDER BY c.creado ASC'
        )->setParameter('date1', $date1)
        ->setParameter('date2', $date2);

        // returns an array of Product objects
        $rows = $query->getResult();
        
        $strHtml= '<html><body>';
        foreach($rows as $r) {

            $strHtml = $strHtml . $r->getCreado()->format('Y/m/d H:i:s') . '-' . $r->getCorreo() .'<br>';
        }

        return new Response($strHtml);
    }

    public function seedingYesterday(): Response
    {
        date_default_timezone_set('America/Bogota');
        
        $ayer = new \DateTime('7/9/2021');
        // $ayer->setTime(15, 30);
        $entityManager = $this->getDoctrine()->getManager();
        

        $nombre = 'marhta';
        $apellido = 'mqz';
        $celular = '(766)-898-99-98';
        $area = 'ventas';
        $hora = 0;

        $times = [];
        for($i=1; $i <= 24; $i++) {
            $contacto = new Contacto();

            $times[$i] = new \DateTime('7/1/2021');
            $times[$i]->setTime($hora, 59, 59);

            $contacto->setNombre($nombre.strval($i));
            $contacto->setApellido($apellido.strval($i));
            $contacto->setCelular($celular);
            $contacto->setCorreo('user'.strval($i).'@gmail.com');
            $contacto->setArea('ventas');
            $contacto->setCreado($times[$i]);
            $contacto->setActualizado($times[$i]);
            $entityManager->persist($contacto);
            $hora++;
        }
        $entityManager->flush();
        $strHtml= '<html><body><>';
        $strHtml = $strHtml . '<h1>SEEDING YESTERDAY</h1>';
        $strHtml = $strHtml . '</body></html>';
        return new Response($strHtml);
    }

}