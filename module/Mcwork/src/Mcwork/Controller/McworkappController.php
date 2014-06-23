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
 * @category contentinum backend
 * @package Controller
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link https://github.com/Mikel1961/contentinum-components
 * @version 1.0.0
 */
namespace Mcwork\Controller;

use ContentinumComponents\Controller\AbstractBackendController;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;

/**
 * Backend module application controller
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class McworkappController extends AbstractBackendController
{

    /**
     * Worker method
     *
     * @var string
     */
    protected $method;
    
    /**
     * 
     * @var unknown
     */
    protected $customerConfigure;

    /**
     * Get the worker method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set a worker method
     *
     * @param string $method
     * @return \Mcwork\Controller\McworkappController
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }
    
    /**
	 * @return the $customerConfigure
	 */
	public function getCustomerConfigure() 
	{
		if (null == $this->customerConfigure){
		    $this->customerConfigure = $this->getServiceLocator()->get('Contentinum\Customer');
		}
	    return $this->customerConfigure;
	}

	/**
	 * @param \Zend\Config $customerConfigure
	 */
	public function setCustomerConfigure($customerConfigure) 
	{
		$this->customerConfigure = $customerConfigure;
	}

	/**
     * Page application
     *
     * @see \ContentinumComponents\Controller\AbstractBackendController::application()
     */
    protected function application($ctrl, $page, $mcworkpages, $role = null, $acl = null)
    {
        $entries = array();
        $content = false;
        $this->iniLoggger();
        if ($mcworkpages->$page) {
            $content = $mcworkpages->$page;
        }
        
        $this->adminlayout($this->layout(), $mcworkpages, $page, $role, $acl, $this->getServiceLocator()
            ->get('viewHelperManager'));
        if ($this->worker) {
            $entries = $this->worker->getStorage()
                ->getRepository($this->entity->getEntityName())
                ->findAll();
        }
        
        if (true == ($log = $this->getLogger())) {
            $log->info('Display ' . $page);
        }
        
        return $this->buildView(array(
            'page' => $page,
            'pagecontent' => $content,
            'entries' => $entries
        ), $content, $mcworkpages);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ContentinumComponents\Controller\AbstractBackendController::displaycontent()
     */
    protected function displaycontent($ctrl, $page, $mcworkpages, $role = null, $acl = null)
    {
        $entry = false;
        $content = false;
        $this->iniLoggger();
        if ($mcworkpages->$page) {
            $content = $mcworkpages->$page;
        }
        
        $this->adminlayout($this->layout(), $mcworkpages, $page, $role, $acl, $this->getServiceLocator()
            ->get('viewHelperManager'));
        
        try {
            if ($this->worker) {
                $entry = $this->worker->fetchContent(array(
                    'id' => $this->params()
                        ->fromRoute('id', 0)
                ), $this->entity, $this->getServiceLocator());
                if (true == ($log = $this->getLogger())) {
                    $log->info('displaycontent_success');
                }
            }
        } catch (\Exception $e) {
            if (true == ($log = $this->getLogger())) {
                $log->err('displaycontent_abort_during');
            }
        }
        return $this->buildView(array(
            'page' => $page,
            'pagecontent' => $content,
            'entries' => $entry
        ), $content, $mcworkpages);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \ContentinumComponents\Controller\AbstractBackendController::downloadcontent()
     */
    protected function downloadcontent($ctrl, $page, $mcworkpages, $role = null, $acl = null)
    {
        $entry = '';
        $this->iniLoggger();
        $filename = $this->params()->fromRoute('id', 0);
        if ($this->worker) {
            $entry = $this->worker->fetchContent(array(
                'id' => $filename
            ), $this->entity);
        }
        if (isset($mcworkpages->$page->response->header) && strlen($entry) > 1) {
            return $this->buildView(array(
                'headerDatas' => $mcworkpages->$page->response->header->toArray(),
                'entries' => $entry,
                'filename' => $filename
            ), $mcworkpages->$page, $mcworkpages);
        }
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \ContentinumComponents\Controller\AbstractBackendController::contenthandle()
     */
    protected function contenthandle($ctrl, $page, $mcworkpages, $role = null, $acl = null)
    {
        $msg = false;
        $this->iniLoggger();
        if ($this->worker) {
            $this->worker->setLogger($this->getLogger());
            
            try {
                if ($this->getRequest()->isPost()) {
                    $attribs = $this->getRequest()->getPost();
                    if (is_object($attribs)) {
                        $attribs = $attribs->toArray();
                    }
                } else {
                    $attribs['id'] = $this->params()->fromRoute('id', 0);
                }
                
                if ($mcworkpages->$page->hasEntries) {
                    $this->worker->setHasEntriesParams($mcworkpages->$page->hasEntries->toArray());
                }
                $method = $this->getMethod();
                $data = $this->worker->$method($attribs, $this->entity, $this->getServiceLocator());
                if (true == ($log = $this->getLogger())) {
                    $log->info(sprintf('contenthandle_success_during %s', $method));
                }
                if ($this->getRequest()->isXmlHttpRequest()) {
                    echo Json::encode(array(
                        'success' => $data
                    ));
                    exit();
                }
            } catch (\Exception $e) {
                if (true == ($log = $this->getLogger())) {
                    $log->err('contenthandle abort during ' . $method . ' ' . $e->getMessage());
                }
                if ($this->getRequest()->isXmlHttpRequest()) {
                    echo Json::encode(array(
                        'error' => sprintf('contenthandle_abort_during %s', $method)
                    ));
                    exit();
                }
            }
        }
        
        if ($mcworkpages->$page->response->redirect) {
            return $this->redirect()->toUrl($mcworkpages->$page->response->redirect);
        } else {
            return $this->redirect()->toRoute('mcwork');
        }
    }

    /**
     * Initialize logger api
     */
    protected function iniLoggger()
    {
        $this->setLogger($this->getServiceLocator()
            ->get('Contentinum\Logs\Applog'));
        if ($this->worker) {
            $this->worker->setLogger($this->getLogger());
        }
    }

    /**
     * Configure and preapre template view
     *
     * @param array $variables view template variables
     * @param \Zend\Config\Config $content page content
     * @param \Zend\Config\Config $mcworkpages
     * @return \Zend\View\Model\ViewModel
     */
    protected function buildView(array $variables, $content, $mcworkpages)
    {
        $view = new ViewModel($variables);
        
        // customer configuration datas
        $view->setVariable('customconfig', $this->getCustomerConfigure());
        
        // get html widget, if specified ...
        $widget = false;
        if (isset($content->template_widget) && strlen($content->template_widget) >= 3) {
            $widget = $content->template_widget;
        }
        
        if (false === $widget && isset($mcworkpages->_defaults->template_widget) && strlen($mcworkpages->_defaults->template_widget) >= 3) {
            $widget = $mcworkpages->_defaults->template_widget;
        }
        
        if (false !== $widget) { // ... and set this if not false
            $view->setVariable('widget', $widget);
        }
        
        if (isset($content->toolbar)) {
            $view->setVariable('toolbarcontent', $this->getServiceLocator()
                ->get('Mcwork\Toolbar'));
        }
        if (isset($content->tableedit)) {
            $view->setVariable('tableeditcontent', $this->getServiceLocator()
                ->get('Mcwork\Tableedit'));
        }
        
        // set template file different from the default, if specified
        if (isset($content->template) && strlen($content->template) > 3) {
            $view->setTemplate($content->template);
        }
        
        return $view;
    }
}