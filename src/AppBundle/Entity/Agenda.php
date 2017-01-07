<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Agenda
 *
 * @ORM\Table(name="agenda")
 * @ORM\Entity
 */
class Agenda
{
    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=30, nullable=false)
     */
    private $categoria;

    /**
     * @var string
     *
     * @ORM\Column(name="atividade", type="string", length=1100, nullable=true)
     */
    private $atividade;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="time", nullable=true)
     */
    private $hora;

    /**
     * @var boolean
     *
     * @ORM\Column(name="periodico", type="boolean", nullable=false)
     */
    private $periodico;

    /**
     * @var boolean
     *
     * @ORM\Column(name="historia", type="boolean", nullable=false)
     */
    private $historia;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set categoria
     *
     * @param string $categoria
     *
     * @return Agenda
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set atividade
     *
     * @param string $atividade
     *
     * @return Agenda
     */
    public function setAtividade($atividade)
    {
        $this->atividade = $atividade;

        return $this;
    }

    /**
     * Get atividade
     *
     * @return string
     */
    public function getAtividade()
    {
        return $this->atividade;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Agenda
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set hora
     *
     * @param \DateTime $hora
     *
     * @return Agenda
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set periodico
     *
     * @param boolean $periodico
     *
     * @return Agenda
     */
    public function setPeriodico($periodico)
    {
        $this->periodico = $periodico;

        return $this;
    }

    /**
     * Get periodico
     *
     * @return boolean
     */
    public function getPeriodico()
    {
        return $this->periodico;
    }

    /**
     * Set historia
     *
     * @param boolean $historia
     *
     * @return Agenda
     */
    public function setHistoria($historia)
    {
        $this->historia = $historia;

        return $this;
    }

    /**
     * Get historia
     *
     * @return boolean
     */
    public function getHistoria()
    {
        return $this->historia;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
