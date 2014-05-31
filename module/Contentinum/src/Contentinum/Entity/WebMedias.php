<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebMedias
 *
 * @ORM\Table(name="web_medias", indexes={@ORM\Index(name="MEDIACONTENT", columns={"web_content_id"}), @ORM\Index(name="MEDIANAME", columns={"media_name"}), @ORM\Index(name="MEDIASOURCE", columns={"media_source"})})
 * @ORM\Entity
 */
class WebMedias extends AbstractEntity
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
     * @ORM\Column(name="media_name", type="string", length=100, nullable=false)
     */
    private $mediaName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="media_source", type="string", length=500, nullable=false)
     */
    private $mediaSource;

    /**
     * @var string
     *
     * @ORM\Column(name="media_type", type="string", length=50, nullable=false)
     */
    private $mediaType = '';
        
    /**
     * @var string
     *
     * @ORM\Column(name="media_metas", type="text", nullable=true)
     */
    private $mediaMetas = '';

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=true)
     */
    private $params = '';

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
	 * @return the $mediaName
	 */
	public function getMediaName() 
	{
		return $this->mediaName;
	}

	/**
	 * @param string $mediaName
	 * @return WebImages
	 */
	public function setMediaName($mediaName) 
	{
		$this->mediaName = $mediaName;
		
		return $this;
	}

	/**
	 * @return the $mediaSource
	 */
	public function getMediaSource() 
	{
		return $this->mediaSource;
	}

	/**
	 * @param string $mediaSource
	 * @return WebImages
	 */
	public function setMediaSource($mediaSource) 
	{
		$this->mediaSource = $mediaSource;
		
		return $this;
	}

	/**
	 * @return the $mediaType
	 */
	public function getMediaType() 
	{
		return $this->mediaType;
	}

	/**
	 * @param string $mediaType
	 * @return WebImages
	 */
	public function setMediaType($mediaType) 
	{
		$this->mediaType = $mediaType;
		
		return $this;
	}

	/**
	 * @return the $mediaMetas
	 */
	public function getMediaMetas() 
	{
		return $this->mediaMetas;
	}

	/**
	 * @param string $mediaMetas
	 * @return WebImages
	 */
	public function setMediaMetas($mediaMetas) 
	{
		$this->mediaMetas = $mediaMetas;
		
		return $this;
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
