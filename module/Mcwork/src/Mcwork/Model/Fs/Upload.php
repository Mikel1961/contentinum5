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

use ContentinumComponents\File\Extension;
use ContentinumComponents\File\Name;
use ContentinumComponents\Path\Clean;
use ContentinumComponents\Images\Resize;
use ContentinumComponents\Tools\HandleSerializeDatabase;
use ContentinumComponents\Images\Size;
use Mcwork\Model\Exception\ErrorLogicModelException;

/**
 * Upload operation file system model
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 *        
 */
class Upload extends Directory
{

    /**
     * Image file extensions
     * 
     * @var array
     */
    private $imageExtensions = array(
        "JPG",
        "JPEG",
        "jpg",
        "jpeg",
        "PNG",
        "png",
        "GIF",
        "gif"
    );

    /**
     * File extension
     * 
     * @var string
     */
    private $ext;

    /**
     * Filename without extension
     * 
     * @var string
     */
    private $mediaName;

    /**
     * Path to destination
     * 
     * @var string
     */
    private $target;

    /**
     * The new file name at the destination
     * 
     * @var string
     */
    private $targetFileName;

    /**
     * Path to destination file name
     * 
     * @var string
     */
    private $targetPathFileName;

    /**
     * Hidden directory for alternative image sizes
     * 
     * @var string
     */
    private $alternateSizeFolder;

    /**
     * Alternative image sizes
     * 
     * @var multitype
     */
    private $alternateSizes;

    /**
     * File and images attribute fields
     * 
     * @var multitype
     */
    private $mediaAttributeFields;

    /**
     * Database insert data
     * 
     * @var array
     */
    private $insert = array();

    public function multipleUpload($fs, $k, $fsTmpName)
    {
        $this->addInsert('mediaName', $fs['file']['name'][$k]);
        $this->addInsert('mediaType', $fs['file']['type'][$k]);
        if (false === $this->moveUploadFile($fsTmpName, $this->buildTargetFile($this->buildTargetName($fs['file']['name'][$k])))) {
            throw new ErrorLogicModelException('Error upload file');
        } else {
            if (in_array($this->ext, $this->imageExtensions)) {
                $this->buildAlternateImageSizes();
            }
        }
    }

    /**
     *
     * @param unknown $files
     */
    public function singleUpload($files, $newname)
    {
        $response = $this->singleUploadFile($files, $newname);
        return $this->uploadResponseCode(json_encode(array_merge(array(
            'FILES' => $response
        ), array(
            'POST' => $_POST
        ), array(
            'status' => 200
        ))), 200);
    }

    /**
     * Database insert treatment
     * 
     * @param array $datas
     * @return \Mcwork\Model\FsUpload
     */
    public function preparedInsert(array $datas)
    {
        $mcSerialize = new HandleSerializeDatabase();
        $this->addInsert('metaCoding', $mcSerialize::STD_METHOD);
        if (isset($this->insert['mediaAlternate'])) {
            $this->addInsert('mediaAlternate', $mcSerialize->execSerialize($this->insert['mediaAlternate']));
        } else {
            $this->addInsert('mediaAlternate', ' ');
        }
        
        $fields = array();
        $attribs = array();
        if (in_array($this->ext, $this->imageExtensions)) {
            $metas = array(
                'alt' => $this->mediaName
            );
            $fields = $this->getMediaAttributeFields('images');
            $size = new Size($this->targetPathFileName);
            $size->imgSize();
            $attribs['dimensions'] = array(
                'height' => $size->getHeight(),
                'width' => $size->getWidth()
            );
        } else {
            $metas = array(
                'linkname' => $this->mediaName
            );
            $fields = $this->getMediaAttributeFields('files');
        }
        
        if (! empty($datas) && ! empty($fields)) {
            foreach ($fields as $field) {
                if (isset($datas[$field])) {
                    $metas[$field] = $datas[$field];
                }
            }
        }
        if (! empty($attribs)) {
            $this->addInsert('mediaAttribute', $mcSerialize->execSerialize($attribs));
        }
        $this->addInsert('mediaMetas', $mcSerialize->execSerialize($metas));
        return $this;
    }

    /**
     *
     * @param unknown $response
     * @param number $httpResponseCode
     * @return string
     */
    protected function uploadResponseCode($response, $httpResponseCode = 200)
    {
        // setting actual response code to an error response breaks ie8
        // dont -> http_response_code($httpResponseCode); if set to an error code
        return $response . '' . '#@#' . json_encode(array(
            'status' => $httpResponseCode
        )) . '#@#';
    }

    /**
     *
     * @param unknown $file
     * @return multitype:Ambigous <multitype:unknown , multitype:multitype:unknown > |multitype:unknown
     */
    protected function singleUploadFile($file, $newname)
    {
        if (is_array($file['name'])) {
            $resultsArray = array();
            foreach ($this->singleUnzipUploadedFiles($file) as $f) {
                $resultsArray[] = self::singleUploadFile($f);
            }
            return $resultsArray;
        } else {
            if ($file["error"] > 0) {
                return array(
                    'error' => $file['error']
                );
            } else {
                if ($newname != $file['name']) {
                    $filename = $newname;
                } else {
                    $filename = $file['name'];
                }
                
                $this->addInsert('mediaName', $filename);
                $this->addInsert('mediaType', $file['type']);
                if (false === $this->moveUploadFile($file["tmp_name"], $this->buildTargetFile($this->buildTargetName($filename)))) {
                    throw new ErrorLogicModelException('Error upload file');
                } else {
                    if (in_array($this->ext, $this->imageExtensions)) {
                        $this->buildAlternateImageSizes();
                    }
                }
                
                return array(
                    'name' => $filename,
                    'type' => $file['type'],
                    'size' => $file['size'],
                    'tmp_name' => $file['tmp_name']
                );
            }
        }
    }

    /**
     *
     * @param unknown $file
     * @return Ambigous <multitype:multitype: , unknown>
     */
    protected function singleUnzipUploadedFiles($file)
    {
        $files = array();
        foreach ($file as $key => $value) {
            foreach ($value as $index => $val) {
                if (! isset($files[$index])) {
                    $files[$index] = array();
                }
                $files[$index][$key] = $val;
            }
        }
        return $files;
    }

    /**
     * Wrapper function for move_uploaded_file
     * 
     * @param string $src source temp file name
     * @param string $dest path with target filename
     * @return boolean
     */
    protected function moveUploadFile($src, $dest)
    {
        return move_uploaded_file($src, $dest);
    }

    /**
     * Create images with different sizes from the current uploaded file
     * Hide this images file in a hidden folder
     */
    protected function buildAlternateImageSizes()
    {
        if (! is_dir($this->target . $this->getDs() . $this->alternateSizeFolder)) {
            $this->makeDirectory($this->alternateSizeFolder, null, $this->getFsCurrent());
        }
        $mediaAlternate = null;
        $mediaSizes = null;
        $resize = new Resize(200, $this->targetPathFileName, $this->targetFileName, $this->target . $this->getDs() . $this->alternateSizeFolder . $this->getDs());
        foreach ($this->alternateSizes as $key => $value) {
            $resize->setTarget($value);
            if (false !== $resize->execute()) {
                $mediaSizes[] = $value;
                $source = Clean::get(str_replace($this->getDocumentRoot(), '', $resize->getResizeImageSource()));
                $mediaAlternate[$key]['mediaSource'] = $source;
                $mediaAlternate[$key]['mediaLink'] = str_replace($this->getDs() . $this->getDcPartial(), '', $source);
                $mediaAlternate[$key]['dimensions'] = $resize->getNewsize();
            }
        }
        if (is_array($mediaSizes)) {
            $this->addInsert('mediaSizes', serialize($mediaSizes));
        }
        $this->addInsert('mediaAlternate', $mediaAlternate);
    }

    /**
     * Complete and add target path with target file
     * 
     * @param string $targetFileName
     * @return string target filename with destination path
     */
    protected function buildTargetFile($targetFileName)
    {
        $target = $this->getDocumentRoot() . $this->getDs() . $this->getFsPath() . $this->getFsCurrent();
        
        if (false !== ($nf = $this->getNewDirectory())) {
            if (! is_dir($target . $this->getDs() . $nf)) {
                $this->mkdir();
                $target .= $this->getDs() . $nf . $this->getDs();
                $this->setFsCurrent($this->getFsCurrent() . $this->getDs() . $nf . $this->getDs());
            } else {
                $target .= $this->getDs() . $nf . $this->getDs();
                $this->setFsCurrent($this->getFsCurrent() . $this->getDs() . $nf . $this->getDs());
            }
        }
        
        $this->target = $target;
        $this->addInsert('mediaSource', Clean::get(str_replace($this->getDocumentRoot(), '', $target)) . $targetFileName);
        $this->addInsert('mediaLink', Clean::get(str_replace($this->getDocumentRoot() . $this->getDs() . $this->getDcPartial(), '', $target)) . $targetFileName);
        $this->targetPathFileName = $target . $targetFileName;
        return $this->targetPathFileName;
    }

    /**
     * Build a target name
     * 
     * @param string $filename
     * @return string valid filename
     */
    protected function buildTargetName($filename)
    {
        $ext = Extension::get($filename);
        switch ($ext) {
            case 'JPG':
            case 'JPEG':
            case 'jpeg':
                $ext = 'jpg';
                break;
            default:
                break;
        }
        $this->ext = $ext;
        $this->mediaName = Name::get($filename);
        $this->targetFileName = $this->filterFsNames(str_replace('.', '-', $this->mediaName)) . '.' . $ext;
        return $this->targetFileName;
    }

    /**
     * Get database inserts
     * 
     * @return the $insert
     */
    public function getInsert($key = null)
    {
        if ($key && array_key_exists($key, $this->insert)) {
            return $this->insert[$key];
        }
        
        return $this->insert;
    }

    /**
     * Get database inserts and empty property
     * 
     * @return multitype:
     */
    public function emptyInserts()
    {
        $inserts = $this->insert;
        $this->insert = array();
        return $inserts;
    }

    /**
     * Set datebase insert values
     * Overwrite exists values if parameter $f = true
     *
     * @param string $key
     * @param multitype $value
     * @param boolen $f
     */
    public function addInsert($key, $value, $f = true)
    {
        if (true === $f) {
            $this->insert[$key] = $value;
        } elseif (! isset($this->insert[$key])) {
            $this->insert[$key] = $value;
        }
    }

    /**
     *
     * @param multitype: $insert
     */
    public function setInsert($insert)
    {
        $this->insert = $insert;
    }

    /**
     * Get hidden directory for alternative image sizes
     * 
     * @return the $alternateSizeFolder
     */
    public function getAlternateSizeFolder()
    {
        return $this->alternateSizeFolder;
    }

    /**
     * Set hidden directory for alternative image sizes
     * 
     * @param string $alternateSizeFolder
     */
    public function setAlternateSizeFolder($alternateSizeFolder)
    {
        $this->alternateSizeFolder = $alternateSizeFolder;
    }

    /**
     * Get array of alternative image sizes
     * 
     * @return the $alternateSizes
     */
    public function getAlternateSizes()
    {
        return $this->alternateSizes;
    }

    /**
     * Set array of alternative image sizes
     * 
     * @param multitype: $alternateSizes
     */
    public function setAlternateSizes($alternateSizes)
    {
        $this->alternateSizes = $alternateSizes;
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
     *
     * @return the $targetFileName
     */
    public function getTargetFileName()
    {
        return $this->targetFileName;
    }
}