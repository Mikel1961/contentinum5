<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebFormsField
 *
 * @ORM\Table(name="web_forms_field", indexes={@ORM\Index(name="FORMREF", columns={"web_forms_id"})})
 * @ORM\Entity
 */
class WebFormsField extends AbstractEntity
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
     * @ORM\Column(name="label", type="string", length=250, nullable=false)
     */
    private $label = '';

    /**
     * @var string
     *
     * @ORM\Column(name="fieldtyp", type="string", length=12, nullable=false)
     */
    private $fieldtyp = 'input';

    /**
     * @var string
     *
     * @ORM\Column(name="fieldname", type="string", length=50, nullable=false)
     */
    private $fieldname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="fieldvalue", type="string", length=250, nullable=false)
     */
    private $fieldvalue = '';

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=10, nullable=false)
     */
    private $size = '';

    /**
     * @var string
     *
     * @ORM\Column(name="maxlength", type="string", length=10, nullable=false)
     */
    private $maxlength = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description = '';

    /**
     * @var string
     *
     * @ORM\Column(name="select_options", type="text", nullable=false)
     */
    private $selectOptions = '';

    /**
     * @var string
     *
     * @ORM\Column(name="images", type="string", length=250, nullable=false)
     */
    private $images = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="item_rang", type="integer", nullable=false)
     */
    private $itemRang = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=8, nullable=false)
     */
    private $status = 'no';

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
    private $createdBy = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="update_by", type="integer", nullable=false)
     */
    private $updateBy = 0;

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
     * @return WebFormsField
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
     * Set label
     *
     * @param string $label
     * @return WebFormsField
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string 
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set fieldtyp
     *
     * @param string $fieldtyp
     * @return WebFormsField
     */
    public function setFieldtyp($fieldtyp)
    {
        $this->fieldtyp = $fieldtyp;

        return $this;
    }

    /**
     * Get fieldtyp
     *
     * @return string 
     */
    public function getFieldtyp()
    {
        return $this->fieldtyp;
    }

    /**
     * Set fieldname
     *
     * @param string $fieldname
     * @return WebFormsField
     */
    public function setFieldname($fieldname)
    {
        $this->fieldname = $fieldname;

        return $this;
    }

    /**
     * Get fieldname
     *
     * @return string 
     */
    public function getFieldname()
    {
        return $this->fieldname;
    }

    /**
     * Set fieldvalue
     *
     * @param string $fieldvalue
     * @return WebFormsField
     */
    public function setFieldvalue($fieldvalue)
    {
        $this->fieldvalue = $fieldvalue;

        return $this;
    }

    /**
     * Get fieldvalue
     *
     * @return string 
     */
    public function getFieldvalue()
    {
        return $this->fieldvalue;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return WebFormsField
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set maxlength
     *
     * @param string $maxlength
     * @return WebFormsField
     */
    public function setMaxlength($maxlength)
    {
        $this->maxlength = $maxlength;

        return $this;
    }

    /**
     * Get maxlength
     *
     * @return string 
     */
    public function getMaxlength()
    {
        return $this->maxlength;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return WebFormsField
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set selectOptions
     *
     * @param string $selectOptions
     * @return WebFormsField
     */
    public function setSelectOptions($selectOptions)
    {
        $this->selectOptions = $selectOptions;

        return $this;
    }

    /**
     * Get selectOptions
     *
     * @return string 
     */
    public function getSelectOptions()
    {
        return $this->selectOptions;
    }

    /**
     * Set images
     *
     * @param string $images
     * @return WebFormsField
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return string 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set itemRang
     *
     * @param integer $itemRang
     * @return WebFormsField
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
     * Set status
     *
     * @param string $status
     * @return WebFormsField
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set publish
     *
     * @param string $publish
     * @return WebFormsField
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
     * @return WebFormsField
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
     * @return WebFormsField
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
     * @return WebFormsField
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
     * @return WebFormsField
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
     * Set webForms
     *
     * @param \Contentinum\Entity\WebForms $webForms
     * @return WebFormsField
     */
    public function setWebForms(\Contentinum\Entity\WebForms $webForms = null)
    {
        $this->webForms = $webForms;

        return $this;
    }

    /**
     * Get webForms
     *
     * @return \Contentinum\Entity\WebForms 
     */
    public function getWebForms()
    {
        return $this->webForms;
    }
}
