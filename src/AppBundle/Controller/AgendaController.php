<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AgendaController extends Controller
{
    /**
     * @Route("/", name="agenda-visualizar")
     */
    public function visualizarAction(Request $request)
    {
        $agenda = $this->getDoctrine()
            ->getRepository('AppBundle:Agenda')
            ->createQueryBuilder('a')
            ->where('a.historia = 0')
            ->orderBy('a.data', 'asc')
            ->addOrderBy('a.hora', 'asc')
            ->getQuery()
            ->getResult()
        ;
        
        return $this->render('agenda/visualizar.html.twig', ['agenda' => $agenda]);
    }
}
