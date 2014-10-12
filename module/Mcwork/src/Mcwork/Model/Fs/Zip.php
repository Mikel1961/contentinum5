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

/**
 * Zip operation file system model
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 *        
 */
class Zip extends AbstractFs
{

    /**
     * Files and or folders to zip
     *
     * @var array
     */
    private $archiveItems = false;

    /**
     * Archive name to unzip or to build
     *
     * @var string
     */
    private $archive = false;

    /**
     * Create a zip archive
     */
    public function zip()
    {
        $archive = $this->getArchive();
        return $this->zipDirectory($this->getArchiveItems(), $archive, $this->getEntity(), $this->getFsCurrent());
    }

    /**
     * Unzip a archive
     */
    public function unzip()
    {
        return $this->unzipDirectory($this->getArchive(), $this->getEntity(), $this->getFsCurrent());
    }

    /**
     *
     * @return the $archiveItems
     */
    public function getArchiveItems()
    {
        return $this->archiveItems;
    }

    /**
     *
     * @param multitype: $archiveItems
     */
    public function setArchiveItems($archiveItems)
    {
        $this->archiveItems = $archiveItems;
    }

    /**
     *
     * @return the $archive
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     *
     * @param string $archive
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;
    }
}