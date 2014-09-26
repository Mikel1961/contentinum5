<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebPages
 *
 * @ORM\Table(name="web_pages_parameter", indexes={@ORM\Index(name="HOSTIDENTREF", columns={"host_id"}), @ORM\Index(name="PREFERENCESREF", columns={"web_preferences_id"})})
 * @ORM\Entity
 */
class WebPagesParameter extends AbstractEntity
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
     * @ORM\Column(name="host_id", type="string", length=36, nullable=false)
     */
    private $hostId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="scope", type="string", length=255, nullable=false)
     */
    private $scope;

    /**
     * @var string
     *
     * @ORM\Column(name="resource", type="string", length=50, nullable=false)
     */
    private $resource = '';

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title = '';

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=250, nullable=false)
     */
    private $url = '';


    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=false)
     */
    private $params = '';


    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=100, nullable=false)
     */
    private $metaTitle = '';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=180, nullable=false)
     */
    private $metaDescription = '';

    /**
     * @var string
     *
     * @ORM\Column(name="robots", type="string", length=60, nullable=false)
     */
    private $robots = '';

    /**
     * @var string
     *
     * @ORM\Column(name="publish", type="string", length=10, nullable=false)
     */
    private $publish = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=10, nullable=false)
     */
    private $language = '';
    
    /**
     * @var string
     *
     * @ORM\Column(name="language_parent", type="integer", nullable=false)
     */
    private $languageParent = '0';    
    

    /**
     * @var boolean
     *
     * @ORM\Column(name="onlylink", type="boolean", nullable=false)
     */
    private $onlylink = '0';

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
     * @return WebPages
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
     * @return the $hostId
     */
    public function getHostId()
    {
        return $this->hostId;
    }

	/**
     * @param string $hostId
     */
    public function setHostId($hostId)
    {
        $this->hostId = $hostId;
    }

	/**
     * @return the $scope
     */
    public function getScope()
    {
        return $this->scope;
    }

	/**
     * @param string $scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }

	/**
     * @return the $resource
     */
    public function getResource()
    {
        return $this->resource;
    }

	/**
     * @param string $resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

	/**
     * @return the $label
     */
    public function getLabel()
    {
        return $this->label;
    }

	/**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

	/**
     * @return the $title
     */
    public function getTitle()
    {
        return $this->title;
    }

	/**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

	/**
     * @return the $url
     */
    public function getUrl()
    {
        return $this->url;
    }

	/**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

	/**
     * @return the $params
     */
    public function getParams()
    {
        return $this->params;
    }

	/**
     * @param string $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

	/**
     * @return the $metaTitle
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

	/**
     * @param string $metaTitle
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
    }

	/**
     * @return the $metaDescription
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

	/**
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

	/**
     * @return the $robots
     */
    public function getRobots()
    {
        return $this->robots;
    }

	/**
     * @param string $robots
     */
    public function setRobots($robots)
    {
        $this->robots = $robots;
    }

	/**
     * @return the $publish
     */
    public function getPublish()
    {
        return $this->publish;
    }

	/**
     * @param string $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
    }

	/**
     * @return the $language
     */
    public function getLanguage()
    {
        return $this->language;
    }

	/**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

	/**
     * @return the $languageParent
     */
    public function getLanguageParent()
    {
        return $this->languageParent;
    }

	/**
     * @param string $languageParent
     */
    public function setLanguageParent($languageParent)
    {
        $this->languageParent = $languageParent;
    }

	/**
     * @return the $onlylink
     */
    public function getOnlylink()
    {
        return $this->onlylink;
    }

	/**
     * @param boolean $onlylink
     */
    public function setOnlylink($onlylink)
    {
        $this->onlylink = $onlylink;
    }

	/**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebPages
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
     * @return WebPages
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
     * @return WebPages
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
     * @return WebPages
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
