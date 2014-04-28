<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * Addresses
 *
 * @ORM\Table(name="addresses")
 * @ORM\Entity
 */
class Addresses extends AbstractEntity
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
     * @ORM\Column(name="refer_id", type="integer", nullable=false)
     */
    private $referId;

    /**
     * @var string
     *
     * @ORM\Column(name="scope", type="string", length=50, nullable=false)
     */
    private $scope;

    /**
     * @var string
     *
     * @ORM\Column(name="address_type", type="string", length=25, nullable=false)
     */
    private $addressType = 'work';

    /**
     * @var string
     *
     * @ORM\Column(name="address_street", type="string", length=250, nullable=false)
     */
    private $addressStreet = '';

    /**
     * @var string
     *
     * @ORM\Column(name="address_further", type="text", nullable=false)
     */
    private $addressFurther = '';

    /**
     * @var string
     *
     * @ORM\Column(name="address_postbox", type="string", length=25, nullable=false)
     */
    private $addressPostbox = '';

    /**
     * @var string
     *
     * @ORM\Column(name="address_city", type="string", length=100, nullable=false)
     */
    private $addressCity = '';

    /**
     * @var string
     *
     * @ORM\Column(name="address_state", type="string", length=100, nullable=false)
     */
    private $addressState = '';

    /**
     * @var string
     *
     * @ORM\Column(name="address_postalcode", type="string", length=20, nullable=false)
     */
    private $addressPostalcode = '';

    /**
     * @var string
     *
     * @ORM\Column(name="address_postalcodebox", type="string", length=20, nullable=false)
     */
    private $addressPostalcodebox = '';

    /**
     * @var string
     *
     * @ORM\Column(name="address_country", type="string", length=255, nullable=false)
     */
    private $addressCountry = '';

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=false)
     */
    private $params = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted = '0';

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
     * @return Addresses
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
     * Set referId
     *
     * @param integer $referId
     * @return Addresses
     */
    public function setReferId($referId)
    {
        $this->referId = $referId;

        return $this;
    }

    /**
     * Get referId
     *
     * @return integer 
     */
    public function getReferId()
    {
        return $this->referId;
    }

    /**
     * Set scope
     *
     * @param string $scope
     * @return Addresses
     */
    public function setScope($scope)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope
     *
     * @return string 
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set addressType
     *
     * @param string $addressType
     * @return Addresses
     */
    public function setAddressType($addressType)
    {
        $this->addressType = $addressType;

        return $this;
    }

    /**
     * Get addressType
     *
     * @return string 
     */
    public function getAddressType()
    {
        return $this->addressType;
    }

    /**
     * Set addressStreet
     *
     * @param string $addressStreet
     * @return Addresses
     */
    public function setAddressStreet($addressStreet)
    {
        $this->addressStreet = $addressStreet;

        return $this;
    }

    /**
     * Get addressStreet
     *
     * @return string 
     */
    public function getAddressStreet()
    {
        return $this->addressStreet;
    }

    /**
     * Set addressFurther
     *
     * @param string $addressFurther
     * @return Addresses
     */
    public function setAddressFurther($addressFurther)
    {
        $this->addressFurther = $addressFurther;

        return $this;
    }

    /**
     * Get addressFurther
     *
     * @return string 
     */
    public function getAddressFurther()
    {
        return $this->addressFurther;
    }

    /**
     * Set addressPostbox
     *
     * @param string $addressPostbox
     * @return Addresses
     */
    public function setAddressPostbox($addressPostbox)
    {
        $this->addressPostbox = $addressPostbox;

        return $this;
    }

    /**
     * Get addressPostbox
     *
     * @return string 
     */
    public function getAddressPostbox()
    {
        return $this->addressPostbox;
    }

    /**
     * Set addressCity
     *
     * @param string $addressCity
     * @return Addresses
     */
    public function setAddressCity($addressCity)
    {
        $this->addressCity = $addressCity;

        return $this;
    }

    /**
     * Get addressCity
     *
     * @return string 
     */
    public function getAddressCity()
    {
        return $this->addressCity;
    }

    /**
     * Set addressState
     *
     * @param string $addressState
     * @return Addresses
     */
    public function setAddressState($addressState)
    {
        $this->addressState = $addressState;

        return $this;
    }

    /**
     * Get addressState
     *
     * @return string 
     */
    public function getAddressState()
    {
        return $this->addressState;
    }

    /**
     * Set addressPostalcode
     *
     * @param string $addressPostalcode
     * @return Addresses
     */
    public function setAddressPostalcode($addressPostalcode)
    {
        $this->addressPostalcode = $addressPostalcode;

        return $this;
    }

    /**
     * Get addressPostalcode
     *
     * @return string 
     */
    public function getAddressPostalcode()
    {
        return $this->addressPostalcode;
    }

    /**
     * Set addressPostalcodebox
     *
     * @param string $addressPostalcodebox
     * @return Addresses
     */
    public function setAddressPostalcodebox($addressPostalcodebox)
    {
        $this->addressPostalcodebox = $addressPostalcodebox;

        return $this;
    }

    /**
     * Get addressPostalcodebox
     *
     * @return string 
     */
    public function getAddressPostalcodebox()
    {
        return $this->addressPostalcodebox;
    }

    /**
     * Set addressCountry
     *
     * @param string $addressCountry
     * @return Addresses
     */
    public function setAddressCountry($addressCountry)
    {
        $this->addressCountry = $addressCountry;

        return $this;
    }

    /**
     * Get addressCountry
     *
     * @return string 
     */
    public function getAddressCountry()
    {
        return $this->addressCountry;
    }

    /**
     * Set params
     *
     * @param string $params
     * @return Addresses
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
     * Set deleted
     *
     * @param boolean $deleted
     * @return Addresses
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return Addresses
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
     * @return Addresses
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
     * @return Addresses
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
     * @return Addresses
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
