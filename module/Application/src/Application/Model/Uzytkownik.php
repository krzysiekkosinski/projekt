<?php

namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Uzytkownik {

    public $id_uzytkownik;
    public $u_imie;
    public $u_nazwisko;
    public $u_funkcja;
    public $id_zespol;
    public $u_login;
    public $u_haslo;
    public $u_mail;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->id_uzytkownik = (!empty($data['id_uzytkownik'])) ? $data['id_uzytkownik'] : null;
        $this->u_imie = (!empty($data['u_imie'])) ? $data['u_imie'] : null;
        $this->u_nazwisko = (!empty($data['u_nazwisko'])) ? $data['u_nazwisko'] : null;
        $this->u_funkcja = (!empty($data['u_funkcja'])) ? $data['u_funkcja'] : null;
        $this->id_zespol = (!empty($data['id_zespol'])) ? $data['id_zespol'] : null;
        $this->u_login = (!empty($data['u_login'])) ? $data['u_login'] : null;
        $this->u_haslo = (!empty($data['u_haslo'])) ? $data['u_haslo'] : null;
        $this->u_mail = (!empty($data['u_mail'])) ? $data['u_mail'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'id_uzytkownik',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'u_nazwisko',
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
                'name' => 'u_imie',
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
                'name' => 'u_funkcja',
                'requird' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 20,
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
                'name' => 'id_uzytkownik',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'u_mail',
                'requird' => true,
                'type' => 'Zend\Form\Element\Email',
                'filtres' => array(
                    array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                ),
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
            ));


            $inputFilter->add(array(
                'name' => 'u_login',
                'requird' => true,
                'filtres' => array(
                    array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                ),
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
            ));
            $inputFilter->add(array(
                'name' => 'u_haslo',
                'requird' => true,
                'filtres' => array(
                    array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 128,
                        ),
                    ),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
