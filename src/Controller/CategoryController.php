<?php
// src/Controller/ProgramController.php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CategoryRepository;

use App\Repository\ProgramRepository;
class CategoryController extends AbstractController

{

    #[Route('/category/', name: 'category_index')]
    public function index(CategoryRepository $CategoryRepository): Response

    {
        $categories = $CategoryRepository->findAll();
// return render twig
        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }

#[Route('/category/{categoryName}', methods : ['GET'], name : 'app_category_show')]
    public function show(string $categoryName, ProgramRepository $programRepository, CategoryRepository $categoryRepository):Response
    {
        $category = $categoryRepository->findOneBy( ['name' => $categoryName]);
        //var_dump($category);
        //die();

        if(!$category){
        throw $this->createNotFoundException('The category does not exist');
        }

        //echo $category->id;
        //die();

        $programs = $programRepository->findBy(['category' => $category], ['id' =>'DESC'], 3);


        return $this->render('category/show.html.twig', ['category' => $category, 'programs' => $programs]);
    }

}