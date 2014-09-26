<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebNavigationTree
 *
 * @ORM\Table(name="web_navigation_tree", indexes={@ORM\Index(name="PAGES", columns={"web_pages_id"}), @ORM\Index(name="PARENTFROM", columns={"parent_from"}), @ORM\Index(name="TREES", columns={"web_navigation_id"})})
 * @ORM\Entity
 */
class WebNavigationTree extends AbstractEntity
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
     * @ORM\Column(name="parent_from", type="integer", nullable=false)
     */
    private $parentFrom = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="item_rang", type="integer", nullable=false)
     */
    private $itemRang = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="rel_link", type="string", length=50, nullable=false)
     */
    private $relLink = '';
    
    /**
     * @var string
     *
     * @ORM\Column(name="target_link", type="string", length=20, nullable=false)
     */    
    private $targetLink = '';

    /**
     * @var string
     *
     * @ORM\Column(name="class", type="string", length=50, nullable=false)
     */
    private $class = '';

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=false)
     */
    private $params = '';

    /**
     * @var string
     *
     * @ORM\Column(name="publish", type="string", length=10, nullable=false)
     */
    private $publish = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="resource", type="string", length=50, nullable=false)
     */
    private $resource = '';

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
     * @var \Contentinum\Entity\WebPagesParameter
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\WebPagesParameter")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="web_pages_id", referencedColumnName="id")
     * })
     */
    private $webPages;
    
    /**
     * @var \Contentinum\Entity\WebNavigations
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\WebNavigations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="web_navigation_id", referencedColumnName="id")
     * })
     */
    private $webNavigations;    

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
     * @return WebNavigationTree
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
     * Set parentFrom
     *
     * @param integer $parentFrom
     * @return WebNavigationTree
     */
    public function setParentFrom($parentFrom)
    {
        $this->parentFrom = $parentFrom;

        return $this;
    }

    /**
     * Get parentFrom
     *
     * @return integer 
     */
    public function getParentFrom()
    {
        return $this->parentFrom;
    }

    /**
     * Set itemRang
     *
     * @param integer $itemRang
     * @return WebNavigationTree
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
     * Set relLink
     *
     * @param string $relLink
     * @return WebNavigationTree
     */
    public function setRelLink($relLink)
    {
        $this->relLink = $relLink;

        return $this;
    }

    /**
     * Get relLink
     *
     * @return string 
     */
    public function getRelLink()
    {
        return $this->relLink;
    }

    /**
     * @return the $targetLink
     */
    public function getTargetLink()
    {
        return $this->targetLink;
    }

	/**
     * @param string $targetLink
     */
    public function setTargetLink($targetLink)
    {
        $this->targetLink = $targetLink;
    }

	/**
     * Set class
     *
     * @param string $class
     * @return WebNavigationTree
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set params
     *
     * @param string $params
     * @return WebNavigationTree
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
     * Set publish
     *
     * @param string $publish
     * @return WebNavigationTree
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
     * Set resource
     *
     * @param string $resource
     * @return WebContent
     */
    public function setResource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return string 
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebNavigationTree
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
     * @return WebNavigationTree
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
     * @return WebNavigationTree
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
     * @return WebNavigationTree
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
     * Set webPages
     *
     * @param \Contentinum\Entity\WebPagesParameter $webPages
     * @return WebNavigationTree
     */
    public function setWebPages(\Contentinum\Entity\WebPagesParameter $webPages = null)
    {
        $this->webPages = $webPages;

        return $this;
    }

    /**
     * Get webPages
     *
     * @return \Contentinum\Entity\WebPagesParameter 
     */
    public function getWebPages()
    {
        return $this->webPages;
    }
    
	/**
     * @return the $webNavigations
     */
    public function getWebNavigations()
    {
        return $this->webNavigations;
    }

	/**
     * @param \Contentinum\Entity\WebNavigations $webNavigations
     */
    public function setWebNavigations($webNavigations)
    {
        $this->webNavigations = $webNavigations;
    }

}
