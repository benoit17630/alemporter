<?php

namespace App\Controller\Admin;

use App\Entity\Admin\BaseIngredient;
use App\Form\Admin\BaseIngredientType;
use App\Repository\Admin\BaseIngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/base/ingredient")
 */
class BaseIngredientController extends AbstractController
{
    /**
     * @Route("/", name="admin_base_ingredient_index", methods={"GET"})
     */
    public function index(BaseIngredientRepository $baseIngredientRepository): Response
    {
        return $this->render('admin/base_ingredient/index.html.twig', [
            'base_ingredients' => $baseIngredientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_base_ingredient_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $baseIngredient = new BaseIngredient();
        $form = $this->createForm(BaseIngredientType::class, $baseIngredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($baseIngredient);
            $entityManager->flush();

            return $this->redirectToRoute('admin_base_ingredient_index');
        }

        return $this->render('admin/base_ingredient/new.html.twig', [
            'base_ingredient' => $baseIngredient,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="admin_base_ingredient_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BaseIngredient $baseIngredient): Response
    {
        $form = $this->createForm(BaseIngredientType::class, $baseIngredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('admin/base_ingredient/edit.html.twig', [
            'base_ingredient' => $baseIngredient,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_base_ingredient_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BaseIngredient $baseIngredient): Response
    {
        if ($this->isCsrfTokenValid('delete'.$baseIngredient->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($baseIngredient);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_base_ingredient_index');
    }
}
