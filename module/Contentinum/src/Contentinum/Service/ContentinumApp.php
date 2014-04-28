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

/** 
 * Applog interface
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */

class ContentinumApp implements ContentinumInterface
{
	protected $allowed = array('');
	
	protected $defaultkey ='_default';
	
	protected $appkey = 'app';
	
	protected $options;
	
	protected $defaults;
	
	protected $sl;
	
	protected $uri;
	
	
	/* (non-PHPdoc)
	 * @see \Contentinum\Service\ContentinumInterface::getUri()
	 */
	public function getUri() 
	{
		if (!$this->uri){
			$this->requestUri();
		}
		return $this->uri;
	}
	
	/**
	 * Cut uri string
	 * @param number $c
	 */
	public function cutUri($c = 3, $uri = null)
	{
		if (null == $uri){
			$this->requestUri();
		}
		
		$uri = explode('_', $this->uri);
		if (isset($uri[$c])){
			unset($uri[$c]);
			$this->uri = implode('_', $uri);
		}
		unset($uri);
	}

	/* (non-PHPdoc)
	 * @see \Contentinum\Service\ContentinumInterface::isPageAvailable()
	 */
	public function isPageAvailable() 
	{
		if (!$this->uri){
			$this->requestUri();
		}
		if (isset($this->options[$this->uri])){
			if (isset($this->options[$this->defaultkey])){
				$this->defaults = $this->options[$this->defaultkey];
			}
			$this->options = $this->options[$this->uri];
			return true;
		} else {
			if (isset($this->options[$this->defaultkey])){
				$this->defaults = $this->options[$this->defaultkey];
			}
			return false;
		}		
	}

	/* (non-PHPdoc)
	 * @see \Contentinum\Service\ContentinumInterface::requestUri()
	 */
	public function requestUri() 
	{
		$uripath = str_replace ( '/', '_',$_SERVER['REQUEST_URI']);
		$this->uri = substr($uripath,1,strlen($uripath));
	}
	
	public function setAppData($appkey = null)
	{
		if ($appkey){
			$this->appkey = $appkey;
		}
		
		if (isset($this->options[$this->appkey])){
			$this->options = $this->options[$this->appkey];
			return true;
		} else {
			return false;
		}
	}

	/* (non-PHPdoc)
	 * @see \Contentinum\Service\ContentinumInterface::getOptions()
	 */
	public function getOptions($key = null) 
	{
		if ($key) {
			if(isset($this->options[$key])){
				return $this->options[$key];
			} else {
				return false;
			}
		} else {
			return $this->options;
		}
		
	}

	/* (non-PHPdoc)
	 * @see \Contentinum\Service\ContentinumInterface::getSl()
	 */
	public function getSl() 
	{
		return $this->sl;		
	}

	/* (non-PHPdoc)
	 * @see \Contentinum\Service\ContentinumInterface::setOptions()
	 */
	public function setOptions(array $options) 
	{
		$this->options = $options;
	}

	/* (non-PHPdoc)
	 * @see \Contentinum\Service\ContentinumInterface::setSl()
	 */
	public function setSl($sl) 
	{
		$this->sl = $sl;		
	}

	
}