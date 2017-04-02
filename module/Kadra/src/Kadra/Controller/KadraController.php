<?php

namespace Kadra\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Kadra\Model\Kadra;

class KadraController extends AbstractActionController {

    protected $kadraTable;

//akcja odpowiedzialna za wyświetlenie listy zespołów
    public function listaAction() {
        $this->sesja();
        $kadry = $this->Tabela()->wszystko(null);

        return new ViewModel(array(
            'kadry' => $kadry));
    }

//akcja odpowiedzialna za dodanie nowego zespołu
    public function dodajAction() {
        $this->sesja();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if (empty($_POST['Nazwa_zespolu'])) {
                echo '<div class="alert alert-danger">Nie podałeś nazwy zespołu</div>';
                return new ViewModel();
            }
            $czy_jest_klub = $this->Tabela()->wszystko(array('nazwa_zespolu' => $_POST['Nazwa_zespolu']));
            $zlicz = $czy_jest_klub->count();
            if ($zlicz > 0) {
                echo '<div class="alert alert-danger">Podany zespół już jest w bazie</div>';
                return new ViewModel();
            } else {
                $data = array(
                    'id_zespol' => "",
                    'nazwa_zespolu' => addslashes(htmlspecialchars($_POST['Nazwa_zespolu'])),
                );
                $kadra = new Kadra();
                $kadra->exchangeArray($data);
                $this->Tabela()->dodaj($kadra);
                return $this->redirect()->toRoute('kadra');
            }
        }
        return new ViewModel();
    }

//akcja odpowiedzialna za edytowanie wybranego zespołu
    public function edytujAction() {
        $this->sesja();

        $id = $this->params('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('kadra');
        }
        $id_array = explode(',', $id);

        foreach ($id_array as $id) {

            $request = $this->getRequest();

            if (!$request->isPost()) {
                $kadry = $this->Tabela()->wszystko(array('id_zespol' => $id));

                if ($kadry->Count() == 0) {
                    return $this->redirect()->toRoute('kadra');
                }
                $edytuj_kadra = new Kadra();

                foreach ($kadry as $kadra) {
                    $edytuj_kadra->exchangeArray(
                            array(
                                'id_zespol' => $kadra->id_zespol,
                                'nazwa_zespolu' => $kadra->nazwa_zespolu,
                            )
                    );
                }
                return new ViewModel(array('kadra' => $edytuj_kadra,));
            } else {
                $data = array(
                    'id_zespol' => $id,
                    'nazwa_zespolu' => addslashes(htmlspecialchars($_POST['Nazwa_zespolu'])),
                );
                $czy_zmieniono = $this->Tabela()->wszystko(array('nazwa_zespolu' => $_POST['Nazwa_zespolu']));
                $zlicz = $czy_zmieniono->count();
                if ($zlicz > 0 || empty($_POST['Nazwa_zespolu'])) {
                    return $this->redirect()->toRoute('kadra', array('action' => "edytuj", 'id' => $id));
                } else {
                    $kadra = new Kadra();
                    $kadra->exchangeArray($data);
                    $this->Tabela()->edytuj($kadra, $id);
                    return $this->redirect()->toRoute('kadra');
                }
            }
        }

        return new ViewModel();
    }

//akcja odpowiedzialna za usunięcie wybranego zespołu
    public function usunAction() {

        $id = $this->params('id', 0);

        $id_array = explode(',', $id);

        foreach ($id_array as $id) {
            $kadry = $this->Tabela()->wszystko(array('id_zespol' => $id));

            $this->Tabela()->usun($id);
        }
        return $this->redirect()->toRoute('kadra');
    }

//funkcja dostępu do tabeli z zespołami
    public function Tabela() {
        if (!$this->KadraTable) {
            $sm = $this->getServiceLocator();
            $this->KadraTable = $sm->get('Kadra\Model\KadraTable');
        }

        return $this->KadraTable;
    }

//funkcja sesja potrzebna do operacji w danym kontrolerze
    private function sesja() {
        session_start();
    }

}
