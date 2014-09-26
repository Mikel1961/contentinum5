<?php
namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebTagAssign
 *
 * @todo no primary indizes set
 *      
 *       @ORM\Table(name="web_tags_assign", uniqueConstraints={@ORM\UniqueConstraint(name="WEBTAGASSIGN", columns={"tag_area","web_item_id", "web_tag_id"})}, indexes={@ORM\Index(name="MEDIATAGSID", columns={"web_mediatag_id"}), @ORM\Index(name="IDX_495AA7811958669F", columns={"web_medias_id"})})
 *       @ORM\Entity
 */
class WebTagAssign extends AbstractEntity
{

    /**
     *
     * @var string @ORM\Column(name="tag_area", type="string", length=200, nullable=false)
     */
    private $tagArea;

    /**
     *
     * @var integer @ORM\Column(name="web_item_id", type="integer", nullable=false)
     */
    private $webItemId;

    /**
     *
     * @var integer @ORM\Column(name="web_tag_id", type="integer", nullable=false)
     */
    private $webTagId;

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
        return array(
            'tagArea',
            'webItemId',
            'webTagId'
        );
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ContentinumComponents\Entity\AbstractEntity::getPrimaryValue()
     */
    public function getPrimaryValue()
    {
        return array(
            'tagArea' => $this->tagArea,
            'webItemId' => $this->webItemId,
            'webTagId' => $this->webTagId
        );
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
     * @return the $tagArea
     */
    public function getTagArea()
    {
        return $this->tagArea;
    }

    /**
     *
     * @param string $tagArea
     *
     * @return WebTagAssign
     */
    public function setTagArea($tagArea)
    {
        $this->tagArea = $tagArea;
        
        return $this;
    }

    /**
     *
     * @return the $webItemId
     */
    public function getWebItemId()
    {
        return $this->webItemId;
    }

    /**
     *
     * @param number $webItemId
     *
     * @return WebTagAssign
     */
    public function setWebItemId($webItemId)
    {
        $this->webItemId = $webItemId;
        
        return $this;
    }

    /**
     *
     * @return the $webTagId
     */
    public function getWebTagId()
    {
        return $this->webTagId;
    }

    /**
     *
     * @param number $webTagId
     *
     * @return WebTagAssign
     */
    public function setWebTagId($webTagId)
    {
        $this->webTagId = $webTagId;
        
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
     * Get upDate
     *
     * @return \DateTime
     */
    public function getUpDate()
    {
        return $this->upDate;
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
}