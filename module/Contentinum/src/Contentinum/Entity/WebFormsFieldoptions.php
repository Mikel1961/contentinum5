<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebFormsFieldoptions
 *
 * @ORM\Table(name="web_forms_fieldoptions", indexes={@ORM\Index(name="FORMFIELDREF", columns={"form_field_id"})})
 * @ORM\Entity
 */
class WebFormsFieldoptions extends AbstractEntity
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
     * @ORM\Column(name="option_group", type="string", length=250, nullable=false)
     */
    private $optionGroup = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="option_value", type="string", length=250, nullable=false)
     */
    private $optionValue = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="option_label", type="string", length=250, nullable=false)
     */
    private $optionLabel = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="option_labeltitle", type="string", length=250, nullable=false)
     */
    private $optionLabeltitle = ' ';

    /**
     * @var string
     *
     * @ORM\Column(name="img_source", type="string", length=250, nullable=false)
     */
    private $imgSource = ' ';

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
     * @var \Contentinum\Entity\WebFormsField
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\WebFormsField")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="form_field_id", referencedColumnName="id")
     * })
     */
    private $formField;

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
     * @return WebFormsFieldoptions
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
     * Set optionGroup
     *
     * @param string $optionGroup
     * @return WebFormsFieldoptions
     */
    public function setOptionGroup($optionGroup)
    {
        $this->optionGroup = $optionGroup;

        return $this;
    }

    /**
     * Get optionGroup
     *
     * @return string 
     */
    public function getOptionGroup()
    {
        return $this->optionGroup;
    }

    /**
     * Set optionValue
     *
     * @param string $optionValue
     * @return WebFormsFieldoptions
     */
    public function setOptionValue($optionValue)
    {
        $this->optionValue = $optionValue;

        return $this;
    }

    /**
     * Get optionValue
     *
     * @return string 
     */
    public function getOptionValue()
    {
        return $this->optionValue;
    }

    /**
     * Set optionLabel
     *
     * @param string $optionLabel
     * @return WebFormsFieldoptions
     */
    public function setOptionLabel($optionLabel)
    {
        $this->optionLabel = $optionLabel;

        return $this;
    }

    /**
     * Get optionLabel
     *
     * @return string 
     */
    public function getOptionLabel()
    {
        return $this->optionLabel;
    }

    /**
     * Set optionLabeltitle
     *
     * @param string $optionLabeltitle
     * @return WebFormsFieldoptions
     */
    public function setOptionLabeltitle($optionLabeltitle)
    {
        $this->optionLabeltitle = $optionLabeltitle;

        return $this;
    }

    /**
     * Get optionLabeltitle
     *
     * @return string 
     */
    public function getOptionLabeltitle()
    {
        return $this->optionLabeltitle;
    }

    /**
     * Set imgSource
     *
     * @param string $imgSource
     * @return WebFormsFieldoptions
     */
    public function setImgSource($imgSource)
    {
        $this->imgSource = $imgSource;

        return $this;
    }

    /**
     * Get imgSource
     *
     * @return string 
     */
    public function getImgSource()
    {
        return $this->imgSource;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebFormsFieldoptions
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
     * @return WebFormsFieldoptions
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
     * @return WebFormsFieldoptions
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
     * @return WebFormsFieldoptions
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
     * Set formField
     *
     * @param \Contentinum\Entity\WebFormsField $formField
     * @return WebFormsFieldoptions
     */
    public function setFormField(\Contentinum\Entity\WebFormsField $formField = null)
    {
        $this->formField = $formField;

        return $this;
    }

    /**
     * Get formField
     *
     * @return \Contentinum\Entity\WebFormsField 
     */
    public function getFormField()
    {
        return $this->formField;
    }
}
