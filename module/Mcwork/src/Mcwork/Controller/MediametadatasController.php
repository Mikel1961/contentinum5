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
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Mcwork\Controller;

use ContentinumComponents\Controller\AbstractContentinumController;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;
use Mcwork\Model\SaveMediaMetas;
use Contentinum\Entity\WebMediaTags;
use Mcwork\Model\MediaTagsAssign;
use Mcwork\Model\SaveMediaTags;

/**
 * Dashboard controller backend
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class MediametadatasController extends AbstractContentinumController
{

    /**
     * Backend list all medias with meta datas
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $params = $this->initParams();
        if ($params['mcworkpages']->Mcwork_Controller_MediaMetas) {
            $content = $params['mcworkpages']->Mcwork_Controller_MediaMetas;
        }
        
        $this->adminlayout($this->layout(), $params['mcworkpages'], 'Mcwork_Controller_MediaMetas', $params['role'], $params['acl'], $this->getServiceLocator()
            ->get('viewHelperManager'));
                
        if ($this->worker) {
            $entries = $this->worker->getStorage()
                ->getRepository($this->entity->getEntityName())
                ->findAll();
        }
        
        if (true == ($log = $this->getLogger())) {
            $log->info('Display Mcwork_Controller_MediaMetas');
        }
        
        $assignTags = new MediaTagsAssign($this->worker->getStorage());
        
        return new ViewModel(array(
            'host' => $params['host'],
            'mediatable' => $params['medias'],
            'pagecontent' => $content,
            'entries' => $entries,
            'assigntags' => $assignTags->sortAssignsToMedia($assignTags->getAssigns())
        ));
    }

    /**
     * Save media tags
     */
    public function savemetasAction()
    {
        $datas = $this->getRequest()->getPost();
        if (isset($datas['dbident'])) {
            try {
                switch ($datas['stage']) {
                    case 'metas':
                        $save = new SaveMediaMetas($this->worker->getStorage());
                        $save->setLogger($this->worker->getLogger());
                        $save->setEntity($this->getEntity());
                        $save->save($datas, $save->fetchPopulateValues($datas['dbident'], false));
                        break;
                    case 'handletags':
                        $save = new SaveMediaTags($this->worker->getStorage());
                        $save->setLogger($this->worker->getLogger());
                        $save->save($datas['tags'], null,'',$datas['dbident']);
                        break;    
                    case 'testjssuccess':
                        print true;
                        exit();
                        break;
                    case 'testjserror':
                        echo Json::encode(array(
                        		'error' => 'Error test'
                        ));
                        exit();
                        break;                            
                    default:
                        
                        echo Json::encode(array(
                            'error' => 'unkown_app'
                        ));
                        exit();
                        break;
                }
                
                print true;
            } catch (\Exception $e) {
                echo Json::encode(array(
                    'error' => $e->getMessage()
                ));
            }
        }
        
        exit();
    }

    /**
     * Get all media tags
     */
    public function mediametatagsAction()
    {
        
        // get tags
        $entity = new WebMediaTags();
        $tagEntries = $this->worker->getStorage()
            ->getRepository($entity->getEntityName())
            ->findAll();
        $tags = array();
        foreach ($tagEntries as $entry) {
            $tags[] = $entry->tagName;
        }
        
        echo Json::encode($tags);
        exit();
    }

    /**
     * Init parameters
     *
     * @return multitype:NULL
     */
    protected function initParams()
    {
        return array(
            'mcworkpages' => $this->getServiceLocator()->get('Mcwork\Pages'),
            'acl' => $this->getServiceLocator()->get('Contentinum\Acl\Acl'),
            'role' => $this->getServiceLocator()->get('Contentinum\Acl\DefaultRole'),
            'medias' => $this->getServiceLocator()->get('Mcwork\Medias'),
            'host' => $this->getRequest()
                ->getUri()
                ->getHost()
        );
    }
}