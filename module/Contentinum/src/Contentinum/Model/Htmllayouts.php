<?php
/**
 * contentinum - accessibility websites
 *
 * LICENSE
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED
 * OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category contentinum
 * @package Model
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Contentinum\Model;

use ContentinumComponents\Entity\AbstractEntity;

/**
 * Application model default layout paramters
 * Api contains application layout paramters
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class Htmllayouts extends AbstractEntity
{

    /**
     * Standard layout
     *
     * @var string
     */
    protected $_layout = 'default';

    /**
     * Standard sequence build
     *
     * @var array
     */
    protected $_sequence;

    /**
     * Header files
     *
     * @var array
     */
    protected $_header;

    /**
     * Footer files
     *
     * @var array
     */
    protected $_footer;

    /**
     * Layout per page different to standard layout
     *
     * @var mixed
     */
    protected $_alternative;

    /**
     * Construct mandant model
     *
     * @param array $options
     * @return void
     */
    public function __construct (array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
    
    /**
	 * @see \ContentinumComponents\Entity\AbstractEntity::getEntityName()
	 */
	public function getEntityName() 
	{
		return get_class($this);
	}
	
    /**
     * @see \ContentinumComponents\Entity\AbstractEntity::getProperties()
     */
    public function getProperties ()
    {
        return get_object_vars($this);
    }

    /**
     * @see \ContentinumComponents\Entity\AbstractEntity::getPrimaryValue()
     */
    public function getPrimaryValue()
    {
        return $this->_layout;
    }

    /**
     * @see \ContentinumComponents\Entity\AbstractEntity::getPrimaryKey()
     */
    public function getPrimaryKey ()
    {
        return 'layout';
    }

    /**
     *
     * @return the $_layout
     */
    public function getLayout ()
    {
        return $this->_layout;
    }

    /**
     *
     * @param field_type $layout
     * @return Application_Model_Htmlstructure
     */
    public function setLayout ($layout)
    {
        $this->_layout = $layout;
        return $this;
    }

    /**
     *
     * @return the $_sequence
     */
    public function getSequence ()
    {
        return $this->_sequence;
    }

    /**
     *
     * @param multitype: $sequence
     * @return Application_Model_Htmlstructure
     */
    public function setSequence ($sequence)
    {
        $this->_sequence = $sequence;
        return $this;
    }

    /**
     *
     * @return the $_header
     */
    public function getHeader ()
    {
        return $this->_header;
    }

    /**
     *
     * @param multitype: $header
     * @return Application_Model_Htmlstructure
     */
    public function setHeader ($header)
    {
        $this->_header = $header;
        return $this;
    }

    /**
     *
     * @return the $_footer
     */
    public function getFooter ()
    {
        return $this->_footer;
    }

    /**
     *
     * @param multitype: $footer
     * @return Application_Model_Htmlstructure
     */
    public function setFooter ($footer)
    {
        $this->_footer = $footer;
        return $this;
    }

    /**
     *
     * @return the $_alternative
     */
    public function getAlternative ()
    {
        return $this->_alternative;
    }

    /**
     *
     * @param mixed $alternative
     * @return Application_Model_Htmlstructure
     */
    public function setAlternative ($alternative)
    {
        $this->_alternative = $alternative;
        return $this;
    }

    /**
     * Return Stylesheets settings
     *
     * @return the $_header['styles']
     */
    public function getStylesheets ()
    {
        if (isset($this->_header['styles'])) {
            return $this->_header['styles'];
        }
        return null;
    }

    /**
     * Return script settings
     *
     * @return the $_header['styles']
     */
    public function getHeaderScripts ()
    {
        if (isset($this->_header['scripts'])) {
            return $this->_header['scripts'];
        }
        return null;
    }
    
    public function getAlternativeHeader($key)
    {
        if ( isset($this->_alternative[$key]['header'])){
            return $this->_alternative[$key]['header'];
        }
        return null;
    }
    
    public function getAlternativeFooter($key)
    {
    	if ( isset($this->_alternative[$key]['footer'])){
    		return $this->_alternative[$key]['footer'];
    	}
    	return null;
    }  

    public function getAlternativeSequence($key)
    {
    	if ( isset($this->_alternative[$key]['sequence'])){
    		return $this->_alternative[$key]['sequence'];
    	}
    	return null;
    }    
}