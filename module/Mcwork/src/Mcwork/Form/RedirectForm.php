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
 * @package Forms
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 * @copyright Copyright (c) 2009-2013 jochum-mediaservices, Katja Jochum (http://www.jochum-mediaservices.de)
 * @license http://www.opensource.org/licenses/bsd-license
 * @since contentinum version 5.0
 * @link      https://github.com/Mikel1961/contentinum-components
 * @version   1.0.0
 */
namespace Mcwork\Form;

use ContentinumComponents\Forms\AbstractForms;

/**
 * contentinum mcwork form page
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class RedirectForm extends AbstractForms
{

    /**
     * form field elements
     *
     * @see \ContentinumComponents\Forms\AbstractForms::elements()
     */
    public function elements()
    {
        return array(
            array(
                'spec' => array(
                    'name' => 'webPagesId',
                    'required' => true,
                    
                    'options' => array(
                        'label' => 'Select a link or page',
                        'empty_option' => '-- pages, links --',
                        'value_options' => $this->getSelectOptions('webPagesId', array(
                            'value' => 'id',
                            'label' => 'label'
                        )),
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR),
                        'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich'
                    ),
                    
                    'type' => 'Select',
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'webPagesId'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'redirect',
                    'required' => true,
                    'options' => array(
                        'label' => 'Redirect Url',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR),
                        'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich'
                    ),
                    
                    'type' => 'Text',
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'redirect'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'statuscode',
                    'required' => true,
                    'options' => array(
                        'label' => 'HTTP Status Codes',
                        'empty_option' => '-- staus codes --',
                        'value_options' => $this->getOptions('Contentinum\Httpstatuscode', array(), 'value'),
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR),
                        'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich'
                    ),
                    'type' => 'Select',
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'statuscode'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'send',
                    'options' => array(
                        'deco-abort-btn' => $this->getDecorators(self::DECO_ABORT_BTN),
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'fieldset' => array(
                            'legend' => 'Save Datas',
                            'attributes' => array(
                                'id' => 'save-datas'
                            )
                        )
                    ),
                    'type' => 'submit',
                    'attributes' => array(
                        'value' => 'Submit',
                        'class' => 'button small'
                    )
                )
            )
        );
    }

    /**
     * form input filter and validation
     *
     * @see \ContentinumComponents\Forms\AbstractForms::filter()
     */
    public function filter()
    {
        return array(
            'redirect' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    )
                )
            )
        );
    }

    /**
     * initiation and get form
     *
     * @see \ContentinumComponents\Forms\AbstractForms::getForm()
     */
    public function getForm()
    {
        return $this->factory->createForm(array(
            'hydrator' => 'Zend\Stdlib\Hydrator\ArraySerializable',
            'elements' => $this->elements(),
            'input_filter' => $this->filter()
        ));
    }
}