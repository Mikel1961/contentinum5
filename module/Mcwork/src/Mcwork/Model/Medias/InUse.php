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
namespace Mcwork\Model\Medias;

use ContentinumComponents\Mapper\Worker;
use Mcwork\Model\Cache\Content;

/**
 * Media in use model
 * Register and un register medias in a table
 * to have an overview about the use
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 *        
 */
class InUse extends Worker
{

    const TABLE_NAME = 'mediainuse';

    const COLUMN_MEDIA = 'mediasid';

    const COLUMN_USEID = 'inuseid';

    const COLUMN_GROUP = 'groupname';

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
     * Register media in table
     * 
     * @param int $mediaId media id
     * @param int $inuseId media categoriy id
     * @param string $name group identifier
     */
    public function insert($mediaId, $inuseId, $name)
    {
        $conn = $this->getConnection();
        $conn->insert(self::TABLE_NAME, array(
            self::COLUMN_MEDIA => $mediaId,
            self::COLUMN_USEID => $inuseId,
            self::COLUMN_GROUP => $name
        ));
    }

    /**
     * Unregister media in table
     * 
     * @param int $mediaId media id
     * @param int $inuseId media categoriy id
     * @param string $name group identifier
     */
    public function remove($mediaId, $inuseId, $name)
    {
        $sql = "DELETE FROM " . self::TABLE_NAME . " ";
        $sql .= "WHERE " . self::COLUMN_MEDIA . " = '" . $mediaId . "' ";
        $sql .= "AND " . self::COLUMN_USEID . " = '" . $inuseId . "' ";
        $sql .= "AND " . self::COLUMN_GROUP . " = '" . $name . "' ";
        $conn = $this->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    /**
     * Fetch all in use medias infos
     * 
     * @return array
     */
    public function fetchContent()
    {
        $sql = "SELECT * " . self::TABLE_NAME;
        $conn = $this->getConnection();
        $statement = $conn->prepare($this->sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * Empty the in use media application cache
     */
    public function emptyCache()
    {
        $empty = new Content();
        $fsEntity = Content::CACHE_FSENTITY;
        $empty->emptyCache(array(
            'id' => 'mcwork_inuse_medias'
        ), new $fsEntity(), $this->getSl());
    }
}