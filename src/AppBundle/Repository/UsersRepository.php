<?php

namespace AppBundle\Repository;

use \Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository
{
    public function getByUsername($username)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT p FROM AppBundle:Users p WHERE p.username = '{$username}'"
            )->getResult();
    }

}
