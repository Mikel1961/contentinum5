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
namespace Mcwork\Model;

use ContentinumComponents\Mapper\Process;
use ContentinumComponents\Entity\AbstractEntity;

/**
 * Model to procede delete
 * 
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 *        
 */
class DeleteItem extends Process
{

    /**
     * Delete data table entries
     * 
     * @param array $attribs
     * @param AbstractEntity $entity
     * @param string $sl
     * @return unknown
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
                if (false !== $this->hasEntriesParams) {
                    if (false === $this->hasEntries($params['tablename'], $params['column'], $item['value'])) {
                        $data['isdelete'][] = $item['value'];
                        $this->delete($this->fetchPopulateValues($item['value'], false), $item['value']);
                    } else {
                        $data['notdelete'][] = $item['value'];
                        if (false !== ($log = $this->getLogger())) {
                            $log->err('could not be deleted since records exist in ' . $entity->getEntityName());
                        }
                    }
                } else {
                    $data['isdelete'][] = $item['value'];
                    $this->delete($this->fetchPopulateValues($item['value'], false), $item['value']);
                }
            }
        }
        return $data;
    }
}