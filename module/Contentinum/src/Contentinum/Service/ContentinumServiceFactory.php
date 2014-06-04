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
use Zend\Config\Config;

/**
 * Contentinum etc config file services
 * Load file content as config instance from cache is available
 * If cache empty or expired load content from php config file and add to cache
 * 
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
abstract class ContentinumServiceFactory implements FactoryInterface
{

    /**
     * Contentinum logger configuration key
     * 
     * @var string
     */
    const CONTENTINUM_CFG_FILE = 'etc_cfg_files';

    /**
     *
     * @see \Zend\ServiceManager\FactoryInterface::createService()
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Contentinum\Configure');
        $config = $config['etc_cfg_files'];
        
        if (isset($config[static::CONTENTINUM_CFG_FILE])) {
            return $this->getFileAsConfig($config[static::CONTENTINUM_CFG_FILE], static::CONTENTINUM_CFG_FILE, $serviceLocator);
        } else {
            return null;
        }
    }

    /**
     * Get result from cache or read from php file
     * 
     * @param string $file path to file and filename
     * @param string $key template file ident
     * @param ServiceLocatorInterface $sl
     */
    protected function getFileAsConfig($file, $key, $sl)
    {
        $cache = $sl->get('Contentinum\Cache\Filesystem7200');
        if (! ($result = $cache->getItem($key))) {
            $result = new Config(include $file);
            $cache->setItem($key, $result);
        }
        return $result;
    }
}