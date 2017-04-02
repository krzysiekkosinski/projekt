<?php

namespace Mecz\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Mecz\Model\Mecz;
use Kadra\Model\Kadra;
use Application\Model\Uzytkownik;

class MeczController extends AbstractActionController {

    protected $meczTable;
    protected $kadraTable;
    protected $uzytkownikTable;

//akcja odpowiedzialna za wyświetlenie listy meczów
    public function listaAction() {
        $this->sesja();
        $mecze = $this->Tabela()->wszystko(null);

        $mecz_array = array();

        foreach ($mecze as $mecz) {
            $mecz->gospodarze = $this->KadraTable()->nazwa_zespolu($mecz->gospodarze);
            $mecz->goscie = $this->KadraTable()->nazwa_zespolu($mecz->goscie);
            $mecz->sedzia_glowny = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_glowny);
            $mecz->sedzia_liniowy_1 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_1);
            $mecz->sedzia_liniowy_2 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_2);
            $mecz_array[] = $mecz;
        }

        return new ViewModel(array(
            'mecze' => $mecz_array));
    }

//akcja odpowiedzialna za dodanie nowego spotkania   
    public function dodajAction() {
        $this->sesja();
        $request = $this->getRequest();
        $gospodarz = $this->KadraTable()->wszystko(null);
        $gosc = $this->KadraTable()->wszystko(null);
        $sedzia_glowny = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
        $sedzia_liniowy_1 = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
        $sedzia_liniowy_2 = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
        $mecze = $this->Tabela()->wszystko(null);
        if ($request->isPost()) {
            if (empty($_POST['Godzina']) || empty($_POST['Miejsce_spotkania']) || empty($_POST['Gospodarz']) || empty($_POST['Gosc']) || empty($_POST['Sedzia_glowny']) || empty($_POST['Sedzia_liniowy_1']) || empty($_POST['Sedzia_liniowy_2'])) {
                echo '<div class="alert alert-danger">Nie podano wszystkich danych</div>';
                return new ViewModel();
            } elseif ($_POST['Gosc'] == $_POST['Gospodarz']) {
                echo '<div class="alert alert-danger">Podano takie same zespoły</div>';
                return new ViewModel();
            } elseif (($_POST['Sedzia_glowny'] == $_POST['Sedzia_liniowy_1']) || ($_POST['Sedzia_glowny'] == $_POST['Sedzia_liniowy_2']) || ($_POST['Sedzia_liniowy_1'] == $_POST['Sedzia_liniowy_2'])) {
                echo '<div class="alert alert-danger">Błąd w doborze sędziów</div>';
                return new ViewModel();
            }
            $czy_jest_termin = $this->Tabela()->wszystko(array('data' => $_POST['Data'], 'godzina' => $_POST['Godzina'], 'miejsce' => $_POST['Miejsce_spotkania']));
            $zlicz = $czy_jest_termin->count();
            if ($zlicz > 0) {
                echo '<div class="alert alert-danger">Podany termin już jest</div>';
                return new ViewModel();
            } else {
                $data = array(
                    'id_mecz' => "",
                    'data' => addslashes(htmlspecialchars($_POST['Data'])),
                    'godzina' => addslashes(htmlspecialchars($_POST['Godzina'])),
                    'miejsce' => addslashes(htmlspecialchars($_POST['Miejsce_spotkania'])),
                    'gospodarze' => (int) $_POST['Gospodarz'],
                    'goscie' => (int) $_POST['Gosc'],
                    'sedzia_glowny' => (int) $_POST['Sedzia_glowny'],
                    'sedzia_liniowy_1' => (int) $_POST['Sedzia_liniowy_1'],
                    'sedzia_liniowy_2' => (int) $_POST['Sedzia_liniowy_2'],
                );
                $mecz = new Mecz();
                $mecz->exchangeArray($data);
                $this->Tabela()->dodaj($mecz);
                return $this->redirect()->toRoute('mecz');
            }
        }
        return new ViewModel(array('gospodarz' => $gospodarz, 'gosc' => $gosc, 'sedzia' => $sedzia_glowny, 'sedzia1' => $sedzia_liniowy_1, 'sedzia2' => $sedzia_liniowy_2));
    }

//akcja odpowiedzialna za edytowanie wybranego spotkania
    public function edytujAction() {
        $this->sesja();

        $id = $this->params('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('mecz');
        }
        $id_array = explode(',', $id);

        foreach ($id_array as $id) {

            $request = $this->getRequest();

            if (!$request->isPost()) {
                $mecze = $this->Tabela()->wszystko(array('id_mecz' => $id));
                $mecz_sprawozdanie = $this->Tabela()->wszystko(array('id_mecz' => $id, 'protokol' => 'tak'));
                $kluby = $this->KadraTable()->wszystko(null);
                $uzytkownicy = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
                $gospodarz = $this->KadraTable()->wszystko(null);
                $gosc = $this->KadraTable()->wszystko(null);
                $sedzia_glowny = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
                $sedzia_liniowy_1 = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
                $sedzia_liniowy_2 = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));

                if ($mecz_sprawozdanie->Count() == 1) {
                    return $this->redirect()->toRoute('mecz');
                }
                $edytuj_mecz = new Mecz();

                foreach ($mecze as $mecz) {
                    $edytuj_mecz->exchangeArray(
                            array(
                                'id_mecz' => $mecz->id_mecz,
                                'data' => $mecz->data,
                                'godzina' => $mecz->godzina,
                                'miejsce' => $mecz->miejsce,
                                'gospodarze' => $mecz->gospodarze,
                                'goscie' => $mecz->goscie,
                                'sedzia_glowny' => $mecz->sedzia_glowny,
                                'sedzia_liniowy_1' => $mecz->sedzia_liniowy_1,
                                'sedzia_liniowy_2' => $mecz->sedzia_liniowy_2,
                            )
                    );
                }
                return new ViewModel(array('mecz' => $edytuj_mecz, 'gospodarz' => $gospodarz, 'gosc' => $gosc, 'sedzia' => $sedzia_glowny, 'sedzia1' => $sedzia_liniowy_1, 'sedzia2' => $sedzia_liniowy_2));
            } else {
                $data = array(
                    'id_mecz' => $id,
                    'data' => addslashes(htmlspecialchars($_POST['Data'])),
                    'godzina' => addslashes(htmlspecialchars($_POST['Godzina'])),
                    'miejsce' => addslashes(htmlspecialchars($_POST['Miejsce_spotkania'])),
                    'gospodarze' => (int) $_POST['Gospodarz'],
                    'goscie' => (int) $_POST['Gosc'],
                    'sedzia_glowny' => (int) $_POST['Sedzia_glowny'],
                    'sedzia_liniowy_1' => (int) $_POST['Sedzia_liniowy_1'],
                    'sedzia_liniowy_2' => (int) $_POST['Sedzia_liniowy_2'],
                );
                $czy_jest_termin = $this->Tabela()->wszystko(array('data' => $_POST['Data'], 'godzina' => $_POST['Godzina'], 'miejsce' => $_POST['Miejsce_spotkania'], 'gospodarze' => (int) $_POST['Gospodarz'], 'goscie' => (int) $_POST['Gosc'], 'sedzia_glowny' => (int) $_POST['Sedzia_glowny'], 'sedzia_liniowy_1' => (int) $_POST['Sedzia_liniowy_1'], 'sedzia_liniowy_2' => (int) $_POST['Sedzia_liniowy_2']));
                $zlicz = $czy_jest_termin->count();
                if ($zlicz > 0 || $_POST['Gosc'] == $_POST['Gospodarz'] || empty($_POST['Miejsce_spotkania']) || ($_POST['Sedzia_glowny'] == $_POST['Sedzia_liniowy_1']) || ($_POST['Sedzia_glowny'] == $_POST['Sedzia_liniowy_2']) || ($_POST['Sedzia_liniowy_1'] == $_POST['Sedzia_liniowy_2'])) {
                    echo '<div class="alert alert-danger">Nie edytowałeś danych</div>';
                    return $this->redirect()->toRoute('mecz', array('action' => "edytuj", 'id' => $id));
                } else {
                    $mecz = new Mecz();
                    $mecz->exchangeArray($data);
                    $this->Tabela()->edytuj($mecz, $id);
                    return $this->redirect()->toRoute('mecz');
                }
            }
        }

        return new ViewModel();
    }

//akcja odpowiedzialna za usunięcie spotkania
    public function usunAction() {

        $id = $this->params('id', 0);
        if ($id == 0)
            return $this->redirect()->toRoute('mecz');
        $id_array = explode(',', $id);

        foreach ($id_array as $id) {
            $mecze = $this->Tabela()->wszystko(array('id_mecz' => $id));

            $this->Tabela()->usun($id);
        }
        return $this->redirect()->toRoute('mecz');
    }

//funkcja dostępu do tabeli z meczami
    public function Tabela() {
        if (!$this->MeczTable) {
            $sm = $this->getServiceLocator();
            $this->MeczTable = $sm->get('Mecz\Model\MeczTable');
        }

        return $this->MeczTable;
    }

//funkcja dostępu do tabeli z zespołami
    public function KadraTable() {
        if (!$this->KadraTable) {
            $sm = $this->getServiceLocator();
            $this->KadraTable = $sm->get('Kadra\Model\KadraTable');
        }

        return $this->KadraTable;
    }

//funkcja dostępu do tabeli z użytkownikami    
    public function UzytkownikTable() {
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
