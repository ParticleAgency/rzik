<?php

namespace Playlist\PlaylistBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Playlist
 *
 * @ORM\Table(name="playlist")
 * @ORM\Entity(repositoryClass="Playlist\PlaylistBundle\Repository\PlaylistRepository")
 */
class Playlist
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="plname", type="string", length=255, nullable=true)
     */
    private $plname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreatepl", type="datetime", nullable=true)
     */
    private $datecreatedpl;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;


    /**
     * @var string
     *
     * @ORM\Column(name="descriptionpl", type="text", nullable=true)
     */
    private $descriptionpl;

    /**
     * @var integer
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var ArrayCollection
     * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\User", inversedBy="playlist")
     */
    private $user;

    /**
     * @var string
     * @ORM\OneToMany(targetEntity="Audio\AudioBundle\Entity\Audio", mappedBy="playlist", cascade={"persist","remove"})
     * @ORM\JoinColumn(name="id", referencedColumnName="audio_id")
     */
    private $audioid;

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
     * Set plname
     *
     * @param string $plname
     * @return Playlist
     */
    public function setPlname($plname)
    {
        $this->plname = $plname;

        return $this;
    }

    /**
     * Get plname
     *
     * @return string 
     */
    public function getPlname()
    {
        return $this->plname;
    }

    /**
     * Set datecreatedpl
     *
     * @param \DateTime $datecreatedpl
     * @return Playlist
     */
    public function setDatecreatedpl($datecreatedpl)
    {
        $this->datecreatedpl = $datecreatedpl;

        return $this;
    }

    /**
     * Get datecreatedpl
     *
     * @return \DateTime 
     */
    public function getDatecreatedpl()
    {
        return $this->datecreatedpl;
    }

    /**
     * Set descriptionpl
     *
     * @param string $descriptionpl
     * @return Playlist
     */
    public function setDescriptionpl($descriptionpl)
    {
        $this->descriptionpl = $descriptionpl;

        return $this;
    }

    /**
     * Get descriptionpl
     *
     * @return string 
     */
    public function getDescriptionpl()
    {
        return $this->descriptionpl;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Playlist
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set user
     *
     * @param \User\UserBundle\Entity\User $user
     * @return Playlist
     */
    public function setUser(\User\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
 * Get user
 *
 * @return \User\UserBundle\Entity\User
 */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Playlist
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
}
