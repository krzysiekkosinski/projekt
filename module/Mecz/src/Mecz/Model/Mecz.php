<?php

namespace Mecz\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Mecz {

    public $id_mecz;
    public $data;
    public $godzina;
    public $miejsce;
    public $gospodarze;
    public $goscie;
    public $sedzia_glowny;
    public $sedzia_liniowy_1;
    public $sedzia_liniowy_2;
    public $id_sprawozdanie;
    public $protokol;

    public function exchangeArray($data) {
        $this->id_mecz = (!empty($data['id_mecz'])) ? $data['id_mecz'] : null;
        $this->data = (!empty($data['data'])) ? $data['data'] : null;
        $this->godzina = (!empty($data['godzina'])) ? $data['godzina'] : null;
        $this->miejsce = (!empty($data['miejsce'])) ? $data['miejsce'] : null;
        $this->gospodarze = (!empty($data['gospodarze'])) ? $data['gospodarze'] : null;
        $this->goscie = (!empty($data['goscie'])) ? $data['goscie'] : null;
        $this->sedzia_glowny = (!empty($data['sedzia_glowny'])) ? $data['sedzia_glowny'] : null;
        $this->sedzia_liniowy_1 = (!empty($data['sedzia_liniowy_1'])) ? $data['sedzia_liniowy_1'] : null;
        $this->sedzia_liniowy_2 = (!empty($data['sedzia_liniowy_2'])) ? $data['sedzia_liniowy_2'] : null;
        $this->id_sprawozdanie = (!empty($data['id_sprawozdanie'])) ? $data['id_sprawozdanie'] : null;
        $this->protokol = (!empty($data['protokol'])) ? $data['protokol'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
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
                'name' => 'data',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'DateTimeFormatter',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'godzina',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'DateTimeFormatter',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'miejsce',
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
                'name' => 'gospodarze',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'goscie',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'sedzia_glowny',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'sedzia_liniowy_1',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'sedzia_liniowy_2',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));
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
                'name' => 'protokol',
                'requird' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 3,
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
