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
 * @package Service
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Contentinum\Service;

use Zend\Log\Filter\Priority;
use Contentinum\Service\ApplogAwareInterface;
use Zend\Log\Writer\Stream;
use Zend\Log\Logger;

/**
 * Applog a wrapper for Zend\Log\Logger or others
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class Applog implements ApplogAwareInterface
{
	
	/**
	 * @const int defined from the BSD Syslog message severities
	 * @link http://tools.ietf.org/html/rfc3164
	 */
	const EMERG  = 0;
	const ALERT  = 1;
	const CRIT   = 2;
	const ERR    = 3;
	const WARN   = 4;
	const NOTICE = 5;
	const INFO   = 6;
	const DEBUG  = 7;	

	/**
	 * 
	 * @const int defined for backend log files
	 */
	const MCWORKEMERG  = 20;
	const MCWORKALERT  = 21;
	const MCWORKCRIT   = 22;
	const MCWORKERR    = 23;
	const MCWORKWARN   = 24;
	const MCWORKNOTICE = 25;
	const MCWORKINFO   = 26;
	const MCWORKDEBUG  = 27;
	
	/**
	 * Configuration key log priority
	 * @var string
	 */
	const OPTION_LOG_PRIORITY = 'log_priority';
	
	/**
	 * Configuration key log writers
	 * @var string
	 */
	const OPTION_LOG_WRITER = 'log_writer';
	
	/**
	 * Configuration key log filter
	 * @var string
	 */
	const OPTION_LOG_FILTER = 'log_filter';
	
	/**
	 * Zend\Log\Logger
	 * @var Zend\Log\Logger
	 */
	protected $logger;
		
	/**
	 * Log priority
	 * @var int
	 */
	protected $priority;
	
	/**
	 * Logger adjustments
	 * @var array
	 */
	protected $options = array();
	
	/**
	 * Construct and initialize logger if not exits
	 * @param array $options
	 */
	public function __construct(array $options = null)
	{
		if ($options){
			$this->setOptions($options);
			if (null === $this->logger){
				$this->setPriority($this->getOption(self::OPTION_LOG_PRIORITY));
				$this->setLogger();
			}
		}
	}
	
	/**
	 * Set log messages
	 * @see \Contentinum\Service\ApplogAwareInterface::log()
	 */
	public function log($priority, $message, $extra = array()) 
	{
		if ( $priority <= $this->priority ){
			$this->logger->log($priority, $message, $extra);
		}
	}
	
	/**
	 * @param string $message
	 * @param array|Traversable $extra
	 */
	public function emerg($message, $extra = array())
	{
		$this->log(self::EMERG, $message, $extra);
	}

	/**
	 * @param string $message
	 * @param array|Traversable $extra
	 */	
	public function alert($message, $extra = array())
	{
		$this->log(self::ALERT, $message, $extra);
	}
	
	/**
	 * @param string $message
	 * @param array|Traversable $extra
	 */
	public function crit($message, $extra = array())
	{
		$this->log(self::CRIT, $message, $extra);
	}
	
	/**
	 * @param string $message
	 * @param array|Traversable $extra
	 */	
	public function err($message, $extra = array())
	{
		$this->log(self::ERR, $message, $extra);
	}	

	/**
	 * @param string $message
	 * @param array|Traversable $extra
	 */	
	public function warn($message, $extra = array())
	{
		$this->log(self::WARN, $message, $extra);
	}	

	/**
	 * @param string $message
	 * @param array|Traversable $extra
	 */	
	public function notice($message, $extra = array())
	{
		$this->log(self::NOTICE, $message, $extra);
	}	

	/**
	 * @param string $message
	 * @param array|Traversable $extra
	 */	
	public function info($message, $extra = array())
	{
		$this->log(self::INFO, $message, $extra);
	}	

	/**
	 * @param string $message
	 * @param array|Traversable $extra
	 */	
	public function debug($message, $extra = array())
	{
		$this->log(self::DEBUG, $message, $extra);
	}	
		
	/**
	 * Get logger priority adjustment
	 * @return number $priority
	 */
	public function getPriority() 
	{
		return $this->priority;
	}

	/**
	 * Set logger priority adjustment
	 * @param number $priority
	 */
	public function setPriority($priority) 
	{
		$this->priority = $priority;
	}
	
	/**
	 * Set logger adjustments
	 * @see \Contentinum\Service\ApplogAwareInterface::setOptions()
	 */
    public function setOptions($options)
    {
    	$this->options = $options;
    	return $this;
    }
    
    /**
	 * Get logger adjustments
	 * @see \Contentinum\Service\ApplogAwareInterface::getOptions()
	 */
    public function getOptions()
    {
    	return $this->options;
    }

    /**
	 * Get a logger adjustment
	 * @see \Contentinum\Service\ApplogAwareInterface::getOption()
	 */
    public function getOption($key)
    {
    	if ( isset($this->options[$key]) ){
    		return $this->options[$key];
    	}
    	return;
    }

    /**
     * Initialize and set Zend\Log\Logger
     * @see \Contentinum\Service\ApplogAwareInterface::setLogger()
     */
	public function setLogger() 
	{
		$streams = $this->getOption ( self::OPTION_LOG_WRITER );
		$this->logger = new Logger ();
		foreach ( $streams as $key => $path ) {
			$writer = new Stream ( $path );
			$this->logger->addWriter ( $writer );
			$this->setFilter ( $key, $writer );
		}
	}

	/**
	 * Set logger filter
	 * @see \Contentinum\Service\ApplogAwareInterface::setFilter()
	 */
    public function setFilter($key, $writer)
    {
    	if ( isset($this->options[self::OPTION_LOG_FILTER][$key]) ){
    		$filters = $this->options[self::OPTION_LOG_FILTER][$key];
    		foreach ($filters as $filter => $options){
    			switch ($filter){
    				case 'priority':
    					$operator = null;
    					if (isset($options[ 'operator'])){
    						$operator =  $options['operator'];
    					}
    					$set = new Priority($options['priority'], $operator);
    					$writer->addFilter($set);
    					break;
    			}
    		} 
    	}
    }
}