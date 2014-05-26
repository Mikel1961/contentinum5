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
     * @ORM\Column(name="charset", type="string", length=20, nullable=false)
     */
    private $charset = 'utf8';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=140, nullable=false)
     */
    private $title = '';

    /**
     * @var string
     *
     * @ORM\Column(name="favicon", type="string", length=80, nullable=false)
     */
    private $favicon = '';
    
    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", nullable=false)
     */    
    private $metaDescription = '';
    
    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="text", nullable=false)
     */
    private $metaKeywords = '';    

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=250, nullable=false)
     */
    private $author = '';

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=40, nullable=false)
     */
    private $language = 'de';

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
     * @ORM\Column(name="meta_viewport", type="string", length=100, nullable=false)
     */    
    private $metaViewport = 'width=device-width, initial-scale=1.0';
    
    /**
     * @var string
     *
     * @ORM\Column(name="robots", type="string", length=100, nullable=false)
     */    
    private $robots = 'index, follow';
    
    /**
     * @var string
     *
     * @ORM\Column(name="global_top_script", type="text", nullable=false)
     */    
    private $globalTopScript = '';
    
    /**
     * @var string
     *
     * @ORM\Column(name="global_bottom_script", type="text", nullable=false)
     */    
    private $globalBottomScript = '';
    
    /**
     * @var string
     *
     * @ORM\Column(name="global_experttop_script", type="text", nullable=false)
     */    
    private $globalExperttopScript = '';
    
    /**
     * @var string
     *
     * @ORM\Column(name="global_expertbottom_script", type="text", nullable=false)
     */    
    private $globalExpertbottomScript = '';

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
     * Set hostId
     *
     * @param string $hostId
     * @return WebPreferences
     */
    public function setHostId($hostId)
    {
        $this->hostId = $hostId;

        return $this;
    }

    /**
     * Get hostId
     *
     * @return string 
     */
    public function getHostId()
    {
        return $this->hostId;
    }

    /**
     * Set host
     *
     * @param string $host
     * @return WebPreferences
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string 
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set standardDomain
     *
     * @param string $standardDomain
     * @return WebPreferences
     */
    public function setStandardDomain($standardDomain)
    {
        $this->standardDomain = $standardDomain;

        return $this;
    }

    /**
     * Get standardDomain
     *
     * @return string 
     */
    public function getStandardDomain()
    {
        return $this->standardDomain;
    }

    /**
     * Set charset
     *
     * @param string $charset
     * @return WebPreferences
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;

        return $this;
    }

    /**
     * Get charset
     *
     * @return string 
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return WebPreferences
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
     * Set favicon
     *
     * @param string $favicon
     * @return WebPreferences
     */
    public function setFavicon($favicon)
    {
        $this->favicon = $favicon;

        return $this;
    }

    /**
     * Get favicon
     *
     * @return string 
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

    /**
     * Get meta description
     * 
	 * @return the $meta_description
	 */
	public function getMetaDescription() 
	{
		return $this->meta_description;
	}

	/**
	 * Set meta description
	 * 
	 * @param string $metaDescription
	 * @return WebPreferences
	 */
	public function setMetaDescription($metaDescription) 
	{
		$this->meta_description = $metaDescription;
		
		return $this;
	}

	/**
	 * Get meta keywords
	 * 
	 * @return the $meta_keywords
	 */
	public function getMetaKeywords()
	{
		return $this->meta_keywords;
	}

	/**
	 * Set meta keywords
	 * 
	 * @param string $metaKeywords
	 * @return WebPreferences
	 */
	public function setMetaKeywords($metaKeywords) 
	{
		$this->meta_keywords = $metaKeywords;
		
		return $this;
	}

	/**
     * Set author
     *
     * @param string $author
     * @return WebPreferences
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return WebPreferences
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set googleaccount
     *
     * @param string $googleaccount
     * @return WebPreferences
     */
    public function setGoogleaccount($googleaccount)
    {
        $this->googleaccount = $googleaccount;

        return $this;
    }

    /**
     * Get googleaccount
     *
     * @return string 
     */
    public function getGoogleaccount()
    {
        return $this->googleaccount;
    }

    /**
     * Set siteverification
     *
     * @param string $siteverification
     * @return WebPreferences
     */
    public function setSiteverification($siteverification)
    {
        $this->siteverification = $siteverification;

        return $this;
    }

    /**
     * Get siteverification
     *
     * @return string 
     */
    public function getSiteverification()
    {
        return $this->siteverification;
    }

    /**
	 * @return the $metaViewport
	 */
	public function getMetaViewport() 
	{
		return $this->metaViewport;
	}

	/**
	 * @param string $metaViewport
	 * @return WebPreferences
	 */
	public function setMetaViewport($metaViewport) 
	{
		$this->metaViewport = $metaViewport;
		
		return $this;
	}

	/**
     * Get meta value robots
     * 
	 * @return the $robots
	 */
	public function getRobots() 
	{
		return $this->robots;
	}

	/**
	 * Set meta value robots
	 * 
	 * @param string $robots
	 * @return WebPreferences
	 */
	public function setRobots($robots) 
	{
		$this->robots = $robots;
		
		return $this;
	}

	/**
	 * Get global js file adjustment (header link value)
	 * 
	 * @return the $globalTopScript
	 */
	public function getGlobalTopScript() 
	{
		return $this->globalTopScript;
	}

	/**
	 * Set global js file adjustment (header link value)
	 * 
	 * @param string $globalTopScript
	 * @return WebPreferences
	 */
	public function setGlobalTopScript($globalTopScript) 
	{
		$this->globalTopScript = $globalTopScript;
		
		return $this;
	}

	/**
	 * Get global js file adjustment (body end tag link value)
	 * 
	 * @return the $globalBottomScript
	 */
	public function getGlobalBottomScript() 
	{
		return $this->globalBottomScript;
	}

	/**
	 * Set global js file adjustment (body end tag link value)
	 * 
	 * @param string $globalBottomScript
	 * @return WebPreferences
	 */
	public function setGlobalBottomScript($globalBottomScript) 
	{
		$this->globalBottomScript = $globalBottomScript;
		
		return $this;
	}

	/**
	 * Get global js file adjustment (header script value)
	 * 
	 * @return the $globalExperttopScript
	 */
	public function getGlobalExperttopScript() 
	{
		return $this->globalExperttopScript;
	}

	/**
	 * Set global js file adjustment (header script value)
	 * 
	 * @param string $globalExperttopScript
	 * @return WebPreferences
	 */
	public function setGlobalExperttopScript($globalExperttopScript) 
	{
		$this->globalExperttopScript = $globalExperttopScript;
		
		return $this;
	}

	/**
	 * Get global js file adjustment (body end tag script value)
	 * 
	 * @return the $globalExpertbottomScript
	 */
	public function getGlobalExpertbottomScript() 
	{
		return $this->globalExpertbottomScript;
	}

	/**
	 * Set global js file adjustment (body end tag script value)
	 * 
	 * @param string $globalExpertbottomScript
	 * @return WebPreferences
	 */
	public function setGlobalExpertbottomScript($globalExpertbottomScript) 
	{
		$this->globalExpertbottomScript = $globalExpertbottomScript;
		
		return $this;
	}

	/**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebPreferences
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
     * @return WebPreferences
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
     * @return WebPreferences
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
     * @return WebPreferences
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
