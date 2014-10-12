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
namespace Mcwork\Model\Delete;

use ContentinumComponents\Mapper\Process;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * Delete Model
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 *        
 */
class Trash extends Process
{

    /**
     * Delete a database table row
     * Ceck if a item publish or not
     * Ceck if this item has foreign entries and there are depends on this
     *
     * @param array $attribs remove attributes
     * @param AbstractEntity $entity group entity
     * @param Zend\ServiceManager\ServiceLocatorInterface $sl Zend\ServiceManager\ServiceLocatorInterface
     * @return Ambigous <multitype:multitype: , unknown>
     */
    public function deleteRow(array $attribs, AbstractEntity $entity = null, $sl = null)
    {
        if (false !== $this->hasEntriesParams) {
            $params = $this->getHasEntriesParams();
        }
        $data = array(
            'isdelete' => array(),
            'notdelete' => array()
        );
        foreach ($attribs as $items) {
            foreach ($items as $item) {
                $entry = $this->find($item['value']); // item exists
                /**
                 * Check if this item control by publish
                 * and is it publish or not
                 */
                if ($entry->publish && 'yes' === $entry->publish) {
                    $data['notdelete'][$item['value']] = $item['name'];
                    if (false !== ($log = $this->getLogger())) {
                        $log->err('Could not be deleted since ' . $item['name'] . ' is publish');
                    }
                } else {
                    /**
                     * Check if depends on foreign entries
                     * and this entries are avaibale
                     */
                    if (false !== $this->hasEntriesParams) {
                        $deleteThis = true;
                        foreach ($params as $target) {
                            if (true === $this->hasEntries($target['tablename'], $target['column'], $item['value'])) {
                                $data['notdelete'][$item['value']] = $item['name'];
                                $deleteThis = false;
                                if (false !== ($log = $this->getLogger())) {
                                    $log->err('Could not be deleted since ' . $item['name'] . ' exist in ' . $target['tablename']);
                                }
                            }
                        }
                        if (true === $deleteThis) {
                            $data['isdelete'][$item['value']] = $item['name'];
                            $this->delete($this->fetchPopulateValues($item['value'], false), $item['value']);
                        }
                    } else {
                        $data['isdelete'][$item['value']] = $item['name'];
                        $this->delete($this->fetchPopulateValues($item['value'], false), $item['value']);
                    }
                }
            }
        }
        return $data;
    }
}