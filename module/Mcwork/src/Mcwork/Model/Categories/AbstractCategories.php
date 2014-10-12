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

use ContentinumComponents\Mapper\Process;
use Mcwork\Model\Categories\Exception\InvalidArgumentException;

/**
 * Provides methods to list, add, edit categories in a group
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
abstract class AbstractCategories extends Process
{

    const ENTITY_ITEM = 'Contentinum\Entity\WebContent';

    const ENTITY_GROUP = 'Contentinum\Entity\IndexGroups';

    const ENTITY_CATEGORIES = 'Contentinum\Entity\IndexCategories';

    const CATEGORIES_GROUP = 'webGroupId';

    const CATEGORIES_ITEM = 'webItemId';

    const CATEGORIES_ORDERBY = 'itemRang';

    const CATEGORY_TABLE_NAME = 'index_categories';

    const CATEGORY_ITEM_TABLE_NAME = 'web_content';

    const CATEGORY_ITEM_PRIMARY = 'id';

    const CATEGORY_GROUP_TABLE_NAME = 'index_group';

    const CATEGORY_GROUP_PRIMARY = 'id';

    const CATEGORY_COL_GROUP = 'web_group_id';

    const CATEGORY_COL_ITEM = 'web_item_id';

    const ORDER_COL = 'item_rang';

    /**
     * Get entity name to have access of the publish property
     * 
     * @return string
     */
    public function getPublishEntity()
    {
        return static::ENTITY_CATEGORIES;
    }

    /**
     * Insert a categorie in a group
     * Determines the number of categories in the group
     * and adds the category last in this group
     *
     * @param array $insert insert category datas
     * @throws InvalidArgumentException
     * @return boolean
     */
    public function addItem($insert)
    {
        if (isset($insert[static::CATEGORIES_GROUP]) && $insert[static::CATEGORIES_ITEM]) {
            $category = static::ENTITY_CATEGORIES;
            $this->setEntity(new $category());
            $em = $this->getStorage();
            foreach ($insert as $key => $value) {
                switch ($key) {
                    case static::CATEGORIES_ITEM:
                        $entityName = static::ENTITY_ITEM;
                        break;
                    case static::CATEGORIES_GROUP:
                        $entityName = static::ENTITY_GROUP;
                        break;
                    default:
                        break;
                }
                $em->clear($entityName);
                $datas[$key] = $em->find($entityName, $value);
            }
            $datas['itemRang'] = $this->sequence(static::CATEGORIES_GROUP, $insert[static::CATEGORIES_GROUP], 'itemRang') + 1;
            
            $category = static::ENTITY_CATEGORIES;
            return parent::save($datas, new $category());
        } else {
            throw new InvalidArgumentException('Missed unique identifier from a group or group item');
        }
    }

    /**
     * Remove a category from a group
     * 
     * @param array $remove datas to remove
     * @throws InvalidArgumentException
     * @return boolean
     */
    public function removeItem($remove)
    {
        if (isset($remove[static::CATEGORIES_GROUP]) && $remove[static::CATEGORIES_ITEM]) {
            $sql = "DELETE FROM " . static::CATEGORY_TABLE_NAME . " ";
            $sql .= "WHERE " . static::CATEGORY_COL_ITEM . " = " . $remove[static::CATEGORIES_ITEM];
            $sql .= " AND " . static::CATEGORY_COL_GROUP . " = " . $remove[static::CATEGORIES_GROUP] . ";";
            // exec query
            $em = $this->getStorage();
            $conn = $em->getConnection();
            $statement = $conn->prepare($sql);
            $statement->execute();
            return true;
        } else {
            throw new InvalidArgumentException('Missed unique identifier from media group or media file');
        }
    }

    /**
     * Fetch all categories of a group arranged in the correct sequence
     * 
     * @param int $id group id
     * @return array database result
     */
    public function categoryQuery($id)
    {
        $em = $this->getStorage();
        $builder = $em->createQueryBuilder();
        $builder->select('main');
        $builder->from(static::ENTITY_CATEGORIES, 'main');
        $builder->leftJoin(static::ENTITY_ITEM, 'ref1', \Doctrine\ORM\Query\Expr\Join::WITH, 'ref1.id = main.' . static::CATEGORIES_ITEM);
        $builder->leftJoin(static::ENTITY_GROUP, 'ref2', \Doctrine\ORM\Query\Expr\Join::WITH, 'ref2.id = main.' . static::CATEGORIES_GROUP);
        $builder->where('main.' . static::CATEGORIES_GROUP . ' = :id');
        $builder->setParameter('id', $id);
        $builder->orderBy('main.' . static::CATEGORIES_ORDERBY, 'ASC');
        return $builder->getQuery()->getResult();
    }

    /**
     * Creates an array of selected content for return to the client
     * 
     * @param array $result database query result
     * @param boolen $asArray true build array, false return database complete result
     * @return multitype:unknown |unknown
     */
    public function resultAsArray($result, $asArray)
    {
        if (true === $asArray) {
            $array = array();
            
            return $array;
        } else {
            return $result;
        }
    }
}