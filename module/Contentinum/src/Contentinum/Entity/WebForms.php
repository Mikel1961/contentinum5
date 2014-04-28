<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebForms
 *
 * @ORM\Table(name="web_forms")
 * @ORM\Entity
 */
class WebForms extends AbstractEntity
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
     * @ORM\Column(name="headline", type="string", length=250, nullable=false)
     */
    private $headline;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=2, nullable=false)
     */
    private $tags = 'h2';

    /**
     * @var string
     *
     * @ORM\Column(name="subheadline", type="string", length=250, nullable=false)
     */
    private $subheadline = '';

    /**
     * @var string
     *
     * @ORM\Column(name="script", type="string", length=250, nullable=false)
     */
    private $script = '';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description = '';

    /**
     * @var string
     *
     * @ORM\Column(name="responsetext", type="text", nullable=false)
     */
    private $responsetext = '';

    /**
     * @var string
     *
     * @ORM\Column(name="emailsubject", type="string", length=250, nullable=false)
     */
    private $emailsubject;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="emailname", type="string", length=250, nullable=false)
     */
    private $emailname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="emailcc", type="string", length=250, nullable=false)
     */
    private $emailcc = '';

    /**
     * @var string
     *
     * @ORM\Column(name="replayemail", type="string", length=100, nullable=false)
     */
    private $replayemail = '';

    /**
     * @var string
     *
     * @ORM\Column(name="replayname", type="string", length=60, nullable=false)
     */
    private $replayname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="emailtext", type="text", nullable=false)
     */
    private $emailtext = '';

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
     * @return WebForms
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
     * Set headline
     *
     * @param string $headline
     * @return WebForms
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
     * @return WebForms
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
     * Set subheadline
     *
     * @param string $subheadline
     * @return WebForms
     */
    public function setSubheadline($subheadline)
    {
        $this->subheadline = $subheadline;

        return $this;
    }

    /**
     * Get subheadline
     *
     * @return string 
     */
    public function getSubheadline()
    {
        return $this->subheadline;
    }

    /**
     * Set script
     *
     * @param string $script
     * @return WebForms
     */
    public function setScript($script)
    {
        $this->script = $script;

        return $this;
    }

    /**
     * Get script
     *
     * @return string 
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return WebForms
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
     * Set responsetext
     *
     * @param string $responsetext
     * @return WebForms
     */
    public function setResponsetext($responsetext)
    {
        $this->responsetext = $responsetext;

        return $this;
    }

    /**
     * Get responsetext
     *
     * @return string 
     */
    public function getResponsetext()
    {
        return $this->responsetext;
    }

    /**
     * Set emailsubject
     *
     * @param string $emailsubject
     * @return WebForms
     */
    public function setEmailsubject($emailsubject)
    {
        $this->emailsubject = $emailsubject;

        return $this;
    }

    /**
     * Get emailsubject
     *
     * @return string 
     */
    public function getEmailsubject()
    {
        return $this->emailsubject;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return WebForms
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
     * Set emailname
     *
     * @param string $emailname
     * @return WebForms
     */
    public function setEmailname($emailname)
    {
        $this->emailname = $emailname;

        return $this;
    }

    /**
     * Get emailname
     *
     * @return string 
     */
    public function getEmailname()
    {
        return $this->emailname;
    }

    /**
     * Set emailcc
     *
     * @param string $emailcc
     * @return WebForms
     */
    public function setEmailcc($emailcc)
    {
        $this->emailcc = $emailcc;

        return $this;
    }

    /**
     * Get emailcc
     *
     * @return string 
     */
    public function getEmailcc()
    {
        return $this->emailcc;
    }

    /**
     * Set replayemail
     *
     * @param string $replayemail
     * @return WebForms
     */
    public function setReplayemail($replayemail)
    {
        $this->replayemail = $replayemail;

        return $this;
    }

    /**
     * Get replayemail
     *
     * @return string 
     */
    public function getReplayemail()
    {
        return $this->replayemail;
    }

    /**
     * Set replayname
     *
     * @param string $replayname
     * @return WebForms
     */
    public function setReplayname($replayname)
    {
        $this->replayname = $replayname;

        return $this;
    }

    /**
     * Get replayname
     *
     * @return string 
     */
    public function getReplayname()
    {
        return $this->replayname;
    }

    /**
     * Set emailtext
     *
     * @param string $emailtext
     * @return WebForms
     */
    public function setEmailtext($emailtext)
    {
        $this->emailtext = $emailtext;

        return $this;
    }

    /**
     * Get emailtext
     *
     * @return string 
     */
    public function getEmailtext()
    {
        return $this->emailtext;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebForms
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
     * @return WebForms
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
     * @return WebForms
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
     * @return WebForms
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
