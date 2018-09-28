<?php
namespace Operation\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;

/**
 * This form is used to collect user's login, password and 'Remember Me' flag.
 */
class PersonalForm extends Form
{
    /**
     * Constructor.     
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('personal-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');
                
        $this->addElements();
        $this->addInputFilter();          
    }
    
    /**
     * This method adds elements to form (input fields and submit button).
     */
    private function addElements()
    {
        // Add "email" field
        $this->add([
                'type'  => 'text',
                'name' => 'personal-email',
                'attributes' => [
                    'id' => 'personal-email',
                    'class'=>'form-control',
                    'placeholder'=>'name@example.com'
                ],
                'options' => [
                    'label' => 'E-mail de la Persona',
                ],
            ]);

        // Add "subject" field
        $this->add([
                'type'  => 'text',
                'name' => 'personal-name',
                'attributes' => [
                  'id' => 'personal-name',
                  'class'=>'form-control',
                  'placeholder'=>'Nombre de la Persona'
                ],
                'options' => [
                    'label' => 'Nombre de la Persona',
                ],
            ]);

        // Add "body" field
        $this->add([
                'type'  => 'text',
                'name' => 'personal-cuit',
                'attributes' => [
                  'id' => 'personal-cuit',
                  'class'=>'form-control',
                  'placeholder'=>'CUIT'
                ],
                'options' => [
                    'label' => 'CUIT',
                ],
            ]);

        $this->add([
                'type'  => 'text',
                'name' => 'personal-seniority',
                'attributes' => [
                  'id' => 'personal-seniority',
                  'class'=>'form-control',
                  'placeholder'=>'En años '
                ],
                'options' => [
                    'label' => 'Antigüedad',
                ],
            ]);
        // Add the submit button
        $this->add([
                'type'  => 'submit',
                'name' => 'submit',
                'attributes' => [
                    'value' => 'Submit',
                ],
            ]);
    }
    
    
    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter()
    {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'     => 'personal-email',
            'required' => true,
            'filters'  => [
               ['name' => 'StringTrim'],
            ],
            'validators' => [
               [
                'name' => 'EmailAddress',
                'options' => [
                  'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
                  'useMxCheck' => false,

                ],
              ],
            ],
          ]
        );
        $inputFilter->add([
            'name'     => 'personal-name',
            'required' => true,
            'filters'  => [
               ['name' => 'StringTrim'],
               ['name' => 'StripTags'],
               ['name' => 'StripNewlines'],
            ],
            'validators' => [
               [
                'name' => 'StringLength',
                  'options' => [
                    'min' => 1,
                    'max' => 128,   
                  ],
               ],
            ],
          ]
        );
        $inputFilter->add([
            'name'     => 'personal-seniority',
            'required' => true,
            'filters'  => [
               ['name' => 'StringTrim'],
               ['name' => 'StripTags'],
               ['name' => 'StripNewlines'],
            ],
            'validators' => [
               [
                'name' => 'StringLength',
                  'options' => [
                    'min' => 1,
                    'max' => 2,   
                  ],
               ],
            ],
          ]
        );

        $inputFilter->add([
            'name'     => 'personal-cuit',
            'required' => true,
            'filters'  => [
              ['name' => 'StripTags'],
            ],
            'validators' => [
              [
                'name' => 'StringLength',
                'options' => [
                  'min' => 1,
                  'max' => 4096
                ],
              ],
            ],
          ]
        );
    }
    

}

