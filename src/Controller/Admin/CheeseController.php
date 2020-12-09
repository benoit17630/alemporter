<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Cheese;
use App\Form\Admin\CheeseType;
use App\Repository\Admin\CheeseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/cheese")
 */
class CheeseController extends AbstractController
{
    /**
     * @Route("/", name="admin_cheese_index", methods={"GET"})
     */
    public function index(CheeseRepository $cheeseRepository): Response
    {
        return $this->render('admin/cheese/index.html.twig', [
            'cheeses' => $cheeseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_cheese_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cheese = new Cheese();
        $form = $this->createForm(CheeseType::class, $cheese);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cheese);
            $entityManager->flush();

            return $this->redirectToRoute('admin_cheese_index');
        }

        return $this->render('admin/cheese/new.html.twig', [
            'cheese' => $cheese,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/edit", name="admin_cheese_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cheese $cheese): Response
    {
        $form = $this->createForm(CheeseType::class, $cheese);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_cheese_index');
        }

        return $this->render('admin/cheese/edit.html.twig', [
            'cheese' => $cheese,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_cheese_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cheese $cheese): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cheese->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cheese);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_cheese_index');
    }
}
