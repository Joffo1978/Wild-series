<?php
// src/Controller/ProgramController.php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Category;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController

{

    #[Route('/category/', name: 'category_index')]
    public function index(CategoryRepository $CategoryRepository): Response

    {
        $categories = $CategoryRepository->findAll();
// return render twig
        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }
    #[Route('/new', name: 'new')]
    public function new(Request $request, CategoryRepository $categoryRepository): Response

    {
        $category = new Category();
        // Create the form, linked with $category

        $form = $this->createForm(CategoryType::class, $category);
        // Get data from HTTP request

        $form->handleRequest($request);

        // Was the form submitted ?

        if ($form->isSubmitted()) {
            $categoryRepository->save($category, true);
            // Deal with the submitted data

            // For example : persiste & flush the entity

            // And redirect to a route that display the result

        }


        // Render the form
        // return render twig
        return $this->renderForm('category/new.html.twig', [

            'form' => $form,]);
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