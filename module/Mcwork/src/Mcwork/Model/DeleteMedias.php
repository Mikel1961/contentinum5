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
use ContentinumComponents\Tools\HandleSerializeDatabase;
use Mcwork\Model\RemoveMedias;

/**
 * Delete Medias to delete medias from database and file system
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 *        
 */
class DeleteMedias extends Process
{
    /**
     * Target entity name
     * @var string
     */
    private $mediasTargetEntity = 'Contentinum\Entity\WebMedias';
    
    /**
     * Media link 
     * @var string
     */
    private $mediaSource;
    
    /**
     * Alternate medias contains the alternate media sources
     * @var array
     */
    private $mediaAlternate = false;
    
    
    /**
     * Delete medias
     *
     * @param array $attribs
     * @param AbstractEntity $entity
     * @param string $sl
     * @return array
     */
    public function deleteRow(array $attribs, AbstractEntity $entity = null, $sl = null)
    {
        $data = array(
            'isdelete' => array(),
            'notdelete' => array()
        );
        $em = $this->getStorage();
        foreach ($attribs as $items) {
            foreach ($items as $item) {
                try {
                    $delItem = $this->fetchPopulateValues($item['value'], false); // get entity
                    $this->setMediaLinks($delItem,$sl); // get set media links in file system
                    $targetId = $delItem->webMediasId->id; // get target entity id
                    $this->delete($delItem, $item['value']); // delete entity
                    $entry = $em->find($this->mediasTargetEntity, $targetId);
                    $em->remove($entry);
                    $em->flush();// delete target entity
                    $this->removeMedias(); // remove the medias from file system
                    $data['isdelete'][] = $item['value'];
                } catch (\Exception $e) {
                    var_dump($e->getMessage());exit;
                    $data['notdelete'][] = $item['value'];
                }
            }
        }
        return $data;
    }
    
    /**
     * Get and set the media sources from this item
     * @param AbstractEntity $delItem
     */
    public function setMediaLinks($delItem, $sl)
    {
        $customer = $sl->get('Contentinum\Customer');
        $imagesTypes = $customer->default->Medias->images_types->toArray();
        $this->mediaSource = $delItem->webMediasId->mediaSource;
        if (isset($imagesTypes[$delItem->webMediasId->mediaType])){
            $mcSerialize = new HandleSerializeDatabase($delItem->webMediasId->decodeMetas);
            $this->mediaAlternate = $mcSerialize->execUnserialize($delItem->webMediasId->mediaAlternate);
            unset($mcSerialize);
        }
    }
    
    /**
     * Remove the medias from the file system
     */
    public function removeMedias()
    {
        $remove = new RemoveMedias();
        $remove->removeMediaFromFileSystem($this->mediaSource);
        if (false !== $this->mediaAlternate){
            foreach ($this->mediaAlternate as $k => $row){
                $remove->removeMediaFromFileSystem($row['mediaSource']);
            }
        }
    }
}