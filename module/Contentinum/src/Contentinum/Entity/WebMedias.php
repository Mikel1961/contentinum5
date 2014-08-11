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
     * @ORM\Column(name="media_link", type="string", length=250, nullable=false)
     */
    private $mediaLink;  

    /**
     * @var string
     *
     * @ORM\Column(name="media_type", type="string", length=50, nullable=false)
     */
    private $mediaType = '';
        
    /**
     * @var string
     *
     * @ORM\Column(name="media_attribute", type="text", nullable=true)
     */
    private $mediaAttribute = '';    
        
    /**
     * @var string
     *
     * @ORM\Column(name="media_alternate", type="text", nullable=true)
     */
    private $mediaAlternate = '';
    
    /**
     *
     * @var string
     *
     * @ORM\Column(name="media_metas", type="text", nullable=true)
     */
    private $mediaMetas = '';    

    /**
     * @var boolean
     *
     * @ORM\Column(name="media_in_use", type="boolean", nullable=false)
     */
    private $mediaInUse = '0';
        
    /**
     * @var string
     *
     * @ORM\Column(name="meta_coding", type="string", length=20, nullable=false)
     */    
    private $metaCoding = '';

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
     * @return WebMedias
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
	 * @return the $mediaName
	 */
	public function getMediaName() 
	{
		return $this->mediaName;
	}

	/**
	 * @param string $mediaName
	 * @return WebMedias
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
	 * @return WebMedias
	 */
	public function setMediaSource($mediaSource) 
	{
		$this->mediaSource = $mediaSource;
		
		return $this;
	}

	/**
	 * @return the $mediaLink
	 */
	public function getMediaLink() 
	{
		return $this->mediaLink;
	}

	/**
	 * @param string $mediaLink
	 * @return WebMedias
	 */
	public function setMediaLink($mediaLink) 
	{
		$this->mediaLink = $mediaLink;
		
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
	 * @return WebMedias
	 */
	public function setMediaType($mediaType) 
	{
		$this->mediaType = $mediaType;
		
		return $this;
	}
	
	/**
	 * @return the $mediaAttribute
	 */
	public function getMediaAttribute() 
	{
		return $this->mediaAttribute;
	}

	/**
	 * @param string $mediaAttribute
	 * @return WebMedias
	 */
	public function setMediaAttribute($mediaAttribute) 
	{
		$this->mediaAttribute = $mediaAttribute;
		
		return $this;
	}

	/**
	 * @return the $mediaAlternate
	 */
	public function getMediaAlternate() 
	{
		return $this->mediaAlternate;
	}

	/**
	 * @param string $mediaAlternate
	 * @return WebMedias
	 */
	public function setMediaAlternate($mediaAlternate) 
	{
		$this->mediaAlternate = $mediaAlternate;
		
		return $this;
	}
	
	/**
	 *
	 * @return the $mediaMetas
	 */
	public function getMediaMetas()
	{
		return $this->mediaMetas;
	}
	
	/**
	 *
	 * @param string $mediaMetas
	 * @return WebMedias
	 */
	public function setMediaMetas($mediaMetas)
	{
		$this->mediaMetas = $mediaMetas;
	
		return $this;
	}	

	/**
	 * @return the $mediaInUse
	 */
	public function getMediaInUse() 
	{
		return $this->mediaInUse;
	}

	/**
	 * @param boolean $mediaInUse
	 * @return WebMedias
	 */
	public function setMediaInUse($mediaInUse) 
	{
		$this->mediaInUse = $mediaInUse;
		
		return $this;
	}

	/**
	 * @return the $metaCoding
	 */
	public function getMetaCoding() 
	{
		return $this->metaCoding;
	}

	/**
	 * @param string $metaCoding
	 * @return WebMedias
	 */
	public function setMetaCoding($metaCoding) 
	{
		$this->metaCoding = $metaCoding;
		
		return $this;
	}

	/**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebMedias
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
     * @return WebMedias
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
     * @return WebMedias
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
     * @return WebMedias
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
