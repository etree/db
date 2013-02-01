<?php
namespace Db\Entity;

use Db\Entity\AbstractEntity;
use Zend\Form\Annotation as Form;

/**
 * @Form\Hydrator("Zend\Stdlib\Hydrator\ObjectProperty")
 * @Form\Name("showSong")
 */
class PerformanceSong extends AbstractEntity {
    use \Db\Entity\Field\Id
        , \Db\Entity\Field\Song
        , \Db\Entity\Field\PerformanceSet
        , \Db\Entity\Field\Note
        , \Db\Entity\Field\IsSegue
        , \Db\Entity\Field\Sort
        ;

    public function getArrayCopy()
    {
        return array(
            'id' => $this->getId(),
            'performanceSet' => $this->getPerformanceSet(),
            'note' => $this->getNote(),
            'isSegue' => $this->getIsSegue(),
            'sort' => $this->getSort(),
        );
    }

    public function exchangeArray($data)
    {
        $this->setNote(isset($data['note']) ? $data['note']: null);
        $this->setIsSegue(isset($data['isSegue']) ? $data['isSegue']: null);
        $this->setSort(isset($data['sort']) ? $data['sort']: null);
    }
}