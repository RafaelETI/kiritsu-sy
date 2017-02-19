<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\Agenda;
use AppBundle\Form\AgendaType;

class AgendaController extends Controller
{
    /**
     * @Route("/", defaults={"page": "1"}, name="agenda-visualizar")
     * @Route("/p/{page}", requirements={"page": "[1-9]\d*"}, name="agenda-visualizar-paginada")
     * 
     * @Method("GET")
     */
    public function visualizarAction($page)
    {
        $agenda = $this->getDoctrine()->getRepository('AppBundle:Agenda')->paginateReadMany($page);
        
        return $this->render('agenda/visualizar.html.twig', ['agenda' => $agenda]);
    }
    
    /**
     * @Route("/agenda/cadastrar", name="agenda-cadastrar")
     * @Method({"GET", "POST"})
     */
    public function cadastrarAction(Request $request)
    {
        $agenda = new Agenda;
        $agenda->setData(new \DateTime);
        $agenda->setHistoria(0);
        
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
        
        return $this->render('agenda/form.html.twig', ['form' => $form->createView()]);
    }
    
    /**
     * @Route("/agenda/editar/{id}", name="agenda-editar")
     * @Method({"GET", "POST"})
     */
    public function editarAction(Request $request, Agenda $agenda)
    {
        !$agenda->getHistoria()? $agenda->setHistoria(0): null;
        
        $form = $this->createForm(AgendaType::class, $agenda);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $agenda = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($agenda);
            $em->flush();
            
            $this->addFlash('notice', 'Sucesso ao editar o agendamento!');
            
            return $this->redirectToRoute('agenda-editar', ['id' => $agenda->getId()]);
        }
        
        return $this->render('agenda/form.html.twig', ['form' => $form->createView()]);
    }
    
    /**
     * @Route("/agenda/excluir/{id}", name="agenda-excluir")
     * @Method("GET")
     */
    public function excluirAction(Agenda $agenda)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($agenda);
        $em->flush();
        
        $this->addFlash('notice', 'Sucesso ao excluir o agendamento!');
        
        return $this->redirectToRoute('agenda-visualizar');
    }
}
