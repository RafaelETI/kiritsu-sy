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
        $this->assertSame(200, self::$client->getResponse()->getStatusCode());
        $this->assertSame('EOF', $crawler->filter('#test')->text());
    }
    
    public function testVisualizar()
    {
        $crawler = self::$client->request('GET', '/');
        $this->padrao($crawler);
        
        $this->assertSame('Agenda > Visualizar', $crawler->filter('caption')->text());
        $this->assertCount(16, $crawler->filter('th[scope=row]'));
    }
    
    public function testCadastrar()
    {
        $crawler = self::$client->request('GET', '/agenda/cadastrar');
        $this->padrao($crawler);
        
        $this->assertSame('Agenda > Cadastrar', $crawler->filter('caption')->text());
        $this->assertSame('Cadastrar', $crawler->filter('button')->text());
    }
}
