<?php

namespace Db\Entity\Field;
use Zend\Form\Annotation as Form;

trait Firstname
{
    /**
     * @Form\Type("Zend\Form\Element")
     * @Form\Attributes({"type": "string"})
     * @Form\Attributes({"id": "firstname"})
     * @Form\Options({"label": "First Name"})
     */
    protected $firstname;

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($value)
    {
        $this->firstname = $value;

        if (method_exists($this, 'setFirstnameNormalize'))
            $this->setFirstnameNormalize($this->getFirstname());

        return $this;
    }

    private function inputFilterInputFirstname($inputFilter = null) {
        return $inputFilter->getFactory()->createInput(array(
            'name' => 'firstname',
            'required' => true,
            'validators' => array(),
        ));
    }
}
