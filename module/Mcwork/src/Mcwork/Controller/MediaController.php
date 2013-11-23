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

/**
 * media controller backend
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class MediaController extends AbstractContentinumController
{
    /**
     * Folder url seperator
     * @var string
     */
    protected $seperator = '_';
    
    /**
     * Base route this controller
     * @var string
     */
    protected $baseroute = 'mcwork/medias';
    /**
     * Backend start page
     *
     * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
     */
    public function indexAction ()
    {
        $params = $this->initParams();
        if ($params['mcworkpages']->Mcwork_Controller_Content_Medias){
            $content = $params['mcworkpages']->Mcwork_Controller_Content_Medias;
        }
        
        $this->adminlayout($this->layout(), $params['mcworkpages'], 'Mcwork_Controller_Content_Medias', $params['role'], $params['acl'], $this->getServiceLocator()
            ->get('viewHelperManager'));
        $entity = $this->getEntity();
        $cd = $this->currentFolder();
        return new ViewModel( array(
                'page' => 'Mcwork_Controller_Content_Medias',
                        'pagecontent' => $content,
                        'basepath' => $entity->getCurrentPath(),
                        'entries' => $this->directoryContent($entity,$cd),
                        'currentFolder' => $cd, 'seperator' => $this->seperator ));
    }
       
    
    public function uploadAction()
    {
        $params = $this->initParams();
        $cd = $this->currentFolder();
        if ($cd){
            $cd .= DS;
        } else {
            $cd = '';
        }
       
        if (!empty($_FILES)) {
             $target = $this->worker->getStorage()->setPath(DS.$this->entity->getCurrentPath())->getAdapter();
            //var_dump($_FILES);exit;
            if (is_array($_FILES['file']['tmp_name'])){
            foreach ($_FILES['file']['tmp_name'] as $k => $file){
            
            
        	$tempFile = $file; //$_FILES['file']['tmp_name'];          //3
        

        	 
        	$targetFile =  $target . DS . $cd . $_FILES['file']['name'][$k];  //5
        
        	move_uploaded_file($tempFile,$targetFile); //6
            
        	 echo true;
            }
            } else {
                $tempFile = $_FILES['file']['tmp_name'];          //3
                
                
                
                $targetFile =  $target . DS . $cd . $_FILES['file']['name'];  //5
                
                move_uploaded_file($tempFile,$targetFile); //6
                echo true;
            }
        }
       
       exit();
	}


    /**
     * Create a new directory
     */
    public function newfolderAction ()
    {
        $params = $this->initParams();
        $makeDirParams = $this->getRequest()->getPost();
        if (isset($makeDirParams['nf'])) {
            try {
                $msg = $this->getWorker()->makeDirectory($makeDirParams['nf'], $this->getEntity(), $makeDirParams['cd']);
                echo Json::encode(array('messages' => $msg));
            } catch (\Exception $e) {
                echo Json::encode(array('error' => $e->getMessage()));
            }
        } else {
            echo Json::encode(array('error' => 'wrong_param_to_create_folder'));
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
                echo true;
            } catch (\Exception $e) {
                echo Json::encode(array('error' => $e->getMessage()));
            }
        } else {
            echo Json::encode(array('error' => 'wrong_param_to_delete_items'));
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
    			echo Json::encode(array('error' => $e->getMessage()));
    		}
    	} else {
    		echo Json::encode(array('error' => 'wrong_param_to_zip_archive'));
    	}
    	exit();
    } 

    
    /**
     * Create a new directory
     */
    public function unzipAction ()
    {
    	$params = $this->initParams();
    	$dirParams = $this->getRequest()->getPost();
    	if (isset($dirParams['af'])) {
    		try {
    			$msg = $this->getWorker()->unzipDirectory($dirParams['af'], $this->getEntity(), $dirParams['cd']);
    			echo true;
    		} catch (\Exception $e) {
    			echo Json::encode(array('error' => $e->getMessage()));
    		}
    	} else {
    		echo Json::encode(array('error' => 'wrong_param_to_unzip_archive'));
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
    			echo true;
    		} catch (\Exception $e) {
    			echo Json::encode(array('error' => $e->getMessage()));
    		}
    	} else {
    		echo Json::encode(array('error' => 'wrong_param_to_copy_items'));
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
    			echo true;
    		} catch (\Exception $e) {
    			echo Json::encode(array('error' => $e->getMessage()));
    		}
    	} else {
    		echo Json::encode(array(
    				'error' => 'wrong_param_to_copy_items'));
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
        if ( isset($dirParams['fm']) ){
            try {
                $msg = $this->getWorker()->renameDirectory($dirParams['fm'], $dirParams['nfm'],$this->getEntity(),$dirParams['cd']);
                echo true;
            } catch (\Exception $e){
                echo Json::encode(array('error' => $e->getMessage()));
            }
        } else {
            echo Json::encode(array(
                    'error' => 'wrong_param_to_rename_items'));
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
	    if ( isset($dirParams['fn']) ){
	    	try {
	    		$props = $this->getWorker()->getFileProperties($dirParams['fn'], $this->getEntity(),$dirParams['cd']);
	    		echo Json::encode($props);
	    	} catch (\Exception $e){
	    		echo Json::encode(array('error' => $e->getMessage()));
	    	}
	    } else {
	    	echo Json::encode(array('error' => 'wrong_param_get_prop_items'));
	    }
	    exit();	    
	}

    /**
     * Get file content and provide this to download
     * @return \Zend\View\Model\ViewModel
     */
    public function downloadAction ()
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
        
        return new ViewModel(array('filename' => $fm,      'downloaditem' => $mng->getAdapter() . DS . $fm));
    }
    
    /**
     * Fetch directory items and print as html table
     * @return \Zend\View\Model\ViewModel
     */
    public function listAction()
    {
        $cd = $this->currentFolder ();       
        return new ViewModel( array('currentFolder' => $cd, 'seperator' => $this->seperator ,'entries' => $this->directoryContent($this->getEntity(),$cd) )  );
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
	 * @return Ambigous <string, mixed>
	 */
	public function configurationAction()
	{
	    echo Json::encode(array('baseroute' => $this->getBaseroute(), 'seperator' => $this->getSeperator(), 'repository' => $this->getEntity()->getCurrentPath(), 'dc' => DOCUMENT_ROOT, 'ds' => DS));
	    exit();
	}
	
	/**
	 * Get directory tree as html list
	 * @param boolean $skip skip or get tree with files
	 * @return string html ul list with directory tree
	 */
    protected function directoryTree($skip = true)
    {
        return $this->worker->getStorage()->getDirectoryTree($this->getEntity()->getCurrentPath(),$skip);
	}

    /**
     * Fetch all directory items
     * @param AbstractStorageEntity $entity
     * @param string $cd current folder to get the items
     * @return array with AbstractStorageEntity
     */
    protected function directoryContent ($entity, $cd = null)
    {
        return $this->getWorker()->fetchAll($entity, $cd);
    }

    /**
     * Decode current folder from query string
     * @param string $cd name of current folder
     * @return Ambigous <string, mixed>
     */
    protected function currentFolder ($cd = null)
    {
        if (null == $cd){
           $cd = $this->params()->fromRoute('cd', null);
        }
        if (null != $cd){
            $cd = str_replace($this->seperator, DS, $cd );
        }
        return $cd;
    }
    
    /**
     * Get folder url seperator
     * @return string
     */
	public function getSeperator() 
	{
		return $this->seperator;
	}
	
	/**
	 * Set folder url seperator
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
	 * @return string
	 */
	public function getBaseroute() 
	{
		return $this->baseroute;
	}
	
	/**
	 * Set base route
	 * @param string $baseroute
	 * @return \Mcwork\Controller\MediaController
	 */
	public function setBaseroute($baseroute) 
	{
		$this->baseroute = $baseroute;
		return $this;
	}
		
    /**
     * Init parameters
     * 
     * @return multitype:NULL
     */
    protected function initParams ()
    {
        return array(
                'mcworkpages' => $this->getServiceLocator()->get('Mcwork\Pages'),
                'acl' => $this->getServiceLocator()->get('Contentinum\Acl\Acl'),
                'role' => $this->getServiceLocator()->get('Contentinum\Acl\DefaultRole'));
    }
}