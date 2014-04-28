<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebNavigations
 *
 * @ORM\Table(name="web_navigations", uniqueConstraints={@ORM\UniqueConstraint(name="NAVIGATION", columns={"tree_ident"})})
 * @ORM\Entity
 */
class WebNavigations extends AbstractEntity
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
     * @ORM\Column(name="tree_ident", type="string", length=250, nullable=false)
     */
    private $treeIdent;

    /**
     * @var string
     *
     * @ORM\Column(name="tpl_assign", type="string", length=25, nullable=false)
     */
    private $tplAssign = '';

    /**
     * @var string
     *
     * @ORM\Column(name="menue", type="string", length=3, nullable=false)
     */
    private $menue;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=150, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="headline", type="string", length=80, nullable=false)
     */
    private $headline = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=2, nullable=false)
     */
    private $tags = '';

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
     * @return WebContent
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
     * Set treeIdent
     *
     * @param string $treeIdent
     * @return WebNavigations
     */
    public function setTreeIdent($treeIdent)
    {
        $this->treeIdent = $treeIdent;

        return $this;
    }

    /**
     * Get treeIdent
     *
     * @return string 
     */
    public function getTreeIdent()
    {
        return $this->treeIdent;
    }

    /**
     * Set tplAssign
     *
     * @param string $tplAssign
     * @return WebNavigations
     */
    public function setTplAssign($tplAssign)
    {
        $this->tplAssign = $tplAssign;

        return $this;
    }

    /**
     * Get tplAssign
     *
     * @return string 
     */
    public function getTplAssign()
    {
        return $this->tplAssign;
    }

    /**
     * Set menue
     *
     * @param string $menue
     * @return WebNavigations
     */
    public function setMenue($menue)
    {
        $this->menue = $menue;

        return $this;
    }

    /**
     * Get menue
     *
     * @return string 
     */
    public function getMenue()
    {
        return $this->menue;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return WebNavigations
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set headline
     *
     * @param string $headline
     * @return WebNavigations
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return WebNavigations
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set params
     *
     * @param string $params
     * @return WebNavigations
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
     * @return WebNavigations
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebNavigations
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
     * @return WebNavigations
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
     * @return WebNavigations
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
     * @return WebNavigations
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
