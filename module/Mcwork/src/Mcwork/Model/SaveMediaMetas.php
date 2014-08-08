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
use ContentinumComponents\Tools\HandleSerializeDatabase;

/**
 * Media metas model
 * Prepare datas before save in database
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class SaveMediaMetas extends Process
{
    /**
     * Contains the field datas to serialize
     * @var array
     */
    protected $serializeFields = array('alt', 'title', 'caption', 'description', 'longdescription','linkname', 'headline');
       
    /**
     * Prepare datas
     * 
     * @see \ContentinumComponents\Mapper\Process::save()
     */
    public function save($datas, $entity = null, $stage = '', $id = null)
    {
        $entity = $this->handleEntity($entity);
        $configuration = $this->getConfiguration();
        if (null === $entity->getPrimaryValue()) {
            parent::save($datas, $entity);
        } else {
            $mediaMetas = array();
            foreach ($this->serializeFields as $field){
                if (isset($datas[$field])){
                    $mediaMetas[$field] = $datas[$field];
                    unset($datas[$field]);
                }
            }
            if (!empty($mediaMetas)){
                $prepare = false;
                if ($entity->prepareSerialize){
                    $prepare = $entity->prepareSerialize;
                }
                if (false === $prepare && $configuration->default->Database_Settings->prepare_serialize_data){
                    $prepare = $configuration->default->Database_Settings->prepare_serialize_data;
                    $datas['prepareSerialize'] = $prepare;
                    $datas['decodeMetas'] = $configuration->default->Database_Settings->decode_serialize_data;
                }
                $dataserialize = new HandleSerializeDatabase($prepare);
                $datas['mediaMetas'] = $dataserialize->execSerialize($mediaMetas);
            } else {
                $datas['mediaMetas'] = '';
            }
            parent::save($datas, $entity, $stage, $id);
        }
    }
}