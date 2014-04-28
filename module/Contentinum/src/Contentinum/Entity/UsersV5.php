<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * UsersV5
 *
 * @ORM\Table(name="users_v5", uniqueConstraints={@ORM\UniqueConstraint(name="USERNAME", columns={"login_username"})}, indexes={@ORM\Index(name="USERGROUPIDENT", columns={"user_groups_id"}), @ORM\Index(name="CONTACTLINK", columns={"contact_id"})})
 * @ORM\Entity
 */
class UsersV5 extends AbstractEntity
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
     * @var boolean
     *
     * @ORM\Column(name="user_types_id", type="boolean", nullable=false)
     */
    private $userTypesId = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="params", type="text", nullable=false)
     */
    private $params = '';

    /**
     * @var string
     *
     * @ORM\Column(name="return_path", type="string", length=200, nullable=false)
     */
    private $returnPath = '';

    /**
     * @var string
     *
     * @ORM\Column(name="apps", type="text", nullable=false)
     */
    private $apps = '';

    /**
     * @var boolean
     *
     * @ORM\Column(name="license", type="boolean", nullable=false)
     */
    private $license = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="salutation", type="string", length=5, nullable=false)
     */
    private $salutation = '';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150, nullable=false)
     */
    private $email = '';

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=25, nullable=false)
     */
    private $phone = '';

    /**
     * @var string
     *
     * @ORM\Column(name="initials", type="string", length=10, nullable=false)
     */
    private $initials = '';

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=6, nullable=false)
     */
    private $language = 'de';

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=50, nullable=false)
     */
    private $avatar = '';
    
    /**
     * @var string
     *
     * @ORM\Column(name="login_homedir", type="string", length=250, nullable=false)
     */    
    private $loginHomedir = '';

    /**
     * @var string
     *
     * @ORM\Column(name="login_username", type="string", length=150, nullable=false)
     */
    private $loginUsername;

    /**
     * @var string
     *
     * @ORM\Column(name="login_password", type="string", length=32, nullable=false)
     */
    private $loginPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="login_password_alt", type="string", length=32, nullable=false)
     */
    private $loginPasswordAlt = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="get_password", type="boolean", nullable=false)
     */
    private $getPassword = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="verify_string", type="string", length=32, nullable=false)
     */
    private $verifyString = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="user_verified", type="string", length=12, nullable=false)
     */
    private $userVerified = 'notverified';

    /**
     * @var integer
     *
     * @ORM\Column(name="try_login", type="integer", nullable=false)
     */
    private $tryLogin = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=false)
     */
    private $lastLogin = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_logout", type="datetime", nullable=false)
     */
    private $lastLogout = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="count_login", type="integer", nullable=false)
     */
    private $countLogin = '0';

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
    private $registerDate = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="up_date", type="datetime", nullable=false)
     */
    private $upDate = '0000-00-00 00:00:00';

    /**
     * @var \Contentinum\Entity\UserGroups
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\UserGroups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_groups_id", referencedColumnName="id")
     * })
     */
    private $userGroups;

    /**
     * @var \Contentinum\Entity\Contacts
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\Contacts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     * })
     */
    private $contact;

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
     * @return UsersV5
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
     * Set userTypesId
     *
     * @param boolean $userTypesId
     * @return UsersV5
     */
    public function setUserTypesId($userTypesId)
    {
        $this->userTypesId = $userTypesId;

        return $this;
    }

    /**
     * Get userTypesId
     *
     * @return boolean 
     */
    public function getUserTypesId()
    {
        return $this->userTypesId;
    }

    /**
     * Set params
     *
     * @param string $params
     * @return UsersV5
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
     * Set returnPath
     *
     * @param string $returnPath
     * @return UsersV5
     */
    public function setReturnPath($returnPath)
    {
        $this->returnPath = $returnPath;

        return $this;
    }

    /**
     * Get returnPath
     *
     * @return string 
     */
    public function getReturnPath()
    {
        return $this->returnPath;
    }

    /**
     * Set apps
     *
     * @param string $apps
     * @return UsersV5
     */
    public function setApps($apps)
    {
        $this->apps = $apps;

        return $this;
    }

    /**
     * Get apps
     *
     * @return string 
     */
    public function getApps()
    {
        return $this->apps;
    }

    /**
     * Set license
     *
     * @param boolean $license
     * @return UsersV5
     */
    public function setLicense($license)
    {
        $this->license = $license;

        return $this;
    }

    /**
     * Get license
     *
     * @return boolean 
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * Set salutation
     *
     * @param string $salutation
     * @return UsersV5
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
     * Set name
     *
     * @param string $name
     * @return UsersV5
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
     * Set email
     *
     * @param string $email
     * @return UsersV5
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return UsersV5
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set initials
     *
     * @param string $initials
     * @return UsersV5
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;

        return $this;
    }

    /**
     * Get initials
     *
     * @return string 
     */
    public function getInitials()
    {
        return $this->initials;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return UsersV5
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return UsersV5
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
    
    
    /**
     * Set users home dir
     * 
     * @param string $loginHomedir
     * @return UsersV5
     */
    public function setLoginHomedir($loginHomedir) 
    {
    	$this->loginHomedir = $loginHomedir;
    	return $this;
    }    

    /**
     * Get users home dir
     * 
	 * @return the $loginHomedir
	 */
	public function getLoginHomedir() 
	{
		return $this->loginHomedir;
	}

	/**
     * Set loginUsername
     *
     * @param string $loginUsername
     * @return UsersV5
     */
    public function setLoginUsername($loginUsername)
    {
        $this->loginUsername = $loginUsername;

        return $this;
    }

    /**
     * Get loginUsername
     *
     * @return string 
     */
    public function getLoginUsername()
    {
        return $this->loginUsername;
    }

    /**
     * Set loginPassword
     *
     * @param string $loginPassword
     * @return UsersV5
     */
    public function setLoginPassword($loginPassword)
    {
        $this->loginPassword = $loginPassword;

        return $this;
    }

    /**
     * Get loginPassword
     *
     * @return string 
     */
    public function getLoginPassword()
    {
        return $this->loginPassword;
    }

    /**
     * Set loginPasswordAlt
     *
     * @param string $loginPasswordAlt
     * @return UsersV5
     */
    public function setLoginPasswordAlt($loginPasswordAlt)
    {
        $this->loginPasswordAlt = $loginPasswordAlt;

        return $this;
    }

    /**
     * Get loginPasswordAlt
     *
     * @return string 
     */
    public function getLoginPasswordAlt()
    {
        return $this->loginPasswordAlt;
    }

    /**
     * Set getPassword
     *
     * @param boolean $getPassword
     * @return UsersV5
     */
    public function setGetPassword($getPassword)
    {
        $this->getPassword = $getPassword;

        return $this;
    }

    /**
     * Get getPassword
     *
     * @return boolean 
     */
    public function getGetPassword()
    {
        return $this->getPassword;
    }

    /**
     * Set verifyString
     *
     * @param string $verifyString
     * @return UsersV5
     */
    public function setVerifyString($verifyString)
    {
        $this->verifyString = $verifyString;

        return $this;
    }

    /**
     * Get verifyString
     *
     * @return string 
     */
    public function getVerifyString()
    {
        return $this->verifyString;
    }

    /**
     * Set userVerified
     *
     * @param string $userVerified
     * @return UsersV5
     */
    public function setUserVerified($userVerified)
    {
        $this->userVerified = $userVerified;

        return $this;
    }

    /**
     * Get userVerified
     *
     * @return string 
     */
    public function getUserVerified()
    {
        return $this->userVerified;
    }

    /**
     * Set tryLogin
     *
     * @param integer $tryLogin
     * @return UsersV5
     */
    public function setTryLogin($tryLogin)
    {
        $this->tryLogin = $tryLogin;

        return $this;
    }

    /**
     * Get tryLogin
     *
     * @return integer 
     */
    public function getTryLogin()
    {
        return $this->tryLogin;
    }

    /**
     * Set lastLogin
     *
     * @param \DateTime $lastLogin
     * @return UsersV5
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin
     *
     * @return \DateTime 
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set lastLogout
     *
     * @param \DateTime $lastLogout
     * @return UsersV5
     */
    public function setLastLogout($lastLogout)
    {
        $this->lastLogout = $lastLogout;

        return $this;
    }

    /**
     * Get lastLogout
     *
     * @return \DateTime 
     */
    public function getLastLogout()
    {
        return $this->lastLogout;
    }

    /**
     * Set countLogin
     *
     * @param integer $countLogin
     * @return UsersV5
     */
    public function setCountLogin($countLogin)
    {
        $this->countLogin = $countLogin;

        return $this;
    }

    /**
     * Get countLogin
     *
     * @return integer 
     */
    public function getCountLogin()
    {
        return $this->countLogin;
    }

    /**
     * Set publish
     *
     * @param string $publish
     * @return UsersV5
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
     * @return UsersV5
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
     * @return UsersV5
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
     * @return UsersV5
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
     * @return UsersV5
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
     * @return UsersV5
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
     * Set userGroups
     *
     * @param \Contentinum\Entity\UserGroups $userGroups
     * @return UsersV5
     */
    public function setUserGroups(\Contentinum\Entity\UserGroups $userGroups = null)
    {
        $this->userGroups = $userGroups;

        return $this;
    }

    /**
     * Get userGroups
     *
     * @return \Contentinum\Entity\UserGroups 
     */
    public function getUserGroups()
    {
        return $this->userGroups;
    }

    /**
     * Set contact
     *
     * @param \Contentinum\Entity\Contacts $contact
     * @return UsersV5
     */
    public function setContact(\Contentinum\Entity\Contacts $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \Contentinum\Entity\Contacts 
     */
    public function getContact()
    {
        return $this->contact;
    }
}
