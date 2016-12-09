<?php

namespace PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Title
 *
 * @ORM\Table(name="title")
 * @ORM\Entity(repositoryClass="PortalBundle\Repository\TitleRepository")
 */
class Title
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

	/**
	 * @ORM\OneToMany(targetEntity="Medical", mappedBy="title")
	 */
	private $medical;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Title
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->medical = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add medical
     *
     * @param \PortalBundle\Entity\Medical $medical
     * @return Title
     */
    public function addMedical(\PortalBundle\Entity\Medical $medical)
    {
        $this->medical[] = $medical;

        return $this;
    }

    /**
     * Remove medical
     *
     * @param \PortalBundle\Entity\Medical $medical
     */
    public function removeMedical(\PortalBundle\Entity\Medical $medical)
    {
        $this->medical->removeElement($medical);
    }

    /**
     * Get medical
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedical()
    {
        return $this->medical;
    }

	/**
	 * Generates the magic method
	 *
	 */
	public function __toString(){
		return $this->getTitle();
	}
}
