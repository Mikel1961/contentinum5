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
 * Copy operation file system model
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 *        
 */
class Copy extends AbstractFs
{

    /**
     * Name of the folder or files to copy in fs
     *
     * @var string
     */
    private $copyItems = false;

    /**
     * Name of copy destination
     *
     * @var string
     */
    private $destination;

    /**
     * Create a new directory
     */
    public function copy()
    {
        return $this->copyDirectory(array(
            array(
                'value' => $this->getCopyItems()
            )
        ), $this->getDestination(), $this->getEntity(), $this->getFsCurrent());
    }

    /**
     *
     * @return the $copyItems
     */
    public function getCopyItems()
    {
        return $this->copyItems;
    }

    /**
     * Set items to copy in the fs
     *
     * @param multiple $copyItems
     */
    public function setCopyItems($copyItems)
    {
        $this->copyItems = $copyItems;
    }

    /**
     *
     * @return the $destination
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     *
     * @param string $destination
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    }
}