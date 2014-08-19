<?php
namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebMediaAssign
 *
 * @todo no primary indizes set
 *      
 *       @ORM\Table(name="web_media_assign", uniqueConstraints={@ORM\UniqueConstraint(name="MEDIATAGASSIGN", columns={"web_medias_id", "web_mediatag_id"})}, indexes={@ORM\Index(name="MEDIATAGSID", columns={"web_mediatag_id"}), @ORM\Index(name="IDX_495AA7811958669F", columns={"web_medias_id"})})
 *       @ORM\Entity
 */
class WebMediaAssign extends AbstractEntity
{

    /**
     *
     * @var integer @ORM\Column(name="web_medias_id", type="integer", nullable=false)
     */
    private $webMediasId;

    /**
     *
     * @var integer @ORM\Column(name="web_mediatag_id", type="integer", nullable=false)
     */
    private $webMediatagId;

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
            'webMedias',
            'webMediatag'
        );
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
     * @return the $webMediasId
     */
    public function getWebMediasId()
    {
        return $this->webMediasId;
    }

    /**
     *
     * @param number $webMediasId
     * 
     * @return WebMediaAssign
     */
    public function setWebMediasId($webMediasId)
    {
        $this->webMediasId = $webMediasId;
        
        return $this;
    }

    /**
     *
     * @return the $webMediatagId
     */
    public function getWebMediatagId()
    {
        return $this->webMediatagId;
    }

    /**
     *
     * @param number $webMediatagId
     * 
     * @return WebMediaAssign
     */
    public function setWebMediatagId($webMediatagId)
    {
        $this->webMediatagId = $webMediatagId;
        
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