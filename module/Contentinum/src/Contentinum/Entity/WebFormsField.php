<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebFormsField
 *
 * @ORM\Table(name="web_forms_field", indexes={@ORM\Index(name="FORMSPARENT", columns={"web_forms_id"}), @ORM\Index(name="FORMSMEDIA", columns={"web_medias_id"})})
 * @ORM\Entity
 */
class WebFormsField extends AbstractEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="resource", type="string", length=50, nullable=false)
     */
    private $resource;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=250, nullable=false)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="field_typ", type="string", length=250, nullable=false)
     */
    private $fieldTyp;

    /**
     * @var string
     *
     * @ORM\Column(name="field_name", type="string", length=50, nullable=false)
     */
    private $fieldName;

    /**
     * @var string
     *
     * @ORM\Column(name="field_value", type="string", length=250, nullable=false)
     */
    private $fieldValue;

    /**
     * @var string
     *
     * @ORM\Column(name="field_required", type="string", length=250, nullable=false)
     */
    private $fieldRequired;

    /**
     * @var string
     *
     * @ORM\Column(name="attributes", type="text", length=65535, nullable=false)
     */
    private $attributes;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="select_options", type="text", length=65535, nullable=false)
     */
    private $selectOptions;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_rang", type="integer", nullable=false)
     */
    private $itemRang;

    /**
     * @var string
     *
     * @ORM\Column(name="publish", type="string", length=10, nullable=false)
     */
    private $publish;

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
     * @var \Contentinum\Entity\WebMedias
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\WebMedias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="web_medias_id", referencedColumnName="id")
     * })
     */
    private $webMedias;
    
    /**
     * @var \Contentinum\Entity\WebForms
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\WebForms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="web_forms_id", referencedColumnName="id")
     * })
     */
    private $webForms;    
    
    
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
     * @return Accounts
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
     * @return the $resource
     */
    public function getResource()
    {
        return $this->resource;
    }

	/**
     * @param string $resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
    }

	/**
     * @return the $label
     */
    public function getLabel()
    {
        return $this->label;
    }

	/**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

	/**
     * @return the $fieldTyp
     */
    public function getFieldTyp()
    {
        return $this->fieldTyp;
    }

	/**
     * @param string $fieldTyp
     */
    public function setFieldTyp($fieldTyp)
    {
        $this->fieldTyp = $fieldTyp;
    }

	/**
     * @return the $fieldName
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

	/**
     * @param string $fieldName
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;
    }

	/**
     * @return the $fieldValue
     */
    public function getFieldValue()
    {
        return $this->fieldValue;
    }

	/**
     * @param string $fieldValue
     */
    public function setFieldValue($fieldValue)
    {
        $this->fieldValue = $fieldValue;
    }

	/**
     * @return the $fieldRequired
     */
    public function getFieldRequired()
    {
        return $this->fieldRequired;
    }

	/**
     * @param string $fieldRequired
     */
    public function setFieldRequired($fieldRequired)
    {
        $this->fieldRequired = $fieldRequired;
    }

	/**
     * @return the $attributes
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

	/**
     * @param string $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

	/**
     * @return the $description
     */
    public function getDescription()
    {
        return $this->description;
    }

	/**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

	/**
     * @return the $selectOptions
     */
    public function getSelectOptions()
    {
        return $this->selectOptions;
    }

	/**
     * @param string $selectOptions
     */
    public function setSelectOptions($selectOptions)
    {
        $this->selectOptions = $selectOptions;
    }

	/**
     * @return the $itemRang
     */
    public function getItemRang()
    {
        return $this->itemRang;
    }

	/**
     * @param number $itemRang
     */
    public function setItemRang($itemRang)
    {
        $this->itemRang = $itemRang;
    }

	/**
     * @return the $publish
     */
    public function getPublish()
    {
        return $this->publish;
    }

	/**
     * @param string $publish
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;
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
     * @return the $webMedias
     */
    public function getWebMedias()
    {
        return $this->webMedias;
    }

	/**
     * @param \Contentinum\Entity\WebMedias $webMedias
     */
    public function setWebMedias($webMedias)
    {
        $this->webMedias = $webMedias;
    }

	/**
     * @return the $webForms
     */
    public function getWebForms()
    {
        return $this->webForms;
    }

	/**
     * @param \Contentinum\Entity\WebForms $webForms
     */
    public function setWebForms($webForms)
    {
        $this->webForms = $webForms;
    }
    


}

