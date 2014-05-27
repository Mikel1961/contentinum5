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
namespace Contentinum\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ContentinumComponents\Mapper\Worker;

/**
 * Contentinum xml template files service
 * Load file content as config instance from cache is available
 * If cache empty or expired load content from xml file and add to cache
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
abstract class WebsiteServiceFactory implements FactoryInterface
{
	/**
	 * Contentinum logger configuration key
	 * @var string
	 */	
	const CONTENTINUM_DATABASE = 'db_cache_keys';

	/**
	 * Get logger configuration and initialize, return Applog
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 * @return Applog
	 */
	public function createService(ServiceLocatorInterface $serviceLocator) 
	{
		$config = $serviceLocator->get('Contentinum\Configure');
		$config = $config['db_cache_keys'];
		
		if ( isset($config[static::CONTENTINUM_DATABASE]) ){
			return $this->queryDbCacheResult($config[static::CONTENTINUM_DATABASE], $serviceLocator);
		} else {
			return null;
		}
		
	}
	
	/**
	 * Get result from cache or read from xml file
	 * @param string $file path to file and filename
	 * @param string $key template file ident
	 * @param ServiceLocatorInterface $sl
	 */
	protected function queryDbCacheResult($config, $sl)
	{
		$result = array();
		$cache = $sl->get('Contentinum\Cache\Filesystem7200');
		$key = $config['cache'];
		if ( ! ($result = $cache->getItem($key)) ){
			$worker = new Worker($sl->get($config['entitymanager']));
			$worker->setEntity($config['entity']);
			$sortby = $config['sortby'];
			$entries = $worker->getStorage()->getRepository($worker->getEntityName())->findAll();
			foreach ($entries as $entry){
				$result[$entry->$sortby] = $entry->toArray();
			}
			$cache->setItem($key,$result);
		}
		return $result;
	}
}