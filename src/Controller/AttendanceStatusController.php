<?php

namespace App\Controller;

use App\Entity\AttendanceStatus;
use App\Form\AttendanceStatusType;
use App\Repository\AttendanceStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/attendance/status')]
class AttendanceStatusController extends AbstractController
{
    #[Route('/', name: 'app_attendance_status_index', methods: ['GET'])]
    public function index(AttendanceStatusRepository $attendanceStatusRepository): Response
    {
        return $this->render('attendance_status/index.html.twig', [
            'attendance_statuses' => $attendanceStatusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_attendance_status_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $attendanceStatus = new AttendanceStatus();
        $form = $this->createForm(AttendanceStatusType::class, $attendanceStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($attendanceStatus);
            $entityManager->flush();

            return $this->redirectToRoute('app_attendance_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('attendance_status/new.html.twig', [
            'attendance_status' => $attendanceStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_attendance_status_show', methods: ['GET'])]
    public function show(AttendanceStatus $attendanceStatus): Response
    {
        return $this->render('attendance_status/show.html.twig', [
            'attendance_status' => $attendanceStatus,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_attendance_status_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AttendanceStatus $attendanceStatus, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AttendanceStatusType::class, $attendanceStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_attendance_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('attendance_status/edit.html.twig', [
            'attendance_status' => $attendanceStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_attendance_status_delete', methods: ['POST'])]
    public function delete(Request $request, AttendanceStatus $attendanceStatus, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$attendanceStatus->getId(), $request->request->get('_token'))) {
            $entityManager->remove($attendanceStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_attendance_status_index', [], Response::HTTP_SEE_OTHER);
    }
}
