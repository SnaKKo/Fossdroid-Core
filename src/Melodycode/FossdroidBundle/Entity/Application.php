<?php

namespace Melodycode\FossdroidBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 */
class Application
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $summary;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $site;

    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $tracker;

    /**
     * @var string
     */
    private $donate;

    /**
     * @var string
     */
    private $icon;

    /**
     * @var string
     */
    private $primary_color;

    /**
     * @var string
     */
    private $secondary_color;

    /**
     * @var string
     */
    private $tertiary_color;

    /**
     * @var string
     */
    private $apk;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $license;

    /**
     * @var boolean
     */
    private $is_published;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \Melodycode\FossdroidBundle\Entity\Category
     */
    private $category;


    /**
     * Set id
     *
     * @param string $id
     * @return Application
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Application
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Application
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
     * Set summary
     *
     * @param string $summary
     * @return Application
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Application
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
     * Set site
     *
     * @param string $site
     * @return Application
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Application
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set tracker
     *
     * @param string $tracker
     * @return Application
     */
    public function setTracker($tracker)
    {
        $this->tracker = $tracker;

        return $this;
    }

    /**
     * Get tracker
     *
     * @return string 
     */
    public function getTracker()
    {
        return $this->tracker;
    }

    /**
     * Set donate
     *
     * @param string $donate
     * @return Application
     */
    public function setDonate($donate)
    {
        $this->donate = $donate;

        return $this;
    }

    /**
     * Get donate
     *
     * @return string 
     */
    public function getDonate()
    {
        return $this->donate;
    }

    /**
     * Set icon
     *
     * @param string $icon
     * @return Application
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set primary_color
     *
     * @param string $primaryColor
     * @return Application
     */
    public function setPrimaryColor($primaryColor)
    {
        $this->primary_color = $primaryColor;

        return $this;
    }

    /**
     * Get primary_color
     *
     * @return string 
     */
    public function getPrimaryColor()
    {
        return $this->primary_color;
    }

    /**
     * Set secondary_color
     *
     * @param string $secondaryColor
     * @return Application
     */
    public function setSecondaryColor($secondaryColor)
    {
        $this->secondary_color = $secondaryColor;

        return $this;
    }

    /**
     * Get secondary_color
     *
     * @return string 
     */
    public function getSecondaryColor()
    {
        return $this->secondary_color;
    }

    /**
     * Set tertiary_color
     *
     * @param string $tertiaryColor
     * @return Application
     */
    public function setTertiaryColor($tertiaryColor)
    {
        $this->tertiary_color = $tertiaryColor;

        return $this;
    }

    /**
     * Get tertiary_color
     *
     * @return string 
     */
    public function getTertiaryColor()
    {
        return $this->tertiary_color;
    }

    /**
     * Set apk
     *
     * @param string $apk
     * @return Application
     */
    public function setApk($apk)
    {
        $this->apk = $apk;

        return $this;
    }

    /**
     * Get apk
     *
     * @return string 
     */
    public function getApk()
    {
        return $this->apk;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Application
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set license
     *
     * @param string $license
     * @return Application
     */
    public function setLicense($license)
    {
        $this->license = $license;

        return $this;
    }

    /**
     * Get license
     *
     * @return string 
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * Set is_published
     *
     * @param boolean $isPublished
     * @return Application
     */
    public function setIsPublished($isPublished)
    {
        $this->is_published = $isPublished;

        return $this;
    }

    /**
     * Get is_published
     *
     * @return boolean 
     */
    public function getIsPublished()
    {
        return $this->is_published;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Application
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Application
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set category
     *
     * @param \Melodycode\FossdroidBundle\Entity\Category $category
     * @return Application
     */
    public function setCategory(\Melodycode\FossdroidBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Melodycode\FossdroidBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
