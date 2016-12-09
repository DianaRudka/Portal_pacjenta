<?php

namespace PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Specialization
 *
 * @ORM\Table(name="specialization")
 * @ORM\Entity(repositoryClass="PortalBundle\Repository\SpecializationRepository")
 */
class Specialization
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

	/**
	 * @ORM\OneToMany(targetEntity="Medical", mappedBy="specialization")
	 */
	private $medical;

	/**
	 * @ORM\OneToMany(targetEntity="Visit", mappedBy="specialization")
	 */
	private $visits;

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
     * Set type
     *
     * @param string $type
     * @return Specialization
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
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
     * @return Specialization
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
     * Add visits
     *
     * @param \PortalBundle\Entity\Visit $visits
     * @return Specialization
     */
    public function addVisit(\PortalBundle\Entity\Visit $visits)
    {
        $this->visits[] = $visits;

        return $this;
    }

    /**
     * Remove visits
     *
     * @param \PortalBundle\Entity\Visit $visits
     */
    public function removeVisit(\PortalBundle\Entity\Visit $visits)
    {
        $this->visits->removeElement($visits);
    }

    /**
     * Get visits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVisits()
    {
        return $this->visits;
    }

	/**
	 * Generates the magic method
	 *
	 */
	public function __toString(){
		return $this->getType();
		// return $this->type;
		// return $this->id;
	}
}
