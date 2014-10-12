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

/**
 * Navigation categories model
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class Navigation extends AbstractCategories
{

    const ENTITY_ITEM = 'Contentinum\Entity\WebPagesParameter';

    const ENTITY_GROUP = 'Contentinum\Entity\WebNavigations';

    const ENTITY_CATEGORIES = 'Contentinum\Entity\WebNavigationTree';

    const CATEGORIES_GROUP = 'webNavigations';

    const CATEGORIES_ITEM = 'webPages';

    const CATEGORY_TABLE_NAME = 'web_navigations';

    const CATEGORY_ITEM_TABLE_NAME = 'web_pages_parameter';

    const CATEGORY_ITEM_PRIMARY = 'id';

    const CATEGORY_GROUP_TABLE_NAME = 'web_navigation_tree';

    const CATEGORY_GROUP_PRIMARY = 'id';

    const CATEGORY_COL_GROUP = 'web_navigation_id';

    const CATEGORY_COL_ITEM = 'web_pages_id';

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
            $datas['itemRang'] = $this->sequence('webNavigations', $datas['webNavigations'], 'itemRang') + 1;
            parent::save($datas, $entity);
        } else {
            $msg = parent::save($datas, $entity, $stage, $id);
            return $msg;
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
            foreach ($result as $entry) {
                $tmp['id'] = $entry->id;
                $tmp['itemRang'] = $entry->itemRang;
                $tmp['itemId'] = $entry->webPages->id;
                $tmp['itemName'] = $entry->webPages->label;
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
        $sql = "SELECT web_pages_id, web_navigation_id FROM web_navigation_tree";
        $em = $this->getStorage();
        $conn = $em->getConnection();
        $statement = $conn->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $mediaGroups = array();
        foreach ($result as $row) {
            $mediaGroups[$row['web_pages_id']][] = $row['web_navigation_id'];
        }
        return $mediaGroups;
    }

    /**
     * Add a navigation branch to this menue point
     * 
     * @param array $datas
     * @return multitype:string |multitype:number
     */
    public function addNavigationBranch($datas)
    {
        if (! isset($datas['ident'])) {
            return array(
                'error' => 'Missed unique identifier from this data record'
            );
        }
        
        // prepare insert data and ...
        $insert['treeIdent'] = 'submenue-' . $datas['page'] . '-' . $datas['scope'];
        $insert['title'] = strip_tags($datas['headline']);
        $insert['tplAssign'] = 'STANDARD';
        $insert['menue'] = 'sub';
        $insert['headline'] = $datas['headline'];
        $insert['htmlwidgets'] = 'none';
        // ... save data
        $save = new \Mcwork\Model\Save\Navigation($this->getStorage());
        $entity = static::ENTITY_GROUP;
        $save->save($insert, new $entity());
        $lastInsert = $save->getLastInsertId();
        // update current menu item set referer to sub navigation
        $entity = static::ENTITY_CATEGORIES;
        $this->setEntity(new $entity());
        parent::save(array(
            'parentFrom' => $lastInsert
        ), $this->find($datas['ident']));
        return array(
            'cat' => $lastInsert
        );
    }

    /**
     * Remove navigation branch from this menue point
     * 
     * @param array $remove row and group ident
     * @return multitype:string |boolean
     */
    public function unlinkNavigationBranch($remove)
    {
        $isRemove = false;
        if (isset($remove['ident'])) {
            $entity = static::ENTITY_CATEGORIES;
            $this->setEntity(new $entity());
            $entity = $this->find($remove['ident']);
            if (false === $this->hasPages($entity->webNavigations->id)) {
                if ($entity->parentFrom > 0) {
                    $update['parentFrom'] = '0';
                    $this->save($update, $entity);
                }
            } else {
                return array(
                    'error' => 'Navigation branch has pages and can not be deleted'
                );
            }
        }
        return true;
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
            $entry = $this->find($row['ident']);
            if ('yes' === $entry->publish) {
                $isRemove = false;
            } elseif ($entry->parentFrom > 0) {
                $isRemove = false;
            } else {
                $this->delete($this->fetchPopulateValues($row['ident'], false), $row['ident']);
                $isRemove = true;
            }
        }
        return $isRemove;
    }

    /**
     * Check naviagtion has page(s)
     * 
     * @param int $navId
     * @return boolean
     */
    protected function hasPages($navId)
    {
        $sql = 'SELECT * FROM web_navigation_tree WHERE web_navigation_id = ' . $navId . '';
        $em = $this->getStorage();
        $conn = $em->getConnection();
        if ($conn->query($sql)->fetchAll()) {
            return true;
        } else {
            return false;
        }
    }
}