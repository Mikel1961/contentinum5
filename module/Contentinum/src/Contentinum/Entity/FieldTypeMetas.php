<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * FieldTypeMetas
 *
 * @ORM\Table(name="field_type_metas")
 * @ORM\Entity
 */
class FieldTypeMetas extends AbstractEntity 
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="datascope", type="string", length=60, nullable=false)
     */
    private $datascope;

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=false)
     */
    private $params = '';

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
     * @var \Contentinum\Entity\FieldTypes
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Contentinum\Entity\FieldTypes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="field_types_id", referencedColumnName="id")
     * })
     */
    private $fieldTypes;



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
     * @see \Contentinum\Entity\AbstractEntity::getEntityName()
     */
    public function getEntityName()
    {
    	return get_class($this);
    
    }
    
    /**
     * (non-PHPdoc)
     * @see \Contentinum\Entity\AbstractEntity::getProperties()
     */
    public function getProperties()
    {
    	return get_object_vars($this);
    }
    
    
    /** (non-PHPdoc)
     * @see \Contentinum\Entity\AbstractEntity::getPrimaryKey()
     */
    public function getPrimaryKey()
    {
    	return 'id';
    
    }
    
    /** (non-PHPdoc)
     * @see \Contentinum\Entity\AbstractEntity::getPrimaryProperty()
     */
    public function getPrimaryValue()
    {
    	return $this->id;
    
    }    
    
    
    /**
     * Set id
     *
     * @param integer $id
     * @return FieldTypeMetas
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
     * Set name
     *
     * @param string $name
     * @return FieldTypeMetas
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set datascope
     *
     * @param string $datascope
     * @return FieldTypeMetas
     */
    public function setDatascope($datascope)
    {
        $this->datascope = $datascope;
    
        return $this;
    }

    /**
     * Get datascope
     *
     * @return string 
     */
    public function getDatascope()
    {
        return $this->datascope;
    }

    /**
     * Set params
     *
     * @param string $params
     * @return FieldTypeMetas
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
     * Set createdBy
     *
     * @param integer $createdBy
     * @return FieldTypeMetas
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
     * @return FieldTypeMetas
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
     * @return FieldTypeMetas
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
     * @return FieldTypeMetas
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
     * Set fieldTypes
     *
     * @param \Contentinum\Entity\FieldTypes $fieldTypes
     * @return FieldTypeMetas
     */
    public function setFieldTypes(\Contentinum\Entity\FieldTypes $fieldTypes)
    {
        $this->fieldTypes = $fieldTypes;
    
        return $this;
    }

    /**
     * Get fieldTypes
     *
     * @return \Mcwork\Entity\FieldTypes 
     */
    public function getFieldTypes()
    {
        return $this->fieldTypes;
    }
}