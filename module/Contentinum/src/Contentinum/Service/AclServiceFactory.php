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
use Contentinum\Service\AclAwareInterface;
use Zend\Permissions\Acl\Acl;

class AclServiceFactory implements FactoryInterface, AclAwareInterface
{
	/**
	 * Contentinum confuguration key
	 * @var string
	 */
	const CONTENTINUM_CONFIG = 'Contentinum\Acl'; 
	/**
	 * Contentinum acl settings
	 * @var string
	 */
	const CONTENTINUM_CONFIG_ACL = 'acl_settings';
	
	/**
	 * Zend\Permissions\Acl\Acl 
	 * @var Zend\Permissions\Acl\Acl 
	 */
	protected $acl;
	
    /**
     * Set and get Zend\Permissions\Acl\Acl
     * @see \Contentinum\Service\AclAwareInterface::getAcl()
     * @return Zend\Permissions\Acl\Acl 
     */
	public function getAcl($settings) 
	{
		if (null === $this->acl ){
			$acl = new Acl();
			// start to set first roles ...
			foreach ($settings['roles'] as $role ){
				$parents = null;
				if ( isset($settings['parent'][$role]) ){
					$parents = array($settings['parent'][$role]);
				}
				$acl->addRole($role,$parents);
			}
			$role = null;
			
			// ... then resoures ...
			foreach ($settings['resources'] as $resource) {
				$acl->addResource($resource);
			}
			
			// ... and now the rules
			foreach ($settings['rules'] as $access => $rule) {
				foreach ($rule as $role => $restrictions) {
					foreach ($restrictions as $resource => $restriction) {
						if ('all' == $restriction) {
							$acl->$access($role, $resource);
						} else {
							$acl->$access($role, $resource, $restriction);
						}
					}
				}
			}	
			$this->setAcl($acl);		
		}
		return $this->acl;
	}

    /**
	 * Set Zend\Permissions\Acl\Acl 
	 * @see \Contentinum\Service\AclAwareInterface::setAcl()
	 */
	public function setAcl(\Zend\Permissions\Acl\Acl $acl) 
	{
		$this->acl = $acl;
	}

	/**
	 * Create service
	 * @see \Zend\ServiceManager\FactoryInterface::createService()
	 * @return Zend\Permissions\Acl\Acl
	 */
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) 
	{
		$config = $serviceLocator->get(self::CONTENTINUM_CONFIG);
		return $this->getAcl($config[self::CONTENTINUM_CONFIG_ACL]);
	}
}