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

/**
 * Rename operation file system model
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 *        
 */
class Rename extends AbstractFs
{

    /**
     * Actual name of file or folder
     *
     * @var string
     */
    private $currentName;

    /**
     * New name of file or folder
     *
     * @var string
     */
    private $newName;

    /**
     * Filtered new name, valid to use in file system
     * 
     * @var string
     */
    private $validNewName;

    /**
     * File extension
     * 
     * @var string
     */
    private $ext = '';

    /**
     * Rename operation in fs
     *
     * @return string operation message
     */
    public function rename($source = null, $destination = null)
    {
        if (null === $source) {
            $source = $this->getCurrentName();
        }
        if (null === $destination) {
            $destination = $this->getValidNewName() . $this->getExt();
        }
        return $this->renameDirectory($source, $destination, $this->getEntity(), $this->getFsCurrent());
    }

    /**
     *
     * @return the $currentName
     */
    public function getCurrentName()
    {
        return $this->currentName;
    }

    /**
     *
     * @param string $currentName
     */
    public function setCurrentName($currentName)
    {
        $this->currentName = $currentName;
    }

    /**
     *
     * @return the $newName
     */
    public function getNewName()
    {
        return $this->newName;
    }

    /**
     *
     * @param string $newName
     * @param string $type
     */
    public function setNewName($newName, $type = 'file')
    {
        $this->newName = $newName;
        if ('file' == $type) {
            
            $this->ext = '.' . Extension::get($newName);
            $newName = Name::get($newName);
        }
        $this->validNewName = $this->filterFsNames($newName);
    }

    /**
     *
     * @return the $validNewName
     */
    public function getValidNewName()
    {
        return $this->validNewName;
    }

    /**
     *
     * @return the $ext
     */
    public function getExt()
    {
        return $this->ext;
    }
}