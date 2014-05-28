<?php

namespace Contentinum\Entity;

use Doctrine\ORM\Mapping as ORM;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * WebRedirect
 *
 * @ORM\Table(name="web_redirect", indexes={@ORM\Index(name="REDIRECT", columns={"redirect"}), @ORM\Index(name="WEBPAGES", columns={"web_pages_id"})})
 * @ORM\Entity
 */
class WebRedirect extends AbstractEntity
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
     * @ORM\Column(name="redirect", type="string", length=250, nullable=false)
     */
    private $redirect;

    /**
     * @var integer
     *
     * @ORM\Column(name="statuscode", type="integer", nullable=false)
     */
    private $statuscode = '301';

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
    private $updateBy = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="up_date", type="datetime", nullable=false)
     */
    private $upDate = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="register_date", type="datetime", nullable=false)
     */
    private $registerDate = '0000-00-00 00:00:00';

    /**
     * @var \Contentinum\Entity\WebPagesParameter
     *
     * @ORM\ManyToOne(targetEntity="Contentinum\Entity\WebPagesParameter")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="web_pages_id", referencedColumnName="id")
     * })
     */    
    private $webPagesId;    


    
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
     * Set redirect
     *
     * @param string $redirect
     * @return WebRedirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;

        return $this;
    }

    /**
     * Get redirect
     *
     * @return string 
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * Set statuscode
     *
     * @param integer $statuscode
     * @return WebRedirect
     */
    public function setStatuscode($statuscode)
    {
        $this->statuscode = $statuscode;

        return $this;
    }

    /**
     * Get statuscode
     *
     * @return integer 
     */
    public function getStatuscode()
    {
        return $this->statuscode;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WebRedirect
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
     * @return WebRedirect
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
     * Set upDate
     *
     * @param \DateTime $upDate
     * @return WebRedirect
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
     * Set registerDate
     *
     * @param \DateTime $registerDate
     * @return WebRedirect
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
     * Set webPagesId
     *
     * @param \Contentinum\Entity\WebPagesParameter $webPagesId
     * @return WebRedirect
     */    
    public function setWebPagesId(\Contentinum\Entity\WebPagesParameter $webPagesId)
    {
    	$this->webPagesId = $webPagesId;
    
    	return $this;
    }
    
    /**
     * Get webPagesId
     *
     * @return \Contentinum\Entity\WebPagesParameter
     */
    public function getWebPagesId()
    {
    	return $this->webPagesId;
    }    
}