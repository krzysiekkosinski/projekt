<?php

namespace Sprawozdanie\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Sprawozdanie {

    public $id_sprawozdanie;
    public $id_mecz;
    public $wynik;
    public $bramki;
    public $sklad_gospodarze;
    public $sklad_goscie;
    public $zolta_kartka;
    public $czerwona_kartka;
    public $dodatkowe_informacje;

    public function exchangeArray($data) {
        $this->id_sprawozdanie = (!empty($data['id_sprawozdanie'])) ? $data['id_sprawozdanie'] : null;
        $this->id_mecz = (!empty($data['id_mecz'])) ? $data['id_mecz'] : null;
        $this->wynik = (!empty($data['wynik'])) ? $data['wynik'] : null;
        $this->bramki = (!empty($data['bramki'])) ? $data['bramki'] : null;
        $this->sklad_gospodarze = (!empty($data['sklad_gospodarze'])) ? $data['sklad_gospodarze'] : null;
        $this->sklad_goscie = (!empty($data['sklad_goscie'])) ? $data['sklad_goscie'] : null;
        $this->zolta_kartka = (!empty($data['zolta_kartka'])) ? $data['zolta_kartka'] : null;
        $this->czerwona_kartka = (!empty($data['czerwona_kartka'])) ? $data['czerwona_kartka'] : null;
        $this->dodatkowe_informacje = (!empty($data['dodatkowe_informacje'])) ? $data['dodatkowe_informacje'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $inputFilter->add(array(
                'name' => 'id_sprawozdanie',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'id_mecz',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'wynik',
                'requird' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 10,
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
                'name' => 'bramki',
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

            $inputFilter->add(array(
                'name' => 'sklad_gospodarze',
                'requird' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 1000,
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
                'name' => 'sklad_goscie',
                'requird' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 1000,
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
                'name' => 'zolta_kartka',
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

            $inputFilter->add(array(
                'name' => 'czerwona_kartka',
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


            $inputFilter->add(array(
                'name' => 'dodatkowe_informacje',
                'requird' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 1000,
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
