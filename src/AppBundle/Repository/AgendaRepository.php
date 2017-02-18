<?php
namespace AppBundle\Repository;

use AppBundle\Entity\Agenda;
use Doctrine\ORM\EntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class AgendaRepository extends EntityRepository
{
    public function readMany()
    {
        return $this->createQueryBuilder('a')
            ->where('a.historia = 0')
            ->orderBy('a.data', 'asc')
            ->addOrderBy('a.hora', 'asc')
        ;
    }
    
    public function paginateReadMany($page = 1)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($this->readMany(), false));
        $paginator->setMaxPerPage(Agenda::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
}
