<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebPages
 *
 * @ORM\Table(name="web_pages_attributes", indexes={@ORM\Index(name="PAGEATTRIBPARENT", columns={"web_pages_id"})})
 * @ORM\Entity
 */
class WebPagesAttributes extends AbstractEntity
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
     * @ORM\Column(name="htmlstructure", type="string", length=50, nullable=false)
     */
    private $htmlstructure = '';

    /**
     * @var string
     *
     * @ORM\Column(name="htmlwidgets", type="string", length=50, nullable=false)
     */
    private $htmlwidgets = '';
    
    /**
     * @var string
     *
     * @ORM\Column(name="charset", type="string", length=20, nullable=false)
     */
    private $charset = 'utf8';

    /**
     * @var string
     *
     * @ORM\Column(name="favicon", type="string", length=150, nullable=false)
     */
    private $favicon = '';    

    /**
     * @var string
     *
     * @ORM\Column(name="body_id", type="string", length=250, nullable=false)
     */
    private $bodyId = '';

    /**
     * @var string
     *
     * @ORM\Column(name="body_class", type="string", length=250, nullable=false)
     */
    private $bodyClass = '';

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
     * @var string
     *
     * @ORM\Column(name="meta_docstart", type="text", nullable=false)
     */
    private $metaDocstart = '';
    
    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="text", nullable=false)
     */
    private $metaKeywords = '';    

    /**
     * @var string
     *
     * @ORM\Column(name="meta_viewport", type="string", length=100, nullable=false)
     */    
    private $metaViewport = 'width=device-width, initial-scale=1.0';

    /**
     * @var string
     *
     * @ORM\Column(name="nocache", type="string", length=1, nullable=false)
     */
    private $nocache = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="publish_up", type="string", nullable=false)
     */
    private $publishUp = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="publish_down", type="string", nullable=false)
     */
    private $publishDown = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="maintenance", type="text", nullable=false)
     */
    private $maintenance = '';

    /**
     * @var string
     *
     * @ORM\Column(name="maintenance_start", type="string", nullable=false)
     */
    private $maintenanceStart = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="maintenance_end", type="string", nullable=false)
     */
    private $maintenanceEnd = '0000-00-00 00:00:00';

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
     * @var \Contentinum\Entity\WebPagesParameter
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\WebPagesParameter")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="web_pages_id", referencedColumnName="id")
     * })
     */
    private $webPages;

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
     */
    public function setId($id)
    {
    	$this->id = $id;
    

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
     * @return the $htmlstructure
     */
    public function getHtmlstructure()
    {
        return $this->htmlstructure;
    }

	/**
     * @param string $htmlstructure
     */
    public function setHtmlstructure($htmlstructure)
    {
        $this->htmlstructure = $htmlstructure;
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
     * @return the $charset
     */
    public function getCharset()
    {
        return $this->charset;
    }

	/**
     * @param string $charset
     */
    public function setCharset($charset)
    {
        $this->charset = $charset;
    }

	/**
     * @return the $favicon
     */
    public function getFavicon()
    {
        return $this->favicon;
    }

	/**
     * @param string $favicon
     */
    public function setFavicon($favicon)
    {
        $this->favicon = $favicon;
    }

	/**
     * @return the $bodyId
     */
    public function getBodyId()
    {
        return $this->bodyId;
    }

	/**
     * @param string $bodyId
     */
    public function setBodyId($bodyId)
    {
        $this->bodyId = $bodyId;
    }

	/**
     * @return the $bodyClass
     */
    public function getBodyClass()
    {
        return $this->bodyClass;
    }

	/**
     * @param string $bodyClass
     */
    public function setBodyClass($bodyClass)
    {
        $this->bodyClass = $bodyClass;
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
     * @return the $metaDocstart
     */
    public function getMetaDocstart()
    {
        return $this->metaDocstart;
    }

	/**
     * @param string $metaDocstart
     */
    public function setMetaDocstart($metaDocstart)
    {
        $this->metaDocstart = $metaDocstart;
    }

	/**
     * @return the $metaKeywords
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

	/**
     * @param string $metaKeywords
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
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
     */
    public function setMetaViewport($metaViewport)
    {
        $this->metaViewport = $metaViewport;
    }

	/**
     * @return the $nocache
     */
    public function getNocache()
    {
        return $this->nocache;
    }

	/**
     * @param string $nocache
     */
    public function setNocache($nocache)
    {
        $this->nocache = $nocache;
    }

	/**
     * @return the $publishUp
     */
    public function getPublishUp()
    {
        return $this->publishUp;
    }

	/**
     * @param Ambigous <string, DateTime> $publishUp
     */
    public function setPublishUp($publishUp)
    {
        $this->publishUp = $publishUp;
    }

	/**
     * @return the $publishDown
     */
    public function getPublishDown()
    {
        return $this->publishDown;
    }

	/**
     * @param Ambigous <DateTime, string> $publishDown
     */
    public function setPublishDown($publishDown)
    {
        $this->publishDown = $publishDown;
    }

	/**
     * @return the $maintenance
     */
    public function getMaintenance()
    {
        return $this->maintenance;
    }

	/**
     * @param string $maintenance
     */
    public function setMaintenance($maintenance)
    {
        $this->maintenance = $maintenance;
    }

	/**
     * @return the $maintenanceStart
     */
    public function getMaintenanceStart()
    {
        return $this->maintenanceStart;
    }

	/**
     * @param Ambigous <DateTime, string> $maintenanceStart
     */
    public function setMaintenanceStart($maintenanceStart)
    {
        $this->maintenanceStart = $maintenanceStart;
    }

	/**
     * @return the $maintenanceEnd
     */
    public function getMaintenanceEnd()
    {
        return $this->maintenanceEnd;
    }

	/**
     * @param Ambigous <DateTime, string> $maintenanceEnd
     */
    public function setMaintenanceEnd($maintenanceEnd)
    {
        $this->maintenanceEnd = $maintenanceEnd;
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
     * Set webPages
     *
     * @param \Contentinum\Entity\WebPagesParameter $webPages
     * @return WebNavigationTree
     */
    public function setWebPages(\Contentinum\Entity\WebPagesParameter $webPages = null)
    {
        $this->webPages = $webPages;

    }

    /**
     * Get webPages
     *
     * @return \Contentinum\Entity\WebPagesParameter 
     */
    public function getWebPages()
    {
        return $this->webPages;
    }
}
