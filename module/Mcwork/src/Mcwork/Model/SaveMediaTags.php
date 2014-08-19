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
use Contentinum\Entity\WebMediaTags;

/**
 * Media Tags Model
 * Prepare serval input datas before save in database
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class SaveMediaTags extends Process
{

    /**
     * Store assign tags before insert
     * @var array
     */
    private $assigsTags = array();

    /**
     * Prepare datas before save
     * decide is it a insert or update
     *
     * @see \ContentinumComponents\Mapper\Process::save()
     */
    public function save($datas, $entity = null, $stage = '', $id = null)
    {
        foreach ($datas as $tagName) {
            $entity = new WebMediaTags();
            $entries = $this->fetchEntries($entity->getEntityName(), 'tagName', $tagName);
            if (false === $entries) {
                $msg = parent::save(array(
                    'tagName' => $tagName
                ), $entity);
                $lastInsertId = $this->getLastInsertId();
            } else {
                $lastInsertId = $entries[0]->id;
            }
            $this->assigsTags[$id][] = $lastInsertId;
        }
        if (! empty($this->assigsTags)) {
            $this->handleAssigns($id);
        }
    }

    /**
     * Delete former assigns and insert new assigns
     * 
     * @param int $id assign id
     */
    public function handleAssigns($id)
    {
        try {
            // delete former assigns ...
            $assigns = new MediaTagsAssign($this->getStorage());
            $assigns->query($assigns->deleteAssigns(), array(
                $assigns->getParamterIdent($assigns::COL_ASSIGNID) => $id
            ));
            // ... and insert new assigns
            foreach ($this->assigsTags as $mediaId => $tagIds) {
                foreach ($tagIds as $tagId) {
                    $date = date('Y-m-d H:i:s');
                    $insert = array(
                        $assigns::COL_ASSIGNID => $mediaId,
                        $assigns::COL_TAGID => $tagId,
                        $assigns::COL_DATEINSERT => $date,
                        $assigns::COL_DATEUPDATE => $date
                    );
                    $assigns->insertQuery($insert);
                }
            }
            if (true === $this->hasLogger()) {
                $this->logger->info('Assignment success in ' . $assigns::ASSIGN_TABLENAME . ' with ' . $id);
            }
        } catch (\Exception $e) {
            if (true === $this->hasLogger()) {
                $this->logger->crit('Error assignment ' . $assigns::ASSIGN_TABLENAME . ': ' . $e->getMessage());
            }
        }
    }
}