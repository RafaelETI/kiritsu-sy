<?php
namespace AppBundle\Twig;

use Miti\Tempo;

class AppExtension extends \Twig_Extension
{
    private $tempo;
    
    public function __construct(Tempo $tempo)
    {
        $this->tempo = $tempo;
    }
    
    public function diaDaSemana($date)
    {
        return $this->tempo->diaDaSemana($date);
    }
    
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('diaDaSemana', [$this, 'diaDaSemana']),
        ];
    }
}
