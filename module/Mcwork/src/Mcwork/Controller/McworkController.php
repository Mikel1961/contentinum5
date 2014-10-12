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
use Zend\Filter\Digits;
use Contentinum\Entity\WebMedias;
use ContentinumComponents\Validator\Doctrine\NoRecordExists;
use ContentinumComponents\Storage\StorageManager;
use ContentinumComponents\Mapper\Sequence;
use Mcwork\Controller\Exception\InvalidArgumentException;

/**
 * Mcwork controller
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class McworkController extends AbstractContentinumController
{

    const MISSED_IDENT_MEDIA = 'Missed unique identifier from media group or media file';

    const MISSED_IDENT = 'Missed unique identifier from this data record';

    const APP_ERROR = 'Application not found or incorrect parameter';

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
        
        $this->adminlayout($this->layout(), $params['mcworkpages'], 'MediaMetas', $params['role'], $params['acl'], $this->getServiceLocator()
            ->get('viewHelperManager'));
        
        if ($this->worker) {
            $entries = $this->worker->getStorage()
                ->getRepository($this->entity->getEntityName())
                ->findAll();
        }
        
        if (true == ($log = $this->getLogger())) {
            $log->info('Display Mcwork_Controller_MediaMetas');
        }
        
        $assignTags = new \Mcwork\Model\Medias\Tags($this->worker->getStorage());
        $assignGroups = new \Mcwork\Model\Categories\Media($this->worker->getStorage());
        
        return new ViewModel(array(
            'host' => $params['host'],
            'mediatable' => $params['medias'],
            'pagecontent' => $content,
            'entries' => $entries,
            'assigntags' => $assignTags->sortAssignsToItem($assignTags->getAssigns(true)),
            'assigngrps' => $assignGroups->getGroupCategories()
        ));
    }

    /**
     * Application action, decide wich method to use
     * 
     * @throws \Exception
     * @return \Zend\View\Model\ViewModel
     */
    public function applicationAction()
    {
        $postParams = $this->params()->fromPost();
        $app = $this->params()->fromRoute('mediaapp', null);
        $appId = $this->params()->fromRoute('id', null);
        $result = '';
        try {
            switch ($app) {
                case 'module':
                    echo $this->contributionModule($postParams);
                    exit();
                    break;
                case 'services':
                    echo Json::encode($this->getServiceLocator()->get($postParams['service']));
                    exit();
                    break;
                case 'publishitem':
                    echo $this->publishitem($postParams);
                    exit();
                    break;
                case 'removesubmenue':
                    echo $this->removesubmenue($postParams);
                    exit();
                    break;
                case 'addsubmenue':
                    echo $this->addsubmenue($postParams);
                    exit();
                    break;
                case 'populatevalues':
                    echo $this->populateValues($postParams);
                    exit();
                    break;
                case 'explorer':
                    echo $this->explorer($postParams);
                    exit();
                    break;
                case 'uploads':
                    echo $this->singleUpload($postParams);
                    exit();
                    break;
                case 'alltags':
                    echo Json::encode($this->alltags());
                    exit();
                    break;
                case 'mediagroups':
                    echo Json::encode($this->mediagroups());
                    exit();
                    break;
                case 'removeitems':
                    return $this->removeitem($postParams);
                    break;
                case 'changeitemrang':
                    return $this->changeitemrang($postParams);
                    break;
                case 'categories':
                    echo Json::encode($this->fetchMediaCategories($postParams));
                    exit();
                    break;
                case 'groupcategories':
                    echo $this->fetchCategories($postParams);
                    exit();
                    break;
                case 'formrules':
                    echo Json::encode($this->formrules());
                    exit();
                    break;
                case 'mediatags':
                    if (isset($postParams['dbident'])) {
                        echo $this->mediatags($postParams['tags'], $postParams['dbident']);
                    } else {
                        echo Json::encode(array(
                            'error' => self::MISSED_IDENT_MEDIA
                        ));
                    }
                    exit();
                    break;
                case 'entryexists':
                    echo $this->entryexists($postParams);
                    exit();
                    break;
                case 'mediametas':
                    if (isset($postParams['dbident'])) {
                        echo $this->mediametas($postParams, $postParams['dbident']);
                    } else {
                        echo Json::encode(array(
                            'error' => self::MISSED_IDENT_MEDIA
                        ));
                    }
                    exit();
                    break;
                case 'additemgrp':
                    if (isset($postParams['mgrp']) && isset($postParams['dbident'])) {
                        $filter = new Digits();
                        $insert['webMediagroupId'] = $filter->filter($postParams['mgrp']);
                        $insert['webMediasId'] = $filter->filter($postParams['dbident']);
                        unset($filter);
                        echo $this->additemtogroup($insert);
                        exit();
                    } else {
                        echo Json::encode(array(
                            'error' => self::MISSED_IDENT_MEDIA
                        ));
                        exit();
                    }
                    break;
                case 'removeitemgrp':
                    if (isset($postParams['mgrp']) && isset($postParams['dbident'])) {
                        $filter = new Digits();
                        $data['webMediagroupId'] = $filter->filter($postParams['mgrp']);
                        $data['webMediasId'] = $filter->filter($postParams['dbident']);
                        unset($filter);
                        echo $this->removeitemfromgroup($data);
                        exit();
                    } else {
                        echo Json::encode(array(
                            'error' => self::MISSED_IDENT_MEDIA
                        ));
                        exit();
                    }
                    break;
                default:
                    $result = array(
                        'error' => self::APP_ERROR
                    );
                    exit();
                    break;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getCode());
        }
    }

    /**
     * Validate if a entry exists or not
     * 
     * @param array $options
     * @return boolean
     */
    protected function entryexists($options)
    {
        $options['storage'] = $this->getWorker();
        try {
            $validator = new NoRecordExists($options);
            return $validator->isValid($options['value']);
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }

    /**
     * Save media tags
     * 
     * @param array $tags
     * @param int $ident
     * @return boolean
     */
    protected function mediatags($tags, $ident)
    {
        $save = new \Mcwork\Model\Medias\Tags($this->worker->getStorage());
        $save->setLogger($this->worker->getLogger());
        $save->save($tags, null, '', $ident);
        return true;
    }

    /**
     * Save media attributes
     * 
     * @param array $datas
     * @param int $ident
     * @return boolean
     */
    protected function mediametas($datas, $ident)
    {
        $save = new \Mcwork\Model\Medias\Attribute($this->worker->getStorage());
        $save->setLogger($this->worker->getLogger());
        $save->setEntity($this->getEntity());
        $save->save($datas, $save->fetchPopulateValues($ident, false));
        return true;
    }

    /**
     * Remove item from media group
     * 
     * @param unknown $data
     * @return boolean
     */
    protected function removeitemfromgroup($data)
    {
        $remove = new \Mcwork\Model\Categories\Media($this->worker->getStorage());
        $remove->removeItem($data);
        return true;
    }

    /**
     * Add item to group
     * 
     * @param array $insert
     * @return boolean
     */
    protected function additemtogroup($insert)
    {
        $add = new \Mcwork\Model\Categories\Media($this->worker->getStorage());
        $add->addItem($insert);
        return true;
    }

    /**
     * Get the form rules
     * 
     * @return Ambigous <object, multitype:, \Mcwork\FormRules>
     */
    protected function formrules()
    {
        $rules = $this->getServiceLocator()->get('Mcwork\FormRules');
        return $rules;
    }

    /**
     * Get all mediagroups
     *
     * @return multitype:NULL
     */
    protected function mediagroups()
    {
        $entity = new \Contentinum\Entity\WebMediaGroup();
        $tagEntries = $this->worker->getStorage()
            ->getRepository($entity->getEntityName())
            ->findAll();
        $result = array();
        foreach ($tagEntries as $entry) {
            $result[$entry->id] = $entry->groupName;
        }
        return $result;
    }

    /**
     * Get all mediatags
     * 
     * @return multitype:NULL
     */
    protected function alltags()
    {
        $entity = new \Contentinum\Entity\WebTags();
        $tagEntries = $this->worker->getStorage()
            ->getRepository($entity->getEntityName())
            ->findAll();
        $result = array();
        foreach ($tagEntries as $entry) {
            $result[] = $entry->tagName;
        }
        return $result;
    }

    /**
     *
     * @param unknown $datas
     */
    protected function fetchMediaCategories($datas)
    {
        $db = new \Mcwork\Model\Categories\Media($this->worker->getStorage());
        $result = $db->fetchContent($datas);
        var_dump($result);
        exit();
    }

    /**
     * Fetch categories from a group
     * 
     * @param array $datas parameters to do this
     * @param boolen $asArray
     * @return Ambigous <string, mixed>
     */
    protected function fetchCategories($datas, $asArray = true)
    {
        $worker = "Mcwork\\Model\\";
        
        if (preg_match('/_/', $datas['categoryname'])) {
            $parts = explode('_', $datas['categoryname']);
            foreach ($parts as $part) {
                $worker .= ucfirst($part);
            }
        } else {
            $worker .= $datas['categoryname'];
        }
        
        $db = new $worker($this->worker->getStorage());
        $result = $db->fetchContent($datas, $asArray);
        return Json::encode($result);
    }

    /**
     * Single file upload
     * 
     * @param array $datas parameters to do this
     * @return string
     */
    protected function singleUpload($datas)
    {
        if (! isset($_FILES['fileUpload'])) {
            echo Json::encode(array(
                'error' => 'no_file_specified'
            ));
        } else {
            $uploadedFile = $_FILES['fileUpload'];
        }
        
        if (false !== ($sourcepath = $this->getMcParameter('public_directory_path', 'Host'))) {
            $entity = new \Mcwork\Entity\FsCustom();
            $entity->setSourcepath($sourcepath);
        } else {
            $entity = new \Mcwork\Entity\FsPublic();
        }
        
        $upload = new \Mcwork\Model\Fs\Upload(new StorageManager(), $entity, 'public');
        $upload->setDcPartial($this->getMcParameter('public_folder', 'Host'));
        $upload->setAlternateSizeFolder($this->getMcParameter('alternate_size_folder', 'Medias'));
        $upload->setAlternateSizes($this->getMcParameter('alternate_sizes', 'Medias'));
        $upload->setMediaAttributeFields($this->getMcParameter('media_attribute_fields', 'Medias'));
        if (isset($datas['current'])) {
            $upload->setFsCurrent($datas['current']);
        }
        if (isset($datas['newdir'])) {
            $upload->setNewDirectory($datas['newdir']);
        }
        try {
            $ret = $upload->singleUpload($uploadedFile, $datas['newname']);
            $save = new \Mcwork\Model\Save\Upload($this->worker->getStorage());
            $save->save($upload->preparedInsert($datas)
                ->emptyInserts(), new WebMedias());
            return $ret;
        } catch (\Exception $e) {
            echo Json::encode(array(
                'error' => $e->getMessage()
            ));
        }
    }

    /**
     * Change, update a sequence
     * 
     * @param array $params parameters to do this
     * @return \Zend\View\Model\ViewModel
     */
    protected function changeitemrang($params)
    {
        $worker = "Mcwork\\Model\\";
        if (preg_match('/_/', $params['categoryname'])) {
            $parts = explode('_', $params['categoryname']);
            $template = str_replace('_', '', $params['categoryname']);
            foreach ($parts as $part) {
                $worker .= ucfirst($part);
            }
        } else {
            $worker .= $params['categoryname'];
            $template = strtolower(str_replace('\\', '', $params['categoryname']));
        }
        
        // calculate and update new squence
        $db = new $worker($this->worker->getStorage());
        $sec = new Sequence($this->worker->getStorage());
        $entity = $db::ENTITY_CATEGORIES;
        $sec->setEntity(new $entity());
        if ('jump' == $params['datamove']) {
            $sec->itemjumprang($params['category'], $params['newrang'], $db::CATEGORIES_GROUP, $params['group']);
        } elseif ('moveup' == $params['datamove'] || 'movedown' == $params['datamove']) {
            $sec->itemmoverang($params['category'], $params['datamove'], $db::CATEGORIES_GROUP, $params['group']);
        }
        // get new table row sequence
        $result = $db->fetchContent(array(
            'id' => $params['group']
        ));
        
        // prepare new table view
        $view = new ViewModel();
        $view->setVariable('toolbarcontent', $this->getServiceLocator()
            ->get('Mcwork\Toolbar'));
        $view->setVariable('onlytable', true);
        $view->setVariable('entries', $result);
        $view->setTemplate('content/' . $template);
        return $view;
    }

    /**
     * Remove a category from a group
     * Calculate the new squence
     * Return the new correct table view
     * 
     * @param array $params parameters to do this
     * @return \Zend\View\Model\ViewModel
     */
    protected function removeitem($params)
    {
        foreach ($params as $row) {
            $worker = "Mcwork\\Model\\" . $row['categoryname'];
            $template = strtolower(str_replace('\\', '', $row['categoryname']));
            $group = $row['dataGroup'];
            break;
        }
        
        $worker = new $worker($this->worker->getStorage());
        $entity = $worker::ENTITY_CATEGORIES;
        $worker->setEntity(new $entity());
        $worker->setSl($this->getServiceLocator());
        $del = $worker->removeItem($params);
        if (false === $del) {
            print 0;
            exit();
        }
        
        // calculate and update new squence
        $sec = new Sequence($this->worker->getStorage());
        $sec->setEntity(new $entity());
        $sec->sortItemRang($worker::CATEGORIES_GROUP, $group);
        
        // get new table row sequence
        $result = $worker->fetchContent(array(
            'id' => $group
        ));
        
        // prepare new table view
        $view = new ViewModel();
        $view->setVariable('toolbarcontent', $this->getServiceLocator()
            ->get('Mcwork\Toolbar'));
        $view->setVariable('onlytable', true);
        $view->setVariable('entries', $result);
        $view->setTemplate('content/' . $template);
        return $view;
    }

    /**
     * File explorer for the javascript client
     * 
     * @param array $params parameters to do this
     * @return Ambigous <string, mixed>
     */
    protected function explorer($params)
    {
        if (false !== ($sourcepath = $this->getMcParameter('public_directory_path', 'Host'))) {
            $entity = new \Mcwork\Entity\FsCustom();
            $entity->setSourcepath($sourcepath);
        } else {
            $entity = new \Mcwork\Entity\FsPublic();
        }
        $dir = '';
        if (isset($params['dir']) && $entity->getCurrentPath() != $params['dir'] . '/') {
            $dir = str_replace($entity->getCurrentPath(), '', $params['dir']);
        }
        $fs = new \Mcwork\Model\Fs\Explorer(new StorageManager());
        $fs->setEntity($entity);
        $fs->setMedias($this->getServiceLocator()
            ->get('Mcwork\Medias'));
        return Json::encode($fs->ls($dir));
    }

    /**
     * Administrate the contribution modules
     * 
     * @param array $params parameters to do this
     * @throws \Exception
     * @return Ambigous <string, mixed>
     */
    protected function contributionModule($params)
    {
        if (isset($params['entity'])) {
            $entity = $params['entity'];
            try {
                $entity = new $entity();
                $repository = $this->worker->getStorage()->getRepository($entity->getEntityName());
                if (isset($params['findBy'])) {
                    $entries = $repository->findBy($this->findBy);
                } else {
                    $entries = $repository->findAll();
                }
                $options = array();
                foreach ($entries as $entry) {
                    $options[$entry->{$params['value']}] = $entry->{$params['label']};
                }
                return Json::encode($options);
            } catch (\Exception $e) {
                throw new InvalidArgumentException('Entity not found ' . $e->getMessage());
            }
        }
    }

    /**
     * Get item values to populate in a form
     * 
     * @param array $params parameters to do this
     * @throws \Exception
     * @return Ambigous <string, mixed>
     */
    protected function populateValues($params)
    {
        if (isset($params['entity']) && isset($params['id'])) {
            $entity = $params['entity'];
            try {
                
                $this->worker->setEntity(new $entity());
                return Json::encode($this->worker->fetchPopulateValues($params['id']));
            } catch (\Exception $e) {
                throw new \Exception('Entity not found ' . $e->getMessage());
            }
        } else {
            return Json::encode(array(
                'error' => self::MISSED_IDENT
            ));
        }
    }

    /**
     * Add an navigation branch
     * 
     * @param array $params parameters to do this
     * @return Ambigous <string, mixed>
     */
    protected function addsubmenue($params)
    {
        $add = new \Mcwork\Model\Categories\Navigation($this->worker->getStorage());
        return Json::encode($add->addNavigationBranch($params));
    }

    /**
     * Remove a navigation branch
     * 
     * @param array $params parameters to do this
     * @return Ambigous <string, mixed>
     */
    protected function removesubmenue($params)
    {
        $minus = new \Mcwork\Model\Categories\Navigation($this->worker->getStorage());
        return Json::encode($minus->unlinkNavigationBranch($params));
    }

    /**
     * Set a item publish or unpublish depends on current status
     * 
     * @param array $params parameters to do this
     * @return Ambigous <string, mixed>
     */
    protected function publishitem($params)
    {
        $worker = "Mcwork\\Model\\";
        
        if (preg_match('/_/', $params['categoryname'])) {
            $parts = explode('_', $params['categoryname']);
            foreach ($parts as $part) {
                $worker .= ucfirst($part);
            }
        } else {
            $worker .= $params['categoryname'];
        }
        $id = $params['ident'];
        $db = new $worker($this->worker->getStorage());
        $entity = $db->getPublishEntity();
        $db->setEntity(new $entity());
        try {
            return Json::encode(array(
                'msg' => $db->publish($id)
            ));
        } catch (\Exception $e) {
            return Json::encode(array(
                'error' => $e->getMessage()
            ));
        }
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