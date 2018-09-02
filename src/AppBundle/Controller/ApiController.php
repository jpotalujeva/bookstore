<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{
    /**
     * @Route("/api/books", name="getBooksList")
     */
    public function getBooksAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository(Book::class)->findAllNamesAndPrices();

        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
        $json = $serializer->normalize($books, 'json');

        return new JsonResponse($json, 200);
    }
}