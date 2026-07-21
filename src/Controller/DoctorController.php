<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Doctor;
use App\Repository\DoctorRepository;
use App\Form\DoctorType;

#[Route('/doctors')]
final class DoctorController extends AbstractController
{
    #[Route('/{id}', name: 'app_details_doctor', methods:['GET'], requirements: ['id' => '\d+'])]
    public function showDoctor(Doctor $doctor): Response
    {
        return $this->render('doctor/details.html.twig', [
            'doctor' => $doctor,
        ]);
    }

    #[Route('/', name: 'app_doctors', methods:['GET'])]
    public function showDoctors(DoctorRepository $doctorRepository): Response
    {
        $doctors = $doctorRepository->findAll();
        return $this->render('doctor/list.html.twig', [
            'doctors' => $doctors,
        ]);
    }

    #[Route('/new', name: 'app_doctor_new', methods:['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $doctor = new Doctor();
        $form = $this->createForm(DoctorType::class, $doctor);

        $form-> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($doctor);
            $em->flush();

            return $this->redirectToRoute('app_details_doctor', ['id' => $doctor->getId()]);
        }
        return $this->render('doctor/new.html.twig', [
            'form' => $form
        ]);
    }
}
