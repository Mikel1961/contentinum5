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
namespace Mcwork\Model\Save;

use ContentinumComponents\Mapper\Process;
use ContentinumComponents\Mapper\Sequence;
use Mcwork\Model\Categories\Content;
use Mcwork\Model\Categories\Page;
use Mcwork\Model\Medias\InUse;

/**
 * Save model provides method to prepae insert and update datas
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class Contribution extends Process
{

    const ENTITY_MODEL = 'Contentinum\Entity\WebContent';

    const INUSE_GROUP = 'mediacontent';

    /**
     * Get entity name to have access of the publish property
     * 
     * @return string
     */
    public function getPublishEntity()
    {
        return self::ENTITY_MODEL;
    }

    /**
     * Prepare datas before save
     *
     * @see \ContentinumComponents\Mapper\Process::save()
     */
    public function save($datas, $entity = null, $stage = '', $id = null)
    {
        $entity = $this->handleEntity($entity);
        if (null === $entity->getPrimaryValue()) {
            $msg = parent::save($datas, $entity, $stage, $id);
            $lastInsertId = $this->getLastInsertId();
            $this->inUseMedia($datas['webMediasId'], $lastInsertId);
            $this->assignGroup($datas, $lastInsertId);
        } else {
            $this->inUseMedia($entity->webMediasId->id, $entity->id, self::INUSE_GROUP, 'delete');
            parent::save($datas, $entity, $stage, $id);
            $this->inUseMedia($datas['webMediasId'], $entity->id);
            $this->updateGroup($datas, $entity->id);
        }
    }

    /**
     * Assign contribution in contribution group
     * 
     * @param array $datas insert contribution datas
     * @param int $lastInsertId
     */
    protected function assignGroup($datas, $lastInsertId)
    {
        $datas['webContent'] = $this->find($lastInsertId, true);
        $group = new Content($this->getStorage());
        $entity = $group::ENTITY_CATEGORIES;
        if (false == $datas[$group::CATEGORIES_GROUP]) { // &&
            $datas[$group::CATEGORIES_GROUP] = $lastInsertId;
            $assignInPage = true;
        } else {
            $assignInPage = false;
        }
        $group->setEntity(new $entity());
        $group->save($datas);
        $lastInsertId = $group->getLastInsertId();
        if (true === $assignInPage) {
            $datas['htmlwidgets'] = 'content';
            $datas[$group::CATEGORIES_GROUP] = $group->find($lastInsertId, true);
            $this->assignPageContent($datas, $lastInsertId);
        }
    }

    /**
     * Assign contribution group to a page
     * 
     * @param array $datas insert group datas
     * @param int $lastInsertId
     */
    protected function assignPageContent($datas, $lastInsertId)
    {
        $page = new Page($this->getStorage());
        $entity = $page::ENTITY_GROUP;
        $this->unsetEntity();
        $this->setEntity(new $entity());
        $datas[$page::CATEGORIES_GROUP] = $this->find($datas[$page::CATEGORIES_GROUP], true);
        $entity = $page::ENTITY_CATEGORIES;
        $page->save($datas, new $entity());
    }

    /**
     * Update group datas
     * 
     * @param array $datas insert group datas
     * @param int $id contribution ident
     */
    protected function updateGroup($datas, $id)
    {
        $datas['webContent'] = $this->find($id, true);
        $group = new Content($this->getStorage());
        
        $entity = $group::ENTITY_CATEGORIES;
        if (false == $datas[$group::CATEGORIES_GROUP]) { // &&
            $datas[$group::CATEGORIES_GROUP] = $id;
        }
        $group->setEntity(new $entity());
        $entries = $group->fetchEntries($group->getEntityName(), 'webContent', $id);
        $groupId = $entries[0]->id;
        $group->save($datas, $entries[0]);
        /*
         * $lastInsertId = $group->getLastInsertId();
         * $datas[$group::CATEGORIES_GROUP] = $group->find($groupId, true);
         * $this->updatePageContent($datas, $groupId);
         */
    }

    /**
     * Update page datas
     * 
     * @param array $datas insert group datas
     * @param int $groupId group ident
     */
    protected function updatePageContent($datas, $groupId)
    {
        $page = new Page($this->getStorage());
        $entity = $page::ENTITY_GROUP;
        $this->unsetEntity();
        $this->setEntity(new $entity());
        $datas[$page::CATEGORIES_GROUP] = $this->find($datas[$page::CATEGORIES_GROUP], true);
        
        $entity = $page::ENTITY_CATEGORIES;
        $page->setEntity(new $entity());
        $entries = $page->fetchEntries($page->getEntityName(), $page::CATEGORIES_ITEM, $groupId);
        $page->save($datas, $entries[0]);
        
        $seq = new Sequence($this->getStorage());
        $entity = $seq->setEntity(new $entity());
        $seq->sortItemRang($page::CATEGORIES_GROUP, $datas[$page::CATEGORIES_GROUP]->id);
    }

    /**
     * Prepare contribution datas before sign as in trash
     * 
     * @param int $id contribution ident
     */
    public function setDeleted($id)
    {
        $entity = $this->find($id);
        $update['deleted'] = '1';
        $update['webPages'] = '0';
        $update['webContentgroup'] = '0';
        $update['htmlwidgets'] = '';
        $update['element'] = '';
        $update['elementAttribute'] = '';
        $update['modul'] = '';
        $update['modulParams'] = '';
        $update['modulDisplay'] = '';
        $update['modulConfig'] = '';
        $update['modulFormat'] = '';
        $update['mediaLinkPage'] = '0';
        $update['mediaLinkGroup'] = '0';
        $update['mediaLinkUrl'] = '';
        $update['mediaStyle'] = '';
        $update['webMediasId'] = 1;
        $this->save($update, $entity);
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
        if ('insert' == $status) {
            if ($mediaId > '1') {
                $save->insert($mediaId, $inuseId, $name);
                $save->emptyCache();
            }
        } else {
            if ($mediaId > '1') {
                $save->remove($mediaId, $inuseId, $name);
                $save->emptyCache();
            }
        }
    }
}