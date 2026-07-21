<?php

namespace App\Controller;

use App\Entity\Specialty;
use App\Entity\Appointment;
use App\Form\AppointmentType;
use App\Repository\SpecialtyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class AppointmentController extends AbstractController
{
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $appointment = new Appointment();
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($appointment);
            $entityManager->flush();
        }

        return $this->render('appointment/_form.html.twig', [
            'form' => $form,
        ]);
    }
}
