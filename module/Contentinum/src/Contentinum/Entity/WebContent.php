<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebContent
 *
 * @ORM\Table(name="web_content", indexes={@ORM\Index(name="TITLEINTERNALUSE", columns={"title"}), @ORM\Index(name="HEADLINEPUBLICUSE", columns={"headline"})})
 * @ORM\Entity
 */
class WebContent extends AbstractEntity
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
     * @var integer
     *
     * @ORM\Column(name="web_contentgroup_id", type="integer", nullable=false)
     */
    private $webContentgroup;    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="web_pages_id", type="integer", nullable=false)
     */
    private $webPages;    
    
    /**
     * @var string
     *
     * @ORM\Column(name="htmlwidgets", type="string", length=50, nullable=false)
     */
    private $htmlwidgets = '';    

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=250, nullable=false)
     */
    private $link = '';

    /**
     * @var string
     *
     * @ORM\Column(name="scope", type="string", length=250, nullable=false)
     */
    private $scope = '';

    /**
     * @var string
     *
     * @ORM\Column(name="modul", type="string", length=60, nullable=false)
     */
    private $modul = '';

    /**
     * @var string
     *
     * @ORM\Column(name="modul_params", type="text", nullable=false)
     */
    private $modulParams = '';

    /**
     * @var string
     *
     * @ORM\Column(name="modul_display", type="string", length=250, nullable=false)
     */
    private $modulDisplay = '';

    /**
     * @var string
     *
     * @ORM\Column(name="modul_config", type="string", length=250, nullable=false)
     */
    private $modulConfig = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=6, nullable=false)
     */
    private $lang = 'de';

    /**
     * @var integer
     *
     * @ORM\Column(name="item_rang", type="integer", nullable=false)
     */
    private $itemRang = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=250, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="headline", type="string", length=250, nullable=false)
     */
    private $headline = '';

    /**
     * @var string
     *
     * @ORM\Column(name="headline_tag", type="string", length=2, nullable=false)
     */
    private $headlineTag = 'h2';

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="text", nullable=false)
     */
    private $question = '';

    /**
     * @var string
     *
     * @ORM\Column(name="content_intro", type="text", nullable=false)
     */
    private $contentIntro = '';

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content = '';

    /**
     * @var string
     *
     * @ORM\Column(name="content_string", type="text", nullable=false)
     */
    private $contentString = '';

    /**
     * @var string
     *
     * @ORM\Column(name="number_letter", type="string", length=5, nullable=false)
     */
    private $numberLetter = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="num_letter_title", type="string", length=100, nullable=false)
     */
    private $numLetterTitle = '';

    /**
     * @var string
     *
     * @ORM\Column(name="comment_status", type="string", length=5, nullable=false)
     */
    private $commentStatus = 'close';

    /**
     * @var string
     *
     * @ORM\Column(name="resource", type="string", length=50, nullable=false)
     */
    private $resource = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="users_id", type="integer", nullable=false)
     */
    private $usersId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="publish_date", type="string", nullable=false)
     */
    private $publishDate = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="send_date", type="string", nullable=false)
     */
    private $sendDate = '0000-00-00';

    /**
     * @var string
     *
     * @ORM\Column(name="publish_author", type="string", length=100, nullable=false)
     */
    private $publishAuthor = '';

    /**
     * @var string
     *
     * @ORM\Column(name="author_email", type="string", length=80, nullable=false)
     */
    private $authorEmail = '';

    /**
     * @var string
     *
     * @ORM\Column(name="author_IP", type="string", length=100, nullable=false)
     */
    private $authorIp = '';

    /**
     * @var string
     *
     * @ORM\Column(name="author_url", type="string", length=200, nullable=false)
     */
    private $authorUrl = '';

    /**
     * @var string
     *
     * @ORM\Column(name="publish_cms", type="string", length=4, nullable=false)
     */
    private $publishCms = 'both';

    /**
     * @var string
     *
     * @ORM\Column(name="publish", type="string", length=10, nullable=false)
     */
    private $publish = 'no';

    /**
     * @var integer
     *
     * @ORM\Column(name="hits", type="integer", nullable=false)
     */
    private $hits = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=false)
     */
    private $version = '0';

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
     *
     * @var \Contentinum\Entity\WebMedia
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\WebMedias")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="web_medias_id", referencedColumnName="id")
     * })
     */
    private $webMediasId;    

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
     * @return WebContent
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
     * @return the $webContentgroup
     */
    public function getWebContentgroup()
    {
        return $this->webContentgroup;
    }

	/**
     * @param number $webContentgroup
     */
    public function setWebContentgroup($webContentgroup)
    {
        $this->webContentgroup = $webContentgroup;
    }

	/**
     * @return the $webPages
     */
    public function getWebPages()
    {
        return $this->webPages;
    }

	/**
     * @param number $webPages
     */
    public function setWebPages($webPages)
    {
        $this->webPages = $webPages;
    }
    
    /**
     * Set htmlwidgets
     *
     * @param string $htmlwidgets
     * @return WebPagesContent
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
     * Set link
     *
     * @param string $link
     * @return WebContent
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set scope
     *
     * @param string $scope
     * @return WebContent
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
     * Set modul
     *
     * @param string $modul
     * @return WebContent
     */
    public function setModul($modul)
    {
        $this->modul = $modul;

        return $this;
    }

    /**
     * Get modul
     *
     * @return string 
     */
    public function getModul()
    {
        return $this->modul;
    }

    /**
     * Set modulParams
     *
     * @param string $modulParams
     * @return WebContent
     */
    public function setModulParams($modulParams)
    {
        $this->modulParams = $modulParams;

        return $this;
    }

    /**
     * Get modulParams
     *
     * @return string 
     */
    public function getModulParams()
    {
        return $this->modulParams;
    }

    /**
     * Set modulDisplay
     *
     * @param string $modulDisplay
     * @return WebContent
     */
    public function setModulDisplay($modulDisplay)
    {
        $this->modulDisplay = $modulDisplay;

        return $this;
    }

    /**
     * Get modulDisplay
     *
     * @return string 
     */
    public function getModulDisplay()
    {
        return $this->modulDisplay;
    }

    /**
     * Set modulConfig
     *
     * @param string $modulConfig
     * @return WebContent
     */
    public function setModulConfig($modulConfig)
    {
        $this->modulConfig = $modulConfig;

        return $this;
    }

    /**
     * Get modulConfig
     *
     * @return string 
     */
    public function getModulConfig()
    {
        return $this->modulConfig;
    }

    /**
     * Set lang
     *
     * @param string $lang
     * @return WebContent
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string 
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set itemRang
     *
     * @param integer $itemRang
     * @return WebContent
     */
    public function setItemRang($itemRang)
    {
        $this->itemRang = $itemRang;

        return $this;
    }

    /**
     * Get itemRang
     *
     * @return integer 
     */
    public function getItemRang()
    {
        return $this->itemRang;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return WebContent
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
     * Set headline
     *
     * @param string $headline
     * @return WebContent
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
     * Set headlineTag
     *
     * @param string $headlineTag
     * @return WebContent
     */
    public function setHeadlineTag($headlineTag)
    {
        $this->headlineTag = $headlineTag;

        return $this;
    }

    /**
     * Get headlineTag
     *
     * @return string 
     */
    public function getHeadlineTag()
    {
        return $this->headlineTag;
    }

    /**
     * Set question
     *
     * @param string $question
     * @return WebContent
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set contentIntro
     *
     * @param string $contentIntro
     * @return WebContent
     */
    public function setContentIntro($contentIntro)
    {
        $this->contentIntro = $contentIntro;

        return $this;
    }

    /**
     * Get contentIntro
     *
     * @return string 
     */
    public function getContentIntro()
    {
        return $this->contentIntro;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return WebContent
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set contentString
     *
     * @param string $contentString
     * @return WebContent
     */
    public function setContentString($contentString)
    {
        $this->contentString = $contentString;

        return $this;
    }

    /**
     * Get contentString
     *
     * @return string 
     */
    public function getContentString()
    {
        return $this->contentString;
    }

    /**
     * Set numberLetter
     *
     * @param string $numberLetter
     * @return WebContent
     */
    public function setNumberLetter($numberLetter)
    {
        $this->numberLetter = $numberLetter;

        return $this;
    }

    /**
     * Get numberLetter
     *
     * @return string 
     */
    public function getNumberLetter()
    {
        return $this->numberLetter;
    }

    /**
     * Set numLetterTitle
     *
     * @param string $numLetterTitle
     * @return WebContent
     */
    public function setNumLetterTitle($numLetterTitle)
    {
        $this->numLetterTitle = $numLetterTitle;

        return $this;
    }

    /**
     * Get numLetterTitle
     *
     * @return string 
     */
    public function getNumLetterTitle()
    {
        return $this->numLetterTitle;
    }

    /**
     * Set commentStatus
     *
     * @param string $commentStatus
     * @return WebContent
     */
    public function setCommentStatus($commentStatus)
    {
        $this->commentStatus = $commentStatus;

        return $this;
    }

    /**
     * Get commentStatus
     *
     * @return string 
     */
    public function getCommentStatus()
    {
        return $this->commentStatus;
    }

    /**
     * Set resource
     *
     * @param string $resource
     * @return WebContent
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
     * Set usersId
     *
     * @param integer $usersId
     * @return WebContent
     */
    public function setUsersId($usersId)
    {
        $this->usersId = $usersId;

        return $this;
    }

    /**
     * Get usersId
     *
     * @return integer 
     */
    public function getUsersId()
    {
        return $this->usersId;
    }

    /**
     * Set publishDate
     *
     * @param string $publishDate
     * @return WebContent
     */
    public function setPublishDate($publishDate)
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    /**
     * Get publishDate
     *
     * @return string 
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * Set sendDate
     *
     * @param string $sendDate
     * @return WebContent
     */
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;

        return $this;
    }

    /**
     * Get sendDate
     *
     * @return string 
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * Set publishAuthor
     *
     * @param string $publishAuthor
     * @return WebContent
     */
    public function setPublishAuthor($publishAuthor)
    {
        $this->publishAuthor = $publishAuthor;

        return $this;
    }

    /**
     * Get publishAuthor
     *
     * @return string 
     */
    public function getPublishAuthor()
    {
        return $this->publishAuthor;
    }

    /**
     * Set authorEmail
     *
     * @param string $authorEmail
     * @return WebContent
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;

        return $this;
    }

    /**
     * Get authorEmail
     *
     * @return string 
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * Set authorIp
     *
     * @param string $authorIp
     * @return WebContent
     */
    public function setAuthorIp($authorIp)
    {
        $this->authorIp = $authorIp;

        return $this;
    }

    /**
     * Get authorIp
     *
     * @return string 
     */
    public function getAuthorIp()
    {
        return $this->authorIp;
    }

    /**
     * Set authorUrl
     *
     * @param string $authorUrl
     * @return WebContent
     */
    public function setAuthorUrl($authorUrl)
    {
        $this->authorUrl = $authorUrl;

        return $this;
    }

    /**
     * Get authorUrl
     *
     * @return string 
     */
    public function getAuthorUrl()
    {
        return $this->authorUrl;
    }

    /**
     * Set publishCms
     *
     * @param string $publishCms
     * @return WebContent
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
     * Set publish
     *
     * @param string $publish
     * @return WebContent
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
     * Set hits
     *
     * @param integer $hits
     * @return WebContent
     */
    public function setHits($hits)
    {
        $this->hits = $hits;

        return $this;
    }

    /**
     * Get hits
     *
     * @return integer 
     */
    public function getHits()
    {
        return $this->hits;
    }

    /**
     * Set version
     *
     * @param integer $version
     * @return WebContent
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set publishUp
     *
     * @param string $publishUp
     * @return WebContent
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
     * @return WebContent
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebContent
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
     * @return WebContent
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
     * @return WebContent
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
     * @return WebContent
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
     *
     * @return the $webMediasId
     */
    public function getWebMediasId()
    {
    	return $this->webMediasId;
    }
    
    /**
     *
     * @param \Contentinum\Entity\WebMedia $webMediasId
     * @return WebMediasMetas
     */
    public function setWebMediasId($webMediasId)
    {
    	$this->webMediasId = $webMediasId;
    
    	return $this;
    }    
}
