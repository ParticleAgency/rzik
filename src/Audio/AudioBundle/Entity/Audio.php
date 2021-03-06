<?php

namespace Audio\AudioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 *
 * @ORM\Table(name="Audio")
 * @ORM\Entity(repositoryClass="Audio\AudioBundle\Repository\AudioRepository")
 */

class Audio
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @var string
    *
    * @ORM\Column(name="title", type="string", length=255, nullable=true)
    */
    private $title;

    /**
    * @var string
    *
    * @ORM\Column(name="description", type="string", length=255, nullable=true)
    */
    private $description;

    /**
    * @var string
    *
    * @ORM\Column(name="artist", type="string", length=255, nullable=true)
    */
    private $artist;

    /**
    * @var string
    *
    * @ORM\Column(name="composer", type="string", length=255, nullable=true)
    */
    private $composer;

    /**
    * @var bool
    *
    * @ORM\Column(name="explicitcontent", type="boolean", nullable=true)
    */
    private $explicitcontent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="transferdate", type="datetime", nullable=true)
     */
    private $transferdate;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @ORM\ManytoOne(targetEntity="Playlist\PlaylistBundle\Entity\Playlist", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $playlist;

    /**
     * @var string
     *
     * @ORM\Column(name="audiofilename", type="string")
     */
    private $audiofilename;

    /**
     * @var string
     *
     * @ORM\Column(name="imagefilename", type="string", nullable=true)
     */
    private $imagefilename;


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
     * @return Audio
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
     * Set description
     *
     * @param string $description
     * @return Audio
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set artist
     *
     * @param string $artist
     * @return Audio
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return string 
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set composer
     *
     * @param string $composer
     * @return Audio
     */
    public function setComposer($composer)
    {
        $this->composer = $composer;

        return $this;
    }

    /**
     * Get composer
     *
     * @return string 
     */
    public function getComposer()
    {
        return $this->composer;
    }

    /**
     * Set explicitcontent
     *
     * @param boolean $explicitcontent
     * @return Audio
     */
    public function setExplicitcontent($explicitcontent)
    {
        $this->explicitcontent = $explicitcontent;

        return $this;
    }

    /**
     * Get explicitcontent
     *
     * @return boolean 
     */
    public function getExplicitcontent()
    {
        return $this->explicitcontent;
    }

    /**
     * Set transferdate
     *
     * @param \DateTime $transferdate
     * @return Audio
     */
    public function setTransferdate($transferdate)
    {
        $this->transferdate = $transferdate;

        return $this;
    }

    /**
     * Get transferdate
     *
     * @return \DateTime 
     */
    public function getTransferdate()
    {
        return $this->transferdate;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Audio
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }
    

    /**
     * Set audiofilename
     *
     * @param string $audiofilename
     * @return Audio
     */
    public function setAudiofilename($audiofilename)
    {
        $this->audiofilename = $audiofilename;

        return $this;
    }

    /**
     * Get audiofilename
     *
     * @return string 
     */
    public function getAudiofilename()
    {
        return $this->audiofilename;
    }

    /**
     * Set imagefilename
     *
     * @param string $imagefilename
     * @return Audio
     */
    public function setImagefilename($imagefilename)
    {
        $this->imagefilename = $imagefilename;

        return $this;
    }

    /**
     * Get imagefilename
     *
     * @return string 
     */
    public function getImagefilename()
    {
        return $this->imagefilename;
    }

    /**
     * Set playlist
     *
     * @param \Playlist\PlaylistBundle\Entity\Playlist $playlist
     *
     * @return Audio
     */
    public function setPlaylist( $playlist = null)
    {
        $this->playlist = $playlist;

        return $this;
    }

    /**
     * Get playlist
     *
     * @return \Playlist\PlaylistBundle\Entity\Playlist
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }
}
