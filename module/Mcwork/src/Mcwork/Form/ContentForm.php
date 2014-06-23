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
class ContentForm extends AbstractForms
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
                    'name' => 'formRowStart',
                    'options' => array(
                        'fieldset' => array(
                            'nofieldset' => 1
                        )
                    ),
                    'type' => 'ContentinumComponents\Forms\Elements\Note',
                    'attributes' => array(
                        'id' => 'formColumStart',
                        'value' => '<div class="row">'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'headline',
                    'required' => true,
                    'options' => array(
                        'label' => 'Headline',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR),
                        'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich'
                    ),
                    
                    'type' => 'Text',
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'headline'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'contentIntro',
                    'options' => array(
                        'label' => 'Contribution Teaser',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW)
                    ),
                    'type' => 'Textarea',
                    'attributes' => array(
                        'rows' => '4',
                        'id' => 'contentIntro'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'content',
                    'options' => array(
                        'label' => 'Contribution',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'fieldset' => array(
                            'legend' => 'Contribution',
                            'attributes' => array(
                                'class' => 'large-8 columns',
                                'id' => 'fieldsetContribution'
                            )
                        )
                    ),
                    'type' => 'Textarea',
                    'attributes' => array(
                        'rows' => '8',
                        'id' => 'content'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'formAccordionStart',
                    'options' => array(),
                    'type' => 'ContentinumComponents\Forms\Elements\Note',
                    'attributes' => array(
                        'id' => 'formAccordionPanelPublish',
                        'value' => '<dl class="accordion" data-accordion><dd><a href="#panelMetas">Properties</a><div id="panelMetas" class="content active">'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'webPagesId',
                    'required' => true,
                    
                    'options' => array(
                        'label' => 'Select a page',
                        'empty_option' => '',
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
                        'id' => 'webPagesId',
                        'class' => 'chosen-select',
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'resource',
                    'required' => true,
                    'options' => array(
                        'label' => 'Access resources',
                        'empty_option' => '-- access values --',
                        'value_options' => $this->getOptions('Contentinum\Resource'),
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR),
                        'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich'
                    ),
                    'type' => 'Select',
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'resource'
                    )
                )
            ),
            
            array(
            		'spec' => array(
            				'name' => 'webMediasId',
            		        'required' => true,
            				'options' => array(
            						'label' => 'Select a media',
            						'value_options' => $this->getSelectOptions('webMediasId', array(
            								'value' => 'id',
            								'label' => 'mediaName'
            						)),
            						'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
            						'deco-error' => $this->getDecorators(self::DECO_ERROR),
            						'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich'
            				),
            
            				'type' => 'Select',
            				'attributes' => array(
            				    'required' => 'required',
            						'id' => 'webMediasId',
            						'class' => 'chosen-select',
            				)
            		)
            ),            
            
            array(
                'spec' => array(
                    'name' => 'htmlwidgets',
                    'required' => true,
                    'options' => array(
                        'label' => 'Choose a contribution widget',
                        'empty_option' => '-- Widgets --',
                        'value_options' => $this->getOptions('Contentinum\Htmlwidgets'),
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
                        'deco-error' => $this->getDecorators(self::DECO_ERROR),
                        'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich'
                    ),
                    'type' => 'Select',
                    'attributes' => array(
                        'required' => 'required',
                        'id' => 'htmlwidgets'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'formAccordionPublish',
                    'options' => array(),
                    'type' => 'ContentinumComponents\Forms\Elements\Note',
                    'attributes' => array(
                        'id' => 'formAccordionPanelTime',
                        'value' => '</div></dd><dd><a href="#panelTime">Contribution published</a><div id="panelTime" class="content">'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'publish',
                    'options' => array(
                        'label' => 'Publish',
                        'empty_option' => '-- publication values --',
                        'value_options' => $this->getOptions('Contentinum\Publish'),
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW)
                    ),
                    'type' => 'Select',
                    'attributes' => array(
                        'id' => 'publish'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'publishUp',
                    'options' => array(
                        'label' => 'Published beginning',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW)
                    ),
                    'type' => 'Text',
                    'attributes' => array(
                        'id' => 'publishUp'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'publishDown',
                    'options' => array(
                        'label' => 'Published ending',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW)
                    ),
                    'type' => 'Text',
                    'attributes' => array(
                        'id' => 'publishDown'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'formAccordionAuthor',
                    'options' => array(),
                    'type' => 'ContentinumComponents\Forms\Elements\Note',
                    'attributes' => array(
                        'id' => 'formAccordionPanelAuthor',
                        'value' => '</div></dd><dd><a href="#panelAuthor">Forming published author</a><div id="panelAuthor" class="content">'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'publishAuthor',
                    'options' => array(
                        'label' => 'Publish Author',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW)
                    ),
                    'type' => 'Text',
                    'attributes' => array(
                        'id' => 'publishAuthor'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'authorEmail',
                    'options' => array(
                        'label' => 'Author Email',
                        'deco-row' => $this->getDecorators(self::DECO_TAB_ROW)
                    ),
                    'type' => 'Text',
                    'attributes' => array(
                        'id' => 'authorEmail'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'formAccordionEnd',
                    'options' => array(
                        'fieldset' => array(
                            'legend' => 'Metas',
                            'attributes' => array(
                                'class' => 'large-4 columns',
                                'id' => 'fieldsetConfiguration'
                            )
                        )
                    ),
                    'type' => 'ContentinumComponents\Forms\Elements\Note',
                    'attributes' => array(
                        'id' => 'formAccordionEnd',
                        'value' => '</div></dd></dl>'
                    )
                )
            ),
            
            array(
                'spec' => array(
                    'name' => 'formRowEnd',
                    'options' => array(
                        'fieldset' => array(
                            'nofieldset' => 1
                        )
                    ),
                    'type' => 'ContentinumComponents\Forms\Elements\Note',
                    'attributes' => array(
                        'id' => 'formColumnEnd',
                        'value' => '</div>'
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
            'headline' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    )
                )
            ),
            'contentIntro' => array(
                'required' => false,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    )
                )
            ),
            'content' => array(
                'required' => false,
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