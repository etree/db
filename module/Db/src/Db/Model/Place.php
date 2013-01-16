<?php

namespace Db\Model;
use Db\Model\AbstractEntityModel
    , Zend\InputFilter\InputFilter
    ;

final class Place extends AbstractEntityModel
{
    use \Db\Field\Name
        , \Db\Field\State
        ;

    public function getDefaultSort()
    {
        return array('name' => 'asc');
    }

    public function getInputFilter($entity = null)
    {
        $inputFilter = new InputFilter();
        $inputFilter->add($this->inputFilterInputName($inputFilter));

        return $inputFilter;
    }
}