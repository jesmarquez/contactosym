<?php
// src/Controller/ContactoController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Contacto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use \DateTime;
use App\Form\ContactoType;
use Symfony\Component\HttpFoundation\Request;

class ContactoController extends AbstractController
{
    public function showForm(): Response
    {
        $number = 980;
        return $this->render('contacto.html.twig', [
            'number' => $number,
        ]);
    }

    public function createProduct(ValidatorInterface $validator): Response
    {
        date_default_timezone_set('America/Bogota');
        
        $hoy = new \DateTime();
        $entityManager = $this->getDoctrine()->getManager();
  
        $contacto = new Contacto();
        $contacto->setNombre('Claris');
        $contacto->setApellido('Marquez');
        $contacto->setCelular('(766)-898-99-98');
        $contacto->setCorreo('david@gmail.com');
        $contacto->setArea('ventas');
        $contacto->setCreado($hoy);
        $contacto->setActualizado($hoy);
        
        $entityManager->persist($contacto);
        $entityManager->flush();

        $errors = $validator->validate($contacto);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }
        
        return new Response('Saved new contact with id '.$contacto->getId());
    }


    public function new(Request $request): Response
    {


        $contacto = new Contacto();

        $form = $this->createForm(ContactoType::class, $contacto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contacto = $form->getData();
            date_default_timezone_set('America/Bogota');

            $hoy = new \DateTime();
            $contacto->setCreado($hoy);
            $contacto->setActualizado($hoy);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contacto);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }
        return $this->render('contacto.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
