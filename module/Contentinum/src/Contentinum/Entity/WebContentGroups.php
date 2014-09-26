<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebContentGroups
 *
 * @ORM\Table(name="web_content_groups", indexes={@ORM\Index(name="CONTENTGROUP", columns={"web_contentgroup_id"}), @ORM\Index(name="GROUPREFCONTENT", columns={"web_content_id"})})
 * @ORM\Entity
 */
class WebContentGroups extends AbstractEntity
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
     * @ORM\Column(name="web_contentgroup_id", type="integer", nullable=false)
     */
    private $webContentgroup;

    /**
     * @var integer
     *
     * @ORM\Column(name="group_style", type="string", length=50, nullable=false)
     */
    private $groupStyle = 'none';

    /**
     * @var integer
     *
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    private $createdBy;

    /**
     * @var integer
     *
     * @ORM\Column(name="update_by", type="integer", nullable=false)
     */
    private $updateBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="register_date", type="datetime", nullable=false)
     */
    private $registerDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="up_date", type="datetime", nullable=false)
     */
    private $upDate;

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
     * @return the $webContentgroup
     */
    public function getWebContentgroup()
    {
        return $this->webContentgroup;
    }

	/**
     * @param number $webContentgroup
     */
    public function setWebContentgroup($webContentgroup)
    {
        $this->webContentgroup = $webContentgroup;
    }

	/**
     * @return the $groupStyle
     */
    public function getGroupStyle()
    {
        return $this->groupStyle;
    }

	/**
     * @param number $groupStyle
     */
    public function setGroupStyle($groupStyle)
    {
        $this->groupStyle = $groupStyle;
    }

	/**
     * @return the $createdBy
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

	/**
     * @param number $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

	/**
     * @return the $updateBy
     */
    public function getUpdateBy()
    {
        return $this->updateBy;
    }

	/**
     * @param number $updateBy
     */
    public function setUpdateBy($updateBy)
    {
        $this->updateBy = $updateBy;
    }

	/**
     * @return the $registerDate
     */
    public function getRegisterDate()
    {
        return $this->registerDate;
    }

	/**
     * @param DateTime $registerDate
     */
    public function setRegisterDate($registerDate)
    {
        $this->registerDate = $registerDate;
    }

	/**
     * @return the $upDate
     */
    public function getUpDate()
    {
        return $this->upDate;
    }

	/**
     * @param DateTime $upDate
     */
    public function setUpDate($upDate)
    {
        $this->upDate = $upDate;
    }

	/**
     * @return the $webContent
     */
    public function getWebContent()
    {
        return $this->webContent;
    }

	/**
     * @param \Contentinum\Entity\WebContent $webContent
     */
    public function setWebContent($webContent)
    {
        $this->webContent = $webContent;
    }

}