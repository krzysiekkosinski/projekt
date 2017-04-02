<?php

namespace Kadra\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Kadra {

    public $id_zespol;
    public $nazwa_zespolu;

    public function exchangeArray($data) {
        $this->id_zespol = (!empty($data['id_zespol'])) ? $data['id_zespol'] : null;
        $this->nazwa_zespolu = (!empty($data['nazwa_zespolu'])) ? $data['nazwa_zespolu'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $inputFilter->add(array(
                'name' => 'id_zespol',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'nazwa_zespolu',
                'requird' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
                'filtres' => array(
                    array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                ),
            ));




            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
