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
 * @category Mcwork
 * @package Model
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Mcwork\Model;

use Mcwork\Model\SaveMedias;
use Mcwork\Model\Exception\ParamNotExistsModelException;
use ContentinumComponents\Tools\HandleSerializeDatabase;

/**
 *
 * @author mike
 *        
 */
class HandleMedias extends SaveMedias
{

    /**
     * Operation method
     *
     * @var string
     */
    protected $operation;

    /**
     * Store any copy, move or delete
     *
     * @var array
     */
    protected $logAction = array();

    /**
     * Document root
     *
     * @var string
     */
    protected $documentRoot;

    /**
     *
     * @return the $operation
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     *
     * @param string $operation
     * @return HandleMedias
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     *
     * @return the $logAction
     */
    public function getLogAction($method = null)
    {
        if (null === $method) {
            return $this->logAction;
        }
        
        if (isset($this->logAction[$method])) {
            return $this->logAction[$method];
        }
        return null;
    }

    /**
     *
     * @param multitype: $logAction
     * @return HandleMedias
     */
    public function setLogAction($logAction)
    {
        $this->logAction = $logAction;
        return $this;
    }

    /**
     *
     * @return the $documentRoot
     */
    public function getDocumentRoot()
    {
        return $this->documentRoot;
    }

    /**
     *
     * @param string $documentRoot
     * @return HandleMedias
     */
    public function setDocumentRoot($documentRoot)
    {
        $this->documentRoot = $documentRoot;
        return $this;
    }

    /**
     * Decide about operation
     * @throws ParamNotExistsModelException
     */
    public function operate()
    {
        if (empty($this->logAction)) {
            throw new ParamNotExistsModelException('Miss logged file operations');
        }
        
        switch ($this->operation) {
            case 'copy':
                return $this->copy();
                break;
            case 'move':
                return $this->move();
                break;
            case 'delete':
                return $this->deleteFiles();
                break;
            default:
                throw new ParamNotExistsModelException('Miss operation parameter');
        }
    }
    

    /**
     * Delete operation
     * @return boolean
     */
    protected function deleteFiles()
    {
        $delete = $this->getLogAction($this->operation);
        foreach ($delete as $row){
            if (isset($row['source']) && ! preg_match("/\_alternate\b/i", $row['source'])) {
                $del = $this->fetchEntries($this->getEntityName(), 'mediaLink', str_replace($this->documentRoot, '', $row['source']));
                if ($del[0]){
                    $del = $del[0];
                    $id = $del->id;
                    $this->delete($this->find($id,true), $id);
                }
            }
            
        }
        return true;
    }

    /**
     * Copy operation
     */
    protected function copy()
    {
        $copies = $this->getLogAction($this->operation);
        $mcUnserialize = new HandleSerializeDatabase();
        foreach ($copies as $row) {
            if (isset($row['source']) && ! preg_match("/\_alternate\b/i", $row['source'])) {
                $mediaLink = str_replace($this->documentRoot, '', $row['source']);
                $startLink = pathinfo($mediaLink);
                $startLink = $startLink['dirname'];
                
                $destLink = pathinfo(str_replace($this->documentRoot, '', $row['dest']));
                $destLink = $destLink['dirname'];
                
                $copy = $this->fetchEntries($this->getEntityName(), 'mediaLink', $mediaLink);
                if (isset($copy[0])) {
                    $copy = $copy[0];
                    
                    $insert['mediaSource'] = str_replace($startLink, $destLink, $copy->mediaSource);
                    $insert['mediaLink'] = str_replace($startLink, $destLink, $copy->mediaLink);
                    $insert['mediaName'] = $copy->mediaName;
                    $insert['mediaType'] = $copy->mediaType;
                    $insert['mediaMetas'] = $copy->mediaMetas;
                    $insert['metaCoding'] = $copy->metaCoding;
                    $insert['resource'] = $copy->resource;
                    
                    if (preg_match('/image\//', $copy->mediaType)) {
                        $insert['mediaAttribute'] = $copy->mediaAttribute;
                        $alternate = $mcUnserialize->execUnserialize($copy->mediaAlternate);
                        $mediaAlternate = array();
                        foreach ($alternate as $key => $medias) {
                            $mediaAlternate[$key]['mediaSource'] = str_replace($startLink, $destLink, $medias['mediaSource']);
                            $mediaAlternate[$key]['mediaLink'] = str_replace($startLink, $destLink, $medias['mediaLink']);
                            $mediaAlternate[$key]['dimensions'] = $medias['dimensions'];
                        }
                        $insert['mediaAlternate'] = $mcUnserialize->execSerialize($mediaAlternate);
                    } else {
                        $insert['mediaAttribute'] = '';
                        $insert['mediaAlternate'] = '';
                    }
                    
                    $entityName = $this->getEntityName();
                    $this->save($insert, new $entityName());
                } else {
                    if (true === $this->hasLogger()) {
                        $this->logger->warn($mediaLink . ' not found in database');
                    }
                }
            }
            return true;
        }
    }
    
    /**
     * Copy operation
     */
    protected function move()
    {
    	$movements = $this->getLogAction($this->operation);
    	$mcUnserialize = new HandleSerializeDatabase();
    	foreach ($movements as $row) {
    		if (isset($row['source']) && ! preg_match("/\_alternate\b/i", $row['source'])) {
    			$mediaLink = str_replace($this->documentRoot, '', $row['source']);
    			$startLink = pathinfo($mediaLink);
    			$startLink = $startLink['dirname'];
    
    			$destLink = pathinfo(str_replace($this->documentRoot, '', $row['dest']));
    			$destLink = $destLink['dirname'];
    
    			$move = $this->fetchEntries($this->getEntityName(), 'mediaLink', $mediaLink);
    			if (isset($move[0])) {
    				$move = $move[0];
                    $id = $move->id;
    				$update['mediaSource'] = str_replace($startLink, $destLink, $move->mediaSource);
    				$update['mediaLink'] = str_replace($startLink, $destLink, $move->mediaLink);

    
    				if (preg_match('/image\//', $move->mediaType)) {
    					$alternate = $mcUnserialize->execUnserialize($move->mediaAlternate);
    					$mediaAlternate = array();
    					foreach ($alternate as $key => $medias) {
    						$mediaAlternate[$key]['mediaSource'] = str_replace($startLink, $destLink, $medias['mediaSource']);
    						$mediaAlternate[$key]['mediaLink'] = str_replace($startLink, $destLink, $medias['mediaLink']);
    						$mediaAlternate[$key]['dimensions'] = $medias['dimensions'];
    					}
    					$update['mediaAlternate'] = $mcUnserialize->execSerialize($mediaAlternate);
    				}
    
    				$this->save($update, $this->find($id,true));
    			} else {
    				if (true === $this->hasLogger()) {
    					$this->logger->warn($mediaLink . ' not found in database');
    				}
    			}
    		}
    		return true;
    	}
    }    
}