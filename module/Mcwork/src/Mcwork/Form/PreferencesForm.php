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
 * contentinum mcwork form preferences
 *
 * @author Michael Jochum, michael.jochum@jochum-mediaservices.de
 */
class PreferencesForm extends AbstractForms 
{
	
	/**
	 * form field elements
	 *
	 * @see \ContentinumComponents\Forms\AbstractForms::elements()
	 */
	public function elements() 
	{
		return array (
				
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
										'value' => '<dl class="tabs" data-tab="data-tab"><dd class="active"><a href="#fieldsetBasedata">Basedata</a></dd><dd><a href="#fieldsetMetadata">Website meta specified</a></dd><dd><a href="#fieldsetJsBlock">Embed javascript instruction</a></dd><dd><a href="#fieldsetJsExpert">Embed javascript instruction block</a></dd></dl><div class="tabs-content">' 
								) 
						) 
				),
				array (
						'spec' => array (
								'name' => 'host',
								'required' => true,
								'options' => array (
										'label' => 'Hostname',
										'deco-error' => $this->getDecorators ( self::DECO_ERROR ),
										'deco-error-msg' => 'Name is required and must be a string' 
								),
								'type' => 'Text',
								'attributes' => array (
										'required' => 'required',
										'id' => 'host' 
								) 
						) 
				),
				array (
						'spec' => array (
								'name' => 'standardDomain',
								'required' => true,
								'options' => array (
										'label' => 'Set Standard',
										'empty_option' => 'Set a standard domain',
										'value_options' => array (
												'no' => 'no standard',
												'yes' => 'Standard domain' 
										),
										'deco-error' => $this->getDecorators ( self::DECO_ERROR ),
										'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich' 
								),
								'type' => 'Select',
								'attributes' => array (
										'required' => 'required',
										'id' => 'standardDomain' 
								) 
						) 
				),
				array (
						'spec' => array (
								'name' => 'title',
								'options' => array (
										'label' => 'Website title',
										'deco-error' => $this->getDecorators ( self::DECO_ERROR ),
										'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich' 
								),
								'type' => 'Text',
								'attributes' => array (
										'id' => 'title' 
								) 
						) 
				),
				array (
						'spec' => array (
								'name' => 'charset',
								'required' => true,
								'options' => array (
										'label' => 'Set Charset',
										'empty_option' => '-- Charset --',
										'value_options' => array (
												'utf-8' => 'Unicode utf8',
												'iso-8859-1' => 'ISO 8859-1',
												'iso-8859-15' => 'ISO 8859-15' 
										),
										'deco-error' => $this->getDecorators ( self::DECO_ERROR ),
										'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich' 
								),
								'type' => 'Select',
								'attributes' => array (
										'required' => 'required',
										'id' => 'charset' 
								) 
						) 
				),
				array (
						'spec' => array (
								'name' => 'language',
								'required' => true,
								'options' => array (
										'label' => 'Set language',
										'empty_option' => '-- language --',
										'value_options' => array (
												'de' => 'German',
												'en' => 'English',
												'fr' => 'French',
												'it' => 'Italian' 
										),
										'deco-error' => $this->getDecorators ( self::DECO_ERROR ),
										'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich' 
								),
								'type' => 'Select',
								'attributes' => array (
										'required' => 'required',
										'id' => 'language' 
								) 
						) 
				),
				array (
						'spec' => array (
								'name' => 'author',
								'required' => true,
								'options' => array (
										'label' => 'Author',
										'deco-error' => $this->getDecorators ( self::DECO_ERROR ),
										'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich',
										'fieldset' => array (
												'legend' => 'Metas',
												'attributes' => array (
														'class' => 'content active',
														'id' => 'fieldsetBasedata' 
												) 
										) 
								),
								'type' => 'Text',
								'attributes' => array (
										'required' => 'required',
										'id' => 'author' 
								) 
						) 
				),
				array (
						'spec' => array (
								'name' => 'robots',			
								'options' => array (
										'label' => 'Set meta value robots',
										'empty_option' => '-- meta value robots --',
										'value_options' => array (
												'index, follow' => 'Index the page, follow the links on the page',
												'index, nofollow' => 'Index the page, nofollow the links on the page',
												'noindex' => 'Disallow search engines from showing this page in their results',
												'nocache' => 'Prevents the search engines from showing a cached copy of this page',
												'none' => 'Don’t do anything with this page at all',
										),
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
								'name' => 'siteverification',
								'required' => true,
								'options' => array (
										'label' => 'Google site verification',
										'fieldset' => array (
												'legend' => 'Metas',
												'attributes' => array (
														'class' => 'content',
														'id' => 'fieldsetMetadata'
												)
										)
								),
								'type' => 'Text',
								'attributes' => array (
										'required' => 'required',
										'id' => 'siteverification'
								)
						)
				),
				array (
						'spec' => array (
								'name' => 'globalTopScript',
								'options' => array (
										'label' => 'Javascript body start tag',
								),
								'type' => 'Textarea',
								'attributes' => array (
										'rows' => '3',
										'id' => 'globalTopScript'
								)
						)
				),
				array (
						'spec' => array (
								'name' => 'globalBottomScript',
								'options' => array (
										'label' => 'Javascript body end tag',
										'fieldset' => array (
												'legend' => 'Embed javascript instruction',
												'attributes' => array (
														'class' => 'content',
														'id' => 'fieldsetJsBlock'
												)
										)
								),
								'type' => 'Textarea',
								'attributes' => array (
										'rows' => '3',
										'id' => 'globalBottomScript'
								)
						)
				),
				array (
						'spec' => array (
								'name' => 'globalExperttopScript',
								'options' => array (
										'label' => 'Javascript block body start tag',
								),
				
								'type' => 'Textarea',
								'attributes' => array (
										'rows' => '4',
										'id' => 'globalExperttopScript'
								)
						)
				),
				array (
						'spec' => array (
								'name' => 'globalExpertbottomScript',
								'options' => array (
										'label' => 'Javascript block body end tag',
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
										'id' => 'globalExpertbottomScript'
								)
						)
				),
				array (
						'spec' => array (
								'name' => 'formpreftabend',
								'options' => array (
										'fieldset' => array (
												'nofieldset' => 1 
										) 
								),
								'type' => 'ContentinumComponents\Forms\Elements\Note',
								'attributes' => array (
										'id' => 'formpreftabend',
										'value' => '</div>' 
								) 
						) 
				),
				array (
						'spec' => array (
								'name' => 'send',
								'options' => array (
										'deco-abort-btn' => $this->getDecorators ( self::DECO_ABORT_BTN ),
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
	 *
	 * @see \ContentinumComponents\Forms\AbstractForms::filter()
	 */
	public function filter() 
	{
		return array (
				'host' => array (
						'required' => true,
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim' 
								) 
						) 
				),
				'title' => array (
						'filters' => array (
								array (
										'name' => 'Zend\Filter\StringTrim' 
								) 
						) 
				),
				'author' => array (
						'filters' => array (
								array (
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
		return $this->factory->createForm ( array (
				'hydrator' => 'Zend\Stdlib\Hydrator\ArraySerializable',
				'elements' => $this->elements (),
				'input_filter' => $this->filter () 
		) );
	}
}