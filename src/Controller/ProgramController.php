<?php

// src/Controller/ProgramController.php

namespace App\Controller;


use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;




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
    #[Route('program/new', name: 'program_new')]
    public function new(Request $request, ProgramRepository $programRepository): Response

    {
        $program= new Program();
        // Create the form, linked with $category

        $form = $this->createForm(ProgramType::class, $program);
        // Get data from HTTP request

        $form->handleRequest($request);

        // Was the form submitted ?

        if ($form->isSubmitted()) {
            $programRepository->save($program, true);
            // Deal with the submitted data

            // For example : persiste & flush the entity

            // And redirect to a route that display the result

        }


        // Render the form
        // return render twig
        return $this->renderForm('program/new.html.twig',[

            'form' => $form,]);
    }
    #[Route('/program/show/{id}', name: 'program_show')]

    public function show(Program $program): Response

    {
        return $this->render('program/show.html.twig', [

            ['program'=>$program]

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