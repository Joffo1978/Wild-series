<?php

// src/Controller/ProgramController.php

namespace App\Controller;


use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ProgramRepository;

Class ProgramController extends AbstractController

{

    #[Route('/program/', name: 'program_')]

    public function index(ProgramRepository $programRepository): Response

    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig',

            ['programs' => $programs]

        );

    }

    #[Route('/program/show/{id<^[0-9]+$>}', name: 'show')]

    public function show(int $id, ProgramRepository $programRepository): Response

    {
        $program = $programRepository->findOneBy(['id' => $id]);
        // same as $program = $programRepository->find($id);




        return $this->render('program/show.html.twig', [

            'program' => $program,

        ]);
    }
    #[Route('/program/show/{programId}/seasons/{seasonId}', name: 'program_season_show')]

    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository,): Response

    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);

        // same as $program = $programRepository->find($id);




        return $this->render('program/season_show.html.twig', [

            'program' => $program, 'season' => $season

        ]);
    }
}