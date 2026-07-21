<?php

namespace App\Controller;

use App\Repository\DoctorRepository;
use App\Repository\OpeningHourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(DoctorRepository $doctorRepository, OpeningHourRepository $openingHourRepository): Response
    {
        $opening_hours = $openingHourRepository->findAll();
        $doctors = $doctorRepository->findAll();
        return $this->render('home/index.html.twig', [
            'doctors' => $doctors,
            'opening_hours' => $opening_hours
        ]);
    }
}
