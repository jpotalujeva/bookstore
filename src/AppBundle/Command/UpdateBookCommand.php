<?php
namespace AppBundle\Command;

use AppBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateBookCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:update-books')
            ->setDescription('Updates books from API.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $this->getContainer()->getParameter('api_endpoint');
        $em = $this->getContainer()->get('doctrine')->getManager();

        $result = $this->CallAPI('POST', $url);
        $result = (array) json_decode($result);

        foreach ($result as $item) {
            $item = (array) $item;
            $entity = $em->getRepository(Book::class)->getByName($item['name']);
            var_dump($entity);
            if (!$entity) {
               $entity = new Book();
               $entity->setPrice($item['price']);
               $entity->setName($item['name']);
               $entity->setDateCreated(new \DateTime());
               $em->persist($entity);
            } else {
                $entity = $entity[0];
                $price = $entity->getPrice();
                if ($price !== $item['price']) {
                    $entity->setPrice($item['price']);
                }
            }
            $em->flush();
            $output->writeln('Inserted Book id: ' . $entity->getId());
        }
    }

    public function CallAPI($method, $url, $data = false)
    {
        $curl = curl_init();
        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }
}