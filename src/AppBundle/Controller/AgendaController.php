<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use AppBundle\Entity\Agenda;
use AppBundle\Form\AgendaType;

class AgendaController extends Controller
{
    /**
     * @Route("/", name="agenda-visualizar")
     * @Method("GET")
     */
    public function visualizarAction()
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
     * @Method({"GET", "POST"})
     * 
     * todo: separar métodos get e post
     */
    public function cadastrarAction(Request $request)
    {
        $agenda = new Agenda;
        
        $form = $this->createForm(AgendaType::class, $agenda);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $agenda = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($agenda);
            $em->flush();
            
            $this->addFlash('notice', 'Sucesso ao cadastrar o agendamento!');
            
            return $this->redirectToRoute('agenda-visualizar');
        }
        
        return $this->render('agenda/cadastrar.html.twig', ['form' => $form->createView()]);
    }
}
