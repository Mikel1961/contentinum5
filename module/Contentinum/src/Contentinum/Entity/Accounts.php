<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * Accounts
 *
 * @ORM\Table(name="accounts")
 * @ORM\Entity
 */
class Accounts extends AbstractEntity
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
     * @var integer
     *
     * @ORM\Column(name="addresses_id", type="integer", nullable=false)
     */
    private $addressesId;

    /**
     * @var string
     *
     * @ORM\Column(name="account_id", type="string", length=36, nullable=false)
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="parent_id", type="string", length=36, nullable=false)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="account_name", type="string", length=250, nullable=false)
     */
    private $accountName;

    /**
     * @var string
     *
     * @ORM\Column(name="organisation", type="string", length=255, nullable=false)
     */
    private $organisation;

    /**
     * @var string
     *
     * @ORM\Column(name="organisation_ext", type="string", length=250, nullable=false)
     */
    private $organisationExt;

    /**
     * @var string
     *
     * @ORM\Column(name="organisation_scope", type="string", length=250, nullable=false)
     */
    private $organisationScope;

    /**
     * @var string
     *
     * @ORM\Column(name="img_logo", type="string", length=250, nullable=false)
     */
    private $imgLogo;

    /**
     * @var string
     *
     * @ORM\Column(name="img_source", type="string", length=250, nullable=false)
     */
    private $imgSource;

    /**
     * @var string
     *
     * @ORM\Column(name="img_large", type="string", length=250, nullable=false)
     */
    private $imgLarge;

    /**
     * @var string
     *
     * @ORM\Column(name="account_fax", type="string", length=25, nullable=false)
     */
    private $accountFax;

    /**
     * @var string
     *
     * @ORM\Column(name="account_phone", type="string", length=25, nullable=false)
     */
    private $accountPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_alternate", type="string", length=25, nullable=false)
     */
    private $phoneAlternate;

    /**
     * @var string
     *
     * @ORM\Column(name="account_email", type="string", length=100, nullable=false)
     */
    private $accountEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="basedir", type="string", length=500, nullable=false)
     */
    private $basedir;

    /**
     * @var string
     *
     * @ORM\Column(name="internet", type="string", length=250, nullable=false)
     */
    private $internet;

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=false)
     */
    private $params;

    /**
     * @var string
     *
     * @ORM\Column(name="publish", type="string", length=10, nullable=false)
     */
    private $publish;

    /**
     * @var integer
     *
     * @ORM\Column(name="webentry", type="integer", nullable=false)
     */
    private $webentry;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted;

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
     * @var \Contentinum\Entity\FieldTypeMetas
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\FieldTypeMetas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="field_metas_id", referencedColumnName="id")
     * })
     */
    private $fieldMetas;

    
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set addressesId
     *
     * @param integer $addressesId
     * @return Accounts
     */
    public function setAddressesId($addressesId)
    {
        $this->addressesId = $addressesId;
    
        return $this;
    }

    /**
     * Get addressesId
     *
     * @return integer 
     */
    public function getAddressesId()
    {
        return $this->addressesId;
    }

    /**
     * Set accountId
     *
     * @param string $accountId
     * @return Accounts
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
    
        return $this;
    }

    /**
     * Get accountId
     *
     * @return string 
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set parentId
     *
     * @param string $parentId
     * @return Accounts
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    
        return $this;
    }

    /**
     * Get parentId
     *
     * @return string 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set accountName
     *
     * @param string $accountName
     * @return Accounts
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;
    
        return $this;
    }

    /**
     * Get accountName
     *
     * @return string 
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * Set organisation
     *
     * @param string $organisation
     * @return Accounts
     */
    public function setOrganisation($organisation)
    {
        $this->organisation = $organisation;
    
        return $this;
    }

    /**
     * Get organisation
     *
     * @return string 
     */
    public function getOrganisation()
    {
        return $this->organisation;
    }

    /**
     * Set organisationExt
     *
     * @param string $organisationExt
     * @return Accounts
     */
    public function setOrganisationExt($organisationExt)
    {
        $this->organisationExt = $organisationExt;
    
        return $this;
    }

    /**
     * Get organisationExt
     *
     * @return string 
     */
    public function getOrganisationExt()
    {
        return $this->organisationExt;
    }

    /**
     * Set organisationScope
     *
     * @param string $organisationScope
     * @return Accounts
     */
    public function setOrganisationScope($organisationScope)
    {
        $this->organisationScope = $organisationScope;
    
        return $this;
    }

    /**
     * Get organisationScope
     *
     * @return string 
     */
    public function getOrganisationScope()
    {
        return $this->organisationScope;
    }

    /**
     * Set imgLogo
     *
     * @param string $imgLogo
     * @return Accounts
     */
    public function setImgLogo($imgLogo)
    {
        $this->imgLogo = $imgLogo;
    
        return $this;
    }

    /**
     * Get imgLogo
     *
     * @return string 
     */
    public function getImgLogo()
    {
        return $this->imgLogo;
    }

    /**
     * Set imgSource
     *
     * @param string $imgSource
     * @return Accounts
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
     * Set imgLarge
     *
     * @param string $imgLarge
     * @return Accounts
     */
    public function setImgLarge($imgLarge)
    {
        $this->imgLarge = $imgLarge;
    
        return $this;
    }

    /**
     * Get imgLarge
     *
     * @return string 
     */
    public function getImgLarge()
    {
        return $this->imgLarge;
    }

    /**
     * Set accountFax
     *
     * @param string $accountFax
     * @return Accounts
     */
    public function setAccountFax($accountFax)
    {
        $this->accountFax = $accountFax;
    
        return $this;
    }

    /**
     * Get accountFax
     *
     * @return string 
     */
    public function getAccountFax()
    {
        return $this->accountFax;
    }

    /**
     * Set accountPhone
     *
     * @param string $accountPhone
     * @return Accounts
     */
    public function setAccountPhone($accountPhone)
    {
        $this->accountPhone = $accountPhone;
    
        return $this;
    }

    /**
     * Get accountPhone
     *
     * @return string 
     */
    public function getAccountPhone()
    {
        return $this->accountPhone;
    }

    /**
     * Set phoneAlternate
     *
     * @param string $phoneAlternate
     * @return Accounts
     */
    public function setPhoneAlternate($phoneAlternate)
    {
        $this->phoneAlternate = $phoneAlternate;
    
        return $this;
    }

    /**
     * Get phoneAlternate
     *
     * @return string 
     */
    public function getPhoneAlternate()
    {
        return $this->phoneAlternate;
    }

    /**
     * Set accountEmail
     *
     * @param string $accountEmail
     * @return Accounts
     */
    public function setAccountEmail($accountEmail)
    {
        $this->accountEmail = $accountEmail;
    
        return $this;
    }

    /**
     * Get accountEmail
     *
     * @return string 
     */
    public function getAccountEmail()
    {
        return $this->accountEmail;
    }

    /**
     * Set basedir
     *
     * @param string $basedir
     * @return Accounts
     */
    public function setBasedir($basedir)
    {
        $this->basedir = $basedir;
    
        return $this;
    }

    /**
     * Get basedir
     *
     * @return string 
     */
    public function getBasedir()
    {
        return $this->basedir;
    }

    /**
     * Set internet
     *
     * @param string $internet
     * @return Accounts
     */
    public function setInternet($internet)
    {
        $this->internet = $internet;
    
        return $this;
    }

    /**
     * Get internet
     *
     * @return string 
     */
    public function getInternet()
    {
        return $this->internet;
    }

    /**
     * Set params
     *
     * @param string $params
     * @return Accounts
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
     * @return Accounts
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
     * Set webentry
     *
     * @param integer $webentry
     * @return Accounts
     */
    public function setWebentry($webentry)
    {
        $this->webentry = $webentry;
    
        return $this;
    }

    /**
     * Get webentry
     *
     * @return integer 
     */
    public function getWebentry()
    {
        return $this->webentry;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Accounts
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
     * @return Accounts
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
     * @return Accounts
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
     * @return Accounts
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
     * @return Accounts
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
     * Set fieldMetas
     *
     * @param \Contentinum\Entity\FieldTypeMetas $fieldMetas
     * @return Accounts
     */
    public function setFieldMetas(\Contentinum\Entity\FieldTypeMetas $fieldMetas = null)
    {
        $this->fieldMetas = $fieldMetas;
    
        return $this;
    }

    /**
     * Get fieldMetas
     *
     * @return \Mcwork\Entity\FieldTypeMetas 
     */
    public function getFieldMetas()
    {
        return $this->fieldMetas;
    }
}