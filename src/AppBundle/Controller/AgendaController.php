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
            ->getManager()
            ->getRepository('AppBundle:Agenda')
            ->listar()
        ;
        
        return $this->render('agenda/visualizar.html.twig', ['agenda' => $agenda]);
    }
}
