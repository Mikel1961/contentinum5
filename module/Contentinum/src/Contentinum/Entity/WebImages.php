<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebImages
 *
 * @ORM\Table(name="web_images", uniqueConstraints={@ORM\UniqueConstraint(name="IMAGECONTENT", columns={"web_content_id"})}, indexes={@ORM\Index(name="img", columns={"img_source"})})
 * @ORM\Entity
 */
class WebImages extends AbstractEntity
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
     * @var string
     *
     * @ORM\Column(name="img_media", type="string", length=10, nullable=false)
     */
    private $imgMedia = 'no';

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
     * @ORM\Column(name="img_object", type="string", length=255, nullable=false)
     */
    private $imgObject = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_large", type="string", length=255, nullable=true)
     */
    private $imgLarge = '0';

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
     * @ORM\Column(name="img_caption", type="string", length=255, nullable=false)
     */
    private $imgCaption = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_longdesc", type="text", nullable=true)
     */
    private $imgLongdesc = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_link_target", type="string", length=4, nullable=false)
     */
    private $imgLinkTarget = 'self';

    /**
     * @var string
     *
     * @ORM\Column(name="img_link", type="string", length=255, nullable=false)
     */
    private $imgLink = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_link_rel", type="string", length=10, nullable=false)
     */
    private $imgLinkRel = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="img_align2", type="string", length=25, nullable=false)
     */
    private $imgAlign2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_source2", type="string", length=255, nullable=false)
     */
    private $imgSource2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_object2", type="string", length=250, nullable=false)
     */
    private $imgObject2 = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="img_large2", type="string", length=255, nullable=false)
     */
    private $imgLarge2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_alt2", type="string", length=255, nullable=false)
     */
    private $imgAlt2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_title2", type="string", length=255, nullable=false)
     */
    private $imgTitle2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_caption2", type="string", length=255, nullable=false)
     */
    private $imgCaption2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_longdesc2", type="text", nullable=true)
     */
    private $imgLongdesc2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_link_target2", type="string", length=4, nullable=false)
     */
    private $imgLinkTarget2 = 'self';

    /**
     * @var string
     *
     * @ORM\Column(name="img_link2", type="string", length=255, nullable=false)
     */
    private $imgLink2 = '';

    /**
     * @var string
     *
     * @ORM\Column(name="img_link_rel2", type="string", length=10, nullable=false)
     */
    private $imgLinkRel2 = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=true)
     */
    private $params = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
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
     * @return WebImages
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
     * @return WebImages
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
     * Set imgMedia
     *
     * @param string $imgMedia
     * @return WebImages
     */
    public function setImgMedia($imgMedia)
    {
        $this->imgMedia = $imgMedia;

        return $this;
    }

    /**
     * Get imgMedia
     *
     * @return string 
     */
    public function getImgMedia()
    {
        return $this->imgMedia;
    }

    /**
     * Set imgAlign
     *
     * @param string $imgAlign
     * @return WebImages
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
     * @return WebImages
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
     * Set imgObject
     *
     * @param string $imgObject
     * @return WebImages
     */
    public function setImgObject($imgObject)
    {
        $this->imgObject = $imgObject;

        return $this;
    }

    /**
     * Get imgObject
     *
     * @return string 
     */
    public function getImgObject()
    {
        return $this->imgObject;
    }

    /**
     * Set imgLarge
     *
     * @param string $imgLarge
     * @return WebImages
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
     * @return WebImages
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
     * @return WebImages
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
     * Set imgCaption
     *
     * @param string $imgCaption
     * @return WebImages
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
     * Set imgLongdesc
     *
     * @param string $imgLongdesc
     * @return WebImages
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
     * Set imgLinkTarget
     *
     * @param string $imgLinkTarget
     * @return WebImages
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
     * Set imgLink
     *
     * @param string $imgLink
     * @return WebImages
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
     * Set imgLinkRel
     *
     * @param string $imgLinkRel
     * @return WebImages
     */
    public function setImgLinkRel($imgLinkRel)
    {
        $this->imgLinkRel = $imgLinkRel;

        return $this;
    }

    /**
     * Get imgLinkRel
     *
     * @return string 
     */
    public function getImgLinkRel()
    {
        return $this->imgLinkRel;
    }

    /**
     * Set imgAlign2
     *
     * @param string $imgAlign2
     * @return WebImages
     */
    public function setImgAlign2($imgAlign2)
    {
        $this->imgAlign2 = $imgAlign2;

        return $this;
    }

    /**
     * Get imgAlign2
     *
     * @return string 
     */
    public function getImgAlign2()
    {
        return $this->imgAlign2;
    }

    /**
     * Set imgSource2
     *
     * @param string $imgSource2
     * @return WebImages
     */
    public function setImgSource2($imgSource2)
    {
        $this->imgSource2 = $imgSource2;

        return $this;
    }

    /**
     * Get imgSource2
     *
     * @return string 
     */
    public function getImgSource2()
    {
        return $this->imgSource2;
    }

    /**
     * Set imgObject2
     *
     * @param string $imgObject2
     * @return WebImages
     */
    public function setImgObject2($imgObject2)
    {
        $this->imgObject2 = $imgObject2;

        return $this;
    }

    /**
     * Get imgObject2
     *
     * @return string 
     */
    public function getImgObject2()
    {
        return $this->imgObject2;
    }

    /**
     * Set imgLarge2
     *
     * @param string $imgLarge2
     * @return WebImages
     */
    public function setImgLarge2($imgLarge2)
    {
        $this->imgLarge2 = $imgLarge2;

        return $this;
    }

    /**
     * Get imgLarge2
     *
     * @return string 
     */
    public function getImgLarge2()
    {
        return $this->imgLarge2;
    }

    /**
     * Set imgAlt2
     *
     * @param string $imgAlt2
     * @return WebImages
     */
    public function setImgAlt2($imgAlt2)
    {
        $this->imgAlt2 = $imgAlt2;

        return $this;
    }

    /**
     * Get imgAlt2
     *
     * @return string 
     */
    public function getImgAlt2()
    {
        return $this->imgAlt2;
    }

    /**
     * Set imgTitle2
     *
     * @param string $imgTitle2
     * @return WebImages
     */
    public function setImgTitle2($imgTitle2)
    {
        $this->imgTitle2 = $imgTitle2;

        return $this;
    }

    /**
     * Get imgTitle2
     *
     * @return string 
     */
    public function getImgTitle2()
    {
        return $this->imgTitle2;
    }

    /**
     * Set imgCaption2
     *
     * @param string $imgCaption2
     * @return WebImages
     */
    public function setImgCaption2($imgCaption2)
    {
        $this->imgCaption2 = $imgCaption2;

        return $this;
    }

    /**
     * Get imgCaption2
     *
     * @return string 
     */
    public function getImgCaption2()
    {
        return $this->imgCaption2;
    }

    /**
     * Set imgLongdesc2
     *
     * @param string $imgLongdesc2
     * @return WebImages
     */
    public function setImgLongdesc2($imgLongdesc2)
    {
        $this->imgLongdesc2 = $imgLongdesc2;

        return $this;
    }

    /**
     * Get imgLongdesc2
     *
     * @return string 
     */
    public function getImgLongdesc2()
    {
        return $this->imgLongdesc2;
    }

    /**
     * Set imgLinkTarget2
     *
     * @param string $imgLinkTarget2
     * @return WebImages
     */
    public function setImgLinkTarget2($imgLinkTarget2)
    {
        $this->imgLinkTarget2 = $imgLinkTarget2;

        return $this;
    }

    /**
     * Get imgLinkTarget2
     *
     * @return string 
     */
    public function getImgLinkTarget2()
    {
        return $this->imgLinkTarget2;
    }

    /**
     * Set imgLink2
     *
     * @param string $imgLink2
     * @return WebImages
     */
    public function setImgLink2($imgLink2)
    {
        $this->imgLink2 = $imgLink2;

        return $this;
    }

    /**
     * Get imgLink2
     *
     * @return string 
     */
    public function getImgLink2()
    {
        return $this->imgLink2;
    }

    /**
     * Set imgLinkRel2
     *
     * @param string $imgLinkRel2
     * @return WebImages
     */
    public function setImgLinkRel2($imgLinkRel2)
    {
        $this->imgLinkRel2 = $imgLinkRel2;

        return $this;
    }

    /**
     * Get imgLinkRel2
     *
     * @return string 
     */
    public function getImgLinkRel2()
    {
        return $this->imgLinkRel2;
    }

    /**
     * Set params
     *
     * @param string $params
     * @return WebImages
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
     * @return WebImages
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
     * @return WebImages
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
     * @return WebImages
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
     * @return WebImages
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
     * @return WebImages
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
     * @return WebImages
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
     * @return WebImages
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
