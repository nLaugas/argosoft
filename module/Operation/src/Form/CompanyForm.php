<?php
namespace Operation\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;

/**
 * This form is used to collect user's login, password and 'Remember Me' flag.
 */
class CompanyForm extends Form
{
    /**
     * Constructor.     
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('company-form');
     
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
                'name' => 'company-email',
                'attributes' => [
                    'id' => 'company-email',
                    'class'=>'form-control',
                    'placeholder'=>'name@example.com'
                ],
                'options' => [
                    'label' => 'E-mail de la Empresa',
                ],
            ]);

        // Add "subject" field
        $this->add([
                'type'  => 'text',
                'name' => 'company-name',
                'attributes' => [
                  'id' => 'company-name',
                  'class'=>'form-control',
                  'placeholder'=>'Nombre de la Empresa'
                ],
                'options' => [
                    'label' => 'Nombre de la Empresa',
                ],
            ]);

        // Add "body" field
        $this->add([
                'type'  => 'text',
                'name' => 'company-cuit',
                'attributes' => [
                  'id' => 'company-cuit',
                  'class'=>'form-control',
                  'placeholder'=>'CUIT'
                ],
                'options' => [
                    'label' => 'CUIT',
                ],
            ]);

         $this->add([
                'type'  => 'text',
                'name' => 'company-address',
                'attributes' => [
                  'id' => 'company-address',
                  'class'=>'form-control',
                  'placeholder'=>'ej : Calofu 1212'
                ],
                'options' => [
                    'label' => 'Direccion de la Empresa',
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
            'name'     => 'company-email',
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
            'name'     => 'company-name',
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
                    'min' => 5,
                    'max' => 100,
                    'messages' => [
                        StringLength::TOO_SHORT => 'El nombre debe tener minimo 5 caracteres.',
                        StringLength::TOO_LONG => 'El nombre debe tener maximo 100 caracteres.',
]   
                  ],
               ],
            ],
          ]
        );

        $inputFilter->add([
            'name'     => 'company-cuit',
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

