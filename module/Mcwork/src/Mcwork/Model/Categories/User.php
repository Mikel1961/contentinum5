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

use ContentinumComponents\Crypt\Password;

/**
 * User (contact) categories model
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class User extends AbstractCategories
{

    const ENTITY_GROUP = 'Contentinum\Entity\Contacts';

    const ENTITY_CATEGORIES = 'Contentinum\Entity\Users5';

    const CATEGORIES_GROUP = 'contacts';

    const CATEGORY_TABLE_NAME = 'users5';

    const CATEGORY_ITEM_PRIMARY = 'id';

    const CATEGORY_GROUP_TABLE_NAME = 'contacts';

    const CATEGORY_GROUP_PRIMARY = 'id';

    const CATEGORY_COL_GROUP = 'contacts_id';

    /**
     * Prepare datas before save
     *
     * @see \ContentinumComponents\Mapper\Process::save()
     */
    public function save($datas, $entity = null, $stage = '', $id = null)
    {
        $entity = $this->handleEntity($entity);
        if (null === $entity->getPrimaryValue()) {
            $datas['loginUsername'] = md5($datas['username']);
            $crypt = new Password();
            $datas['loginPassword'] = $crypt->encode($datas['loginPassword']);
            parent::save($datas, $entity);
        } else {
            if ($entity->username != $datas['username']) {
                $datas['loginUsername'] = md5($datas['username']);
            }
            if (isset($datas['loginPassword']) && $datas['loginPassword'] > '0') {
                $crypt = new Password();
                $datas['loginPassword'] = $crypt->encode($datas['loginPassword']);
            }
            $msg = parent::save($datas, $entity, $stage, $id);
            return $msg;
        }
    }
}