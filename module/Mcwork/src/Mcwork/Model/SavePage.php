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
use ContentinumComponents\Filter\Url\Prepare;
use Contentinum\Entity\WebRedirect;

/**
 * Page model
 * Prepare serval input datas before save in database
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class SavePage extends Process
{

    /**
     * Prepare datas
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
            parent::save($datas, $entity);
        } else {
            if (isset($datas['redirect']) && '1' == $datas['redirect']) {
                $insert['redirect'] = $entity->url;
                $insert['webPagesId'] = $entity;
                $insert['statuscode'] = '301';
            }
            $datas['scope'] = $datas['url'];
            $msg = parent::save($datas, $entity, $stage, $id);
            $this->setRedirect($insert);
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
        $handle = new SaveRedirect($this->getStorage());
        $handle->save($insert, new WebRedirect());
    }
}