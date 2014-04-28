<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebContentAssign
 *
 * @ORM\Table(name="web_content_assign")
 * @ORM\Entity
 */
class WebContentAssign extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="web_content_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $webContentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="web_tag_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $webTagId;

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
    	return array('webContentId','webTagId');
    }
    
    /** (non-PHPdoc)
     * @see \ContentinumComponents\Entity\AbstractEntity::getPrimaryValue()
     */
    public function getPrimaryValue()
    {
    	return array($this->webContentId, $this->webTagId);
    }
    
    /** (non-PHPdoc)
     * @see \ContentinumComponents\Entity\AbstractEntity::getProperties()
     */
    public function getProperties()
    {
    	return get_object_vars($this);
    }
    
    /**
     * Set webContentId
     *
     * @param integer $webContentId
     * @return WebContentAssign
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
     * Set webTagId
     *
     * @param integer $webTagId
     * @return WebContentAssign
     */
    public function setWebTagId($webTagId)
    {
        $this->webTagId = $webTagId;

        return $this;
    }

    /**
     * Get webTagId
     *
     * @return integer 
     */
    public function getWebTagId()
    {
        return $this->webTagId;
    }

    /**
     * Set registerDate
     *
     * @param \DateTime $registerDate
     * @return WebContentAssign
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
     * @return WebContentAssign
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
