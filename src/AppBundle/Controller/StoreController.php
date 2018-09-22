<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Form\BookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StoreController extends Controller
{
    const LIMIT = 50;
    /**
     * @Route("/home/{currentPage}",  defaults={"currentPage"=1},name="home")
     */
    public function indexAction(Request $request, $currentPage = 1)
    {
        $user = $this->getUser();
        if ($currentPage == null)
        {
            $currentPage = 1;
        }
        $em = $this->getDoctrine()->getManager();
        $books =  $em->getRepository(Book::class)->findAllCustom($currentPage, 50);
        return $this->render('store/index.html.twig', [
            'maxPages' => ceil(count($books)/50),
            'thisPage' => $currentPage['currentPage'],
            'books' => $books,
            'user' => $user
        ]);
    }

    /**
     * @Route("/addbook", name="add_book")
     */
    public function addAction(Request $request)
    {
        return $this->render('store/add_book.html.twig', []);
    }

    /**
     * @Route("/insert", name="insert")
     */
    public function insertAction(Request $request)
    {
        $entity = new Book();
        $form = $this->createForm(BookType::class,$entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name = $entity->getName();
            $em = $this->getDoctrine()->getManager();
            if ($em->getRepository(Book::class)->getByName($name)) {
                return $this->render('exception.html.twig', ['error' =>'Book with this name already exists!']);
            }
            $entity->setDateCreated(new \DateTime());
            $em->persist($entity);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('store/insert.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function editAction($id, Request $request)
    {
        $manager = $this->getDoctrine()->getManager();
        $entity = $manager->getRepository(Book::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Book is not found!');
        }

        $form = $this->createForm(BookType::class, $entity);
        $form->handleRequest($request);


        if ($form->isSubmitted () && $form->isValid()) {
            $manager->merge($entity);
            $manager->flush();

            $this->addFlash('success', 'Data saved');

            return $this->redirect($this->generateUrl('home'));
        }
        return $this->render('store/edit.html.twig', [
            'form' => $form->createView(),
            'entity' => $entity
        ]);
    }

    public function showAllAction($currentPage)
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository(Book::class)->findAllCustom($currentPage, self::LIMIT);

        $maxPages = ceil($books->count()/self::LIMIT);
        $thisPage = $currentPage;

        if (!$books) {
            throw $this->createNotFoundException('Unable to find Books.');
        }
        return $this->render('store/index.html.twig', [
            'books' => $books,
            'maxPages'=>$maxPages,
            'thisPage' => $thisPage,
        ] );
    }
}
