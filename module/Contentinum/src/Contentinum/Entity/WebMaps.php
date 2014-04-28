<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebMaps
 *
 * @ORM\Table(name="web_maps")
 * @ORM\Entity
 */
class WebMaps extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="headline", type="string", length=250, nullable=false)
     */
    private $headline;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=2, nullable=false)
     */
    private $tags = 'h2';

    /**
     * @var string
     *
     * @ORM\Column(name="subheadline", type="string", length=250, nullable=false)
     */
    private $subheadline = '';

    /**
     * @var string
     *
     * @ORM\Column(name="mapkey", type="string", length=250, nullable=false)
     */
    private $mapkey = '';

    /**
     * @var string
     *
     * @ORM\Column(name="centerlatitude", type="string", length=40, nullable=false)
     */
    private $centerlatitude = '51.165691';

    /**
     * @var string
     *
     * @ORM\Column(name="centerlongitude", type="string", length=40, nullable=false)
     */
    private $centerlongitude = '10.451526';

    /**
     * @var boolean
     *
     * @ORM\Column(name="startzoom", type="boolean", nullable=false)
     */
    private $startzoom = '5';

    /**
     * @var string
     *
     * @ORM\Column(name="script", type="string", length=250, nullable=false)
     */
    private $script = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="update_by", type="integer", nullable=false)
     */
    private $updateBy = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="register_date", type="datetime", nullable=false)
     */
    private $registerDate = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="up_date", type="datetime", nullable=false)
     */
    private $upDate = '0000-00-00 00:00:00';

    /**
     * Construct
     * @param array $options
     */
    public function __construct (array $options = null)
    {
    	if (is_array($options)) {
    		$this->setOptions($options);
    	}
    }
    
    /** (non-PHPdoc)
     * @see \ContentinumComponents\Entity\AbstractEntity::getEntityName()
     */
    public function getEntityName()
    {
    	return get_class($this);
    }
    
    /** (non-PHPdoc)
     * @see \ContentinumComponents\Entity\AbstractEntity::getPrimaryKey()
     */
    public function getPrimaryKey()
    {
    	return 'id';
    }
    
    /** (non-PHPdoc)
     * @see \ContentinumComponents\Entity\AbstractEntity::getPrimaryValue()
     */
    public function getPrimaryValue()
    {
    	return $this->id;
    }
    
    /** (non-PHPdoc)
     * @see \ContentinumComponents\Entity\AbstractEntity::getProperties()
     */
    public function getProperties()
    {
    	return get_object_vars($this);
    }
    
    /**
     * @param number $id
     *
     * @return WebMaps
     */
    public function setId($id)
    {
    	$this->id = $id;
    
    	return $this;
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
     * Set headline
     *
     * @param string $headline
     * @return WebMaps
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return WebMaps
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set subheadline
     *
     * @param string $subheadline
     * @return WebMaps
     */
    public function setSubheadline($subheadline)
    {
        $this->subheadline = $subheadline;

        return $this;
    }

    /**
     * Get subheadline
     *
     * @return string 
     */
    public function getSubheadline()
    {
        return $this->subheadline;
    }

    /**
     * Set mapkey
     *
     * @param string $mapkey
     * @return WebMaps
     */
    public function setMapkey($mapkey)
    {
        $this->mapkey = $mapkey;

        return $this;
    }

    /**
     * Get mapkey
     *
     * @return string 
     */
    public function getMapkey()
    {
        return $this->mapkey;
    }

    /**
     * Set centerlatitude
     *
     * @param string $centerlatitude
     * @return WebMaps
     */
    public function setCenterlatitude($centerlatitude)
    {
        $this->centerlatitude = $centerlatitude;

        return $this;
    }

    /**
     * Get centerlatitude
     *
     * @return string 
     */
    public function getCenterlatitude()
    {
        return $this->centerlatitude;
    }

    /**
     * Set centerlongitude
     *
     * @param string $centerlongitude
     * @return WebMaps
     */
    public function setCenterlongitude($centerlongitude)
    {
        $this->centerlongitude = $centerlongitude;

        return $this;
    }

    /**
     * Get centerlongitude
     *
     * @return string 
     */
    public function getCenterlongitude()
    {
        return $this->centerlongitude;
    }

    /**
     * Set startzoom
     *
     * @param boolean $startzoom
     * @return WebMaps
     */
    public function setStartzoom($startzoom)
    {
        $this->startzoom = $startzoom;

        return $this;
    }

    /**
     * Get startzoom
     *
     * @return boolean 
     */
    public function getStartzoom()
    {
        return $this->startzoom;
    }

    /**
     * Set script
     *
     * @param string $script
     * @return WebMaps
     */
    public function setScript($script)
    {
        $this->script = $script;

        return $this;
    }

    /**
     * Get script
     *
     * @return string 
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return WebMaps
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebMaps
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updateBy
     *
     * @param integer $updateBy
     * @return WebMaps
     */
    public function setUpdateBy($updateBy)
    {
        $this->updateBy = $updateBy;

        return $this;
    }

    /**
     * Get updateBy
     *
     * @return integer 
     */
    public function getUpdateBy()
    {
        return $this->updateBy;
    }

    /**
     * Set registerDate
     *
     * @param \DateTime $registerDate
     * @return WebMaps
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    /**
     * Get registerDate
     *
     * @return \DateTime 
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    /**
     * Set upDate
     *
     * @param \DateTime $upDate
     * @return WebMaps
     */
    public function setUpDate($upDate)
    {
        $this->upDate = $upDate;

        return $this;
    }

    /**
     * Get upDate
     *
     * @return \DateTime 
     */
    public function getUpDate()
    {
        return $this->upDate;
    }
}
