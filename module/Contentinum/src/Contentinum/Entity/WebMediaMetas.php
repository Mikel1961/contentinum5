<?php
namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebMediaMetas
 *
 * @ORM\Table(name="web_media_metas", indexes={@ORM\Index(name="MEDIANAME", columns={"media_name"}), @ORM\Index(name="MEDIASOURCE", columns={"media_source"})})
 * @ORM\Entity
 */
class WebMediaMetas extends AbstractEntity
{

    /**
     *
     * @var integer 
     *      
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;
    
    /**
     *
     * @var string
     *
     * @ORM\Column(name="prepare_serialize", type="string", length=30, nullable=false)
     */
    private $prepareSerialize = '';    
    
    
    /**
     *
     * @var string
     *
     * @ORM\Column(name="decode_metas", type="string", length=30, nullable=false)
     */
    private $decodeMetas = '';    

    /**
     *
     * @var string 
     * 
     * @ORM\Column(name="media_metas", type="text", nullable=true)
     */
    private $mediaMetas = '';

    /**
     *
     * @var integer 
     * 
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = '0';

    /**
     *
     * @var integer 
     * 
     * @ORM\Column(name="update_by", type="integer", nullable=false)
     */
    private $updateBy = '0';

    /**
     *
     * @var \DateTime 
     * 
     * @ORM\Column(name="register_date", type="datetime", nullable=false)
     */
    private $registerDate = '0000-00-00 00:00:00';

    /**
     *
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
     *
     * @param array $options            
     */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ContentinumComponents\Entity\AbstractEntity::getEntityName()
     */
    public function getEntityName()
    {
        return get_class($this);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ContentinumComponents\Entity\AbstractEntity::getPrimaryKey()
     */
    public function getPrimaryKey()
    {
        return 'id';
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ContentinumComponents\Entity\AbstractEntity::getPrimaryValue()
     */
    public function getPrimaryValue()
    {
        return $this->id;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ContentinumComponents\Entity\AbstractEntity::getProperties()
     */
    public function getProperties()
    {
        return get_object_vars($this);
    }

    /**
     *
     * @param number $id            
     *
     * @return WebMediasMetas
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
	 * @return the $prepareSerialize
	 */
	public function getPrepareSerialize() 
	{
		return $this->prepareSerialize;
	}

	/**
	 * @param string $prepareSerialize
	 * @return WebMediasMetas
	 */
	public function setPrepareSerialize($prepareSerialize) 
	{
		$this->prepareSerialize = $prepareSerialize;
		
		return $this;
	}


	/**
	 * @return the $decodeMetas
	 */
	public function getDecodeMetas() 
	{
		return $this->decodeMetas;
	}

	/**
	 * @param string $decodeMetas
	 * @return WebMediasMetas
	 */
	public function setDecodeMetas($decodeMetas) 
	{
		$this->decodeMetas = $decodeMetas;
		
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
     * @return WebMediasMetas
     */
    public function setMediaMetas($mediaMetas)
    {
        $this->mediaMetas = $mediaMetas;
        
        return $this;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy            
     * @return WebMediasMetas
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
     * @return WebMediasMetas
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
     * @return WebMediasMetas
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
     * @return WebMediasMetas
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