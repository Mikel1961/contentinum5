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
class PreferencesForm extends AbstractForms {
	
	/**
	 * form field elements
	 * 
	 * @see \ContentinumComponents\Forms\AbstractForms::elements()
	 */
	public function elements() {
		return array (
				array (
						'spec' => array (
								'name' => 'host',
								'required' => true,
								
								'options' => array (
										'label' => 'Hostname',
										'deco-row' => $this->getDecorators ( self::DECO_ROW ),
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
										'deco-row' => $this->getDecorators ( self::DECO_ROW ),
										'deco-error' => $this->getDecorators ( self::DECO_ERROR ),
										'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich',
										'fieldset' => array (
												'legend' => 'Domain',
												'attribute' => array (
														'id' => 'fieldsetDomain' 
												) 
										) 
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
										'label' => 'Title',
										'deco-row' => $this->getDecorators ( self::DECO_ROW ),
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
								'name' => 'author',
								'options' => array (
										'label' => 'Author',
										'deco-row' => $this->getDecorators ( self::DECO_ROW ),
										'deco-error' => $this->getDecorators ( self::DECO_ERROR ),
										'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich',
										'fieldset' => array (
												'legend' => 'Metas',
												'attribute' => array (
														'id' => 'fieldsetMetas' 
												) 
										) 
								),
								
								'type' => 'Text',
								'attributes' => array (
										'id' => 'author' 
								) 
						) 
				),
				array (
						'spec' => array (
								'name' => 'send',
								'options' => array (
										'deco-row' => $this->getDecorators ( self::DECO_ROW_BUTTON ),
										'deco-abort-btn' => $this->getDecorators ( self::DECO_ABORT_BTN ) 
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
	public function filter() {
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
	public function getForm() {
		return $this->factory->createForm ( array (
				'hydrator' => 'Zend\Stdlib\Hydrator\ArraySerializable',
				'elements' => $this->elements (),
				'input_filter' => $this->filter () 
		) );
	}
}