<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategoryRepository;
use App\Entity\Category;
// use App\Form\CategoryType;


class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index(CategoryController $categoryRepository)
    {
        return $this->list_all($categoryRepository);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list_all(CategoryController $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/create", name="category_create")
     */
    public function create(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
            // TODO: check if the following line works
            return $this->redirectToRoute('category/show', $category);
        }

        return $this->render('category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
    /**
     * @Route("/category/title/{byTitle}", name="category_title")
     * @ParamConverter("category", options={"mapping": {"byTitle": "title"}})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function title(Category $category)
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }
}
