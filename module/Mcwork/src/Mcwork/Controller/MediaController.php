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
use ContentinumComponents\Filter\Url\Prepare;
use ContentinumComponents\File\Extension;
use ContentinumComponents\File\Name;
use ContentinumComponents\Images\Size;
use ContentinumComponents\Images\Resize;
use ContentinumComponents\Path\Clean;
use Mcwork\Model\HandleUpload;
use Contentinum\Entity\WebMedias;
use Mcwork\Model\Cachecontent;
use Mcwork\Entity\CacheFiles;
use Mcwork\Model\SaveMedias;
use ContentinumComponents\Tools\HandleSerializeDatabase;
use Doctrine\ORM\EntityManager;
use Mcwork\Model\HandleMedias;

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
     * Doctrine EntityManager
     * @var EntityManager
     */
    protected $em = false;

    /**
     * Backend start page
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
        $entity = $this->getEntity();
        $cd = $this->currentFolder();
        return new ViewModel(array(
            'host' => $params['host'],
            'docroot' => $this->worker->getStorage()->getDocumentRoot(),
            'mediatable' => $params['medias'],
            'page' => 'Mcwork_Controller_Content_Medias',
            'pagecontent' => $content,
            'basepath' => $entity->getCurrentPath(),
            'entries' => $this->directoryContent($entity, $cd),
            'currentFolder' => $cd,
            'disablefolder' => array('_alternate'),
            'seperator' => $this->seperator
        ));
    }

    /**
     * Uplod medias save meta datas in database
     */
    public function uploadAction()
    {
        $params = $this->initParams();
        $cd = $this->currentFolder();
        if ($cd) {
            $cd .= DS;
        } else {
            $cd = '';
        }

        if (! empty($_FILES)) {
            $allowedUploads = $this->getMcParameter('allowed_uploads', 'Medias');
            $allowedUploads = $allowedUploads->toArray();
            $alternateSizes = $this->getMcParameter('alternate_sizes', 'Medias');
            $save = false;
            if (null != $this->em) {
                $save = new HandleUpload($this->getEm());
                $save->setLogger($this->worker->getLogger());
                $mcSerialize = new HandleSerializeDatabase();
            }
            
            $target = $this->worker->getStorage()
                ->setPath(DS . $this->entity->getCurrentPath())
                ->getAdapter() . DS . $cd;
            $docRoot = $this->worker->getStorage()->getDocumentRoot();
            if (is_array($_FILES['file']['tmp_name'])) {
                foreach ($_FILES['file']['tmp_name'] as $k => $file) {
                    $ext = Extension::get($_FILES['file']['name'][$k]);
                    switch ($ext){
                    	case 'JPG':
                    	case 'JPEG':
                    	case 'jpeg':
                    	    $ext = 'jpg';
                    	break;
                    	default:
                    	    break;
                    }
                    
                    if (!isset($allowedUploads[$ext])){                      
                        continue;
                    }
                    
                    $mediaName = Name::get($_FILES['file']['name'][$k]);
                    $filter = new Prepare(); // filter filename to a url friendly string
                                             // extract filename, replaces dots and withespace with a dash
                    $targetFileName = $filter->filter(str_replace('.', '-', $mediaName)) . '.' . $ext;
                    unset($filter);
                    $return[$_FILES['file']['name'][$k]]['filename'] = $targetFileName; // build server response
                    $targetFile = $target . $targetFileName; // build target file
                    move_uploaded_file($file, $targetFile);
                    // prepare database insert ...
                    if (false !== $save) { // ... if connector available
                        $insert['mediaName'] = $_FILES['file']['name'][$k]; // original file name
                        $insert['mediaType'] = $_FILES['file']['type'][$k];
                        $insert['mediaSource'] = Clean::get(str_replace($docRoot, '', $targetFile));
                        $insert['mediaLink'] = str_replace(DS . $this->hostfolder, '', $insert['mediaSource']);
                        $insert['mediaAlternate'] = '';
                        $insert['mediaMetas'] = '';
                        $insert['metaCoding'] = $mcSerialize::STD_METHOD;
                    }
                    switch ($ext) {
                        case "JPG":
                        case "JPEG":
                        case "jpg":
                        case "jpeg":
                        // $attribs['exif'] = exif_read_data($targetFile); // disable to much and to different datas
                        case "PNG":
                        case "png":
                        case "GIF":
                        case "gif":                            
                            if (! is_dir($target . '_alternate')) {
                                $this->getWorker()->makeDirectory('_alternate', $this->getEntity(), $cd);
                            }                           
                            $resize = new Resize(200, $targetFile, $targetFileName, $target . '_alternate' . DS);
                            foreach ($alternateSizes as $key => $value) {
                                $resize->setTarget($value);
                                if (false !== $resize->execute()) {
                                    $source = Clean::get(str_replace($docRoot, '', $resize->getResizeImageSource()));
                                    if (false !== $save) {
                                        $mediaAlternate[$key]['mediaSource'] = $source;
                                        $mediaAlternate[$key]['mediaLink'] = str_replace(DS . $this->hostfolder, '', $source);
                                        $mediaAlternate[$key]['dimensions'] = $resize->getNewsize();
                                    }
                                }
                            }
                            
                            if (false !== $save) {
                                $insert['mediaMetas'] = $mcSerialize->execSerialize(array(
                                    'alt' => $mediaName
                                ));                             
                                $size = new Size($targetFile);
                                $size->imgSize();                               
                                if ($insert['mediaType'] != ($type = image_type_to_mime_type(exif_imagetype($targetFile)))) {
                                    $insert['mediaType'] = $type;
                                }
                                $attribs['dimensions'] = array(
                                    'height' => $size->getHeight(),
                                    'width' => $size->getWidth()
                                );
                                $insert['mediaAttribute'] = $mcSerialize->execSerialize($attribs);                         
                                $insert['mediaAlternate'] = $mcSerialize->execSerialize($mediaAlternate);
                            }
                            break;
                        case "ico":
                        case "tiff":
                        case "bmp":
                            if (false !== $save) {
                                $insert['mediaMetas'] = $mcSerialize->execSerialize(array(
                                    'alt' => $mediaName
                                ));
                            }
                            break;
                        default:
                            if (false !== $save) {
                                $insert['mediaMetas'] = $mcSerialize->execSerialize(array(
                                    'linkname' => $mediaName
                                ));
                            }
                            break;
                    }
                    if (false !== $save) {
                    // save in media database
                    $save->save($insert, new WebMedias());
                    }
                }
                // empty file cache medias
                $this->emptyMediaCache();
                // server response
                echo Json::encode($return);
                exit();
            } else {
                echo Json::encode(array(
                    'error' => 'wrong_param_to_upload_files'
                ));
            }
        }
        exit();
    }

    /**
     * Create a new directory
     */
    public function newfolderAction()
    {
        $params = $this->initParams();
        $makeDirParams = $this->getRequest()->getPost();
        if (isset($makeDirParams['nf'])) {
            try {
                $filter = new Prepare();
                $nf = $filter->filter($makeDirParams['nf']);
                unset($filter);                
                $msg = $this->getWorker()->makeDirectory($nf, $this->getEntity(), $makeDirParams['cd']);
                echo Json::encode(array(
                    'messages' => $msg
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
     * Delete/Remove files or folders within the allowed directory tree
     */
    public function removeAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['cb'])) {
            try {
                $msg = $this->getWorker()->removeDirectory($dirParams['cb'], $this->getEntity(), $dirParams['cd']);
                if (null != $this->em) {
                	$del = new HandleMedias($this->getEm());
                	$del->setLogger($this->worker->getLogger());
                	$del->setEntity(new WebMedias());
                	$del->setLogAction($this->worker->getStorage()->getLogAction())->setOperation('delete');
                	$del->setDocumentRoot($this->worker->getStorage()->getDocumentRoot() . DS . $this->hostfolder);
                	$del->operate();
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
                'error' => 'wrong_param_to_delete_items'
            ));
        }
        exit();
    }

    /**
     * Zip files or folders within the allowed directory tree
     */
    public function zipAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['cb'])) {
            try {
                $msg = $this->getWorker()->zipDirectory($dirParams['cb'], $dirParams['af'], $this->getEntity(), $dirParams['cd']);
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
     * Create a new directory
     */
    public function unzipAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['af'])) {
            try {
                $msg = $this->getWorker()->unzipDirectory($dirParams['af'], $this->getEntity(), $dirParams['cd']);
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
     * Copy files or folders within the allowed directory tree
     */
    public function copyAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['cb'])) {           
            try {
                $msg = $this->getWorker()->copyDirectory($dirParams['cb'], $dirParams['df'], $this->getEntity(), $dirParams['cd']);
                if (null != $this->em) {
                	$copy = new HandleMedias($this->getEm());
                	$copy->setLogger($this->worker->getLogger());
                	$copy->setEntity(new WebMedias());
                	$copy->setLogAction($this->worker->getStorage()->getLogAction())->setOperation('copy');
                	$copy->setDocumentRoot($this->worker->getStorage()->getDocumentRoot() . DS . $this->hostfolder);
                	$copy->operate();
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
     * Move folder and/or files within the allowed directory tree
     */
    public function moveAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['cb'])) {
            try {
                $msg = $this->getWorker()->moveDirectory($dirParams['cb'], $dirParams['df'], $this->getEntity(), $dirParams['cd']);
                if (null != $this->em) {
                	$move = new HandleMedias($this->getEm());
                	$move->setLogger($this->worker->getLogger());
                	$move->setEntity(new WebMedias());
                	$move->setLogAction($this->worker->getStorage()->getLogAction())->setOperation('move');
                	$move->setDocumentRoot($this->worker->getStorage()->getDocumentRoot() . DS . $this->hostfolder);
                	$move->operate();
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
     * Rename a folder or a file
     */
    public function renameAction()
    {
        $params = $this->initParams();
        $dirParams = $this->getRequest()->getPost();
        if (isset($dirParams['fm'])) {
            $worker = new SaveMedias($this->getServiceLocator()->get('doctrine.entitymanager.orm_default'));
            $worker->setEntity(new WebMedias());
            $result = $worker->find($dirParams['dbident']);
            $update['mediaName'] = $dirParams['nfm']; // $result->mediaName;
            $ext = Extension::get($dirParams['nfm']);
            $filter = new Prepare();
            $fileNameNoExt = $filter->filter(str_replace('.', '-', Name::get($dirParams['nfm'])));
            unset($filter);
            $newFileName = $fileNameNoExt . '.' . $ext;
            $update['mediaSource'] = str_replace($dirParams['fm'], $newFileName, $result->mediaSource);
            $update['mediaLink'] = str_replace($dirParams['fm'], $newFileName, $result->mediaLink);
            $mcSerialize = new HandleSerializeDatabase();
            $bulkRename = $mcSerialize->execUnserialize($result->mediaAlternate);
            
            try {
                $msg = $this->getWorker()->renameDirectory($dirParams['fm'], $newFileName, $this->getEntity(), $dirParams['cd']);
                if (is_array($bulkRename) && ! empty($bulkRename)) {
                    $search = Name::get($dirParams['fm']) . '-';
                    $replace = $fileNameNoExt . '-';                    
                    $bulkRenamed = array();
                    foreach ($bulkRename as $key => $bulkRow){
                        if ( isset($bulkRow['mediaSource']) ){ 
                            $bulkRow['mediaSource'] = str_replace($search, $replace, $bulkRow['mediaSource'] );
                        }
                        if ( isset($bulkRow['mediaLink']) ){
                        	$bulkRow['mediaLink'] = str_replace($search, $replace, $bulkRow['mediaLink'] );
                        }  
                        $bulkRenamed[$key] = $bulkRow;
                        
                    }
                    $update['mediaAlternate'] = $mcSerialize->execSerialize($bulkRenamed);
                    $docRoot = $this->worker->getStorage()->getDocumentRoot();
                    foreach ($bulkRename as $key => $row) {
                        $source = $docRoot . $row['mediaSource'];
                        $destination = $docRoot . str_replace($search, $replace, $row['mediaSource']);
                        $this->getWorker()
                            ->getStorage()
                            ->rename($source, $destination);
                    }
                }
                $worker->save($update, $result);
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
        $cd = $this->currentFolder();
        return new ViewModel(array(
            'currentFolder' => $cd,
            'seperator' => $this->seperator,
            'entries' => $this->directoryContent($this->getEntity(), $cd)
        ));
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
        	if (true === $value){
        	    $allowed .= ' .' . $ext . ',';
        	}
        }
        echo Json::encode(array(
            'baseroute' => $this->getBaseroute(),
            'seperator' => $this->getSeperator(),
            'repository' => $this->getEntity()->getCurrentPath(),
            'dc' => DOCUMENT_ROOT,
            'ds' => DS, 
            'allowedUploads' => substr($allowed, 0, -1),
            'maxFilesize' => $this->getMcParameter('max_filesize', 'Medias'),
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
	 * @return the $em
	 */
	public function getEm() 
	{
		return $this->em;
	}

	/**
	 * @param \Doctrine\ORM\EntityManager $em
	 */
	public function setEm($em) 
	{
		$this->em = $em;
	}

    /**
     * Empty media cache
     * 
     * @param string $key
     */
    public function emptyMediaCache($key = 'mcworkwebsitemedias')
    {
        $empty = new Cachecontent(); // empty file cache medias
        $empty->emptyCache(array(
            'id' => $key
        ), new CacheFiles(), $this->getServiceLocator());
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
            if (true == ($log = $this->worker->getLogger())){
            	$log->notice('No entry in media table or ' . $e->getMessage());
            }        	
        }
        
        return array(
            'mcworkpages' => $this->getServiceLocator()->get('Mcwork\Pages'),
            'acl' => $this->getServiceLocator()->get('Contentinum\Acl\Acl'),
            'role' => $this->getServiceLocator()->get('Contentinum\Acl\DefaultRole'),
            'medias' => $medias,
            'host' => $this->getRequest()
                ->getUri()
                ->getHost()
        );
    }
}