<?php

namespace Zawodnik\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Zawodnik {

    public $id_zawodnik;
    public $z_imie;
    public $z_nazwisko;
    public $z_data_ur;
    public $id_zespol;

    public function exchangeArray($data) {
        $this->id_zawodnik = (!empty($data['id_zawodnik'])) ? $data['id_zawodnik'] : null;
        $this->z_imie = (!empty($data['z_imie'])) ? $data['z_imie'] : null;
        $this->z_nazwisko = (!empty($data['z_nazwisko'])) ? $data['z_nazwisko'] : null;
        $this->z_data_ur = (!empty($data['z_data_ur'])) ? $data['z_data_ur'] : null;
        $this->id_zespol = (!empty($data['id_zespol'])) ? $data['id_zespol'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $inputFilter->add(array(
                'name' => 'id_zawodnik',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'z_imie',
                'requird' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 50,
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

            $inputFilter->add(array(
                'name' => 'z_nazwisko',
                'requird' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 50,
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

            $inputFilter->add(array(
                'name' => 'z_data_ur',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'DateTimeFormatter',
                    ),
                ),
            ));


            $inputFilter->add(array(
                'name' => 'id_zespol',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));



            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
