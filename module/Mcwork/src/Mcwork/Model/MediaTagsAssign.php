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

class MediaTagsAssign extends Process
{

    const ASSIGN_TABLENAME = 'web_media_assign';

    const REF_TABLENAME = 'web_media_tags';

    const REF_COL_TAGNAME = 'tag_name';

    const COL_REFERENZ = 'id';

    const COL_ASSIGNID = 'web_medias_id';

    const COL_TAGID = 'web_mediatag_id';

    const COL_DATEINSERT = 'register_date';

    const COL_DATEUPDATE = 'up_date';

    protected $coltarget = array(
        self::COL_REFERENZ => self::COL_TAGID
    );

    protected $params = array(
        self::COL_ASSIGNID => ':webmediasid',
        self::COL_TAGID => ':webmediatagid',
        self::COL_DATEINSERT => ':registerdate',
        self::COL_DATEUPDATE => ':update'
    );

    /**
     * Native sql string
     *
     * @var string
     */
    private $sql;

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
        $conn->insert(self::ASSIGN_TABLENAME, $data);
    }

    /**
     * Prepare and execute sql query
     *
     * @return array
     */
    public function getAssigns()
    {
        
        // set sql query
        if (null === $this->sql) {
            $this->fetchAllAssigns();
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
    public function sortAssignsToMedia($result)
    {
        $tagsByMedia = array();
        foreach ($result as $row) {
            $tagsByMedia[$row[self::COL_ASSIGNID]][] = $row[self::REF_COL_TAGNAME];
        }
        return $tagsByMedia;
    }

    /**
     * Native sql query string
     */
    protected function fetchAllAssigns()
    {
        $this->sql = "SELECT main." . self::COL_ASSIGNID . ", main." . self::COL_TAGID . ", ref1." . self::REF_COL_TAGNAME . " ";
        $this->sql .= "FROM " . self::ASSIGN_TABLENAME . " AS main ";
        $this->sql .= "LEFT JOIN " . self::REF_TABLENAME . " AS ref1";
        $this->sql .= " ON ref1." . self::COL_REFERENZ . " = main." . $this->coltarget[self::COL_REFERENZ] . " ";
    }

    /**
     * Delete query
     */
    public function deleteAssigns($col = self::COL_ASSIGNID)
    {
        $this->sql = "DELETE FROM " . self::ASSIGN_TABLENAME . " ";
        $this->sql .= "WHERE " . $col . " = " . $this->getParamterIdent($col);
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
     * Database connection
     *
     * @return \Doctrine\DBAL\Connection
     */
    protected function getConnection()
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
}