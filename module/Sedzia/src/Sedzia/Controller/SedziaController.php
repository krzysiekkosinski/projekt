<?php

namespace Sedzia\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Uzytkownik;

class SedziaController extends AbstractActionController {

    protected $uzytkownikTable;

//akcja odpowiedzialna za wyświetlenie listy sędziów
    public function listaAction() {
        $this->sesja();
        $sedziowie = $this->Tabela()->wszystko(array('u_funkcja' => 'sedzia'));


        return new ViewModel(array(
            'sedziowie' => $sedziowie));
    }

//funkcja dostępu do tabeli z użytkownikami
    public function Tabela() {
        if (!$this->UzytkownikTable) {
            $sm = $this->getServiceLocator();
            $this->UzytkownikTable = $sm->get('Application\Model\UzytkownikTable');
        }

        return $this->UzytkownikTable;
    }

//funkcja sesja potrzebna do operacji w danym kontrolerze   
    private function sesja() {
        session_start();
    }

}
