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
namespace Mcwork\Model\Tags;

use ContentinumComponents\Mapper\Process;

/**
 * Provide methods to add, delete and assign tags to content items
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
abstract class AbstractTags extends Process
{

    const TAG_ENTITY = 'Contentinum\Entity\WebTags';

    const TAG_ENTITY_COL_NAME = 'tagName';

    const TAG_ENTITY_COL_GROUP = 'tagGroup';

    const TAG_TABLENAME = 'web_tags';

    const TAG_GROUP = 'tag_group';

    const TAG_PRIMARY = 'id';

    const TAG_NAME = 'tag_name';

    const TAG_ASSIGN_ENTITY = 'Contentinum\Entity\WebTagAssign';

    const TAG_ASSIGN_TABLENAME = 'web_tags_assign';

    const TAG_ASSIGN_AREA = 'tag_area';

    const TAG_ASSIGN_ITEM_ID = 'web_item_id';

    const TAG_ASSIGN_TAG_ID = 'web_tag_id';

    const TAG_ASSIGN_DATEINSERT = 'register_date';

    const TAG_ASSIGN_DATEUPDATE = 'up_date';

    const TAG_GROUP_VALUE = 'all';

    const TAG_ASSIGN_AREA_VALUE = 'all';

    protected $coltarget = array(
        self::TAG_PRIMARY => self::TAG_ASSIGN_TAG_ID
    );

    protected $params = array(
        self::TAG_ASSIGN_ITEM_ID => ':webitemid',
        self::TAG_ASSIGN_TAG_ID => ':webtagid',
        self::TAG_ASSIGN_DATEINSERT => ':registerdate',
        self::TAG_ASSIGN_DATEUPDATE => ':update'
    );

    /**
     * Store assign tags before insert
     *
     * @var array
     */
    protected $assigsTags = array();

    /**
     * Native sql string
     *
     * @var string
     */
    private $sql;

    /**
     * Database connection
     *
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection()
    {
        $em = $this->getStorage();
        return $em->getConnection();
    }

    /**
     * Get current sql string
     *
     * @return the $sql
     */
    public function getSql()
    {
        return $this->sql;
    }

    /**
     * Set Sql string
     *
     * @param string $sql
     *
     * @return MediaTagsAssign
     */
    public function setSql($sql)
    {
        $this->sql = $sql;
        
        return $this;
    }

    /**
     *
     * @param string $sql
     * @param array $param
     */
    public function query($sql, array $param)
    {
        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($param);
    }

    /**
     * Build insert sql string and insert data
     *
     * @param array $data
     */
    public function insertQuery(array $data)
    {
        $conn = $this->getConnection();
        $conn->insert(self::TAG_ASSIGN_TABLENAME, $data);
    }

    /**
     * Prepare and execute sql query
     *
     * @return array
     */
    public function getAssigns($area = false)
    {
        
        // set sql query
        if (null === $this->sql) {
            $this->fetchAllAssigns($area);
        }
        
        // execute query
        $conn = $this->getConnection();
        $statement = $conn->prepare($this->sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    /**
     * Sort tags to medias
     *
     * @param array $result
     * @return Ambigous <multitype:, unknown>
     */
    public function sortAssignsToItem($result)
    {
        $tagsByItem = array();
        foreach ($result as $row) {
            $tagsByItem[$row[self::TAG_ASSIGN_ITEM_ID]][] = $row[self::TAG_NAME];
        }
        return $tagsByItem;
    }

    /**
     * Native sql query string
     */
    public function fetchAllAssigns($area = false)
    {
        $this->sql = "SELECT main." . self::TAG_ASSIGN_ITEM_ID . ", main." . self::TAG_ASSIGN_TAG_ID . ", ref1." . self::TAG_NAME . " ";
        $this->sql .= "FROM " . self::TAG_ASSIGN_TABLENAME . " AS main ";
        $this->sql .= "LEFT JOIN " . self::TAG_TABLENAME . " AS ref1";
        $this->sql .= " ON ref1." . self::TAG_PRIMARY . " = main." . $this->coltarget[self::TAG_PRIMARY] . "";
        if (true === $area) {
            $this->sql .= " WHERE main." . self::TAG_ASSIGN_AREA . " = '" . static::TAG_ASSIGN_AREA_VALUE . "'";
        }
    }

    /**
     * Delete query
     */
    public function deleteAssigns($col = self::TAG_ASSIGN_ITEM_ID)
    {
        $this->sql = "DELETE FROM " . self::TAG_ASSIGN_TABLENAME . " ";
        $this->sql .= "WHERE " . $col . " = " . $this->getParamterIdent($col) . " ";
        $this->sql .= "AND " . self::TAG_ASSIGN_AREA . " = '" . static::TAG_ASSIGN_AREA_VALUE . "'";
        return $this->sql;
    }

    /**
     * Table column name identifier in where clause
     *
     * @param string $col
     * @return multitype:string |NULL
     */
    public function getParamterIdent($col)
    {
        if (isset($this->params[$col])) {
            return $this->params[$col];
        }
        return null;
    }

    /**
     * Prepare datas before save
     * decide is it a insert or update
     *
     * @see \ContentinumComponents\Mapper\Process::save()
     */
    public function save($datas, $entity = null, $stage = '', $id = null)
    {
        foreach ($datas as $tagName) {
            $tagEntity = self::TAG_ENTITY;
            $entity = new $tagEntity();
            $entries = $this->fetchEntries($entity->getEntityName(), self::TAG_ENTITY_COL_NAME, $tagName);
            if (false === $entries) {
                $msg = parent::save(array(
                    self::TAG_ENTITY_COL_NAME => $tagName,
                    self::TAG_ENTITY_COL_GROUP => static::TAG_GROUP_VALUE
                ), $entity);
                $lastInsertId = $this->getLastInsertId();
            } else {
                $lastInsertId = $entries[0]->id;
            }
            $this->assigsTags[$id][] = $lastInsertId;
        }
        if (! empty($this->assigsTags)) {
            $this->assigns($id);
        }
    }

    /**
     * Delete and create a new tag assign
     *
     * @param int $id item ident
     */
    public function assigns($id)
    {
        try {
            // delete former assigns ...
            $this->query($this->deleteAssigns(), array(
                $this->getParamterIdent(self::TAG_ASSIGN_ITEM_ID) => $id
            ));
            // ... and insert new assigns
            foreach ($this->assigsTags as $itemId => $tagIds) {
                foreach ($tagIds as $tagId) {
                    $date = date('Y-m-d H:i:s');
                    $insert = array(
                        self::TAG_ASSIGN_AREA => static::TAG_ASSIGN_AREA_VALUE,
                        self::TAG_ASSIGN_ITEM_ID => $itemId,
                        self::TAG_ASSIGN_TAG_ID => $tagId,
                        self::TAG_ASSIGN_DATEINSERT => $date,
                        self::TAG_ASSIGN_DATEUPDATE => $date
                    );
                    $this->insertQuery($insert);
                }
            }
            if (true === $this->hasLogger()) {
                $this->logger->info('Assignment success in ' . self::TAG_ASSIGN_TABLENAME . ' with ' . $id);
            }
        } catch (\Exception $e) {
            if (true === $this->hasLogger()) {
                $this->logger->crit('Error assignment ' . self::TAG_ASSIGN_TABLENAME . ': ' . $e->getMessage());
            }
        }
    }
}