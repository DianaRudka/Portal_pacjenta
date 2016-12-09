<?php

namespace PortalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visit
 *
 * @ORM\Table(name="visit")
 * @ORM\Entity(repositoryClass="PortalBundle\Repository\VisitRepository")
 */
class Visit
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
     * @var DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="visits")
	 */
	private $patient;

	/**
	 * @ORM\ManyToOne(targetEntity="Medical", inversedBy="visits")
	 */
	private $medical;

	/**
	 * @ORM\ManyToOne(targetEntity="Specialization", inversedBy="visits")
	 */
	private $specialization;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Visit
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set patient
     *
     * @param \PortalBundle\Entity\User $patient
     * @return Visit
     */
    public function setPatient(\PortalBundle\Entity\User $patient = null)
    {
        $this->patient = $patient;

        return $this;
    }

    /**
     * Get patient
     *
     * @return \PortalBundle\Entity\User 
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * Set medical
     *
     * @param \PortalBundle\Entity\Medical $medical
     * @return Visit
     */
    public function setMedical(\PortalBundle\Entity\Medical $medical = null)
    {
        $this->medical = $medical;

        return $this;
    }

    /**
     * Get medical
     *
     * @return \PortalBundle\Entity\Medical 
     */
    public function getMedical()
    {
        return $this->medical;
    }

    /**
     * Set specialization
     *
     * @param \PortalBundle\Entity\Specialization $specialization
     * @return Visit
     */
    public function setSpecialization(\PortalBundle\Entity\Specialization $specialization = null)
    {
        $this->specialization = $specialization;

        return $this;
    }

    /**
     * Get specialization
     *
     * @return \PortalBundle\Entity\Specialization 
     */
    public function getSpecialization()
    {
        return $this->specialization;
    }
}
