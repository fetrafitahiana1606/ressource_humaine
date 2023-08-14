<?php

namespace App\Controller;

use App\Entity\Payroll;
use App\Form\PayrollType;
use App\Repository\PayrollRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/payroll')]
class PayrollController extends AbstractController
{
    #[Route('/', name: 'app_payroll_index', methods: ['GET'])]
    public function index(PayrollRepository $payrollRepository): Response
    {
        return $this->render('payroll/index.html.twig', [
            'payrolls' => $payrollRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_payroll_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $payroll = new Payroll();
        $form = $this->createForm(PayrollType::class, $payroll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($payroll);
            $entityManager->flush();

            return $this->redirectToRoute('app_payroll_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('payroll/new.html.twig', [
            'payroll' => $payroll,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_payroll_show', methods: ['GET'])]
    public function show(Payroll $payroll): Response
    {
        return $this->render('payroll/show.html.twig', [
            'payroll' => $payroll,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_payroll_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Payroll $payroll, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PayrollType::class, $payroll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_payroll_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('payroll/edit.html.twig', [
            'payroll' => $payroll,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_payroll_delete', methods: ['POST'])]
    public function delete(Request $request, Payroll $payroll, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$payroll->getId(), $request->request->get('_token'))) {
            $entityManager->remove($payroll);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_payroll_index', [], Response::HTTP_SEE_OTHER);
    }
}
