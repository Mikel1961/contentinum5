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
use ContentinumComponents\Filter\Url\Prepare;
use Contentinum\Entity\WebRedirect;
use Mcwork\Model\Categories\Navigation;

/**
 * Save model provides method to prepae insert and update datas
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class Page extends Process
{

    const ENTITY_MODEL = 'Contentinum\Entity\WebPagesParameter';

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
            if (strlen($datas['url']) == 0) {
                $filter = new Prepare();
                $datas['url'] = $filter->filter($datas['label']);
            }
            $datas['scope'] = $datas['url'];
            $msg = parent::save($datas, $entity);
            if (isset($datas['webNavigations']) && $datas['webNavigations'] > '0') {
                $this->addPageInNavigation($datas, $this->getLastInsertId());
            }
            return $msg;
        } else {
            $setRedirect = false;
            if (isset($datas['redirect']) && '1' === $datas['redirect']) {
                $insert['redirect'] = $entity->url;
                $insert['webPagesId'] = $entity;
                $insert['statuscode'] = '301';
                $setRedirect = true;
            }
            if ('index' === $entity->url) {
                unset($datas['url']);
            }
            $msg = parent::save($datas, $entity, $stage, $id);
            if (true === $setRedirect) {
                $this->setRedirect($insert);
            }
            return $msg;
        }
    }

    /**
     * Set redirect after change page url
     *
     * @param unknown $insert
     */
    public function setRedirect($insert)
    {
        $handle = new Redirect($this->getStorage());
        $handle->save($insert, new WebRedirect());
    }

    /**
     * Add host default page
     * 
     * @param array $datas data to insert
     * @param AbstractEntity $entity
     */
    public function addDefaults($datas, $entity)
    {
        $entity = $this->handleEntity($entity);
        parent::save($datas, $entity);
    }

    /**
     * Add a page in a navigation tree
     * 
     * @param array $datas
     * @param int $id page ident
     */
    protected function addPageInNavigation($datas, $id)
    {
        $datas['webPages'] = $this->find($id, true);
        $datas['publish'] = 'yes';
        $nav = new Navigation($this->getStorage());
        $entity = $nav::ENTITY_GROUP;
        $this->unsetEntity();
        $this->setEntity(new $entity());
        $datas['webNavigations'] = $this->find($datas['webNavigations'], true);
        $entity = $nav::ENTITY_CATEGORIES;
        $nav->save($datas, new $entity());
        return true;
    }
}