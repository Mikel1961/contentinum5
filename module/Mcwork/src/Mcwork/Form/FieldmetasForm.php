<?php
namespace Mcwork\Form;

use ContentinumComponents\Forms\AbstractForms;





class FieldmetasForm extends AbstractForms
{
    
    /*
     * (non-PHPdoc) @see \Contentinum\Forms\AbstractForms::elements()
    */
    public function elements()
    {
    	return array(
    		
    	    array(
    	    		'spec' => array(
    	    				'name' => 'fieldTypes',
    	    				'required' => true,
    	    					
    	    				'options' => array(
    	    						'label' => 'Select field type',
    	    				    'empty_option' => 'Please select a field type',
    	    				    'value_options' => $this->getSelectOptions('fieldTypes' ),
    	    				    
    	    				    
    	    				    
    	    						'deco-row' => $this->getDecorators(self::DECO_ROW),
    	    						'deco-error' => $this->getDecorators(self::DECO_ERROR),
    	    				        'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich',
    	    				),
    	    					
    	    				'type' => 'Select',
    	    				'attributes' => array(
    	    						'required' => 'required',
    	    						'id' => 'fieldTypes'
    	    				)
    	    		)
    	    ),
    	    
    	    array(
    	    		'spec' => array(
    	    				'name' => 'name',
    	    				'required' => true,
    	    
    	    				'options' => array(
    	    						'label' => 'Field meta name',
    	    						'deco-row' => $this->getDecorators(self::DECO_ROW),
    	    						'deco-error' => $this->getDecorators(self::DECO_ERROR),
    	    				        'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich',
    	    				),
    	    
    	    				'type' => 'Text',
    	    				'attributes' => array(
    	    						'required' => 'required',
    	    						'id' => 'name'
    	    				)
    	    		)
    	    ),  
    	    array(
    	    		'spec' => array(
    	    				'name' => 'datascope',
    	    				'required' => true,
    	    				'options' => array(
    	    						'label' => 'Scope',
    	    						'deco-row' => $this->getDecorators(self::DECO_ROW),
    	    						'deco-error' => $this->getDecorators(self::DECO_ERROR),
    	    				        'deco-error-msg' => 'Das Feld darf nicht leer sein ein Wert ist erforderlich',
    	    				),
    	    
    	    				'type' => 'Text',
    	    				'attributes' => array(
    	    						'required' => 'required',
    	    						'id' => 'datascope'
    	    				)
    	    		)
    	    ),
    	    array(
    	    		'spec' => array(
    	    				'name' => 'send',
    	    				'options' => array(
    	    						'deco-row' => $this->getDecorators(self::DECO_ROW),
    	    				        'deco-abort-btn' => $this->getDecorators(self::DECO_ABORT_BTN),
    	    				),
    	    				'type' => 'Submit',
    	    				'attributes' => array(
    	    						'value' => 'Submit',
    	    				        'class' => 'small button', 
    	    				)
    	    		)
    	    )    	      	    
    	    
    	);
    }    
    

	/* (non-PHPdoc)
	 * @see \Contentinum\Forms\AbstractForms::filter()
	 */
	public function filter() 
	{
        return array(
            'name' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    )
                )
            ),
            'datascope' => array(
                'required' => true,
                'filters' => array(
                    array(
                        'name' => 'Zend\Filter\StringTrim'
                    ),
                    array(
                        'name' => 'Zend\Filter\StringToLower'
                    )
                ),
                'validators' => array(
                    array(
                        'name' => 'ContentinumComponents\Validator\Doctrine\NoRecordExists',
                        'options' => array(
                            'storage' => $this->getStorage(),
                            'entity' => 'Contentinum\Entity\FieldTypeMetas',
                            'field' => 'datascope',
                            'exclude' => $this->getExclude()
                        )
                    )
                )
            )
        );

	}

    
    /*
     * (non-PHPdoc) @see \Contentinum\Forms\AbstractForms::getForm()
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