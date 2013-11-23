<?php


namespace Mcwork\Controller;




use ContentinumComponents\Controller\AbstractFormController;
use Zend\View\Model\ViewModel;


/**
 * @author mike
 *
 */
class AddFormController extends AbstractFormController
{
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
	 */
	public function prepare()
	{
	    
	    $this->form = $this->formFactory->getForm();
		$this->form->setAttribute('action', $this->formAction);
		$this->form->setAttribute('method', $this->formMethod);
		$this->formTagAttributes();
	}
	
	/**
	 * Validate form entries and update database entry
	 * @see \Contentinum\Controller\AbstractFormController::process()
	 */
	public function process() 
	{
		$model = new ViewModel ( array (
				'form' => $this->form 
		) );
		
		try {
			$msg = $this->worker->save ( $this->form->getData (), $this->entity);
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
	
}