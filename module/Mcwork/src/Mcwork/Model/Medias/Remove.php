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

/**
 * Remove Model
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 *        
 */
class Remove extends Administrate
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
     * @var \Mcwork\Model\Fs\Remove
     */
    private $fs;

    /**
     * Delete operation
     * 
     * @return boolean
     */
    public function remove()
    {
        $result = $this->find($this->dbIdent, true);
        $mcSerialize = $this->getSerializeApi();
        $remove = $mcSerialize->execUnserialize($result->mediaAlternate);
        if (is_array($remove) && ! empty($remove)) {
            foreach ($remove as $k => $row) {
                if (isset($row['mediaSource'])) {
                    $this->fs->getStorage()->delete($this->getDocumentRoot() . $row['mediaSource']);
                }
            }
        }
        $this->delete($result, $this->dbIdent);
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
     * @param \Mcwork\Model\Fs\Remove $fs
     */
    public function setFs($fs)
    {
        $this->fs = $fs;
    }
}