<?php
namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebMediaTags
 *
 * @ORM\Table(name="web_tags", uniqueConstraints={@ORM\UniqueConstraint(name="WEBTAGID", columns={"tag_name"})})
 * @ORM\Entity
 */
class WebTags extends AbstractEntity
{

    /**
     *
     * @var integer @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     *      @ORM\Id
     *      @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     *
     * @var string @ORM\Column(name="tag_group", type="string", length=200, nullable=false)
     */
    private $tagGroup;

    /**
     *
     * @var string @ORM\Column(name="tag_name", type="string", length=200, nullable=false)
     */
    private $tagName;

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
     * @return WebMediaTags
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
     * @return the $tagGroup
     */
    public function getTagGroup()
    {
        return $this->tagGroup;
    }

    /**
     *
     * @param string $tagGroup
     *
     * @return WebMediaTags
     */
    public function setTagGroup($tagGroup)
    {
        $this->tagGroup = $tagGroup;
        
        return $this;
    }

    /**
     * Get tage name
     *
     * @param string $tagName
     *
     * @return WebMediaTags
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
        
        return $this;
    }

    /**
     * Set tage name
     *
     * @return the $tagName
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebMediaTags
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
     * @return WebMediaTags
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
     * @return WebMediaTags
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
     * @return WebMediaTags
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