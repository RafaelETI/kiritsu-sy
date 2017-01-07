<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chuva
 *
 * @ORM\Table(name="chuva", uniqueConstraints={@ORM\UniqueConstraint(name="data", columns={"data"})})
 * @ORM\Entity
 */
class Chuva
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;

    /**
     * @var boolean
     *
     * @ORM\Column(name="intensidade", type="boolean", nullable=false)
     */
    private $intensidade;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Chuva
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
     * Set intensidade
     *
     * @param boolean $intensidade
     *
     * @return Chuva
     */
    public function setIntensidade($intensidade)
    {
        $this->intensidade = $intensidade;

        return $this;
    }

    /**
     * Get intensidade
     *
     * @return boolean
     */
    public function getIntensidade()
    {
        return $this->intensidade;
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
