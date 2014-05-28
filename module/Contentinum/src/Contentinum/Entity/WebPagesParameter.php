<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebPagesParameter
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
     * @ORM\Column(name="rel_link", type="string", length=50, nullable=false)
     */
    private $relLink = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=false)
     */
    private $params = '';

    /**
     * @var string
     *
     * @ORM\Column(name="settings", type="text", nullable=false)
     */
    private $settings = '';

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
     * @ORM\Column(name="meta_keywords", type="text", nullable=false)
     */
    private $metaKeywords = '';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_viewport", type="string", length=100, nullable=false)
     */
    private $metaViewport = '';

    /**
     * @var string
     *
     * @ORM\Column(name="robots", type="string", length=60, nullable=false)
     */
    private $robots = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nocache", type="string", length=1, nullable=false)
     */
    private $nocache = 'n';

    /**
     * @var string
     *
     * @ORM\Column(name="publish", type="string", length=10, nullable=false)
     */
    private $publish = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="publish_cms", type="string", length=4, nullable=false)
     */
    private $publishCms = 'both';

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
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted = '0';

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
     * @return WebPagesParameter
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
     * @return WebPagesParameter
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
     * Set scope
     *
     * @param string $scope
     * @return WebPagesParameter
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope
     *
     * @return string 
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set htmlstructure
     *
     * @param string $htmlstructure
     * @return WebPagesParameter
     */
    public function setHtmlstructure($htmlstructure)
    {
        $this->htmlstructure = $htmlstructure;

        return $this;
    }

    /**
     * Get htmlstructure
     *
     * @return string 
     */
    public function getHtmlstructure()
    {
        return $this->htmlstructure;
    }

    /**
     * Set htmlwidgets
     *
     * @param string $htmlwidgets
     * @return WebPagesParameter
     */
    public function setHtmlwidgets($htmlwidgets)
    {
        $this->htmlwidgets = $htmlwidgets;

        return $this;
    }

    /**
     * Get htmlwidgets
     *
     * @return string 
     */
    public function getHtmlwidgets()
    {
        return $this->htmlwidgets;
    }

    /**
     * Set resource
     *
     * @param string $resource
     * @return WebPagesParameter
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return string 
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set label
     *
     * @param string $label
     * @return WebPagesParameter
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return WebPagesParameter
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
     * Set url
     *
     * @param string $url
     * @return WebPagesParameter
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set relLink
     *
     * @param string $relLink
     * @return WebPagesParameter
     */
    public function setRelLink($relLink)
    {
        $this->relLink = $relLink;

        return $this;
    }

    /**
     * Get relLink
     *
     * @return string 
     */
    public function getRelLink()
    {
        return $this->relLink;
    }

    /**
     * Set params
     *
     * @param string $params
     * @return WebPagesParameter
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get params
     *
     * @return string 
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set settings
     *
     * @param string $settings
     * @return WebPagesParameter
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Get settings
     *
     * @return string 
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set bodyId
     *
     * @param string $bodyId
     * @return WebPagesParameter
     */
    public function setBodyId($bodyId)
    {
        $this->bodyId = $bodyId;

        return $this;
    }

    /**
     * Get bodyId
     *
     * @return string 
     */
    public function getBodyId()
    {
        return $this->bodyId;
    }

    /**
     * Set bodyClass
     *
     * @param string $bodyClass
     * @return WebPagesParameter
     */
    public function setBodyClass($bodyClass)
    {
        $this->bodyClass = $bodyClass;

        return $this;
    }

    /**
     * Get bodyClass
     *
     * @return string 
     */
    public function getBodyClass()
    {
        return $this->bodyClass;
    }

    /**
     * Set headScript
     *
     * @param string $headScript
     * @return WebPagesParameter
     */
    public function setHeadScript($headScript)
    {
        $this->headScript = $headScript;

        return $this;
    }

    /**
     * Get headScript
     *
     * @return string 
     */
    public function getHeadScript()
    {
        return $this->headScript;
    }

    /**
     * Set bodyFooterScript
     *
     * @param string $bodyFooterScript
     * @return WebPagesParameter
     */
    public function setBodyFooterScript($bodyFooterScript)
    {
        $this->bodyFooterScript = $bodyFooterScript;

        return $this;
    }

    /**
     * Get bodyFooterScript
     *
     * @return string 
     */
    public function getBodyFooterScript()
    {
        return $this->bodyFooterScript;
    }

    /**
     * Set metaDocstart
     *
     * @param string $metaDocstart
     * @return WebPagesParameter
     */
    public function setMetaDocstart($metaDocstart)
    {
        $this->metaDocstart = $metaDocstart;

        return $this;
    }

    /**
     * Get metaDocstart
     *
     * @return string 
     */
    public function getMetaDocstart()
    {
        return $this->metaDocstart;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return WebPagesParameter
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string 
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return WebPagesParameter
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     * @return WebPagesParameter
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string 
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Set metaViewport
     *
     * @param string $metaViewport
     * @return WebPagesParameter
     */
    public function setMetaViewport($metaViewport)
    {
        $this->metaViewport = $metaViewport;

        return $this;
    }

    /**
     * Get metaViewport
     *
     * @return string 
     */
    public function getMetaViewport()
    {
        return $this->metaViewport;
    }

    /**
     * Set robots
     *
     * @param string $robots
     * @return WebPagesParameter
     */
    public function setRobots($robots)
    {
        $this->robots = $robots;

        return $this;
    }

    /**
     * Get robots
     *
     * @return string 
     */
    public function getRobots()
    {
        return $this->robots;
    }

    /**
     * Set nocache
     *
     * @param string $nocache
     * @return WebPagesParameter
     */
    public function setNocache($nocache)
    {
        $this->nocache = $nocache;

        return $this;
    }

    /**
     * Get nocache
     *
     * @return string 
     */
    public function getNocache()
    {
        return $this->nocache;
    }

    /**
     * Set publish
     *
     * @param string $publish
     * @return WebPagesParameter
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;

        return $this;
    }

    /**
     * Get publish
     *
     * @return string 
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * Set publishCms
     *
     * @param string $publishCms
     * @return WebPagesParameter
     */
    public function setPublishCms($publishCms)
    {
        $this->publishCms = $publishCms;

        return $this;
    }

    /**
     * Get publishCms
     *
     * @return string 
     */
    public function getPublishCms()
    {
        return $this->publishCms;
    }

    /**
     * Set publishUp
     *
     * @param string $publishUp
     * @return WebPagesParameter
     */
    public function setPublishUp($publishUp)
    {
        $this->publishUp = $publishUp;

        return $this;
    }

    /**
     * Get publishUp
     *
     * @return string 
     */
    public function getPublishUp()
    {
        return $this->publishUp;
    }

    /**
     * Set publishDown
     *
     * @param string $publishDown
     * @return WebPagesParameter
     */
    public function setPublishDown($publishDown)
    {
        $this->publishDown = $publishDown;

        return $this;
    }

    /**
     * Get publishDown
     *
     * @return string 
     */
    public function getPublishDown()
    {
        return $this->publishDown;
    }

    /**
     * Set maintenance
     *
     * @param string $maintenance
     * @return WebPagesParameter
     */
    public function setMaintenance($maintenance)
    {
        $this->maintenance = $maintenance;

        return $this;
    }

    /**
     * Get maintenance
     *
     * @return string 
     */
    public function getMaintenance()
    {
        return $this->maintenance;
    }

    /**
     * Set maintenanceStart
     *
     * @param string $maintenanceStart
     * @return WebPagesParameter
     */
    public function setMaintenanceStart($maintenanceStart)
    {
        $this->maintenanceStart = $maintenanceStart;

        return $this;
    }

    /**
     * Get maintenanceStart
     *
     * @return string 
     */
    public function getMaintenanceStart()
    {
        return $this->maintenanceStart;
    }

    /**
     * Set maintenanceEnd
     *
     * @param string $maintenanceEnd
     * @return WebPagesParameter
     */
    public function setMaintenanceEnd($maintenanceEnd)
    {
        $this->maintenanceEnd = $maintenanceEnd;

        return $this;
    }

    /**
     * Get maintenanceEnd
     *
     * @return string 
     */
    public function getMaintenanceEnd()
    {
        return $this->maintenanceEnd;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return WebPagesParameter
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set onlylink
     *
     * @param boolean $onlylink
     * @return WebPagesParameter
     */
    public function setOnlylink($onlylink)
    {
        $this->onlylink = $onlylink;

        return $this;
    }

    /**
     * Get onlylink
     *
     * @return boolean 
     */
    public function getOnlylink()
    {
        return $this->onlylink;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebPagesParameter
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
     * @return WebPagesParameter
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
     * @return WebPagesParameter
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
     * @return WebPagesParameter
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
     * @return WebPagesParameter
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
