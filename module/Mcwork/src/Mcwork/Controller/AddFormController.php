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
use Zend\View\Model\ViewModel;
use Zend\Json\Json;

/**
 * form controller backend add a data record in database
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class AddFormController extends AbstractFormController
{

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
     */
    public function prepare()
    {
        $action = '';
        if (is_array($this->populateFromRoute) && ! empty($this->populateFromRoute)) {
            foreach ($this->populateFromRoute as $formRoute => $key) {
                $action .= '/' . $this->params()->fromRoute($formRoute);
            }
        }
        
        $this->form = $this->formFactory->getForm();
        $this->form->setAttribute('action', $this->formAction . $action);
        $this->form->setAttribute('method', $this->formMethod);
        $this->formTagAttributes();
    }

    /**
     * Validate form entries and update database entry
     * 
     * @see \Contentinum\Controller\AbstractFormController::process()
     */
    public function process()
    {
        try {
            $msg = $this->worker->save($this->form->getData(), $this->entity);
            $viewVariable = 'success';
            $viewValue = true;
            // insert database sucessfully, back to list if set toRoute
            if (null !== $this->toRoute && false === $this->getXmlHttpRequest()) {            
                $ln = '';
                if (is_array($this->populateFromRoute) && ! empty($this->populateFromRoute)) {
                    foreach ($this->populateFromRoute as $formRoute => $key) {
                        $ln .= '/' . $this->params()->fromRoute($formRoute);
                    }
                }
                return $this->redirect()->toUrl($this->toRoute . $ln);
            } else {
                echo true;
                exit();
            }
        } catch (\Exception $e) {
            $viewVariable = 'insertError';
            $viewValue = true;
            $msg = $e->getMessage();
        }
        
        if (false === $this->getXmlHttpRequest()) {
            $model = new ViewModel(array(
                'form' => $this->form
            ));
            $model->setVariable($viewVariable, $viewValue);
            $model->setVariable('messages', $msg);
            return $model;
        } else {
            echo Json::encode(array(
                'error' => $msg
            ));
            exit();
        }
    }

    /**
     * Populate entries in form fields from configuration file
     */
    protected function populate()
    {
        $populate = false;
        if (is_array($this->populateFromRoute) && ! empty($this->populateFromRoute)) {
            foreach ($this->populateFromRoute as $formRoute => $key) {
                $populate[$key] = $this->params()->fromRoute($formRoute);
            }
        }
        if (is_array($this->addPopulate) && ! empty($this->addPopulate)) {
            if (false !== $populate) {
                $populate = array_merge($this->addPopulate, $populate);
            } else {
                $populate = $this->addPopulate;
            }
        }
        if (false !== $populate) {
            $this->form->populateValues($populate);
        }
    }
}