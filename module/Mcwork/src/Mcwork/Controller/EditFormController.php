<?php

namespace Mcwork\Controller;




use ContentinumComponents\Controller\AbstractFormController;
use Zend\View\Model\ViewModel;

class EditFormController extends AbstractFormController
{

	
	/**
	 * Entry identifier
	 * @var int|string
	 */
	protected $id;
	
	/**
	 * Query parameter,default 'id'
	 * @var string
	 */
	protected $querykey = 'id';
	
    /**
     * Exclude columns and value for validators
     * @var array
     */
	protected $exclude;
	
	/**
	 * Construct
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
	    if (!$this->id) {
    	    $this->id = $this->params()->fromRoute($this->querykey, 0);
	        if (!$this->id) {
    		    if ( $this->toRoute ){
    		        return $this->redirect()->toRoute($this->toRoute);
    		    } else {
    		        return $this->redirect()->toRoute('mcwork');
    		    }
    		}
	    }

		if ( $this->exclude ){
		    $this->exclude['value'] = $this->id;
		    $this->formFactory->setExclude($this->exclude);
		}

	    $this->form = $this->formFactory->getForm();
		$this->form->setAttribute('action', $this->formAction . '/'.$this->id);
		$this->form->setAttribute('method', $this->formMethod);
		$this->formTagAttributes();
	}
	
	/**
	 * Populate database entries in form fields
	 */
	protected function populate()
	{ 
	    $this->form->populateValues($this->worker->fetchPopulateValues($this->id));
	}

	/** 
	 * Validate form entries and update database entry
	 * @see \Contentinum\Controller\AbstractFormController::process()
	 */
	protected function process() 
	{
		$model = new ViewModel ( array (
				'form' => $this->form
		) );
		
		try {
			$msg = $this->worker->save ( $this->form->getData (), $this->worker->fetchPopulateValues($this->id,false) );
			$model->setVariable ( 'success', true );
			// insert database sucessfully, back to list if set toRoute
			if (null !== $this->toRoute){
				return $this->redirect()->toRoute($this->toRoute);
			}			
		} catch ( \Exception $e ) {
			$model->setVariable ( 'insertError', true );
			$msg = $e->getMessage();
		}
		
		$model->setVariable('messages', $msg);
		return $model;
	}

	/**
	 * Get entry identifier
	 * @return Ambigous <number, string> $id
	 */
	public function getId() 
	{
		return $this->id;
	}

	/**
	 * Set Entry identifier
	 * @param Ambigous <number, string> $id
	 */
	public function setId($id) 
	{
		$this->id = $id;
	}

	/**
	 * Get query parameter
	 * @return string $querykey
	 */
	public function getQuerykey() 
	{
		return $this->querykey;
	}
	
	/**
	 * Set query parameter
	 * @param string $querykey
	 */
	public function setQuerykey($querykey) 
	{
		$this->querykey = $querykey;
	}

	/**
	 * Get validation exclude column and value
	 * @return array
	 */
	public function getExclude() 
	{
		return $this->exclude;
	}
	
	/**
	 * Set validation exclude column and value
	 * @param array $exclude
	 */
	public function setExclude(array $exclude) 
	{
		if ( array_key_exists('field',  $exclude) ){
	       $this->exclude = $exclude;
		}

	    return $this;
	}
}