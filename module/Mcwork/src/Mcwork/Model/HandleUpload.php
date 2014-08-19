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
use Contentinum\Entity\WebMediaMetas;
use Contentinum\Entity\WebMedias;

/**
 * Contacts model
 * Prepare datas before save in database
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class HandleUpload extends Process
{
    /**
     * Prepared meta datas for db insert
     * @var array
     */
    private $mediaMetas = array();
    /**
     * Prepare datas before save
     * decide is it a insert or update
     * 
     * @see \ContentinumComponents\Mapper\Process::save()
     */
    public function save($datas, $entity = null, $stage = '', $id = null)
    {
        if (false !== ($result = $this->alreadyExists($datas['mediaSource'], $entity))){
            $entity = $this->find($result,true);
        }
        $entity = $this->handleEntity($entity);
        if (null === $entity->getPrimaryValue()) {
            return parent::save($datas, $entity, $stage, $id);
        } else {
            if ( isset($datas['mediaMetas'])) {
            	unset($datas['mediaMetas']);
            }            
            parent::save($datas, $entity, $stage, $id);
        }
    }
    
    /**
     * is media already exists
     * @param string $mediaSource media source string
     * @param WebMedias $entity
     * @return boolean|int
     */
    protected function alreadyExists($mediaSource,$entity)
    {
        $this->setEntity($entity);
        $entityName = $this->getEntityName();
        $em = $this->getStorage();
        $builder = $em->createQueryBuilder();
        $builder->add('select', 'main')->add('from', $entityName . ' AS main');
        $builder->add('where', 'main.mediaSource = ?' . 1);
        $builder->setParameter(1, $mediaSource);
        $query = $builder->getQuery();
        $result = $query->getResult();
        if (!$result){
        	return false;
        } else {
        	return $result[0]->id;
        }        
    }
	/**
	 * @return the $mediaMetas
	 */
	public function getMediaMetas() 
	{
		return $this->mediaMetas;
	}

	/**
	 * @param multitype: $mediaMetas
	 * @return HandleUpload
	 */
	public function setMediaMetas(array $mediaMetas) 
	{
		$this->mediaMetas = $mediaMetas;
		return $this;
	}
	
	/**
	 * 
	 * @param multitype: $mediaMetas
	 * @param string $key
	 * @return HandleUpload
	 */
	public function addMediaMetas($mediaMetas, $key = null)
	{
		if (null === $key){
		    return $this->setMediaMetas($mediaMetas);
		}
		$this->mediaMetas[$key] = $mediaMetas;
		return $this;
	}

}