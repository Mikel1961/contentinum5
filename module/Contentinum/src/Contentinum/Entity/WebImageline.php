<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebImageline
 *
 * @ORM\Table(name="web_imageline", indexes={@ORM\Index(name="text_id", columns={"line_id"}), @ORM\Index(name="img", columns={"img_source"}), @ORM\Index(name="web_content_id", columns={"web_content_id"})})
 * @ORM\Entity
 */
class WebImageline extends AbstractEntity
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
     * @ORM\Column(name="web_content_id", type="integer", nullable=false)
     */
    private $webContentId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="line_id", type="integer", nullable=false)
     */
    private $lineId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="lineset", type="string", length=5, nullable=false)
     */
    private $lineset = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="linetitle", type="string", length=100, nullable=false)
     */
    private $linetitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_rang", type="integer", nullable=false)
     */
    private $itemRang = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="img_align", type="string", length=25, nullable=false)
     */
    private $imgAlign = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_source", type="string", length=255, nullable=false)
     */
    private $imgSource;

    /**
     * @var string
     *
     * @ORM\Column(name="img_large", type="string", length=255, nullable=false)
     */
    private $imgLarge = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_alt", type="string", length=255, nullable=false)
     */
    private $imgAlt;

    /**
     * @var string
     *
     * @ORM\Column(name="img_title", type="string", length=255, nullable=false)
     */
    private $imgTitle = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_longdesc", type="text", nullable=false)
     */
    private $imgLongdesc = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_caption", type="text", nullable=false)
     */
    private $imgCaption = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_link", type="string", length=255, nullable=false)
     */
    private $imgLink = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_link_target", type="string", length=4, nullable=false)
     */
    private $imgLinkTarget = 'self';

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=false)
     */
    private $params = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description = '';

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
     * @return WebImageline
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
     * Set webContentId
     *
     * @param integer $webContentId
     * @return WebImageline
     */
    public function setWebContentId($webContentId)
    {
        $this->webContentId = $webContentId;

        return $this;
    }

    /**
     * Get webContentId
     *
     * @return integer 
     */
    public function getWebContentId()
    {
        return $this->webContentId;
    }

    /**
     * Set lineId
     *
     * @param integer $lineId
     * @return WebImageline
     */
    public function setLineId($lineId)
    {
        $this->lineId = $lineId;

        return $this;
    }

    /**
     * Get lineId
     *
     * @return integer 
     */
    public function getLineId()
    {
        return $this->lineId;
    }

    /**
     * Set lineset
     *
     * @param string $lineset
     * @return WebImageline
     */
    public function setLineset($lineset)
    {
        $this->lineset = $lineset;

        return $this;
    }

    /**
     * Get lineset
     *
     * @return string 
     */
    public function getLineset()
    {
        return $this->lineset;
    }

    /**
     * Set linetitle
     *
     * @param string $linetitle
     * @return WebImageline
     */
    public function setLinetitle($linetitle)
    {
        $this->linetitle = $linetitle;

        return $this;
    }

    /**
     * Get linetitle
     *
     * @return string 
     */
    public function getLinetitle()
    {
        return $this->linetitle;
    }

    /**
     * Set itemRang
     *
     * @param integer $itemRang
     * @return WebImageline
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
     * Set imgAlign
     *
     * @param string $imgAlign
     * @return WebImageline
     */
    public function setImgAlign($imgAlign)
    {
        $this->imgAlign = $imgAlign;

        return $this;
    }

    /**
     * Get imgAlign
     *
     * @return string 
     */
    public function getImgAlign()
    {
        return $this->imgAlign;
    }

    /**
     * Set imgSource
     *
     * @param string $imgSource
     * @return WebImageline
     */
    public function setImgSource($imgSource)
    {
        $this->imgSource = $imgSource;

        return $this;
    }

    /**
     * Get imgSource
     *
     * @return string 
     */
    public function getImgSource()
    {
        return $this->imgSource;
    }

    /**
     * Set imgLarge
     *
     * @param string $imgLarge
     * @return WebImageline
     */
    public function setImgLarge($imgLarge)
    {
        $this->imgLarge = $imgLarge;

        return $this;
    }

    /**
     * Get imgLarge
     *
     * @return string 
     */
    public function getImgLarge()
    {
        return $this->imgLarge;
    }

    /**
     * Set imgAlt
     *
     * @param string $imgAlt
     * @return WebImageline
     */
    public function setImgAlt($imgAlt)
    {
        $this->imgAlt = $imgAlt;

        return $this;
    }

    /**
     * Get imgAlt
     *
     * @return string 
     */
    public function getImgAlt()
    {
        return $this->imgAlt;
    }

    /**
     * Set imgTitle
     *
     * @param string $imgTitle
     * @return WebImageline
     */
    public function setImgTitle($imgTitle)
    {
        $this->imgTitle = $imgTitle;

        return $this;
    }

    /**
     * Get imgTitle
     *
     * @return string 
     */
    public function getImgTitle()
    {
        return $this->imgTitle;
    }

    /**
     * Set imgLongdesc
     *
     * @param string $imgLongdesc
     * @return WebImageline
     */
    public function setImgLongdesc($imgLongdesc)
    {
        $this->imgLongdesc = $imgLongdesc;

        return $this;
    }

    /**
     * Get imgLongdesc
     *
     * @return string 
     */
    public function getImgLongdesc()
    {
        return $this->imgLongdesc;
    }

    /**
     * Set imgCaption
     *
     * @param string $imgCaption
     * @return WebImageline
     */
    public function setImgCaption($imgCaption)
    {
        $this->imgCaption = $imgCaption;

        return $this;
    }

    /**
     * Get imgCaption
     *
     * @return string 
     */
    public function getImgCaption()
    {
        return $this->imgCaption;
    }

    /**
     * Set imgLink
     *
     * @param string $imgLink
     * @return WebImageline
     */
    public function setImgLink($imgLink)
    {
        $this->imgLink = $imgLink;

        return $this;
    }

    /**
     * Get imgLink
     *
     * @return string 
     */
    public function getImgLink()
    {
        return $this->imgLink;
    }

    /**
     * Set imgLinkTarget
     *
     * @param string $imgLinkTarget
     * @return WebImageline
     */
    public function setImgLinkTarget($imgLinkTarget)
    {
        $this->imgLinkTarget = $imgLinkTarget;

        return $this;
    }

    /**
     * Get imgLinkTarget
     *
     * @return string 
     */
    public function getImgLinkTarget()
    {
        return $this->imgLinkTarget;
    }

    /**
     * Set params
     *
     * @param string $params
     * @return WebImageline
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
     * Set description
     *
     * @param string $description
     * @return WebImageline
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
     * Set publish
     *
     * @param string $publish
     * @return WebImageline
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
     * @return WebImageline
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebImageline
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
     * @return WebImageline
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
     * @return WebImageline
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
     * @return WebImageline
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
