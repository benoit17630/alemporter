<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Fish;
use App\Form\Admin\FishType;
use App\Repository\Admin\FishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/fish")
 */
class FishController extends AbstractController
{
    /**
     * @Route("/", name="admin_fish_index", methods={"GET"})
     */
    public function index(FishRepository $fishRepository): Response
    {
        return $this->render('admin/fish/index.html.twig', [
            'fish' => $fishRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_fish_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fish = new Fish();
        $form = $this->createForm(FishType::class, $fish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fish);
            $entityManager->flush();

            return $this->redirectToRoute('admin_fish_index');
        }

        return $this->render('admin/fish/new.html.twig', [
            'fish' => $fish,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/edit", name="admin_fish_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fish $fish): Response
    {
        $form = $this->createForm(FishType::class, $fish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_fish_index');
        }

        return $this->render('admin/fish/edit.html.twig', [
            'fish' => $fish,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_fish_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Fish $fish): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fish->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fish);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_fish_index');
    }
}
