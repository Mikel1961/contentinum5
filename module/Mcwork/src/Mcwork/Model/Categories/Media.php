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
namespace Mcwork\Model\Categories;

use Mcwork\Model\Medias\Administrate;
use Mcwork\Model\Medias\InUse;

/**
 * Media categories model
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class Media extends AbstractCategories
{

    const ENTITY_ITEM = 'Contentinum\Entity\WebMedias';

    const ENTITY_GROUP = 'Contentinum\Entity\WebMediaGroup';

    const ENTITY_CATEGORIES = 'Contentinum\Entity\WebMediaCategories';

    const CATEGORIES_GROUP = 'webMediagroupId'; // webMediagroupId

    const CATEGORIES_ITEM = 'webMediasId'; // webMediasId

    const CATEGORY_TABLE_NAME = 'web_media_categories';

    const CATEGORY_ITEM_TABLE_NAME = 'web_medias';

    const CATEGORY_ITEM_PRIMARY = 'id';

    const CATEGORY_GROUP_TABLE_NAME = 'web_media_group';

    const CATEGORY_GROUP_PRIMARY = 'id';

    const CATEGORY_COL_GROUP = 'web_mediagroup_id';

    const CATEGORY_COL_ITEM = 'web_medias_id';

    const INUSE_GROUP = 'mediacategories';

    /**
     * Prepare datas before save
     * Insert the category with the correct sequnce number in this group
     *
     * @see \ContentinumComponents\Mapper\Process::save()
     */
    public function save($datas, $entity = null, $stage = '', $id = null)
    {
        $entity = $this->handleEntity($entity);
        if (null === $entity->getPrimaryValue()) {
            $datas['itemRang'] = $this->sequence('webMediagroupId', $datas['webMediagroupId'], 'itemRang') + 1;
            parent::save($datas, $entity, $stage, $id);
            $this->inUseMedia($datas['webMediasId'], $this->lastInsertId);
            return true;
        } else {
            $this->inUseMedia($entity->webMediasId->id, $entity->id, self::INUSE_GROUP, 'delete');
            parent::save($datas, $entity, $stage, $id);
            $this->inUseMedia($datas['webMediasId'], $entity->id);
        }
    }

    /**
     * Get the contents of the specific category
     *
     * @param array $params query conditions
     * @param boolen $asArray false = return entity objects, true returns a result array
     * @return Ambigous <\Mcwork\Model\Categories\multitype:unknown, multitype:, array>
     */
    public function fetchContent($params, $asArray = false)
    {
        if (isset($params['id'])) {
            $result = $this->categoryQuery($params['id']);
        } else {
            $result = array();
        }
        return $this->resultAsArray($result, $asArray);
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Mcwork\Model\Categories\AbstractCategories::resultAsArray()
     */
    public function resultAsArray($result, $asArray)
    {
        if (true === $asArray) {
            $array = array();
            $medias = new Administrate($this->getStorage());
            $mcSerialize = $medias->getSerializeApi();
            foreach ($result as $entry) {
                $tmp['id'] = $entry->id;
                $tmp['itemRang'] = $entry->itemRang;
                $tmp['itemId'] = $entry->webMediasId->id;
                if (true === $medias->isValidImages($entry->webMediasId->mediaType)) {
                    $tmp['src'] = $medias->mediaAlternate($mcSerialize->execUnserialize($entry->webMediasId->mediaAlternate));
                } else {
                    $tmp['icon'] = 'fa-file';
                }
                $tmp['itemName'] = $entry->webMediasId->mediaName;
                
                $array[] = $tmp;
                $tmp = array();
            }
            return $array;
        } else {
            return $result;
        }
    }

    /**
     * Fetch categories with all groups that this category is assigned
     * 
     * @return Ambigous <multitype:, unknown>
     */
    public function getGroupCategories()
    {
        $sql = "SELECT web_medias_id, web_mediagroup_id FROM web_media_categories";
        $em = $this->getStorage();
        $conn = $em->getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $mediaGroups = array();
        foreach ($result as $row) {
            $mediaGroups[$row['web_medias_id']][] = $row['web_mediagroup_id'];
        }
        return $mediaGroups;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Mcwork\Model\Categories\AbstractCategories::removeItem()
     */
    public function removeItem($remove)
    {
        $isRemove = false;
        foreach ($remove as $row) {
            $items = $this->find($row['ident']);
            $this->delete($this->fetchPopulateValues($row['ident'], false), $row['ident']);
            $this->inUseMedia($items->webMediasId->id, $row['ident'], 'mediacategories', 'remove');
            $isRemove = true;
        }
        return true;
    }

    /**
     * Register this media categorie in the inusemedia table
     * thus different operational prevent the file system
     * Empty cache if register success
     *
     * @param int $mediaId media id
     * @param int $inuseId media categorie id
     * @param string $name group indetifier
     * @param string $status
     */
    protected function inUseMedia($mediaId, $inuseId, $name = self::INUSE_GROUP, $status = 'insert')
    {
        $save = new InUse($this->getStorage());
        $save->setSl($this->getSl());
        if ('insert' == $status) {
            $save->insert($mediaId, $inuseId, $name);
        } else {
            $save->remove($mediaId, $inuseId, $name);
        }
        $save->emptyCache();
    }
}