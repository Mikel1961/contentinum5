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
namespace Mcwork\Model\Fs;

use ContentinumComponents\Storage\StorageDirectory;
use ContentinumComponents\Filter\Url\Prepare;
use ContentinumComponents\File\Extension;

/**
 * Provide methods for fs operation
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
abstract class AbstractFs extends StorageDirectory
{

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
     * Document root application (not the typical dc)
     *
     * @var string
     */
    private $documentRoot = false;

    /**
     * Path to file system ( extension to $documentRoot )
     * Shortname: fs
     *
     * @var string
     */
    private $fsPath = false;

    /**
     * Partial from document root and path to fs
     * For speciall treatments
     *
     * @var string
     */
    private $dcPartial = false;

    /**
     * Current fs location
     *
     * @var string
     */
    private $fsCurrent = '';

    /**
     * Directory seperator
     *
     * @var unknown
     */
    private $ds = false;

    /**
     * Public or non public file system area
     *
     * @var string
     */
    private $area = false;

    /**
     * Media table
     *
     * @var array
     */
    private $medias = array();

    /**
     * Array of files which should not be displayed
     *
     * @var array
     */
    private $excludedFiles = array(
        'index.html'
    );

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
     * @param string $storage
     * @param string $entity
     */
    public function __construct($storage = null, $entity = null, $area = false)
    {
        if (null !== $storage) {
            $this->setStorage($storage);
        }
        if (null !== $entity) {
            $this->setEntity($entity);
        }
        
        $this->area = false;
    }

    /**
     *
     * @return the $documentRoot
     */
    public function getDocumentRoot()
    {
        if (false === $this->documentRoot) {
            $this->documentRoot = $this->getStorage()->getDocumentRoot();
        }
        return $this->documentRoot;
    }

    /**
     *
     * @param string $documentRoot
     */
    public function setDocumentRoot($documentRoot = null)
    {
        if (null === $documentRoot) {
            $documentRoot = $this->getStorage()->getDocumentRoot();
        }
        $this->documentRoot = $documentRoot;
    }

    /**
     *
     * @return the $fsPath
     */
    public function getFsPath()
    {
        if (false === $this->fsPath) {
            $this->fsPath = $this->getEntity()->getCurrentPath();
        }
        return $this->fsPath;
    }

    /**
     *
     * @param string $fsPath
     */
    public function setFsPath($fsPath = null)
    {
        if (null === $fsPath) {
            $fsPath = $this->getEntity()->getCurrentPath();
        }
        $this->fsPath = $fsPath;
    }

    /**
     *
     * @return the $dcPartial
     */
    public function getDcPartial()
    {
        return $this->dcPartial;
    }

    /**
     *
     * @param string $dcPartial
     */
    public function setDcPartial($dcPartial)
    {
        $this->dcPartial = $dcPartial;
    }

    /**
     *
     * @return the $fsCurrent
     */
    public function getFsCurrent()
    {
        return $this->fsCurrent;
    }

    /**
     *
     * @param string $fsCurrent
     */
    public function setFsCurrent($fsCurrent)
    {
        $this->fsCurrent = $fsCurrent;
    }

    /**
     *
     * @return the $ds
     */
    public function getDs()
    {
        if (false === $this->ds) {
            $this->ds = DS;
        }
        return $this->ds;
    }

    /**
     *
     * @param \Mcwork\Model\unknown $ds
     */
    public function setDs($ds = null)
    {
        if (null === $ds) {
            $ds = DS;
        }
        $this->ds = $ds;
    }

    /**
     * Get area of the fs
     *
     * @throws \Exception
     * @return string
     */
    public function getArea()
    {
        if (false === $this->area) {
            throw new \Exception('Does not define a area of the file system');
        }
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
     * Get media table
     *
     * @return the $medias
     */
    public function searchMedias($key = null)
    {
        if (null !== $key && isset($this->medias[$key])) {
            return $this->medias[$key];
        } else {
            return false;
        }
    }

    /**
     * Get media table
     *
     * @return the $medias
     */
    public function getMedias($key = null)
    {
        if (null !== $key && isset($this->medias[$key])) {
            return $this->medias[$key];
        } else {
            return $this->medias;
        }
    }

    /**
     * Set media table
     *
     * @param multitype: $medias
     */
    public function setMedias($medias)
    {
        if (! is_array($medias)) {
            if (is_object($medias) && method_exists($medias, 'toArray')) {
                $this->medias = $medias->toArray();
            }
        } else {
            $this->medias = $medias;
        }
    }

    /**
     * Check if the file should be displayed
     *
     * @param string $file
     * @return boolean
     */
    public function isExcludedFile($file)
    {
        if (in_array($file, $this->excludedFiles)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @return the $excludedFiles
     */
    public function getExcludedFiles()
    {
        return $this->excludedFiles;
    }

    /**
     * Set file icons
     *
     * @param array $excludedFiles
     */
    public function setExcludedFiles(array $excludedFiles)
    {
        $this->excludedFiles = $excludedFiles;
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
     * Filter and prepare file and directory names before us in fs
     *
     * @param string $value
     * @return Ambigous <unknown, \Zend\Filter\mixed, mixed>
     */
    public function filterFsNames($value)
    {
        $filter = new Prepare();
        $value = $filter->filter($value);
        unset($filter);
        return $value;
    }

    /**
     * Warpper for ContentinumComponents\File\Extension
     *
     * @param string $file
     * @return string
     */
    public function fileExtension($file)
    {
        return Extension::get($file);
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