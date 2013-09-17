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
namespace Contentinum\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Contentinum\Model\Htmllayouts;
use ContentinumComponents\Html\HtmlAttribute;

/**
 * Get and set website and webpage meta datas and values per page
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class Pagemetas extends AbstractPlugin
{
	/**
	 * Header meta names
	 * @var array
	 */
	protected $headmetas = array('meta_description' => 'description', 'meta_keywords' => 'keywords', 'meta_viewport' => 'viewport' );
	
	/**
	 * Html and body tag attributes
	 * @var array
	 */
	protected $tagAttributes = array('htmlId' => 'html_id', 'htmlClass' => 'html_class', 'bodyId' => 'body_id', 'bodyClass' => 'body_class');
	
	/**
	 * 
	 * @param Zend\Config\Config $htmllayout html layout
	 * @param array $pagelist website page list
	 * @param string $page specified page key
	 * @param Zend\View\Helper $viewHelper
	 * @param instance $layout Zend Layout Instance
	 */
	public function __invoke($htmllayout, $pagelist, $page, $viewHelper, $layout)
	{
		$pageMetaDatas = $pagelist->$page; // webpage specified values
		$defaultMetaDatas = $pagelist->_default; // website specified values
		
		// set html layout 
		$model = new Htmllayouts();
		$key = $model->getPrimaryValue();
		$model->setOptions($htmllayout->$key->toArray());
		
		// set the different values to standard values
		if ('default' != $pageMetaDatas->htmlstructure){
			$header = $this->alternative($model->getAlternativeHeader($pageMetaDatas->htmlstructure), 'header', $model);
			if (is_array($header)) {
				$model->setHeader($header);
			}
			
			$footer = $this->alternative($model->getAlternativeFooter($pageMetaDatas->htmlstructure), 'footer', $model);
			if (is_array($footer)) {
				$model->setFooter($footer);
			}
			
			$sequence = $this->alternative($model->getAlternativeSequence($pageMetaDatas->htmlstructure), 'sequence', $model);
			if (is_array($sequence)) {
				$model->setSequence($sequence);
			}			
		}
		
		// get and set webpage meta datas and values
		$this->setHeadTitle($viewHelper->get('headTitle'),$pageMetaDatas,$defaultMetaDatas);
		$this->setHeadMeta($viewHelper->get('headMeta'), $pageMetaDatas, $defaultMetaDatas);
		$this->setHeadLink($viewHelper->get('headLink'), $model->getStylesheets());
		$this->setHeadScript($viewHelper->get('headScript'), $model->getHeaderScripts());
		$this->setInlineScript($viewHelper->get('inlineScript'), $model->getFooter());
		$this->setTagAttributtes($pageMetaDatas, $defaultMetaDatas, $layout);
	}
	
	
	/**
	 * Set webpage header title
	 * @param Zend\View\Helper\HeadTitle $headTitle
	 * @param Zend\Config\Config $page webpage specified values
	 * @param Zend\Config\Config $defaults website specified values
	 */	
	protected function setHeadTitle($headTitle, $page, $defaults)
	{
		
		$prepend = false;
		if ( $page->label ){
			$prepend = $page->label;
		}
		
		if ( $page->meta_title ){
			$prepend = $page->meta_title;
		}
		
		if ( false !== $prepend ){
			$headTitle->setSeparator(' - ');
			$headTitle->prepend($prepend);
		}
		
		$headTitle->append($defaults->meta_title);

	}
	
	/**
	 * Set meta datas in webpage header
	 * @param Zend\View\Helper\HeadMeta $headMeta
	 * @param Zend\Config\Config $page webpage specified values
	 * @param Zend\Config\Config $defaults website specified values
	 */
	protected function setHeadMeta($headMeta,$page,$defaults)
	{
		foreach ($this->headmetas as $key => $property){
			$value = false;
			if ($defaults->$key){
				$value = $defaults->$key;
			}
			if ($page->$key){
				$value = $page->$key;
			}
			if ( false !== $value ){
				$headMeta->appendName($property, $value);
			}
		}

	}
	
	/**
	 * Set stylesheets files in webpage header
	 * @param Zend\View\Helper\HeadLink $headLink
	 * @param array $scripts
	 */	
	protected function setHeadLink($headLink, array $styles) 
	{
		
		if (isset($styles['assets']) && '1' == $styles['assets']){
			return false;
		}
		
		foreach ( $styles ['style'] as $style ) {
			if (isset ( $style ['href'] )) {
				$headLink->appendStylesheet ( $style ['href'] );
			}
		}
	}
	
	/**
	 * Set js script files in webpage header
	 * @param Zend\View\Helper\HeadScript $headScript
	 * @param array $scripts
	 */	
	protected function setHeadScript($headScript, array $scripts)
	{
		
		if (isset($scripts['assets']) && '1' == $scripts['assets']){
			return false;
		}		
		
		foreach ($scripts['script'] as $script){
			if ( isset($script['src']) ){
				$headScript->appendFile($script['src']);
			}
		}
	}
	
	/**
	 * Set js script files before body end tag
	 * @param Zend\View\Helper\InlineScript $inlineScript
	 * @param array $scripts
	 */
	protected function setInlineScript($inlineScript, array $scripts) 
	{
		
		if (isset($scripts['assets']) && '1' == $scripts['assets']){
			return false;
		}
				
		foreach ( $scripts ['script'] as $script ) {
			if (isset ( $script ['src'] )) {
				$inlineScript->appendFile ( $script ['src'] );
			}
		}
	}

	/**
	 * Go through array and notice whether attributes are available for html or body tag
	 * If available set attribute string
	 * @param Zend\Config\Config $page webpage specified values
	 * @param Zend\Config\Config $defaults website specified values
	 * @param instance $layout Zend Layout Instance
	 */
	protected function setTagAttributtes($page,$defaults,$layout)
	{
		$html = '';
		$body = '';
		foreach ($this->tagAttributes as $keys => $attrib){
			switch ($keys){
				case 'htmlId':
					$html .= $this->renderTagAttrib('id', $page,$defaults, $attrib);
					break;
				case 'htmlClass':
					$html .= $this->renderTagAttrib('class', $page,$defaults, $attrib);
					break;	
				case 'bodyId':
					$body .= $this->renderTagAttrib('id', $page,$defaults, $attrib);
					break;
				case 'bodyClass':
					$body .= $this->renderTagAttrib('class', $page,$defaults, $attrib);
					break;
				default:									
					
			}
		}
		
		if ($html){
			$layout->htmlTagAttribs = $html;
		}
		
		if ($body){
			$layout->bodyTagAttribs = $body;
		}
	}

	/**
	 * Get set tag attributes
	 * @param string $attrib selector
	 * @param Zend\Config\Config $page webpage specified values
	 * @param Zend\Config\Config $defaults website specified values
	 * @param string $value search this value
	 * @return Ambigous <string, boolean>|NULL
	 */
	protected function renderTagAttrib($attrib, $page, $defaults, $value)
	{
		$set = false;
		if ($defaults->$value){
			$set = $defaults->$value;
		}		
		if ($page->$value){
			$set = $page->$value;
		}
		
		if (false !== $set){
			return HtmlAttribute::attributeString($attrib,$set,true);
		}
		return null;
	}

	/**
	 * Get alternative html structure for this webpage
	 * @param mixed $alternative
	 * @param string $area
	 * @param Contentinum\Model\Htmlstructure $model
	 * @return array|NULL
	 */
	protected function alternative($alternative, $area, $model)
	{
		if ($alternative){
			if ( isset($alternative['reference'])){
				$ref = $alternative['reference'];
				if ('default' != $ref){
					switch ($area){
						case 'sequence':
							$alternative = $model->getAlternativeSequence($ref);
							break;
						case 'footer':
							$alternative = $model->getAlternativeFooter($ref);
							break;
						case 'header':
							$alternative = $model->getAlternativeHeader($ref);
							break;
						default:
							$alternative = null;
					}
	
				} else {
					$alternative = null;
				}
			}
		}
		return $alternative;
	}	

}