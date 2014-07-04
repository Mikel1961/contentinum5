<?php
namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebMediaBlockMetas
 *
 * @ORM\Table(name="web_media_blockmetas", indexes={@ORM\Index(name="MEDIABLOCKMETAS", columns={"headline"})})
 * @ORM\Entity
 */
class WebMediaBlockMetas extends AbstractEntity
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false)
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     *
     * @var string @ORM\Column(name="headline", type="string", length=100, nullable=false)
     */
    private $headline = '';

    /**
     *
     * @var string @ORM\Column(name="sub_headline", type="text", nullable=true)
     */
    private $subHeadline = '';

    /**
     *
     * @var string @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description = '';

    /**
     *
     * @var string @ORM\Column(name="resource", type="string", length=50, nullable=false)
     */
    private $resource = '';

    /**
     *
     * @var string @ORM\Column(name="htmlwidgets", type="string", length=50, nullable=false)
     */
    private $htmlwidgets = '';

    /**
     *
     * @var integer @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy = '0';

    /**
     *
     * @var integer @ORM\Column(name="update_by", type="integer", nullable=false)
     */
    private $updateBy = '0';

    /**
     *
     * @var \DateTime @ORM\Column(name="register_date", type="datetime", nullable=false)
     */
    private $registerDate = '0000-00-00 00:00:00';

    /**
     *
     * @var \DateTime @ORM\Column(name="up_date", type="datetime", nullable=false)
     */
    private $upDate = '0000-00-00 00:00:00';

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
     * @return WebMediaBlockMetas
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
     *
     * @return the $headline
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     *
     * @param string $headline
     *
     * @return WebMediaBlockMetas
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
        
        return $this;
    }

    /**
     *
     * @return the $subHeadline
     */
    public function getSubHeadline()
    {
        return $this->subHeadline;
    }

    /**
     *
     * @param string $subHeadline
     */
    public function setSubHeadline($subHeadline)
    {
        $this->subHeadline = $subHeadline;
    }

    /**
     *
     * @return the $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     *
     * @param string $description
     * 
     * @return WebMediaBlockMetas
     */
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }

    /**
     *
     * @return the $resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     *
     * @param string $resource
     * 
     * @return WebMediaBlockMetas
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
        
        return $this;
    }

    /**
     *
     * @return the $htmlwidgets
     */
    public function getHtmlwidgets()
    {
        return $this->htmlwidgets;
    }

    /**
     *
     * @param string $htmlwidgets
     * 
     * @return WebMediaBlockMetas
     */
    public function setHtmlwidgets($htmlwidgets)
    {
        $this->htmlwidgets = $htmlwidgets;
        
        return $this;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebMediaBlockMetas
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
     * @return WebMediaBlockMetas
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
     * @return WebMediaBlockMetas
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
     * @return WebMediaBlockMetas
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