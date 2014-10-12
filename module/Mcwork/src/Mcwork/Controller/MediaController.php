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

use ContentinumComponents\Controller\AbstractContentinumController;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;
use Doctrine\ORM\EntityManager;
use Mcwork\Controller\Exception\InvalidArgumentException;

/**
 * media controller backend file handle
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class MediaController extends AbstractContentinumController
{

    /**
     * Folder url seperator
     *
     * @var string
     */
    protected $seperator = '_';

    /**
     * Base route this controller
     *
     * @var string
     */
    protected $baseroute = 'mcwork/medias';

    /**
     * Public host folder
     *
     * @var string
     */
    protected $hostfolder = 'public';

    /**
     * Public or non public file system area
     *
     * @var string
     */
    protected $area = 'public';

    /**
     * Doctrine EntityManager
     *
     * @var EntityManager
     */
    protected $em = false;

    /**
     * Index action display file system content
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction()
    {
        $params = $this->initParams();
        if ($params['mcworkpages']->Mcwork_Controller_Content_Medias) {
            $content = $params['mcworkpages']->Mcwork_Controller_Content_Medias;
        }
        $this->adminlayout($this->layout(), $params['mcworkpages'], 'Mcwork_Controller_Content_Medias', $params['role'], $params['acl'], $this->getServiceLocator()
            ->get('viewHelperManager'));
        $entity = $this->initFsEntity();
        $cd = $this->currentFolder();
        return new ViewModel(array(
            'xmlhttp' => $this->getXmlHttpRequest(),
            'host' => $params['host'],
            'docroot' => $this->worker->getStorage()->getDocumentRoot(),
            'mediatable' => $params['medias'],
            'inusemedias' => $params['inusemedias'],
            'page' => 'Mcwork_Controller_Content_Medias',
            'pagecontent' => $content,
            'basepath' => $entity->getCurrentPath(),
            'entries' => $this->directoryContent($entity, $cd),
            'currentFolder' => $cd,
            'disablefolder' => array(
                $this->getMcParameter('alternate_size_folder', 'Medias')
            ),
            'seperator' => $this->seperator
        ));
    }

    /**
     * Upload action, multiple upload with dropzone
     */
    public function uploadAction()
    {
        if (! empty($_FILES) && is_array($_FILES['file']['tmp_name'])) {
            $params = $this->initParams();
            $fs = new \Mcwork\Model\Fs\Upload($this->worker->getStorage(), $this->initFsEntity(), $this->area);
            $fs->setDcPartial($this->getMcParameter('public_folder', 'Host'));
            $fs->setAlternateSizeFolder($this->getMcParameter('alternate_size_folder', 'Medias'));
            $fs->setAlternateSizes($this->getMcParameter('alternate_sizes', 'Medias'));
            $fs->setMediaAttributeFields($this->getMcParameter('media_attribute_fields', 'Medias'));
            $fs->setFsCurrent(($this->currentFolder()) ? $this->currentFolder() . DS : '');
            if (null != $this->em) {
                $db = new \Mcwork\Model\Save\Upload($this->getEm());
                $db->setLogger($this->worker->getLogger());
            }
            try {
                foreach ($_FILES['file']['tmp_name'] as $k => $file) {
                    $fs->multipleUpload($_FILES, $k, $file);
                    if (null != $this->em) {
                        $mediaEntity = \Mcwork\Model\Medias\Administrate::MEDIA_ENTITY;
                        $db->save($fs->preparedInsert(array())
                            ->emptyInserts(), new $mediaEntity());
                    }
                    $return[$_FILES['file']['name'][$k]]['filename'] = $fs->getTargetFileName();
                }
                // empty file cache medias
                $this->emptyMediaCache();
                // server response
                echo Json::encode($return);
                exit();
            } catch (\Exception $e) {
                echo Json::encode(array(
                    'error' => $e->getMessage()
                ));
                exit();
            }
        }
        echo Json::encode(array(
            'error' => 'wrong_param_to_upload_files'
        ));
        exit();
    }

    /**
     * New folder action, create new directories
     */
    public function newfolderAction()
    {
        $params = $this->initParams();
        $makeDirParams = $this->getRequest()->getPost();
        if (isset($makeDirParams['nf'])) {
            try {
                $fs = new \Mcwork\Model\Fs\Directory($this->worker->getStorage(), $this->initFsEntity(), $this->area);
                $fs->setFsCurrent($makeDirParams['cd']);
                $fs->setNewDirectory($makeDirParams['nf']);
                $message = $fs->mkdir();
                echo Json::encode(array(
                    'messages' => $message
                ));
            } catch (\Exception $e) {
                echo Json::encode(array(
                    'error' => $e->getMessage()
                ));
            }
        } else {
            echo Json::encode(array(
                'error' => 'wrong_param_to_create_folder'
            ));
        }
        exit();
    }

    /**
     * Remove action, delete/remove files or folders within the allowed directory tree
     */
    public function removeAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['cb'])) {
            try {
                $emptyCache = false;
                $fs = new \Mcwork\Model\Fs\Remove($this->worker->getStorage(), $this->initFsEntity(), $this->area);
                $fs->setFsCurrent($dirParams['cd']);
                if (null != $this->em) {
                    $db = new \Mcwork\Model\Medias\Remove($this->em);
                    $db->setLogger($this->worker->getLogger());
                    $db->setEntity($db->getMediaEntity());
                }
                foreach ($dirParams['cb'] as $item => $row) {
                    $fs->setRemoveFsItems($item);
                    $msg = $fs->remove();
                    if (null != $this->em && 'file' == $row['data-type']) {
                        if (isset($row['data-ident']) && $row['data-ident'] > '0') {
                            $emptyCache = true;
                            $db->setFs($fs);
                            $db->setDbIdent($row['data-ident']);
                            $db->setLogAction($this->worker->getStorage()
                                ->getLogAction())
                                ->setOperation('delete');
                            $db->setDocumentRoot($fs->getDocumentRoot() . DS . $fs->getDcPartial());
                            $db->remove();
                        }
                    }
                    if (true === $emptyCache) {
                        // empty file cache medias
                        $this->emptyMediaCache();
                    }
                }
                echo true;
            } catch (\Exception $e) {
                echo Json::encode(array(
                    'error' => $e->getMessage()
                ));
            }
        } else {
            echo Json::encode(array(
                'error' => 'wrong_param_to_delete_items'
            ));
        }
        exit();
    }

    /**
     * Zip Action, zip files or folders within the allowed directory tree
     */
    public function zipAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        
        if (isset($dirParams['cb'])) {
            try {
                $fs = new \Mcwork\Model\Fs\Zip($this->worker->getStorage(), $this->initFsEntity(), $this->area);
                $fs->setFsCurrent($dirParams['cd']);
                $fs->setArchive($dirParams['af']);
                $fs->setArchiveItems($dirParams['cb']);
                $msg = $fs->zip();
                echo true;
            } catch (\Exception $e) {
                echo Json::encode(array(
                    'error' => $e->getMessage()
                ));
            }
        } else {
            echo Json::encode(array(
                'error' => 'wrong_param_to_zip_archive'
            ));
        }
        exit();
    }

    /**
     * Unzip action, unzip files or folders within the allowed directory tree
     */
    public function unzipAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['af'])) {
            try {
                $fs = new \Mcwork\Model\Fs\Zip($this->worker->getStorage(), $this->initFsEntity(), $this->area);
                $fs->setFsCurrent($dirParams['cd']);
                $fs->setArchive($dirParams['af']);
                $msg = $fs->unzip();
                
                $db = new \Mcwork\Model\Medias\Unzip($this->worker->getStorage(), $this->initFsEntity(), $this->area);
                $db->setDcPartial($this->getMcParameter('public_folder', 'Host'));
                $db->setAlternateSizeFolder($this->getMcParameter('alternate_size_folder', 'Medias'));
                $db->setAlternateSizes($this->getMcParameter('alternate_sizes', 'Medias'));
                $db->setMediaAttributeFields($this->getMcParameter('media_attribute_fields', 'Medias'));
                $db->unzip($this->worker->getStorage()
                    ->getLogAction());
                
                echo true;
            } catch (\Exception $e) {
                echo Json::encode(array(
                    'error' => $e->getMessage()
                ));
            }
        } else {
            echo Json::encode(array(
                'error' => 'wrong_param_to_unzip_archive'
            ));
        }
        exit();
    }

    /**
     * Copy action, copy files or folders within the allowed directory tree
     */
    public function copyAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['cb'])) {
            try {
                $emptyCache = false;
                $fs = new \Mcwork\Model\Fs\Copy($this->worker->getStorage(), $this->initFsEntity(), $this->area);
                $fs->setFsCurrent($dirParams['cd']);
                $fs->setDestination($dirParams['df']);
                $fs->setDcPartial($this->getMcParameter('public_folder', 'Host'));
                if (null != $this->em) {
                    $db = new \Mcwork\Model\Medias\Copy($this->em);
                    $db->setHiddenFolder($this->getMcParameter('alternate_size_folder', 'Medias'));
                    $db->setLogger($this->worker->getLogger());
                    $db->setEntity($db->getMediaEntity());
                    $db->setDocumentRoot($fs->getDocumentRoot() . DS . $fs->getDcPartial());
                }
                foreach ($dirParams['cb'] as $item => $row) {
                    $fs->setCopyItems($item);
                    $msg = $fs->copy();
                    if (null != $this->em && 'file' == $row['data-type']) {
                        if (isset($row['data-ident']) && $row['data-ident'] > '0') {
                            $db->setFs($fs);
                            $db->setDbIdent($row['data-ident']);
                            $db->setLogAction($this->worker->getStorage()
                                ->getLogAction())
                                ->setOperation('copy');
                            $db->copy();
                            $emptyCache = true;
                        }
                    }
                }
                if (true === $emptyCache) {
                    // empty file cache medias
                    $this->emptyMediaCache();
                }
                echo true;
            } catch (\Exception $e) {
                echo Json::encode(array(
                    'error' => $e->getMessage()
                ));
            }
        } else {
            echo Json::encode(array(
                'error' => 'wrong_param_to_copy_items'
            ));
        }
        exit();
    }

    /**
     * Move Action, move folder and/or files within the allowed directory tree
     */
    public function moveAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['cb'])) {
            try {
                $emptyCache = false;
                $fs = new \Mcwork\Model\Fs\Move($this->worker->getStorage(), $this->initFsEntity(), $this->area);
                $fs->setFsCurrent($dirParams['cd']);
                $fs->setDestination($dirParams['df']);
                $fs->setDcPartial($this->getMcParameter('public_folder', 'Host'));
                if (null != $this->em) {
                    $db = new \Mcwork\Model\Medias\Move($this->em);
                    $db->setHiddenFolder($this->getMcParameter('alternate_size_folder', 'Medias'));
                    $db->setLogger($this->worker->getLogger());
                    $db->setEntity($db->getMediaEntity());
                    $db->setDocumentRoot($fs->getDocumentRoot() . DS . $fs->getDcPartial());
                }
                foreach ($dirParams['cb'] as $item => $row) {
                    $fs->setMoveItems($item);
                    $msg = $fs->move();
                    if (null != $this->em && 'file' == $row['data-type']) {
                        if (isset($row['data-ident']) && $row['data-ident'] > '0') {
                            $db->setFs($fs);
                            $db->setDbIdent($row['data-ident']);
                            $db->setLogAction($this->worker->getStorage()
                                ->getLogAction())
                                ->setOperation('move');
                            $db->move();
                            $emptyCache = true;
                        }
                    }
                }
                if (true === $emptyCache) {
                    // empty file cache medias
                    $this->emptyMediaCache();
                }
                
                echo true;
            } catch (\Exception $e) {
                echo Json::encode(array(
                    'error' => $e->getMessage()
                ));
            }
        } else {
            echo Json::encode(array(
                'error' => 'wrong_param_to_move_items'
            ));
        }
        exit();
    }

    /**
     * Rename Action, rename files or folders within the allowed directory tree
     */
    public function renameAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['fm'])) {
            try {
                $fs = new \Mcwork\Model\Fs\Rename($this->worker->getStorage(), $this->initFsEntity(), $this->area);
                $fs->setFsCurrent($dirParams['cd']);
                $fs->setCurrentName($dirParams['fm']);
                $fs->setNewName($dirParams['nfm'], $dirParams['mediatype']);
                $msg = $fs->rename();
                if (null != $this->em && 'file' == $dirParams['mediatype']) {
                    $db = new \Mcwork\Model\Medias\Rename($this->em);
                    $db->setLogger($this->worker->getLogger());
                    $db->setEntity($db->getMediaEntity());
                    $db->setDocumentRoot($fs->getDocumentRoot());
                    $db->setDbIdent($dirParams['dbident']);
                    $db->setFs($fs);
                    $db->rename();
                    // empty file cache medias
                    $this->emptyMediaCache();
                }
                echo true;
            } catch (\Exception $e) {
                echo Json::encode(array(
                    'error' => $e->getMessage()
                ));
            }
        } else {
            echo Json::encode(array(
                'error' => 'wrong_param_to_rename_items'
            ));
        }
        exit();
    }

    /**
     * Get file or folder properties
     */
    public function propertiesAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['fn'])) {
            try {
                $props = $this->getWorker()->getFileProperties($dirParams['fn'], $this->getEntity(), $dirParams['cd']);
                echo Json::encode($props);
            } catch (\Exception $e) {
                echo Json::encode(array(
                    'error' => $e->getMessage()
                ));
            }
        } else {
            echo Json::encode(array(
                'error' => 'wrong_param_get_prop_items'
            ));
        }
        exit();
    }

    /**
     * Get file content and provide this to download
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function downloadAction()
    {
        $params = $this->initParams();
        $fm = $this->params()->fromRoute('fm', false);
        $cd = $this->currentFolder();
        $mng = $this->getWorker()->getStorage();
        if ($cd) {
            $mng->setCurrent($cd);
        }
        $entity = $this->getEntity();
        $mng->setPath(DS . $entity->getCurrentPath());
        
        return new ViewModel(array(
            'filename' => $fm,
            'downloaditem' => $mng->getAdapter() . DS . $fm
        ));
    }

    /**
     * Fetch directory items and print as html table
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function listAction()
    {
        try {
            $cd = $this->currentFolder();
            return new ViewModel(array(
                'currentFolder' => $cd,
                'seperator' => $this->seperator,
                'entries' => $this->directoryContent($this->getEntity(), $cd)
            ));
        } catch (\Exception $e) {
            echo Json::encode(array(
                'error' => $e->getCode()
            ));
            exit();
        }
    }

    /**
     * Get and print the directory tree list
     */
    public function treeAction()
    {
        echo $this->directoryTree();
        exit();
    }

    /**
     * Get media files configuration
     *
     * @return Ambigous <string, mixed>
     */
    public function configurationAction()
    {
        $allowed = '';
        $allowedUploads = $this->getMcParameter('allowed_uploads', 'Medias');
        $allowedUploads = $allowedUploads->toArray();
        foreach ($allowedUploads as $ext => $value) {
            if (true === $value) {
                $allowed .= ' .' . $ext . ',';
            }
        }
        $uri = $this->getRequest()->getUri();
        $base = sprintf('%s://%s', $uri->getScheme(), $uri->getHost());
        echo Json::encode(array(
            'host' => $base,
            'baseroute' => $this->getBaseroute(),
            'seperator' => $this->getSeperator(),
            'repository' => $this->getEntity()->getCurrentPath(),
            'dc' => DOCUMENT_ROOT,
            'ds' => DS,
            'allowedUploads' => substr($allowed, 0, - 1),
            'maxFilesize' => $this->getMcParameter('max_filesize', 'Medias')
        ));
        exit();
    }

    /**
     * Get directory tree as html list
     *
     * @param boolean $skip skip or get tree with files
     * @return string html ul list with directory tree
     */
    protected function directoryTree($skip = true)
    {
        return $this->worker->getStorage()->getDirectoryTree($this->getEntity()
            ->getCurrentPath(), $skip);
    }

    /**
     * Fetch all directory items
     *
     * @param AbstractStorageEntity $entity
     * @param string $cd current folder to get the items
     * @return array with AbstractStorageEntity
     */
    protected function directoryContent($entity, $cd = null)
    {
        return $this->getWorker()->fetchAll($entity, $cd);
    }

    /**
     * Decode current folder from query string
     *
     * @param string $cd name of current folder
     * @return Ambigous <string, mixed>
     */
    protected function currentFolder($cd = null)
    {
        if (null == $cd) {
            $cd = $this->params()->fromRoute('cd', null);
        }
        if (null != $cd) {
            $cd = str_replace($this->seperator, DS, $cd);
        }
        return $cd;
    }

    /**
     * Get folder url seperator
     *
     * @return string
     */
    public function getSeperator()
    {
        return $this->seperator;
    }

    /**
     * Set folder url seperator
     *
     * @param string $seperator
     * @return \Mcwork\Controller\MediaController
     */
    public function setSeperator($seperator)
    {
        $this->seperator = $seperator;
        return $this;
    }

    /**
     * Get base route
     *
     * @return string
     */
    public function getBaseroute()
    {
        return $this->baseroute;
    }

    /**
     * Set base route
     *
     * @param string $baseroute
     * @return \Mcwork\Controller\MediaController
     */
    public function setBaseroute($baseroute)
    {
        $this->baseroute = $baseroute;
        return $this;
    }

    /**
     *
     * @return the $em
     */
    public function getEm()
    {
        return $this->em;
    }

    /**
     *
     * @param \Doctrine\ORM\EntityManager $em
     */
    public function setEm($em)
    {
        $this->em = $em;
    }

    /**
     *
     * @return the $area
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     *
     * @param string $area
     */
    public function setArea($area)
    {
        $this->area = $area;
    }

    /**
     * Empty media cache
     *
     * @param string $key
     */
    public function emptyMediaCache($key = 'mcwork_medias')
    {
        $empty = new \Mcwork\Model\Cache\Content();
        $fsEntity = \Mcwork\Model\Cache\Content::CACHE_FSENTITY;
        $empty->emptyCache(array(
            'id' => $key
        ), new $fsEntity(), $this->getServiceLocator());
    }

    /**
     * Init directory path to a file system
     *
     * @throws InvalidArgumentException
     * @return \Mcwork\Entity\FsCustom|\Mcwork\Entity\FsPublic|\Mcwork\Entity\FsDenied
     */
    protected function initFsEntity()
    {
        if ('public' == $this->area) {
            if (false !== ($sourcepath = $this->getMcParameter('public_directory_path', 'Host'))) {
                $entity = new \Mcwork\Entity\FsCustom();
                $entity->setSourcepath($sourcepath);
                return $entity;
            } else {
                return new \Mcwork\Entity\FsPublic();
            }
        } elseif ('denied' == $this->area) {
            if (false !== ($sourcepath = $this->getMcParameter('denied_directory_path', 'Host'))) {
                $entity = new \Mcwork\Entity\FsCustom();
                $entity->setSourcepath($sourcepath);
                return $entity;
            } else {
                return new \Mcwork\Entity\FsDenied();
            }
        } else {
            throw new InvalidArgumentException('Does not define a file system');
        }
    }

    /**
     * Init parameters
     *
     * @return multitype:NULL
     */
    protected function initParams()
    {
        $medias = array();
        try {
            $medias = $this->getServiceLocator()->get('Mcwork\Medias');
        } catch (\Exception $e) {
            if (true == ($log = $this->worker->getLogger())) {
                $log->notice('No entry in media table or ' . $e->getMessage());
            }
        }
        
        return array(
            'mcworkpages' => $this->getServiceLocator()->get('Mcwork\Pages'),
            'acl' => $this->getServiceLocator()->get('Contentinum\Acl\Acl'),
            'role' => $this->getServiceLocator()->get('Contentinum\Acl\DefaultRole'),
            'medias' => $medias,
            'inusemedias' => $this->getServiceLocator()->get('Mcwork\MediaInUse'),
            'host' => $this->getRequest()
                ->getUri()
                ->getHost()
        );
    }
}