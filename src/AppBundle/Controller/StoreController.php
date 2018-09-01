<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use AppBundle\Form\BookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class StoreController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function indexAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->container->get('doctrine')->getEntityManager();
        $books =  $em->getRepository(Book::class)->findAll();
        return $this->render('store/index.html.twig', [
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
            $em = $this->getDoctrine()->getManager();
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

        if ($form->isSubmitted() && $form->isValid()) {
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
}
