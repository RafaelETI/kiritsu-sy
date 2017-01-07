<?php
namespace AppBundle\Repository;

use \Doctrine\ORM\EntityRepository;

class AgendaRepository extends EntityRepository
{
    public function listar()
    {
        return $this->createQueryBuilder('a')
            ->where('a.historia = 0')
            ->orderBy('a.data', 'asc')
            ->addOrderBy('a.hora', 'asc')
            ->getQuery()
            ->getResult()
        ;
    }
}
