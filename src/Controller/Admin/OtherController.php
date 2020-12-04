<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Other;
use App\Form\Admin\OtherType;
use App\Repository\Admin\OtherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/other")
 */
class OtherController extends AbstractController
{
    /**
     * @Route("/", name="admin_other_index", methods={"GET"})
     */
    public function index(OtherRepository $otherRepository): Response
    {
        return $this->render('admin/other/index.html.twig', [
            'others' => $otherRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_other_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $other = new Other();
        $form = $this->createForm(OtherType::class, $other);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($other);
            $entityManager->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/other/new.html.twig', [
            'other' => $other,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/edit", name="admin_other_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Other $other): Response
    {
        $form = $this->createForm(OtherType::class, $other);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/other/edit.html.twig', [
            'other' => $other,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_other_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Other $other): Response
    {
        if ($this->isCsrfTokenValid('delete'.$other->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($other);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_home');
    }
}
