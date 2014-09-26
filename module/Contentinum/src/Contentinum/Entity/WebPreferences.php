<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebPreferences
 *
 * @ORM\Table(name="web_preferences", uniqueConstraints={@ORM\UniqueConstraint(name="HOSTIDENT", columns={"host_id"}), @ORM\UniqueConstraint(name="HOSTNAME", columns={"host"})})
 * @ORM\Entity
 */
class WebPreferences extends AbstractEntity
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
    private $hostId;

    /**
     * @var string
     *
     * @ORM\Column(name="host", type="string", length=250, nullable=false)
     */
    private $host;
    

    /**
     * @var string
     *
     * @ORM\Column(name="standard_domain", type="string", length=3, nullable=false)
     */
    private $standardDomain = 'no';


    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=140, nullable=false)
     */
    private $title = '';

    
    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", nullable=false)
     */    
    private $metaDescription = '';
     

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=250, nullable=false)
     */
    private $author = '';

    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=40, nullable=false)
     */
    private $locale = '';

    /**
     * @var string
     *
     * @ORM\Column(name="googleaccount", type="string", length=200, nullable=false)
     */
    private $googleaccount = '';

    /**
     * @var string
     *
     * @ORM\Column(name="siteverification", type="string", length=200, nullable=false)
     */
    private $siteverification = '';
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="head_script", type="text", nullable=false)
     */
    private $headScript = '';

    /**
     * @var string
     *
     * @ORM\Column(name="body_footer_script", type="text", nullable=false)
     */
    private $bodyFooterScript = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="update_by", type="integer", nullable=false)
     */
    private $updateBy = '0';

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
     * @return WebPreferences
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
     * @return the $host
     */
    public function getHost()
    {
        return $this->host;
    }

	/**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

	/**
     * @return the $standardDomain
     */
    public function getStandardDomain()
    {
        return $this->standardDomain;
    }

	/**
     * @param string $standardDomain
     */
    public function setStandardDomain($standardDomain)
    {
        $this->standardDomain = $standardDomain;
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
     * @return the $author
     */
    public function getAuthor()
    {
        return $this->author;
    }

	/**
     * @param string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

	/**
     * @return the $locale
     */
    public function getLocale()
    {
        return $this->locale;
    }

	/**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

	/**
     * @return the $googleaccount
     */
    public function getGoogleaccount()
    {
        return $this->googleaccount;
    }

	/**
     * @param string $googleaccount
     */
    public function setGoogleaccount($googleaccount)
    {
        $this->googleaccount = $googleaccount;
    }

	/**
     * @return the $siteverification
     */
    public function getSiteverification()
    {
        return $this->siteverification;
    }

	/**
     * @param string $siteverification
     */
    public function setSiteverification($siteverification)
    {
        $this->siteverification = $siteverification;
    }

	/**
     * @return the $headScript
     */
    public function getHeadScript()
    {
        return $this->headScript;
    }

	/**
     * @param string $headScript
     */
    public function setHeadScript($headScript)
    {
        $this->headScript = $headScript;
    }

	/**
     * @return the $bodyFooterScript
     */
    public function getBodyFooterScript()
    {
        return $this->bodyFooterScript;
    }

	/**
     * @param string $bodyFooterScript
     */
    public function setBodyFooterScript($bodyFooterScript)
    {
        $this->bodyFooterScript = $bodyFooterScript;
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


}
