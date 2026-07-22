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
use App\Repository\AppointmentRepository;
use Symfony\Component\Security\Http\Attribute\IsGranted;


final class AppointmentController extends AbstractController
{
    #[Route('/appointment/new', name: 'app_new_appointment')]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $appointment = new Appointment();
        $appointment->setFirstName($user->getFirstName());
        $appointment->setLastName($user->getLastName());
        $appointment->setEmail($user->getEmail());
        $appointment->setPhone($user->getPhone());
        $appointment->setUser($user);
        $form = $this->createForm(AppointmentType::class, $appointment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($appointment);
            $entityManager->flush();

            return $this->redirectToRoute('app_my_appointments', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('appointment/new.html.twig', [
            'form' => $form,
        ]);
    }

     #[Route('/appointments', name: 'app_appointments')]
     #[IsGranted('ROLE_ADMIN')]
        public function showAppointments(Request $request, EntityManagerInterface $entityManager, AppointmentRepository $appointmentRepository ): Response
    {
        $appointments = $appointmentRepository->findAll();

        return $this->render('appointment/listAdmin.html.twig', [
            'appointments' => $appointments,
        ]);
    }

     #[Route('/my-appointments', name: 'app_my_appointments')]
     #[IsGranted('ROLE_USER')]
        public function showMyAppointments(Request $request, EntityManagerInterface $entityManager, AppointmentRepository $appointmentRepository ): Response
    {
        $user = $this->getUser();
        $appointments = $appointmentRepository->findBy([
            'user' => $user,
        ]);

        return $this->render('appointment/listUser.html.twig', [
            'appointments' => $appointments,
        ]);
    }

    public function showNew(Request $request, EntityManagerInterface $entityManager): Response
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
