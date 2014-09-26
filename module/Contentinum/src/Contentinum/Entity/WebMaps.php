<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebMaps
 *
 * @ORM\Table(name="web_maps", indexes={@ORM\Index(name="MAPSNAME", columns={"headline"})})
 * @ORM\Entity
 */
class WebMaps extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="htmlwidgets", type="string", length=50, nullable=false)
     */
    private $htmlwidgets;

    /**
     * @var string
     *
     * @ORM\Column(name="subheadline", type="string", length=250, nullable=false)
     */
    private $subheadline;

    /**
     * @var string
     *
     * @ORM\Column(name="mapkey", type="string", length=250, nullable=false)
     */
    private $mapkey;

    /**
     * @var string
     *
     * @ORM\Column(name="centerlatitude", type="string", length=40, nullable=false)
     */
    private $centerlatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="centerlongitude", type="string", length=40, nullable=false)
     */
    private $centerlongitude;

    /**
     * @var boolean
     *
     * @ORM\Column(name="startzoom", type="boolean", nullable=false)
     */
    private $startzoom;

    /**
     * @var string
     *
     * @ORM\Column(name="script", type="string", length=250, nullable=false)
     */
    private $script;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="update_by", type="integer", nullable=false)
     */
    private $updateBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="register_date", type="datetime", nullable=false)
     */
    private $registerDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="up_date", type="datetime", nullable=false)
     */
    private $upDate;
    
    /**
     * @var \Contentinum\Entity\WebPreferences
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\WebPreferences")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="web_preferences_id", referencedColumnName="id")
     * })
     */
    private $webPreferences;    

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
     * @return Accounts
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
     * @return the $headline
     */
    public function getHeadline()
    {
        return $this->headline;
    }

	/**
     * @param string $headline
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

	/**
     * @return the $htmlwidgets
     */
    public function getHtmlwidgets()
    {
        return $this->htmlwidgets;
    }

	/**
     * @param string $htmlwidgets
     */
    public function setHtmlwidgets($htmlwidgets)
    {
        $this->htmlwidgets = $htmlwidgets;
    }

	/**
     * @return the $subheadline
     */
    public function getSubheadline()
    {
        return $this->subheadline;
    }

	/**
     * @param string $subheadline
     */
    public function setSubheadline($subheadline)
    {
        $this->subheadline = $subheadline;
    }

	/**
     * @return the $mapkey
     */
    public function getMapkey()
    {
        return $this->mapkey;
    }

	/**
     * @param string $mapkey
     */
    public function setMapkey($mapkey)
    {
        $this->mapkey = $mapkey;
    }

	/**
     * @return the $centerlatitude
     */
    public function getCenterlatitude()
    {
        return $this->centerlatitude;
    }

	/**
     * @param string $centerlatitude
     */
    public function setCenterlatitude($centerlatitude)
    {
        $this->centerlatitude = $centerlatitude;
    }

	/**
     * @return the $centerlongitude
     */
    public function getCenterlongitude()
    {
        return $this->centerlongitude;
    }

	/**
     * @param string $centerlongitude
     */
    public function setCenterlongitude($centerlongitude)
    {
        $this->centerlongitude = $centerlongitude;
    }

	/**
     * @return the $startzoom
     */
    public function getStartzoom()
    {
        return $this->startzoom;
    }

	/**
     * @param boolean $startzoom
     */
    public function setStartzoom($startzoom)
    {
        $this->startzoom = $startzoom;
    }

	/**
     * @return the $script
     */
    public function getScript()
    {
        return $this->script;
    }

	/**
     * @param string $script
     */
    public function setScript($script)
    {
        $this->script = $script;
    }

	/**
     * @return the $description
     */
    public function getDescription()
    {
        return $this->description;
    }

	/**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

	/**
     * @return the $createdBy
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

	/**
     * @param number $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

	/**
     * @return the $updateBy
     */
    public function getUpdateBy()
    {
        return $this->updateBy;
    }

	/**
     * @param number $updateBy
     */
    public function setUpdateBy($updateBy)
    {
        $this->updateBy = $updateBy;
    }

	/**
     * @return the $registerDate
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

	/**
     * @param DateTime $registerDate
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;
    }

	/**
     * @return the $upDate
     */
    public function getUpDate()
    {
        return $this->upDate;
    }

	/**
     * @param DateTime $upDate
     */
    public function setUpDate($upDate)
    {
        $this->upDate = $upDate;
    }
    
    /**
     * Set webPreferences
     *
     * @param \Contentinum\Entity\WebPreferences $webPreferences
     * @return WebPages
     */
    public function setWebPreferences(\Contentinum\Entity\WebPreferences $webPreferences = null)
    {
        $this->webPreferences = $webPreferences;
    
        return $this;
    }
    
    /**
     * Get webPreferences
     *
     * @return \Contentinum\Entity\WebPreferences
     */
    public function getWebPreferences()
    {
        return $this->webPreferences;
    }    

}

