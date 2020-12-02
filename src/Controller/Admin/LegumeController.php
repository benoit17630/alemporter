<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Legume;
use App\Form\Admin\LegumeType;
use App\Repository\Admin\LegumeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/legume")
 */
class LegumeController extends AbstractController
{
    /**
     * @Route("/", name="admin_legume_index", methods={"GET"})
     */
    public function index(LegumeRepository $legumeRepository): Response
    {
        return $this->render('admin/legume/index.html.twig', [
            'legumes' => $legumeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_legume_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $legume = new Legume();
        $form = $this->createForm(LegumeType::class, $legume);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($legume);
            $entityManager->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/legume/new.html.twig', [
            'legume' => $legume,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_legume_show", methods={"GET"})
     */
    public function show(Legume $legume): Response
    {
        return $this->render('admin/legume/show.html.twig', [
            'legume' => $legume,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_legume_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Legume $legume): Response
    {
        $form = $this->createForm(LegumeType::class, $legume);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/legume/edit.html.twig', [
            'legume' => $legume,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_legume_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Legume $legume): Response
    {
        if ($this->isCsrfTokenValid('delete'.$legume->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($legume);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_home');
    }
}
