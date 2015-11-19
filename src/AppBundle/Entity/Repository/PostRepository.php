<?php
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function findByType($type)
    {
        $query = $this->getEntityManager()->createQuery('
                SELECT p FROM AppBundle:Post p
                WHERE p.type = :type
                ORDER BY p.date DESC
        ');
        $query->setParameter('type',$type);
        return $query->getResult();
    }
}