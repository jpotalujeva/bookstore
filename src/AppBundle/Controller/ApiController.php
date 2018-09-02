<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

class ApiController extends Controller
{
    /**
     * @Route("/api/books", name="getBooksList")
     */
    public function getBooksAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository(Product::class)->findAllNamesAndPrices();

        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
        $json = $serializer->normalize($books, 'json');

        return new JsonResponse($json, 200);
    }

    /**
     * Can be tested with Postman app
     * Example of request string
     * http://domain/api/books/create?
     * params={
     *     "book":{
     *         "name":"Minds of Billy Milligan",
     *         "author":"Daniel Keyes",
     *         "pages":300,
     *         "price":14.10
     *     }
     * }
     *
     * @Route("/api/books/create", name="addBook")
     */
    public function addBooksAction(Request $request)
    {
        $params = $request->query->all();
        $params = (array) json_decode($params['params']);

        if (!$params['book']) {
          throw new \Exception('Book data is not provided!');
        }
        $book = (array) $params['book'];

        $entity = new Product();
        $entity->setName($book['name']);
        $entity->setPrice($book['price']);
        $entity->setDateCreated(new \DateTime());

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new JsonEncoder()));
        $json = $serializer->normalize($entity, 'json');

        return new JsonResponse($json, 201);
    }
}