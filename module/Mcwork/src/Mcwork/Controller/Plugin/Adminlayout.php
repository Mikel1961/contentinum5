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
 * @package Controller Plugin
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Mcwork\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use ContentinumComponents\Html\HtmlAttribute;

/**
 * Set layout configuration
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class Adminlayout extends AbstractPlugin
{

	public function __invoke($layout,$mcworkpages, $page, $role = null, $acl = null, $viewHelper = null)
	{
		$defaults = $mcworkpages->_defaults;
		$pageConfigure = false;
		if ($mcworkpages->$page){
			$pageConfigure = $mcworkpages->$page;
		}
		
		if (null !== $role){
			$layout->role = $role;
		}
		if (null !== $acl){
			$layout->acl = $acl;
		}	
		$this->setTitle($defaults, $pageConfigure, $page, $viewHelper);
		$this->setHeadline($page, $pageConfigure, $layout);
		$this->bodyAttributes($defaults, $pageConfigure, $layout);
		$this->templateFile($defaults, $pageConfigure, $layout);
		
		
	}
	
	/**
	 * Body tag attributes
	 * @param unknown $defaults
	 * @param unknown $pageConfigure
	 * @param unknown $layout
	 */
	protected function setTitle($defaults,$pageConfigure, $page, $viewHelperManager)
	{

		$headTitleHelper   = $viewHelperManager->get('headTitle');
		$headTitleHelper->setSeparator(' - ');		
		
		if (isset($defaults->title) && strlen($defaults->title) > 0){
			$headTitleHelper->append($defaults->title);
		}
	
		if (isset($pageConfigure->title) && strlen($pageConfigure->title) > 0){
			$headTitleHelper->prepend($pageConfigure->title);
		} else {
			$headTitleHelper->prepend($page);
		}
	
	}	
	
    /**
     * set headline
     * @param unknown $page
     * @param unknown $pageConfigure
     * @param unknown $layout
     */
	protected function setHeadline($page, $pageConfigure, $layout)
	{
		if ( isset($pageConfigure->headline) && strlen($pageConfigure->headline) > 0){
			$layout->headline = $pageConfigure->headline;
		} else {
			$layout->headline = $page;
		}
	}
	
	/**
	 * Body tag attributes
	 * @param unknown $defaults
	 * @param unknown $pageConfigure
	 * @param unknown $layout
	 */
	protected function bodyAttributes($defaults,$pageConfigure,$layout)
	{
		$bodyTagAttribs = array();
		if (isset($defaults->bodyTagAttribs) && strlen($defaults->bodyTagAttribs) > 0){
			$bodyTagAttribs = $defaults->bodyTagAttribs;
		}
		
		if (isset($pageConfigure->bodyTagAttribs) && strlen($pageConfigure->bodyTagAttribs) > 0){
			$bodyTagAttribs = $pageConfigure->bodyTagAttribs;
		}
		
		if ( is_array($bodyTagAttribs) ){
			$attributes = '';
			foreach ($bodyTagAttribs as $attribute => $value){
				$attributes .= HtmlAttribute::attributeString($attribute,$value,true);
			}
			$layout->bodyAttributes = $attributes;
		}

	}
	
	/**
	 * 
	 * @param unknown $defaults
	 * @param unknown $pageConfigure
	 * @param unknown $layout
	 */
	protected function templateFile($defaults,$pageConfigure,$layout)
	{
		$layout->setTemplate('mcwork/layout/admin');
	}


}