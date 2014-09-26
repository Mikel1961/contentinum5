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
 * @category contentinum
 * @package Service
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Mcwork\Service\Pages;

use Contentinum\Service\WebsiteServiceFactory;
use ContentinumComponents\Mapper\Worker;
use Zend\Config\Config;

/**
 * Content of the full page tables for use in backend
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class PublicServiceFactory extends WebsiteServiceFactory
{
    /**
     * Cache key page table
     * @var string
     */
    const CONTENTINUM_DATABASE = 'public_pages';
    
    /**
     * (non-PHPdoc)
     * @see \Contentinum\Service\WebsiteServiceFactory::queryDbCacheResult()
     */
    protected function queryDbCacheResult($config, $sl)
    {
        $result = array();
        $cache = $sl->get('Contentinum\Cache\Filesystem7200');
        $key = $config['cache'];
        if (! ($result = $cache->getItem($key))) {
            $worker = new Worker($sl->get($config['entitymanager']));
            $repos = $worker->getStorage()->getRepository($config['entity']);
            if (isset($config['findBy'])){
                $entries = $repos->findBy($config['findBy']);
            } else {
                $entries = $repos->findAll();
            }
            $tmp = array();
            foreach ($entries as $entry){
                $tmp[$entry->id] = array('name' => $entry->label);
            }
            $result = new Config($tmp);
            $cache->setItem($key, $result);
        }  
        return $result;
    }    
}