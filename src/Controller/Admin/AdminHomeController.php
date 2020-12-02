<?php

namespace App\Controller\Admin;

use App\Repository\Admin\BaseIngredientRepository;
use App\Repository\Admin\OpeningTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index(OpeningTimeRepository $timeRepository,
                          BaseIngredientRepository $baseIngredientRepository): Response
    {
        $horaires = $timeRepository->findAll();

        $baseIngredients = $baseIngredientRepository->findAll();

        return $this->render('admin/admin_home/index.html.twig', [
            'horaires' => $horaires,
            'baseIngrendients' => $baseIngredients

        ]);
    }
}
