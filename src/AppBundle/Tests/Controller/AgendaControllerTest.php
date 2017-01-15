<?php
namespace AppBundle\Tests\Controller;

use Symfony\ {
    Bundle\FrameworkBundle\Test\WebTestCase,
    Component\DomCrawler\Crawler
};

class AgendaControllerTest extends WebTestCase
{
    private static $client;
    
    public static function setUpBeforeClass()
    {
        self::$client = static::createClient();
    }
    
    private function padrao(Crawler $crawler)
    {
        $this->assertTrue(self::$client->getResponse()->isSuccessful());
        $this->assertSame('EOF', $crawler->filter('#test')->text());
    }
    
    public function testCadastrar()
    {
        $crawler = self::$client->request('GET', '/agenda/cadastrar');
        $this->padrao($crawler);
        
        $this->assertSame('Agenda > Formulário', $crawler->filter('caption')->text());
        $this->assertSame('Salvar', $crawler->filter('button')->text());
        
        $form = $crawler->selectButton('Salvar')->form();
        
        $form['agenda[categoria]'] = 'Categoria';
        $form['agenda[atividade]'] = 'Atividade.';
        
        $form['agenda[data][day]'] = '2';
        $form['agenda[data][month]'] = '1';
        $form['agenda[data][year]'] = '2017';
        
        $form['agenda[hora][hour]'] = '19';
        $form['agenda[hora][minute]'] = '23';
        
        $form['agenda[periodico]'] = '1';
        $form['agenda[historia]'] = '0';
        
        self::$client->submit($form);
        
        $this->assertTrue(self::$client->getResponse()->isRedirect('/'));
    }
    
    public function testVisualizarAposCadastro()
    {
        $crawler = self::$client->request('GET', '/');
        $this->padrao($crawler);
        
        $this->assertSame('Sucesso ao cadastrar o agendamento!', $crawler->filter('caption')->text());
        $this->assertCount(17, $crawler->filter('th[scope=row]'));
        
        $this->assertGreaterThan(0, $crawler->filter('tbody tr')->eq(0)->filter('th')->text());
        $this->assertSame('Categoria', $crawler->filter('tbody tr')->eq(0)->filter('td')->eq(0)->text());
        $this->assertSame('Atividade.', $crawler->filter('tbody tr')->eq(0)->filter('td')->eq(1)->text());
        $this->assertSame('02/01/2017', $crawler->filter('tbody tr')->eq(0)->filter('td')->eq(2)->text());
        $this->assertSame('Mon', $crawler->filter('tbody tr')->eq(0)->filter('td')->eq(3)->text());
        $this->assertSame('19:23', $crawler->filter('tbody tr')->eq(0)->filter('td')->eq(4)->text());
    }
    
    public function testEditar()
    {
        $crawler = self::$client->request('GET', "/");
        
        $link = $crawler->filter('tbody tr')->eq(0)->filter('a')->eq(1)->link();
        $uri = explode('/', $link->getUri());
        $id = array_pop($uri);
        $crawler = self::$client->click($link);
        
        $this->padrao($crawler);
        
        $this->assertSame('Agenda > Formulário', $crawler->filter('caption')->text());
        $this->assertSame('Salvar', $crawler->filter('button')->text());
        
        $form = $crawler->selectButton('Salvar')->form();
        
        $form['agenda[categoria]'] = 'Categoria 2';
        $form['agenda[atividade]'] = 'Atividade 2.';
        
        $form['agenda[data][day]'] = '1';
        $form['agenda[data][month]'] = '1';
        $form['agenda[data][year]'] = '2017';
        
        $form['agenda[hora][hour]'] = '19';
        $form['agenda[hora][minute]'] = '57';
        
        $form['agenda[periodico]'] = '0';
        $form['agenda[historia]'] = '0';
        
        self::$client->submit($form);
        
        $this->assertTrue(self::$client->getResponse()->isRedirect("/agenda/editar/$id"));
    }
    
    public function testVisualizarAposEdicao()
    {
        $crawler = self::$client->request('GET', '/');
        $this->padrao($crawler);
        
        $this->assertSame('Sucesso ao editar o agendamento!', $crawler->filter('caption')->text());
        $this->assertCount(17, $crawler->filter('th[scope=row]'));
        
        $this->assertGreaterThan(0, $crawler->filter('tbody tr')->eq(0)->filter('th')->text());
        $this->assertSame('Categoria 2', $crawler->filter('tbody tr')->eq(0)->filter('td')->eq(0)->text());
        $this->assertSame('Atividade 2.', $crawler->filter('tbody tr')->eq(0)->filter('td')->eq(1)->text());
        $this->assertSame('01/01/2017', $crawler->filter('tbody tr')->eq(0)->filter('td')->eq(2)->text());
        $this->assertSame('Sun', $crawler->filter('tbody tr')->eq(0)->filter('td')->eq(3)->text());
        $this->assertSame('19:57', $crawler->filter('tbody tr')->eq(0)->filter('td')->eq(4)->text());
    }
    
    public function testExcluir()
    {
        $crawler = self::$client->request('GET', "/");
        
        $link = $crawler->filter('tbody tr')->eq(0)->filter('a')->eq(2)->link();
        $crawler = self::$client->click($link);
        
        $this->assertTrue(self::$client->getResponse()->isRedirect("/"));
    }
    
    public function testVisualizarAposExclusao()
    {
        $crawler = self::$client->request('GET', '/');
        $this->padrao($crawler);
        
        $this->assertSame('Sucesso ao excluir o agendamento!', $crawler->filter('caption')->text());
        $this->assertCount(16, $crawler->filter('th[scope=row]'));
        
        $this->assertNotSame('Categoria 2', $crawler->filter('tbody tr')->eq(0)->filter('td')->eq(0)->text());
    }
}
