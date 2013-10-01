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
 * @package Controller
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Contentinum\Controller;

use ContentinumComponents\Controller\AbstractContentinumController;
use Zend\View\Model\ViewModel;
use Zend\Mvc\MvcEvent;
use Zend\Config\Config;

/**
 * The application controller
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class ApplicationController extends AbstractContentinumController
{


	public function onDispatch(MvcEvent $e)
	{
		
	
		//$t = array('seite1' => 1, 'seite2' => 2, 'seite4' => 3);
		$pagelist = $this->getpages();
		$pages = $e->getRouteMatch()->getParam('pages');
		$e->getRouteMatch()->setParam ( 'action', 'application' );
		if ( ! isset($pagelist->$pages) ){
			$this->notFoundAction();
		}
		$e->setResult($this->application($pages,$pagelist));
		
	}
	
	
	public function application($page,$pagelist)
	{
		$logger = $this->getServiceLocator()->get('Contentinum\Logs\Applog');
		$logger->notice('request ' . $page);
		
		$htmllayouts = $this->getServiceLocator()->get('Contentinum\Htmllayouts');
		$this->pagemetas($htmllayouts, $pagelist, $page, $this->getServiceLocator()->get('viewHelperManager'), $this->layout());
		$structure = $this->htmlwidgets($this->getServiceLocator()->get('Contentinum\Htmlwidgets'),$pagelist, $page);
		return new ViewModel(array('htmllayouts' => $htmllayouts, 'structurelements' => $structure, 'entries' => array(),     'content' => '<h1>contentinum 5 - application</h1><p>Hello application! Seite: '.$page.'</p>'));
	}

	
	public function indexAction() 
	{
		return new ViewModel();
	}
	
	/**
	 * @deprecated
	 * @return \Zend\Config\Config
	 */
    protected function getpages()
    {
    	
    	$pagelist = array(
    			'_default' => array('htmlstructure' => 'default','htmlwidgets' => 'maincontent','resource' => 'index','meta_title' => 'contentinum5, jochum-mediaservices','meta_description' => 'Eine tolle Homepage','meta_viewport' => 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0', 'html_class' => 'no-js', 'publish' => 'yes'),
    			'index' => array('htmlstructure' => 'default','htmlwidgets' => 'maincontent','resource' => 'index','meta_title' => '','meta_description' => '','meta_viewport' => '', 'label' => 'Home','publish'=> 'yes'),
    			'seite1' => array('htmlstructure' => 'default','htmlwidgets' => 'maincontent','resource' => 'index','meta_title' => '','meta_description' => '','meta_viewport' => '', 'label' => 'Seite 1', 'publish' => 'yes'),
    			'seite2' => array('htmlstructure' => 'default','htmlwidgets' => 'maincontent','resource' => 'index','meta_title' => 'Dies ist Seite 2','meta_description' => 'Eine tolle Seite zwei','meta_viewport' => '', 'label' => 'Seite 2','publish' => 'yes'),
    		
    	);
    	return new Config($pagelist);

    }
}