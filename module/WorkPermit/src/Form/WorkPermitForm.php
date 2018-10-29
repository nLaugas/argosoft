<?php
namespace WorkPermit\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

/**
 * This form is used to collect user's email, full name, password and status. The form 
 * can work in two scenarios - 'create' and 'update'. In 'create' scenario, user
 * enters password, in 'update' scenario he/she doesn't enter password.
 */
class WorkPermitForm extends Form
{
    /**
     * Scenario ('create' or 'update').
     * @var string 
     */
    private $scenario;
    
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager = null;
    
    /**
     * Current user.
     * @var User\Entity\User 
     */
    private $workPermit = null;
    
    /**
     * Constructor.     
     */
    public function __construct($scenario = 'create', $entityManager = null, $workPermit = null)
    {
        // Define form name
        parent::__construct('work-permit-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');
        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->workPermit = $workPermit;
        
        $this->addElements();
        $this->addInputFilter();          
    }
    
    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements() 
    {
       

        $this->add([            
            'type'  => 'text',
            'name' => 'work-reason',
            'options' => [
                'label' => 'Motivo de Trabajo',
            ],
        ]);
        
        // Add "full_name" field
        $this->add([            
            'type'  => 'text',
            'name' => 'start-time',       
            'options' => [
                'label' => 'Hora de Inicio',
            ],
            
        ]);
        
         $this->add([            
            'type'  => 'text',
            'name' => 'end-time',            
            'options' => [
                'label' => 'Hora de Finalizacion',
            ],
        ]);
        
          // Add "contractor" field
        $this->add([            
            'type'  => 'select',
            'name' => 'contractor',
            'options' => [
                'label' => 'Contratista',
            ],
        ]);

     
        // Add the Submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [                
                'value' => 'Create'
            ],
        ]);
    }
    
    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter() 
    {
        // Create main input filter
        $inputFilter = new InputFilter();        
        $this->setInputFilter($inputFilter);
                
        // Add input for "email" field
        $inputFilter->add([
                'name'     => 'work-reason',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],  //este filtro saca espacio                   
                ],                
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 128
                        ],
                    ],
                    
                                        
                ],
            ]);     
        
        // Add input for "full_name" field
        $inputFilter->add([
                'name'     => 'end-time',
                'required' => true,
                'filters'  => [                    
                    ['name' => 'StringTrim'],
                ],                
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 512
                        ],
                    ],
                ],
            ]);
        
       // Add input for "full_name" field
        $inputFilter->add([
                'name'     => 'start-time',
                'required' => true,
                'filters'  => [                    
                    ['name' => 'StringTrim'],
                ],                
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min' => 1,
                            'max' => 512
                        ],
                    ],
                ],
            ]);

        $inputFilter->add([
                'class'    => ArrayInput::class,
                'name'     => 'contractor',
                'required' => true,
                'filters'  => [                    
                    ['name' => 'ToInt'],
                ],                
                'validators' => [
                    ['name'=>'GreaterThan', 'options'=>['min'=>0]]
                ],
            ]); 

        
            
    }           
}