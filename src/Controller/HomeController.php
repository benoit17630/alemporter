<?php

namespace App\Controller;


use App\Repository\Admin\CheeseRepository;
use App\Repository\Admin\FishRepository;
use App\Repository\Admin\LegumeRepository;
use App\Repository\Admin\MeatRepository;
use App\Repository\Admin\OpeningTimeRepository;
use App\Repository\Admin\OtherRepository;
use App\Repository\Admin\PizzaRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param PizzaRepository $pizzaRepository
     * @param OpeningTimeRepository $timeRepository
     * @param Request $request
     * @param MeatRepository $meatRepository
     * @param LegumeRepository $legumeRepository
     * @param CheeseRepository $cheeseRepository
     * @param FishRepository $fishRepository
     * @param OtherRepository $otherRepository
     * @return Response
     */
    public function index(PizzaRepository $pizzaRepository,
                          OpeningTimeRepository $timeRepository,
                          Request $request,
                          MeatRepository $meatRepository,
                          LegumeRepository $legumeRepository,
                          CheeseRepository $cheeseRepository,
                          FishRepository $fishRepository,
                          OtherRepository $otherRepository): Response
    {

        $horaires =$timeRepository->findAll();
        $pizzas = $pizzaRepository->findBy( [], ["price"=>"asc"]);

        $search = $request->query->get('search');
        //si $search n est pas vide je peut faire ma recherche sinon je rend ma vue
        if ( !empty($search) ) {

            // j'appelle ma requête personalisée de repository
            $meats = $meatRepository->searchByMeat($search);
            $legumes = $legumeRepository->searchByLegume($search);
            $cheeses = $cheeseRepository->searchByCheese($search);
            $fishs = $fishRepository->searchByFish($search);
            $others = $otherRepository->searchByOther($search);

            return $this->render("home/search.html.twig",[
                    'meats' => $meats,
                    'legumes' => $legumes,
                    'cheeses' => $cheeses,
                    'fishs' => $fishs,
                    'others' => $others,

                ]
            );
        }


        return $this->render('home/index.html.twig', [
            'pizzas'=> $pizzas,
            'horaires'=> $horaires,

        ]);

    }


}
