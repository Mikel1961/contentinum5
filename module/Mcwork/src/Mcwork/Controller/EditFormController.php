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
 * @category contentinum backend
 * @package Controller
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Mcwork\Controller;

use ContentinumComponents\Controller\AbstractFormController;
use ContentinumComponents\Tools\HandleSerializeDatabase;
use Zend\View\Model\ViewModel;

/**
 * form controller backend edit a data record
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class EditFormController extends AbstractFormController
{

    /**
     * Entry identifier
     *
     * @var int string
     */
    protected $id;

    /**
     * Query parameter,default 'id'
     *
     * @var string
     */
    protected $querykey = 'id';

    /**
     * Exclude columns and value for validators
     *
     * @var array
     */
    protected $exclude;

    /**
     * Unserialize populate datas
     * 
     * @var boolean array
     */
    protected $unserialize = false;

    /**
     * Construct
     *
     * @param AbstractForms $addForm
     */
    public function __construct($addForm)
    {
        parent::__construct($addForm);
    }

    /**
     * Create and prepare form
     * Validate query parameter
     * Set exclude columns, if available, for doctrine validators NoRecord or RecordExists
     * and set columns value
     */
    protected function prepare()
    {
        if (! $this->id) {
            $this->id = $this->params()->fromRoute($this->querykey, 0);
            if (! $this->id) {
                if ($this->toRoute) {
                    return $this->redirect()->toUrl($this->toRoute);
                } else {
                    return $this->redirect()->toRoute('mcwork');
                }
            }
        }
        
        $this->formFactory->setDataIdent($this->id);
        
        if ($this->exclude) {
            $this->exclude['value'] = $this->id;
            $this->formFactory->setExclude($this->exclude);
        }
        
        $this->form = $this->formFactory->getForm();
        $this->form->setAttribute('action', $this->formAction . '/' . $this->id);
        $this->form->setAttribute('method', $this->formMethod);
        $this->formTagAttributes();
    }

    /**
     * Populate database entries in form fields
     */
    protected function populate()
    {
        $datas = $this->worker->fetchPopulateValues($this->id);
        
        if (false !== $this->unserialize && isset($this->unserialize['fields'])) {
            if (isset($datas['decodeMetas']) && strlen($datas['decodeMetas']) > 1) {
                $method = $datas['decodeMetas'];
                $decode = new HandleSerializeDatabase($method);
                if (is_string($this->unserialize['fields'])) {
                    $datas = array_merge($datas,$decode->execUnserialize($datas[$this->unserialize['fields']]));                
                }
            } elseif (is_array($this->unserialize['fields'])) {
                if (isset($datas['decodeMetas']) && strlen($datas['decodeMetas']) > 1) {
                    $method = $datas['decodeMetas'];
                    $decode = new HandleSerializeDatabase($method);
                    foreach ($this->unserialize['fields'] as $field) {
                        if (isset($datas[$field])) {
                            $datas[$field] = $decode->execUnserialize($datas[$field]);
                        }
                    }
                    
                }
            }
        }
        $this->form->populateValues($datas);
    }

    /**
     * Validate form entries and update database entry
     *
     * @see \Contentinum\Controller\AbstractFormController::process()
     */
    protected function process()
    {
        $model = new ViewModel(array(
            'form' => $this->form
        ));
        
        try {
            $msg = $this->worker->save($this->form->getData(), $this->worker->fetchPopulateValues($this->id, false));
            $model->setVariable('success', true);
            // insert database sucessfully, back to list if set toRoute
            if (null !== $this->toRoute) {
                return $this->redirect()->toUrl($this->toRoute);
            }
        } catch (\Exception $e) {
            $model->setVariable('insertError', true);
            $msg = $e->getMessage();
        }
        
        $model->setVariable('messages', $msg);
        return $model;
    }

    /**
     * Get entry identifier
     *
     * @return Ambigous <number, string> $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Entry identifier
     *
     * @param Ambigous <number, string> $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get query parameter
     *
     * @return string $querykey
     */
    public function getQuerykey()
    {
        return $this->querykey;
    }

    /**
     * Set query parameter
     *
     * @param string $querykey
     */
    public function setQuerykey($querykey)
    {
        $this->querykey = $querykey;
    }

    /**
     * Get validation exclude column and value
     *
     * @return array
     */
    public function getExclude()
    {
        return $this->exclude;
    }

    /**
     * Set validation exclude column and value
     *
     * @param array $exclude
     */
    public function setExclude(array $exclude)
    {
        if (array_key_exists('field', $exclude)) {
            $this->exclude = $exclude;
        }
        
        return $this;
    }

    /**
     *
     * @return the $unserialize
     */
    public function getUnserialize()
    {
        return $this->unserialize;
    }

    /**
     *
     * @param Ambigous <boolean, multitype:> $unserialize
     */
    public function setUnserialize(array $unserialize)
    {
        $this->unserialize = $unserialize;
    }

    public function findSerializeError($data1)
    {
        echo "<pre>";
        $data2 = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $data1);
        $max = (strlen($data1) > strlen($data2)) ? strlen($data1) : strlen($data2);
        
        echo $data1 . PHP_EOL;
        echo $data2 . PHP_EOL;
        
        for ($i = 0; $i < $max; $i ++) {
            
            if (@$data1{$i} !== @$data2{$i}) {
                
                echo "Diffrence ", @$data1{$i}, " != ", @$data2{$i}, PHP_EOL;
                echo "\t-> ORD number ", ord(@$data1{$i}), " != ", ord(@$data2{$i}), PHP_EOL;
                echo "\t-> Line Number = $i" . PHP_EOL;
                
                $start = ($i - 20);
                $start = ($start < 0) ? 0 : $start;
                $length = 40;
                
                $point = $max - $i;
                if ($point < 20) {
                    $rlength = 1;
                    $rpoint = - $point;
                } else {
                    $rpoint = $length - 20;
                    $rlength = 1;
                }
                
                echo "\t-> Section Data1  = ", substr_replace(substr($data1, $start, $length), "<b style=\"color:green\">{$data1 {$i}}</b>", $rpoint, $rlength), PHP_EOL;
                echo "\t-> Section Data2  = ", substr_replace(substr($data2, $start, $length), "<b style=\"color:red\">{$data2 {$i}}</b>", $rpoint, $rlength), PHP_EOL;
            }
        }
    }
}