<?php

namespace App\Controller;


use App\Repository\Admin\OpeningTimeRepository;
use App\Repository\Admin\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param PizzaRepository $pizzaRepository
     * @param OpeningTimeRepository $timeRepository
     * @return Response
     */
    public function index(PizzaRepository $pizzaRepository,
                          OpeningTimeRepository $timeRepository): Response
    {

        $horaires =$timeRepository->findAll();
        $pizzas = $pizzaRepository->findBy( [], ["price"=>"asc"]);




        return $this->render('home/index.html.twig', [
            'pizzas'=> $pizzas,
            'horaires'=> $horaires,


        ]);
    }
}
