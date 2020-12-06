<?php

namespace App\Controller\Admin;

use App\Entity\Admin\LastIngredient;
use App\Form\Admin\LastIngredientType;
use App\Repository\Admin\LastIngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/last/ingredient")
 */
class LastIngredientController extends AbstractController
{
    /**
     * @Route("/", name="admin_last_ingredient_index", methods={"GET"})
     */
    public function index(LastIngredientRepository $lastIngredientRepository): Response
    {
        return $this->render('admin/last_ingredient/index.html.twig', [
            'last_ingredients' => $lastIngredientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_last_ingredient_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lastIngredient = new LastIngredient();
        $form = $this->createForm(LastIngredientType::class, $lastIngredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lastIngredient);
            $entityManager->flush();

            return $this->redirectToRoute('admin_last_ingredient_index');
        }

        return $this->render('admin/last_ingredient/new.html.twig', [
            'last_ingredient' => $lastIngredient,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/edit", name="admin_last_ingredient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, LastIngredient $lastIngredient): Response
    {
        $form = $this->createForm(LastIngredientType::class, $lastIngredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_last_ingredient_index');
        }

        return $this->render('admin/last_ingredient/edit.html.twig', [
            'last_ingredient' => $lastIngredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_last_ingredient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, LastIngredient $lastIngredient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lastIngredient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lastIngredient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_last_ingredient_index');
    }
}
