<?php
namespace AppBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AgendaRepositoryTest extends KernelTestCase
{
    private $em;
    
    protected function setUp()
    {
        self::bootKernel();
        
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }
    
    public function testListar()
    {
        $agenda = $this->em->getRepository('AppBundle:Agenda');
        $a = $agenda->listar();
        
        $this->assertCount(16, $a);
        
        $this->assertSame(847, $a[0]->getId());
        $this->assertSame('Diverso', $a[0]->getCategoria());
        $this->assertSame('31/12/2016', $a[0]->getData()->format('d/m/Y'));
        $this->assertNull($a[0]->getHora());
        $this->assertTrue($a[0]->getPeriodico());
        $this->assertFalse($a[0]->getHistoria());
    }
    
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }
}
