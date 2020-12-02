<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Meat;
use App\Form\Admin\MeatType;
use App\Repository\Admin\MeatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/meat")
 */
class MeatController extends AbstractController
{
    /**
     * @Route("/", name="admin_meat_index", methods={"GET"})
     */
    public function index(MeatRepository $meatRepository): Response
    {
        return $this->render('admin/meat/index.html.twig', [
            'meats' => $meatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_meat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $meat = new Meat();
        $form = $this->createForm(MeatType::class, $meat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($meat);
            $entityManager->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/meat/new.html.twig', [
            'meat' => $meat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_meat_show", methods={"GET"})
     */
    public function show(Meat $meat): Response
    {
        return $this->render('admin/meat/show.html.twig', [
            'meat' => $meat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_meat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Meat $meat): Response
    {
        $form = $this->createForm(MeatType::class, $meat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/meat/edit.html.twig', [
            'meat' => $meat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_meat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Meat $meat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$meat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($meat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_home');
    }
}
