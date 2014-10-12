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
 * @package Entity
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Mcwork\Entity;

use ContentinumComponents\Storage\AbstractStorageEntity;
use Mcwork\Entity\Exception\InvalidArgumentException;

/**
 * Provide customer media paths from Contentinum\Customer
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class FsCustom extends AbstractStorageEntity
{

    private $sourcepath = false;

    /**
     *
     * @see \ContentinumComponents\Storage\AbstractStorageEntity::getCurrentPath()
     */
    public function getCurrentPath()
    {
        $path = $this->getSourcepath();
        if (false === $path || strlen($path) < 1) {
            throw new InvalidArgumentException('Invalid or no directory or directory path set');
        }
        return $this->getSourcepath();
    }

    /**
     *
     * @return the $sourcepath
     */
    public function getSourcepath()
    {
        return $this->sourcepath;
    }

    /**
     *
     * @param boolean $sourcepath
     */
    public function setSourcepath($sourcepath)
    {
        $this->sourcepath = $sourcepath;
    }
}