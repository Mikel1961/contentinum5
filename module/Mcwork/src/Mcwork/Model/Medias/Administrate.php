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
namespace Mcwork\Model\Medias;

use Mcwork\Model\Medias\Exception\InvalidArgumentException;
use Mcwork\Model\Save\Medias;

/**
 * Provide methods to do the similar fs operation in database media table
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class Administrate extends Medias
{

    const MEDIA_ENTITY = 'Contentinum\Entity\WebMedias';

    const MEDIA_SERIALIZE = 'ContentinumComponents\Tools\HandleSerializeDatabase';

    /**
     * Contains images that can be displayed in the browser
     *
     * @var array
     */
    private $validImagesTypes = array(
        'image/gif',
        'image/jpeg',
        'image/png'
    );

    /**
     * Operation method
     *
     * @var string
     */
    private $operation;

    /**
     * Store any copy, move or delete
     *
     * @var array
     */
    private $logAction = array();

    /**
     * Document root
     *
     * @var string
     */
    private $documentRoot;

    /**
     * Hidden folder for image alternate sizes
     * 
     * @var string
     */
    private $hiddenFolder;

    /**
     * File and images attribute fields
     * 
     * @var multitype
     */
    private $mediaAttributeFields;

    /**
     * Includes available file icons
     *
     * @var array
     */
    private $fileIcons = array(
        'file' => 'fa-file'
    );

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
     * @return \Mcwork\Model\AdministrateMedias
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
    public function getLogAction()
    {
        return $this->logAction;
    }

    /**
     *
     * @param multitype: $logAction
     * @return \Mcwork\Model\AdministrateMedias
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
     * @return \Mcwork\Model\AdministrateMedias
     */
    public function setDocumentRoot($documentRoot)
    {
        $this->documentRoot = $documentRoot;
        return $this;
    }

    /**
     *
     * @return the $hiddenFolder
     */
    public function getHiddenFolder()
    {
        return $this->hiddenFolder;
    }

    /**
     *
     * @param string $hiddenFolder
     * @return \Mcwork\Model\AdministrateMedias
     */
    public function setHiddenFolder($hiddenFolder)
    {
        $this->hiddenFolder = $hiddenFolder;
        return $this;
    }

    /**
     * Check is this file icon avaibale and return
     * or check if a standard is available and return this
     * otherwise return false
     *
     * @param string $key
     * @return multitype:|boolean
     */
    public function isFileIcon($key)
    {
        if (! empty($this->fileIcons) && isset($this->fileIcons[$key])) {
            return $this->fileIcons[$key];
        } elseif (! empty($this->fileIcons) && isset($this->fileIcons['file'])) {
            return $this->fileIcons['file'];
        } else {
            return false;
        }
    }

    /**
     * Get available file icons
     *
     * @return the $fileIcons
     */
    public function getFileIcons()
    {
        return $this->fileIcons;
    }

    /**
     *
     * @param multitype: $fileIcons
     */
    public function setFileIcons($fileIcons)
    {
        $this->fileIcons = $fileIcons;
    }

    /**
     * Get the image types that can be displayed in the browser
     *
     * @return the $validImagesTypes
     */
    public function getValidImagesTypes()
    {
        return $this->validImagesTypes;
    }

    /**
     * Check if this image file has the correct image type to display in the browser
     *
     * @param string $type
     * @return boolean
     */
    public function isValidImages($type)
    {
        if (in_array($type, $this->validImagesTypes)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @return the $mediaAttributeFields
     */
    public function getMediaAttributeFields($key = null)
    {
        if (null !== $key) {
            if (isset($this->mediaAttributeFields[$key])) {
                return $this->mediaAttributeFields[$key];
            } else {
                return array();
            }
        } else {
            return $this->mediaAttributeFields;
        }
    }

    /**
     *
     * @param multitype $mediaAttributeFields
     */
    public function setMediaAttributeFields($mediaAttributeFields)
    {
        $this->mediaAttributeFields = $mediaAttributeFields;
    }

    /**
     * Get set media entity
     * 
     * @param string $entity name entity
     * @return Contentinum\Entity\WebMedias
     */
    public function getMediaEntity($entity = null)
    {
        if (null === $entity) {
            $entity = self::MEDIA_ENTITY;
        }
        return new $entity();
    }

    /**
     * ContentinumComponents\Tools\HandleSerializeDatabase
     * 
     * @param string $api name api
     * @return ContentinumComponents\Tools\HandleSerializeDatabase
     */
    public function getSerializeApi($api = null)
    {
        if (null === $api) {
            $api = self::MEDIA_SERIALIZE;
        }
        return new $api();
    }

    /**
     * Find hidden folders
     * 
     * @return string
     */
    public function searchString()
    {
        return "/" . $this->getHiddenFolder() . "/i";
    }

    /**
     * Build query and get result
     * 
     * @param array $columns
     * @param array $where
     * @param string $entityName
     * @throws InvalidValueModelException
     * @return array
     */
    public function fetchMediaTable(array $columns, array $where = null, $entityName = null)
    {
        $em = $this->getStorage();
        if (null === $entityName) {
            $entityName = self::MEDIA_ENTITY;
            if (false === $entityName) {
                throw new InvalidArgumentException('Entity can not be found or is not available!');
            }
        }
        $builder = $em->createQueryBuilder();
        $builder->add('select', 'main.' . implode(', main.', $columns));
        $builder->add('from', $entityName . ' AS main');
        if (is_array($where) && ! empty($where)) {
            foreach ($where as $conditions) {
                $builder->where($conditions['cond']);
                $builder->setParameter($conditions['param'][0], $conditions['param'][1]);
            }
        }
        $query = $builder->getQuery();
        return $query->getResult();
    }

    /**
     * Method to get properties from a media alternate array
     *
     * @param array $mediaAlternate
     * @param string $field array key name
     * @param string $ln array key name
     * @return boolean|multitype:array
     */
    public function mediaAlternate($mediaAlternate, $field = 'thumbnail', $ln = 'mediaLink')
    {
        $src = false;
        
        if (isset($mediaAlternate[$field][$ln])) {
            $src = $mediaAlternate[$field][$ln];
        }
        
        return $src;
    }
}