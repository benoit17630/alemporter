<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Pizza;
use App\Form\Admin\PizzaType;
use App\Repository\Admin\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/pizza")
 */
class PizzaController extends AbstractController
{
    /**
     * @Route("/", name="admin_pizza_index", methods={"GET"})
     * @param PizzaRepository $pizzaRepository
     * @return Response
     */
    public function index(PizzaRepository $pizzaRepository): Response
    {
        return $this->render('admin/pizza/index.html.twig', [
            'pizzas' => $pizzaRepository->findBy([],["basepizza"=>'ASC',"price"=>'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="admin_pizza_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $pizza = new Pizza();
        $form = $this->createForm(PizzaType::class, $pizza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pizza);
            $entityManager->flush();

            return $this->redirectToRoute('admin_pizza_index');
        }

        return $this->render('admin/pizza/new.html.twig', [
            'pizza' => $pizza,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/edit", name="admin_pizza_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Pizza $pizza
     * @return Response
     */
    public function edit(Request $request, Pizza $pizza): Response
    {
        $form = $this->createForm(PizzaType::class, $pizza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_pizza_index');
        }

        return $this->render('admin/pizza/edit.html.twig', [
            'pizza' => $pizza,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_pizza_delete", methods={"DELETE"})
     * @param Request $request
     * @param Pizza $pizza
     * @return Response
     */
    public function delete(Request $request, Pizza $pizza): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pizza->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pizza);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_pizza_index');
    }

    /**
     * @Route ("/tomate/index", name="admin_tomate_index")
     * @param PizzaRepository $pizzaRepository
     * @return Response
     */
    public function pizzaTomate(PizzaRepository $pizzaRepository){
        $tomates= $pizzaRepository->findBy(["basepizza"=>1], ["price"=>'ASC']);

        return $this->render('admin/pizza/tomate_index.html.twig',[
            'tomates'=> $tomates
        ]);
    }

    /**
     * @Route ("/creme/index", name="admin_creme_index")
     * @param PizzaRepository $pizzaRepository
     * @return Response
     */
    public function pizzaCreme(PizzaRepository $pizzaRepository){
        $cremes= $pizzaRepository->findBy(["basepizza"=>2], ["price"=>'ASC']);

        return $this->render('admin/pizza/créme_index.html.twig',[
            'cremes'=> $cremes
        ]);
    }

    /**
     * @Route ("/special/index", name="admin_special_index")
     * @param PizzaRepository $pizzaRepository
     * @return Response
     */
    public function pizzaSpecial(PizzaRepository $pizzaRepository){
        $special = $pizzaRepository->findBy(["basepizza"=>3], ["price"=>'ASC']);

        return $this->render('admin/pizza/special_index.html.twig',[
            'specials'=> $special
        ]);
    }
}
