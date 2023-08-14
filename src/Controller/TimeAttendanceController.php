<?php

namespace App\Controller;

use App\Entity\TimeAttendance;
use App\Form\TimeAttendanceType;
use App\Repository\TimeAttendaceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/time/attendance')]
class TimeAttendanceController extends AbstractController
{
    #[Route('/', name: 'app_time_attendance_index', methods: ['GET'])]
    public function index(TimeAttendaceRepository $timeAttendaceRepository): Response
    {
        return $this->render('time_attendance/index.html.twig', [
            'time_attendances' => $timeAttendaceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_time_attendance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $timeAttendance = new TimeAttendance();
        $form = $this->createForm(TimeAttendanceType::class, $timeAttendance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($timeAttendance);
            $entityManager->flush();

            return $this->redirectToRoute('app_time_attendance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('time_attendance/new.html.twig', [
            'time_attendance' => $timeAttendance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_time_attendance_show', methods: ['GET'])]
    public function show(TimeAttendance $timeAttendance): Response
    {
        return $this->render('time_attendance/show.html.twig', [
            'time_attendance' => $timeAttendance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_time_attendance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TimeAttendance $timeAttendance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TimeAttendanceType::class, $timeAttendance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_time_attendance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('time_attendance/edit.html.twig', [
            'time_attendance' => $timeAttendance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_time_attendance_delete', methods: ['POST'])]
    public function delete(Request $request, TimeAttendance $timeAttendance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timeAttendance->getId(), $request->request->get('_token'))) {
            $entityManager->remove($timeAttendance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_time_attendance_index', [], Response::HTTP_SEE_OTHER);
    }
}
