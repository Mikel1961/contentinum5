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
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class PageForm extends AbstractForms
{

	/**
	 * form field elements
	 * @see \ContentinumComponents\Forms\AbstractForms::elements()
	 */
    public function elements()
    {
    	return array(
    			
    			array (
    					'spec' => array (
    							'name' => 'formpreftab',
    							'options' => array (
    									'fieldset' => array (
    											'nofieldset' => 1
    									)
    							),
    							'type' => 'ContentinumComponents\Forms\Elements\Note',
    							'attributes' => array (
    									'id' => 'formpreftab',
    									'value' => '<dl class="tabs" data-tab="data-tab">
    									<dd class="active"><a href="#fieldsetPagebasedata">Page standard datas</a></dd>
    									<dd><a href="#fieldsetPageMetadata">Page meta specified</a></dd>
    									<dd><a href="#fieldsetPagePublished">Page publication</a></dd>
    									<dd><a href="#fieldsetJsExpert">Embed javascript instruction block</a></dd>
    									</dl><div class="tabs-content">'
    							)
    					)
    			),    			
    		
    			array(
    					'spec' => array(
    							'name' => 'webPreferences',
    							'required' => true,
    			
    							'options' => array(
    									'label' => 'Select field meta',
    									'empty_option' => 'Please select a field meta',
    									'value_options' => $this->getSelectOptions('webPreferences',array('value' => 'id', 'label' => 'host') ),
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    									'deco-error' => $this->getDecorators(self::DECO_ERROR),
    									'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich',
    							),
    			
    							'type' => 'Select',
    							'attributes' => array(
    									'required' => 'required',
    									'id' => 'webPreferences'
    							)
    					)
    			), 
    			array(
    					'spec' => array(
    							'name' => 'label',
    							'required' => true,
    								
    							'options' => array(
    									'label' => 'Label',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    									'deco-error' => $this->getDecorators(self::DECO_ERROR),
    									'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich',
    							),
    								
    							'type' => 'Text',
    							'attributes' => array(
    									'required' => 'required',
    									'id' => 'label'
    							)
    					)
    			), 

    			array(
    					'spec' => array(
    							'name' => 'url',    			
    							'options' => array(
    									'label' => 'Page Url',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    			
    							'type' => 'Text',
    							'attributes' => array(
    									'id' => 'url'
    							)
    					)
    			),  

    			array (
    					'spec' => array (
    							'name' => 'resource',
    							'required' => true,
    							'options' => array (
    									'label' => 'Access resources',
    									'empty_option' => '-- access values --',
    									'value_options' => $this->getOptions('Contentinum\Resource'),
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    									'deco-error' => $this->getDecorators ( self::DECO_ERROR ),
    									'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich',
    							),
    							'type' => 'Select',
    							'attributes' => array (
    									'required' => 'required',
    									'id' => 'resource'
    							)
    					)
    			),  

    			array (
    					'spec' => array (
    							'name' => 'htmlstructure',
    							'options' => array (
    									'label' => 'Choose a layout',
    									'description' => 'Overrides the global default values',
    									'empty_option' => '-- Layouts --',
    									'value_options' => $this->getOptions('Contentinum\Htmllayouts'),
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    							'type' => 'Select',
    							'attributes' => array (
    									'id' => 'htmlstructure'
    							)
    					)
    			),  

    			array (
    					'spec' => array (
    							'name' => 'htmlwidgets',
    							'required' => true,
    							'options' => array (
    									'label' => 'Choose a content widget',
    									'empty_option' => '-- Widgets --',
    									'value_options' => $this->getOptions('Contentinum\Htmlwidgets'),
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    									'deco-error' => $this->getDecorators ( self::DECO_ERROR ),
    									'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich'
    							),
    							'type' => 'Select',
    							'attributes' => array (
    									'required' => 'required',
    									'id' => 'htmlwidgets'
    							)
    					)
    			),    			

    			array (
    					'spec' => array (
    							'name' => 'params',
    							'options' => array (
    									'label' => 'navigation trees',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    									'fieldset' => array (
    											'legend' => 'Page standard datas',
    											'attributes' => array (
    													'class' => 'content active',
    													'id' => 'fieldsetPagebasedata'
    											)
    									)
    							),
    							'type' => 'Text',
    							'attributes' => array (
    									'id' => 'params'
    							)
    					)
    			), 

    			array (
    					'spec' => array (
    							'name' => 'title',
    							'options' => array (
    									'label' => 'Link title (is displayed as a tooltip)',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    							'type' => 'Text',
    							'attributes' => array (
    									'id' => 'title'
    							)
    					)
    			), 

    			array (
    					'spec' => array (
    							'name' => 'metaTitle',
    							'options' => array (
    									'label' => 'Page title',
    									'description' => 'Overrides the link name as page title',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    							'type' => 'Text',
    							'attributes' => array (
    									'id' => 'metaTitle'
    							)
    					)
    			),    			
    			
    			array (
    					'spec' => array (
    							'name' => 'robots',
    							'options' => array (
    									'label' => 'Set meta value robots',
    									'description' => 'Overrides the global default values',
    									'empty_option' => '-- meta value robots --',
    									'value_options' => $this->getOptions('Contentinum\Robots', array(),'value'),
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    							'type' => 'Select',
    							'attributes' => array (
    									'id' => 'robots'
    							)
    					)
    			),
    			array (
    					'spec' => array (
    							'name' => 'metaDescription',
    							'options' => array (
    									'label' => 'Meta value description',
    									'description' => 'Overrides the global default values',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    							'type' => 'Textarea',
    							'attributes' => array (
    									'rows' => '4',
    									'id' => 'metaDescription'
    							)
    					)
    			),
    			array (
    					'spec' => array (
    							'name' => 'metaKeywords',
    							'options' => array (
    									'label' => 'Meta value keywords',
    									'description' => 'Overrides the global default values',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    							'type' => 'Textarea',
    							'attributes' => array (
    									'rows' => '3',
    									'id' => 'metaKeywords'
    							)
    					)
    			),
    			array (
    					'spec' => array (
    							'name' => 'metaViewport',
    							'options' => array (
    									'label' => 'Viewport',
    									'description' => 'Overrides the global default values',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    							'type' => 'Text',
    							'attributes' => array (
    									'id' => 'metaViewport'
    							)
    					)
    			), 

    			array (
    					'spec' => array (
    							'name' => 'bodyId',
    							'options' => array (
    									'label' => 'Html body tag id',
    									'description' => 'Html body tag id attribute value',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    							'type' => 'Text',
    							'attributes' => array (
    									'id' => 'bodyId'
    							)
    					)
    			), 

    			array (
    					'spec' => array (
    							'name' => 'bodyClass',
    							'options' => array (
    									'label' => 'Html body tag class attribute value',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    									'fieldset' => array (
    											'legend' => 'Metas',
    											'attributes' => array (
    													'class' => 'content',
    													'id' => 'fieldsetPageMetadata'
    											)
    									),
    							),
    							'type' => 'Text',
    							'attributes' => array (
    									'id' => 'bodyClass'
    							)
    					)
    			),  

    			
    			array (
    					'spec' => array (
    							'name' => 'publish',
    							'options' => array (
    									'label' => 'Publish',
    									'empty_option' => '-- publication values --',
    									'value_options' => $this->getOptions('Contentinum\Publish'),
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    							'type' => 'Select',
    							'attributes' => array (
    									'id' => 'publish'
    							)
    					)
    			),
    			
    			array (
    					'spec' => array (
    							'name' => 'publishUp',
    							'options' => array (
    									'label' => 'Published beginning',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    							'type' => 'Text',
    							'attributes' => array (
    									'id' => 'publishUp'
    							)
    					)
    			),
    			
    			array (
    					'spec' => array (
    							'name' => 'publishDown',
    							'options' => array (
    									'label' => 'Published ending',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    									'fieldset' => array (
    											'legend' => 'Metas',
    											'attributes' => array (
    													'class' => 'content',
    													'id' => 'fieldsetPagePublished'
    											)
    									),
    							),
    							'type' => 'Text',
    							'attributes' => array (
    									'id' => 'publishDown'
    							)
    					)
    			),    			
    			
    			
    			
    			array (
    					'spec' => array (
    							'name' => 'headScript',
    							'options' => array (
    									'label' => 'Javascript block head tag',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    							),
    			
    							'type' => 'Textarea',
    							'attributes' => array (
    									'rows' => '4',
    									'id' => 'headScript'
    							)
    					)
    			),
    			array (
    					'spec' => array (
    							'name' => 'bodyFooterScript',
    							'options' => array (
    									'label' => 'Javascript block body end tag',
    									'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
    									'fieldset' => array (
    											'legend' => 'Embed javascript instruction block',
    											'attributes' => array (
    													'class' => 'content',
    													'id' => 'fieldsetJsExpert',
    											)
    									)
    							),
    							'type' => 'Textarea',
    							'attributes' => array (
    									'rows' => '4',
    									'id' => 'bodyFooterScript'
    							)
    					)
    			),    			
    			
    			
    			

    			array (
    					'spec' => array (
    							'name' => 'formtabend',
    							'options' => array (
    									'fieldset' => array (
    											'nofieldset' => 1
    									)
    							),
    							'type' => 'ContentinumComponents\Forms\Elements\Note',
    							'attributes' => array (
    									'id' => 'formtabend',
    									'value' => '</div>'
    							)
    					)
    			),    			

				array (
						'spec' => array (
								'name' => 'send',
								'options' => array (
										'deco-abort-btn' => $this->getDecorators ( self::DECO_ABORT_BTN ),
										'deco-row' => $this->getDecorators(self::DECO_TAB_ROW),
										'fieldset' => array (
												'legend' => 'Save Datas',
												'attributes' => array (
														'id' => 'save-datas' 
												) 
										) 
								),
								'type' => 'submit',
								'attributes' => array (
										'value' => 'Submit',
										'class' => 'button small' 
								) 
						) 
				)   			
    			
    			
    	);
    }    
    
    /**
     * form input filter and validation
     * @see \ContentinumComponents\Forms\AbstractForms::filter()
     */
	public function filter() 
	{
		return array(
			
				'label' => array(
						'required' => true,
						'filters' => array(
								array(
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),
				'url' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim' 
								) 
						) 
				),
				'htmlstructure' => array(
						'required' => false,
				),
				'params' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),	
				'title' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),
				'metaTitle' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),
				'robots' => array (
						'required' => false,
				),				
				'metaDescription' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),
				'metaKeywords' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),
				'bodyId' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),	
				'bodyClass' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),
				'publish' => array (
						'required' => false,
				),
				'publishUp' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),
				'publishDown' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),	
				'headScript' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),
				'bodyFooterScript' => array (
						'required' => false,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim'
								)
						)
				),										
		);

	}

	/**
	 * initiation and get form
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