<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity
    , Zend\Form\Annotation as Form
    , Zend\InputFilter\InputFilter
;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("abstractLink")
 */
class AbstractLink extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Title
        , \Db\Entity\Field\Url
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\TypeDescriminator
        ;

    /** Hydrator functions */
    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'url' => $this->getUrl(),
            'note' => $this->getNote(),
            'typeDescriminator' => $this->getTypeDescriminator(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setTitle(isset($data['title']) ? $data['title']: null);
        $this->setUrl(isset($data['url']) ? $data['url']: null);
        $this->setNote(isset($data['note']) ? $data['note']: null);
    }

    public function getInputFilter() {
        $inputFilter = new InputFilter();

        $inputFilter->add($this->inputFilterInputTitle($inputFilter));
        $inputFilter->add($this->inputFilterInputUrl($inputFilter));
        $inputFilter->add($this->inputFilterInputNote($inputFilter));

        return $inputFilter;
    }

}
