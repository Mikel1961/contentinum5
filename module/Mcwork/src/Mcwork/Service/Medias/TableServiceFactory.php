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
namespace Mcwork\Service\Medias;

use Contentinum\Service\WebsiteServiceFactory;
use Mcwork\Model\AdministrateMedias;

/**
 * Content of full media table to use in backend
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class TableServiceFactory extends WebsiteServiceFactory
{
    /**
     * Cache key media table
     * @var string
     */
    const CONTENTINUM_DATABASE = 'mcwork_medias';


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
            $worker = new AdministrateMedias($sl->get($config['entitymanager']));
            $worker->setEntity($config['entity']);
            $datas = $worker->fetchMediaTable(array(
                'id',
                'mediaName',
                'mediaSource',
                'mediaType',
                'mediaAlternate',
                'mediaInUse',
                'resource'
            ));
            foreach ($datas as $row) {
                $result[$row['mediaSource']]['mediaInUse'] = $row['mediaInUse'];
                $result[$row['mediaSource']]['id'] = $row['id'];
                $result[$row['mediaSource']]['mediaName'] = $row['mediaName'];
                $result[$row['mediaSource']]['mediaType'] = $row['mediaType'];
                $result[$row['mediaSource']]['mediaAlternate'] = $row['mediaAlternate'];
                $result[$row['mediaSource']]['resource'] = $row['resource'];
            }
            $cache->setItem($key, $result);
        }
        return $result;
    }
}