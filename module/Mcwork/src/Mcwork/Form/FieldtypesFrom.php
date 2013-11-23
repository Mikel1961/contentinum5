<?php
namespace Mcwork\Form;

use ContentinumComponents\Forms\AbstractForms;


class FieldtypesFrom extends AbstractForms
{
   
    /**
     * 
     * @return multitype:multitype:multitype:string boolean multitype:string  multitype:string Ambigous <\ContentinumComponents\Forms\the, multitype:>    multitype:multitype:string multitype:string  multitype:Ambigous <\ContentinumComponents\Forms\the, multitype:>    multitype:multitype:string boolean multitype:string  multitype:string Ambigous <\ContentinumComponents\Forms\the, multitype:> multitype:string Ambigous <\ContentinumComponents\Forms\the, multitype:>
     */
    public function elements()
    {
        return array(
            array(
                'spec' => array(
                    'name' => 'name',
                    'required' => true,
                    
                    'options' => array(
                        'label' => 'Fieldtype',
                        //'description' => array('text' => 'hier steht text', 'deco-desc' => $this->getDecorators(self::DECO_DESC) ),
                        'deco-row' => $this->getDecorators(self::DECO_ROW),
                        'deco-error' =>  $this->getDecorators(self::DECO_ERROR),
                        'deco-error-msg' => 'Name is required and must be a string',
                    ),
                    
                    'type' => 'Text',
                    'attributes' => array(
                        'pattern' => '[a-zA-Z]+',
                        'required' => 'required',
                        'id' => 'name'
                    )
                )
            ),
            array(
                'spec' => array(
                    'name' => 'typescope',
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
                        'id' => 'typescope'   
                    )
                )
            ),
            array(
                'spec' => array(
                    'name' => 'send',
                    'options' => array(
                        'deco-row' => $this->getDecorators(self::DECO_ROW_BUTTON),
                        'deco-abort-btn' => $this->getDecorators(self::DECO_ABORT_BTN),
                     ),
                    'type' => 'submit',
                    'attributes' => array(
                        'value' => 'Submit',
                        'class' => 'small button',   
                    )
                )
            )
        );
    }
    
    /**
     * 
     * @return multitype:multitype:boolean multitype:multitype:string    multitype:boolean multitype:multitype:string   multitype:multitype:string multitype:string \Doctrine\ORM\EntityManager Ambigous <\ContentinumComponents\Forms\the, multitype:>
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
            'typescope' => array(
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
                            'entity' => 'Contentinum\Entity\FieldTypes',
                            'field' => 'typescope',
                            'exclude' => $this->getExclude()
                        )
                    )
                )
            )
        );
    }
    
    /**
     * 
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