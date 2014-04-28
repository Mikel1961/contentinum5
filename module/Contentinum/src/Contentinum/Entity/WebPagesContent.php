<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebPagesContent
 *
 * @ORM\Table(name="web_pages_content", indexes={@ORM\Index(name="PAGEIDENT", columns={"web_pages_id"}), @ORM\Index(name="CONTENTIDENT", columns={"web_content_id"})})
 * @ORM\Entity
 */
class WebPagesContent extends AbstractEntity
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
     * @ORM\Column(name="web_pages_id", type="integer", nullable=false)
     */
    private $webPagesId;

    /**
     * @var string
     *
     * @ORM\Column(name="web_pages_scope", type="string", length=255, nullable=false)
     */
    private $webPagesScope;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_rang", type="integer", nullable=false)
     */
    private $itemRang = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="template", type="string", length=30, nullable=false)
     */
    private $template = 'default';

    /**
     * @var string
     *
     * @ORM\Column(name="adjustments", type="text", nullable=false)
     */
    private $adjustments;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=250, nullable=false)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="tpl_assign", type="string", length=20, nullable=false)
     */
    private $tplAssign = 'content';

    /**
     * @var boolean
     *
     * @ORM\Column(name="medias", type="boolean", nullable=true)
     */
    private $medias = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="publish", type="string", length=10, nullable=false)
     */
    private $publish = 'no';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_up", type="datetime", nullable=false)
     */
    private $publishUp = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publish_down", type="datetime", nullable=false)
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
     * @var \Contentinum\Entity\WebContent
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\WebContent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="web_content_id", referencedColumnName="id")
     * })
     */
    private $webContent;

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
     * @return WebPagesContent
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
     * Set webPagesId
     *
     * @param integer $webPagesId
     * @return WebPagesContent
     */
    public function setWebPagesId($webPagesId)
    {
        $this->webPagesId = $webPagesId;

        return $this;
    }

    /**
     * Get webPagesId
     *
     * @return integer 
     */
    public function getWebPagesId()
    {
        return $this->webPagesId;
    }

    /**
     * Set webPagesScope
     *
     * @param string $webPagesScope
     * @return WebPagesContent
     */
    public function setWebPagesScope($webPagesScope)
    {
        $this->webPagesScope = $webPagesScope;

        return $this;
    }

    /**
     * Get webPagesScope
     *
     * @return string 
     */
    public function getWebPagesScope()
    {
        return $this->webPagesScope;
    }

    /**
     * Set itemRang
     *
     * @param integer $itemRang
     * @return WebPagesContent
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
     * Set template
     *
     * @param string $template
     * @return WebPagesContent
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string 
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set adjustments
     *
     * @param string $adjustments
     * @return WebPagesContent
     */
    public function setAdjustments($adjustments)
    {
        $this->adjustments = $adjustments;

        return $this;
    }

    /**
     * Get adjustments
     *
     * @return string 
     */
    public function getAdjustments()
    {
        return $this->adjustments;
    }

    /**
     * Set file
     *
     * @param string $file
     * @return WebPagesContent
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set tplAssign
     *
     * @param string $tplAssign
     * @return WebPagesContent
     */
    public function setTplAssign($tplAssign)
    {
        $this->tplAssign = $tplAssign;

        return $this;
    }

    /**
     * Get tplAssign
     *
     * @return string 
     */
    public function getTplAssign()
    {
        return $this->tplAssign;
    }

    /**
     * Set medias
     *
     * @param boolean $medias
     * @return WebPagesContent
     */
    public function setMedias($medias)
    {
        $this->medias = $medias;

        return $this;
    }

    /**
     * Get medias
     *
     * @return boolean 
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Set publish
     *
     * @param string $publish
     * @return WebPagesContent
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
     * Set publishUp
     *
     * @param \DateTime $publishUp
     * @return WebPagesContent
     */
    public function setPublishUp($publishUp)
    {
        $this->publishUp = $publishUp;

        return $this;
    }

    /**
     * Get publishUp
     *
     * @return \DateTime 
     */
    public function getPublishUp()
    {
        return $this->publishUp;
    }

    /**
     * Set publishDown
     *
     * @param \DateTime $publishDown
     * @return WebPagesContent
     */
    public function setPublishDown($publishDown)
    {
        $this->publishDown = $publishDown;

        return $this;
    }

    /**
     * Get publishDown
     *
     * @return \DateTime 
     */
    public function getPublishDown()
    {
        return $this->publishDown;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebPagesContent
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
     * @return WebPagesContent
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
     * @return WebPagesContent
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
     * @return WebPagesContent
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
     * Set webContent
     *
     * @param \Contentinum\Entity\WebContent $webContent
     * @return WebPagesContent
     */
    public function setWebContent(\Contentinum\Entity\WebContent $webContent = null)
    {
        $this->webContent = $webContent;

        return $this;
    }

    /**
     * Get webContent
     *
     * @return \Contentinum\Entity\WebContent 
     */
    public function getWebContent()
    {
        return $this->webContent;
    }
}
