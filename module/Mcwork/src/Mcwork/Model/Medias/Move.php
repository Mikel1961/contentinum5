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

use ContentinumComponents\Path\Clean;
use Mcwork\Model\Medias\Exception\InvalidArgumentException;

/**
 * Move Model
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 *        
 */
class Move extends Administrate
{

    /**
     * Db table primary key
     *
     * @var int
     */
    private $dbIdent;

    /**
     * Properties for rename operation
     *
     * @var \Mcwork\Model\Fs\Move
     */
    private $fs;

    /**
     * Move operation
     */
    public function move()
    {
        $movements = $this->getLogAction($this->getOperation());
        if (! isset($movements['move'])) {
            if (true === $this->hasLogger()) {
                $this->logger->err('Error when move the file ' . $this->fs->getMoveItems());
            }
            throw new InvalidArgumentException('Error when move the file ' . $this->fs->getMoveItems());
        }
        
        $update = array();
        $result = $this->find($this->getDbIdent());
        $mcSerialize = $this->getSerializeApi();
        $bulk = $mcSerialize->execUnserialize($result->mediaAlternate);
        // source path
        $mediaLink = pathinfo(str_replace($this->getDocumentRoot(), '', $movements['move'][0]['source']));
        $startLink = Clean::get($mediaLink['dirname']);
        // destination path
        $destLink = pathinfo(str_replace($this->getDocumentRoot(), '', $movements['move'][0]['dest']));
        $destLink = Clean::get($destLink['dirname']);
        // prepare update
        $update['mediaSource'] = str_replace($startLink, $destLink, $result->mediaSource);
        $update['mediaLink'] = str_replace($startLink, $destLink, $result->mediaLink);
        if (is_array($bulk) && ! empty($bulk)) {
            $mediaAlternate = array();
            $files = array();
            $i = 1;
            foreach ($bulk as $key => $medias) {
                $files[$i]['value'] = basename($medias['mediaSource']);
                $mediaAlternate[$key]['mediaSource'] = str_replace($startLink, $destLink, $medias['mediaSource']);
                $mediaAlternate[$key]['mediaLink'] = str_replace($startLink, $destLink, $medias['mediaLink']);
                $mediaAlternate[$key]['dimensions'] = $medias['dimensions'];
                $i ++;
            }
            $update['mediaAlternate'] = $mcSerialize->execSerialize($mediaAlternate);
            $source = $this->getDocumentRoot() . $startLink . DS . $this->getHiddenFolder();
            $dest = $this->getDocumentRoot() . $destLink . DS . $this->getHiddenFolder();
            if (! is_dir($dest)) {
                $this->fs->getStorage()->create($dest);
            }
            $this->fs->getStorage()->move($files, $source, $dest);
        }
        $this->save($update, $result);
        return true;
    }

    /**
     *
     * @return the $dbIdent
     */
    public function getDbIdent()
    {
        return $this->dbIdent;
    }

    /**
     *
     * @param number $dbIdent
     */
    public function setDbIdent($dbIdent)
    {
        $this->dbIdent = $dbIdent;
    }

    /**
     *
     * @return the $fs
     */
    public function getFs()
    {
        return $this->fs;
    }

    /**
     *
     * @param \Mcwork\Model\Fs\Move $fs
     */
    public function setFs($fs)
    {
        $this->fs = $fs;
    }
}