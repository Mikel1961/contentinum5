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
 * @link https://github.com/Mikel1961/contentinum-components
 * @version 1.0.0
 */
namespace Mcwork\Model;

use ContentinumComponents\Storage\StorageFiles;
use ContentinumComponents\Storage\AbstractStorageEntity;
use Mcwork\Model\Exception\ParamNotExistsModelException;

/**
 * Cache handle model
 * Methods to delete cache content
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class Cachecontent extends StorageFiles
{
    const MCWORK_CACHEKEYS  = 'Mcwork\Cachekeys';
    const CACHE_FILESYSTEM = 'Contentinum\Cache\Filesystem7200';

    /**
     * Cache keys
     *
     * @var array
     */
    protected $keys = false;

    /**
     * Fetch cache datas
     * if cache available set meta datas
     *
     * @param array $attribs
     * @param AbstractStorageEntity $entity
     * @param ServiceLocatorInterface $sl
     * @throws ParamNotExistsModelException
     * @return array
     */
    public function fetchContent(array $attribs, AbstractStorageEntity $entity, $sl = null)
    {
        if (0 == $attribs['id']) {
            $cache = $this->getCacheConfiguration($sl);
            $keys = $this->getCacheKeys($sl);
            foreach ($keys as $key => $datas) {
                if ($cache->hasItem($key)) {
                    $datas['metas'] = $cache->getMetadata($key);
                }
                $cacheData[$key] = $datas;
            }
            unset($datas);
            return $cacheData;
        } else {
            $keys = $this->getCacheKeys($sl);
            
            if (isset($keys[$attribs['id']])) {
                $tmp = $keys[$attribs['id']];
                if ($cache->hasItem($attribs['id'])) {
                    $tmp['metas'] = $cache->getMetadata($attribs['id']);
                }
                $cacheData[$attribs['id']] = $tmp;
                unset($tmp);
                return $cacheData;
            } else {
                throw new ParamNotExistsModelException('It was not a valid index passed');
            }
        }
    }

    /**
     * Remove cache item(s)
     *
     * @param array $attribs
     * @param AbstractStorageEntity $entity
     * @param ServiceLocatorInterface $sl
     * @throws ParamNotExistsModelException
     * @return string
     */
    public function emptyCache(array $attribs, AbstractStorageEntity $entity, $sl = null)
    {
        if (strlen($attribs['id']) > 1 && 'all' != $attribs['id']) {
            $cache = $this->getCacheConfiguration($sl);
            if ($cache->hasItem($attribs['id'])) {
                $cache->removeItem($attribs['id']);
            }
            return 'success_remove_cache_item';
        } elseif ('all' == $attribs['id']) {
            $keys = $this->getCacheKeys($sl);
            $cache = $this->getCacheConfiguration($sl);
            foreach ($keys as $key => $datas) {
                if ($cache->hasItem($key)) {
                    $cache->removeItem($key);
                }
            }
            return 'success_remove_all_cache_items';
        } else {
            throw new ParamNotExistsModelException('It was not a valid index passed');
        }
    }
    
    /**
     * Get cache keys
     * @param ServiceLocatorInterface $sl
     * @return array
     */
    protected function getCacheKeys($sl)
    {
        if (false === $this->keys){
            $keys = $sl->get(self::MCWORK_CACHEKEYS);
            $this->keys = $keys->toArray();
        }
        return $this->keys;
    }

    /**
     * Get cache instance
     *
     * @param ServiceLocatorInterface $sl
     * @return \Zend\Cache\Storage\StorageInterface
     */
    protected function getCacheConfiguration($sl)
    {
        return $sl->get(self::CACHE_FILESYSTEM);
    }
}