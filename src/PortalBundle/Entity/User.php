<?php

namespace PortalBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="PortalBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="name", type="string")
	 */
	protected $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="surname", type="string")
	 */
	protected $surname;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="pesel", type="integer")
	 */
	protected $pesel;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="phone", type="integer")
	 */
	protected $phone;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="gender", type="integer")
	 */
	protected $gender;

	/**
	 * @ORM\OneToMany(targetEntity="Visit", mappedBy="patient")
	 */
	private $visits;

	public function __construct() {
		$this->visits = new ArrayCollection();
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

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set pesel
     *
     * @param integer $pesel
     * @return User
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;

        return $this;
    }

    /**
     * Get pesel
     *
     * @return integer 
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * Add visits
     *
     * @param \PortalBundle\Entity\Visit $visits
     * @return User
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
     * Set phone
     *
     * @param integer $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set gender
     *
     * @param integer $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return integer 
     */
    public function getGender()
    {
        return $this->gender;
    }
}
