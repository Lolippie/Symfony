<?php

namespace App\Controller;

use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Doctor;
use App\Repository\DoctorRepository;
use App\Form\DoctorType;

final class DoctorController extends AbstractController
{
    #[Route('/doctors/{id}', name: 'app_details_doctor', methods:['GET'], requirements: ['id' => '\d+'])]
    public function showDoctor(Doctor $doctor): Response
    {
        return $this->render('doctor/details.html.twig', [
            'doctor' => $doctor,
        ]);
    }

    #[Route('/doctors.{_format}', name: 'app_doctors',requirements:['_format' => 'html|json'], methods:['GET'], defaults: ['_format' =>'html'])]
    public function showDoctors(Request $request, DoctorRepository $doctorRepository): Response
    {
        $doctors = $doctorRepository->findAll();

        if ($request->getRequestFormat() === 'json') {
            return $this->json($doctors, context: [
                'groups' => ['doctor:read']
            ]);
        }

        return $this->render('doctor/list.html.twig', [
            'doctors' => $doctors,
        ]);
    }

    #[Route('/new', name: 'app_doctor_new', methods:['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $em, FileUploader $fileUploader): Response
    {
        $doctor = new Doctor();
        $form = $this->createForm(DoctorType::class, $doctor);

        $form-> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $brochureFile */
            $photoFile = $form->get('photoFile')->getData();
            if ($photoFile) {
                $photoFileName = $fileUploader->upload($photoFile);
                $doctor->setPhoto($photoFileName);
            }

            $em->persist($doctor);
            $em->flush();

            return $this->redirectToRoute('app_details_doctor', ['id' => $doctor->getId()]);
        }
        return $this->render('doctor/new.html.twig', [
            'form' => $form
        ]);
    }
}
