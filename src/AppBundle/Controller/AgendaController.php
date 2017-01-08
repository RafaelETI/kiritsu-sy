<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Agenda;
use AppBundle\Form\AgendaType;

class AgendaController extends Controller
{
    /**
     * @Route("/", name="agenda-get-visualizar")
     * @Method("GET")
     */
    public function getVisualizarAction()
    {
        $agenda = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Agenda')
            ->listar()
        ;
        
        return $this->render('agenda/visualizar.html.twig', ['agenda' => $agenda]);
    }
    
    /**
     * @Route("/agenda/cadastrar", name="agenda-cadastrar")
     */
    public function cadastrarAction()
    {
        $agenda = new Agenda;
        
        $agenda->setCategoria('Categoria');
        $agenda->setAtividade('Atividade.');
        $agenda->setData(new \DateTime('now'));
        $agenda->setHora(new \DateTime('now'));
        $agenda->setPeriodico(0);
        $agenda->setHistoria(0);
        
        $form = $this->createForm(AgendaType::class, $agenda);
        
        return $this->render('agenda/cadastrar.html.twig', ['form' => $form->createView()]);
    }
}
