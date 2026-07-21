<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Doctor;
use App\Repository\DoctorRepository;

#[Route('/doctors')]
final class DoctorController extends AbstractController
{
    #[Route('/{id}', name: 'app_details_doctor')]
    public function showDoctor(Doctor $doctor): Response
    {
        return $this->render('doctor/details.html.twig', [
            'doctor' => $doctor,
        ]);
    }

    #[Route('/', name: 'app_doctors')]
    public function showDoctors(DoctorRepository $doctorRepository): Response
    {
        $doctors = $doctorRepository->findAll();
        return $this->render('doctor/list.html.twig', [
            'doctors' => $doctors,
        ]);
    }
}
