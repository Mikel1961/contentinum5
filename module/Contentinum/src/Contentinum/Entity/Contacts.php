<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * Contacts
 *
 * @ORM\Table(name="contacts", indexes={@ORM\Index(name="ACCOUNTIDENT", columns={"account_ident"}), @ORM\Index(name="CONTACTNAME", columns={"last_name"}), @ORM\Index(name="ACCOUNTSCOPE", columns={"accounts_id"})})
 * @ORM\Entity
 */
class Contacts extends AbstractEntity
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
     * @ORM\Column(name="account_ident", type="string", length=36, nullable=false)
     */
    private $accountIdent = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="fieldmeta_id", type="integer", nullable=false)
     */
    private $fieldmetaId = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=5, nullable=false)
     */
    private $title = '';

    /**
     * @var string
     *
     * @ORM\Column(name="salutation", type="string", length=10, nullable=false)
     */
    private $salutation = '';

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=100, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="business_title", type="string", length=100, nullable=false)
     */
    private $businessTitle = '';

    /**
     * @var string
     *
     * @ORM\Column(name="department", type="string", length=255, nullable=false)
     */
    private $department = '';

    /**
     * @var string
     *
     * @ORM\Column(name="phone_home", type="string", length=25, nullable=false)
     */
    private $phoneHome = '';

    /**
     * @var string
     *
     * @ORM\Column(name="phone_mobile", type="string", length=25, nullable=false)
     */
    private $phoneMobile = '';

    /**
     * @var string
     *
     * @ORM\Column(name="phone_work", type="string", length=25, nullable=false)
     */
    private $phoneWork = '';

    /**
     * @var string
     *
     * @ORM\Column(name="phone_other", type="string", length=25, nullable=false)
     */
    private $phoneOther = '';

    /**
     * @var string
     *
     * @ORM\Column(name="phone_fax", type="string", length=25, nullable=false)
     */
    private $phoneFax = '';

    /**
     * @var string
     *
     * @ORM\Column(name="contact_email", type="string", length=100, nullable=false)
     */
    private $contactEmail = '';

    /**
     * @var string
     *
     * @ORM\Column(name="contact_chat", type="string", length=100, nullable=false)
     */
    private $contactChat = '';

    /**
     * @var string
     *
     * @ORM\Column(name="contact_img_source", type="string", length=250, nullable=false)
     */
    private $contactImgSource = '';

    /**
     * @var string
     *
     * @ORM\Column(name="contact_img_large", type="string", length=250, nullable=false)
     */
    private $contactImgLarge = '';

    /**
     * @var string
     *
     * @ORM\Column(name="publish", type="string", length=10, nullable=false)
     */
    private $publish = 'no';

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
     * @var \Contentinum\Entity\Accounts
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\Accounts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="accounts_id", referencedColumnName="id")
     * })
     */
    private $accounts;

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
     * @return Contacts
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
     * Set accountIdent
     *
     * @param string $accountIdent
     * @return Contacts
     */
    public function setAccountIdent($accountIdent)
    {
        $this->accountIdent = $accountIdent;

        return $this;
    }

    /**
     * Get accountIdent
     *
     * @return string 
     */
    public function getAccountIdent()
    {
        return $this->accountIdent;
    }

    /**
     * Set fieldmetaId
     *
     * @param integer $fieldmetaId
     * @return Contacts
     */
    public function setFieldmetaId($fieldmetaId)
    {
        $this->fieldmetaId = $fieldmetaId;

        return $this;
    }

    /**
     * Get fieldmetaId
     *
     * @return integer 
     */
    public function getFieldmetaId()
    {
        return $this->fieldmetaId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Contacts
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
     * Set salutation
     *
     * @param string $salutation
     * @return Contacts
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;

        return $this;
    }

    /**
     * Get salutation
     *
     * @return string 
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Contacts
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Contacts
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set businessTitle
     *
     * @param string $businessTitle
     * @return Contacts
     */
    public function setBusinessTitle($businessTitle)
    {
        $this->businessTitle = $businessTitle;

        return $this;
    }

    /**
     * Get businessTitle
     *
     * @return string 
     */
    public function getBusinessTitle()
    {
        return $this->businessTitle;
    }

    /**
     * Set department
     *
     * @param string $department
     * @return Contacts
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return string 
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set phoneHome
     *
     * @param string $phoneHome
     * @return Contacts
     */
    public function setPhoneHome($phoneHome)
    {
        $this->phoneHome = $phoneHome;

        return $this;
    }

    /**
     * Get phoneHome
     *
     * @return string 
     */
    public function getPhoneHome()
    {
        return $this->phoneHome;
    }

    /**
     * Set phoneMobile
     *
     * @param string $phoneMobile
     * @return Contacts
     */
    public function setPhoneMobile($phoneMobile)
    {
        $this->phoneMobile = $phoneMobile;

        return $this;
    }

    /**
     * Get phoneMobile
     *
     * @return string 
     */
    public function getPhoneMobile()
    {
        return $this->phoneMobile;
    }

    /**
     * Set phoneWork
     *
     * @param string $phoneWork
     * @return Contacts
     */
    public function setPhoneWork($phoneWork)
    {
        $this->phoneWork = $phoneWork;

        return $this;
    }

    /**
     * Get phoneWork
     *
     * @return string 
     */
    public function getPhoneWork()
    {
        return $this->phoneWork;
    }

    /**
     * Set phoneOther
     *
     * @param string $phoneOther
     * @return Contacts
     */
    public function setPhoneOther($phoneOther)
    {
        $this->phoneOther = $phoneOther;

        return $this;
    }

    /**
     * Get phoneOther
     *
     * @return string 
     */
    public function getPhoneOther()
    {
        return $this->phoneOther;
    }

    /**
     * Set phoneFax
     *
     * @param string $phoneFax
     * @return Contacts
     */
    public function setPhoneFax($phoneFax)
    {
        $this->phoneFax = $phoneFax;

        return $this;
    }

    /**
     * Get phoneFax
     *
     * @return string 
     */
    public function getPhoneFax()
    {
        return $this->phoneFax;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     * @return Contacts
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string 
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set contactChat
     *
     * @param string $contactChat
     * @return Contacts
     */
    public function setContactChat($contactChat)
    {
        $this->contactChat = $contactChat;

        return $this;
    }

    /**
     * Get contactChat
     *
     * @return string 
     */
    public function getContactChat()
    {
        return $this->contactChat;
    }

    /**
     * Set contactImgSource
     *
     * @param string $contactImgSource
     * @return Contacts
     */
    public function setContactImgSource($contactImgSource)
    {
        $this->contactImgSource = $contactImgSource;

        return $this;
    }

    /**
     * Get contactImgSource
     *
     * @return string 
     */
    public function getContactImgSource()
    {
        return $this->contactImgSource;
    }

    /**
     * Set contactImgLarge
     *
     * @param string $contactImgLarge
     * @return Contacts
     */
    public function setContactImgLarge($contactImgLarge)
    {
        $this->contactImgLarge = $contactImgLarge;

        return $this;
    }

    /**
     * Get contactImgLarge
     *
     * @return string 
     */
    public function getContactImgLarge()
    {
        return $this->contactImgLarge;
    }


    /**
     * Set publish
     *
     * @param string $publish
     * @return Contacts
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
     * Set deleted
     *
     * @param boolean $deleted
     * @return Contacts
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
     * @return Contacts
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
     * @return Contacts
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
     * @return Contacts
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
     * @return Contacts
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
     * Set accounts
     *
     * @param \Contentinum\Entity\Accounts $accounts
     * @return Contacts
     */
    public function setAccounts(\Contentinum\Entity\Accounts $accounts = null)
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * Get accounts
     *
     * @return \Contentinum\Entity\Accounts 
     */
    public function getAccounts()
    {
        return $this->accounts;
    }
}
