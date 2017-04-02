<?php

namespace Sprawozdanie\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Sprawozdanie\Model\Sprawozdanie;
use Mecz\Model\Mecz;
use Kadra\Model\Kadra;
use Application\Model\Uzytkownik;

class SprawozdanieController extends AbstractActionController {

    protected $sprawozdanieTable;
    protected $meczTable;
    protected $kadraTable;
    protected $uzytkownikTable;

 //akcja odpowiedzialna za wyświetlenie listy sprawozdań   
    public function listaAction() {
        $this->sesja();
        $mecze = $this->MeczTable()->wszystko(array('sedzia_glowny' => $_SESSION['id'], 'protokol' => 'nie'));
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

//akcja odpowiedzialna za podgląd gotowych sprawozdań dla sędziego
    public function podgladsAction() {
        $this->sesja();

        $mecze_s_glowny = $this->MeczTable()->wszystko(array('sedzia_glowny' => $_SESSION['id'], 'protokol' => 'tak'));

        $mecz_array_s_glowny = array();

        foreach ($mecze_s_glowny as $mecz) {
            $mecz->gospodarze = $this->KadraTable()->nazwa_zespolu($mecz->gospodarze);
            $mecz->goscie = $this->KadraTable()->nazwa_zespolu($mecz->goscie);
            $mecz->sedzia_glowny = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_glowny);
            $mecz->sedzia_liniowy_1 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_1);
            $mecz->sedzia_liniowy_2 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_2);
            $mecz_array_s_glowny[] = $mecz;
        }

        $mecze_s_liniowy_1 = $this->MeczTable()->wszystko(array('sedzia_liniowy_1' => $_SESSION['id'], 'protokol' => 'tak'));

        $mecz_array_s_liniowy_1 = array();

        foreach ($mecze_s_liniowy_1 as $mecz) {
            $mecz->gospodarze = $this->KadraTable()->nazwa_zespolu($mecz->gospodarze);
            $mecz->goscie = $this->KadraTable()->nazwa_zespolu($mecz->goscie);
            $mecz->sedzia_glowny = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_glowny);
            $mecz->sedzia_liniowy_1 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_1);
            $mecz->sedzia_liniowy_2 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_2);
            $mecz_array_s_liniowy_1[] = $mecz;
        }

        $mecze_s_liniowy_2 = $this->MeczTable()->wszystko(array('sedzia_liniowy_2' => $_SESSION['id'], 'protokol' => 'tak'));

        $mecz_array_s_liniowy_2 = array();

        foreach ($mecze_s_liniowy_2 as $mecz) {
            $mecz->gospodarze = $this->KadraTable()->nazwa_zespolu($mecz->gospodarze);
            $mecz->goscie = $this->KadraTable()->nazwa_zespolu($mecz->goscie);
            $mecz->sedzia_glowny = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_glowny);
            $mecz->sedzia_liniowy_1 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_1);
            $mecz->sedzia_liniowy_2 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_2);
            $mecz_array_s_liniowy_2[] = $mecz;
        }
        $mecz_array = array_merge($mecz_array_s_glowny, $mecz_array_s_liniowy_1, $mecz_array_s_liniowy_2);
        return new ViewModel(array(
            'mecze' => $mecz_array));
    }

//akcja odpowiedzialna za podgląd gotowych sprawozdań dla administratora
    public function podgladaAction() {
        $this->sesja();
        $mecze = $this->MeczTable()->wszystko(array('protokol' => 'tak'));

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
            'mecze' => $mecz_array,
            'xxx' => $mecze->Count()));
    }

//akcja odpowiedzialna za podgląd gotowych sprawozdań dla działacza
    public function podgladdAction() {
        $this->sesja();
        $mecze_gospodarz = $this->MeczTable()->wszystko(array('gospodarze' => $_SESSION['id_zespol'], 'protokol' => 'tak'));
        $mecz_gospodarz_array = array();

        foreach ($mecze_gospodarz as $mecz) {
            $mecz->gospodarze = $this->KadraTable()->nazwa_zespolu($mecz->gospodarze);
            $mecz->goscie = $this->KadraTable()->nazwa_zespolu($mecz->goscie);
            $mecz->sedzia_glowny = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_glowny);
            $mecz->sedzia_liniowy_1 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_1);
            $mecz->sedzia_liniowy_2 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_2);
            $mecz_gospodarz_array[] = $mecz;
        }


        $mecze_gosc = $this->MeczTable()->wszystko(array('goscie' => $_SESSION['id_zespol'], 'protokol' => 'tak'));

        $mecz_gosc_array = array();

        foreach ($mecze_gosc as $mecz) {
            $mecz->gospodarze = $this->KadraTable()->nazwa_zespolu($mecz->gospodarze);
            $mecz->goscie = $this->KadraTable()->nazwa_zespolu($mecz->goscie);
            $mecz->sedzia_glowny = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_glowny);
            $mecz->sedzia_liniowy_1 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_1);
            $mecz->sedzia_liniowy_2 = $this->UzytkownikTable()->dane_sedziego($mecz->sedzia_liniowy_2);
            $mecz_gosc_array[] = $mecz;
        }
        $mecz_array = array_merge($mecz_gospodarz_array, $mecz_gosc_array);


        return new ViewModel(array(
            'mecze' => $mecz_array));
    }

//akcja odpowiedzialna za dodanie nowego sprawozdania
    public function dodajAction() {
        $this->sesja();

        $id = $this->params('id', 0);
        if (($this->Tabela()->wszystko(array('id_mecz' => $id))->Count()) > 0) {
            return $this->redirect()->toRoute('sprawozdanie');
        } else {
            if (!$id) {
                return $this->redirect()->toRoute('sprawozdanie');
            }
            $id_array = explode(',', $id);

            foreach ($id_array as $id) {

                $request = $this->getRequest();

                if (!$request->isPost()) {
                    $mecze = $this->MeczTable()->wszystko(array('id_mecz' => $id));
                    $kluby = $this->KadraTable()->wszystko(null);
                    $uzytkownicy = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
                    $gospodarz = $this->KadraTable()->wszystko(null);
                    $gosc = $this->KadraTable()->wszystko(null);
                    $sedzia_glowny = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
                    $sedzia_liniowy_1 = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
                    $sedzia_liniowy_2 = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));

                    if ($mecze->Count() == 0) {
                        return $this->redirect()->toRoute('mecz');
                    }
                    $dane = new Mecz();

                    foreach ($mecze as $mecz) {
                        $dane->exchangeArray(
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


                    return new ViewModel(array('mecz' => $dane, 'gospodarz' => $gospodarz, 'gosc' => $gosc, 'sedzia' => $sedzia_glowny, 'sedzia1' => $sedzia_liniowy_1, 'sedzia2' => $sedzia_liniowy_2));
                }

                $wyn1 = addslashes(htmlspecialchars($_POST['Wynik1']));
                $wyn2 = addslashes(htmlspecialchars($_POST['Wynik2']));
                $wynik = $wyn1 . ' : ' . $wyn2;


                $data = array(
                    'id_sprawozdanie' => "",
                    'id_mecz' => $id,
                    'wynik' => $wynik,
                    'bramki' => addslashes(htmlspecialchars($_POST['Bramki'])),
                    'sklad_gospodarze' => addslashes(htmlspecialchars($_POST['Sklad_gospodarze'])),
                    'sklad_goscie' => addslashes(htmlspecialchars($_POST['Sklad_goscie'])),
                    'zolta_kartka' => addslashes(htmlspecialchars($_POST['Zolta_kartka'])),
                    'czerwona_kartka' => addslashes(htmlspecialchars($_POST['Czerwona_kartka'])),
                    'dodatkowe_informacje' => addslashes(htmlspecialchars($_POST['Info'])),
                );

                $sprawozdanie = new Sprawozdanie();
                $sprawozdanie->exchangeArray($data);
                $this->Tabela()->dodaj($sprawozdanie);
                $this->MeczTable()->sprawko($id);
                return $this->redirect()->toRoute('sprawozdanie');
            }
        }
    }

//akcja odpowiedzialna za wyświetlenie sprawozdania
    public function wyswietlAction() {
        $this->sesja();

        $id = $this->params('id', 0);
        if ($id == 0) {
            if ($_SESSION['funkcja'] == 'admin')
                return $this->redirect()->toRoute('podglada');
            else if ($_SESSION['funkcja'] == 'dzialacz')
                return $this->redirect()->toRoute('podgladd');
            else
                return $this->redirect()->toRoute('podglads');
        }

        $id = $this->params('id', 0);
        $id_array = explode(',', $id);

        foreach ($id_array as $id) {

            $request = $this->getRequest();
            if (!$request->isPost()) {
                $mecze = $this->MeczTable()->wszystko(array('id_mecz' => $id));
                $kluby = $this->KadraTable()->wszystko(null);
                $sprawozdania = $this->Tabela()->wszystko(array('id_mecz' => $id));
                $uzytkownicy = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
                $gospodarz = $this->KadraTable()->wszystko(null);
                $gosc = $this->KadraTable()->wszystko(null);
                $sedzia_glowny = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
                $sedzia_liniowy_1 = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));
                $sedzia_liniowy_2 = $this->UzytkownikTable()->wszystko(array('u_funkcja' => 'sedzia'));


                $dane = new Mecz();

                foreach ($mecze as $mecz) {
                    $dane->exchangeArray(
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

                $dane_spr = new Sprawozdanie();
                foreach ($sprawozdania as $sprawozdanie) {
                    $dane_spr->exchangeArray(
                            array(
                                'id_mecz' => $sprawozdanie->id_mecz,
                                'wynik' => $sprawozdanie->wynik,
                                'bramki' => $sprawozdanie->bramki,
                                'sklad_gospodarze' => $sprawozdanie->sklad_gospodarze,
                                'sklad_goscie' => $sprawozdanie->sklad_goscie,
                                'zolta_kartka' => $sprawozdanie->zolta_kartka,
                                'czerwona_kartka' => $sprawozdanie->czerwona_kartka,
                                'dodatkowe_informacje' => $sprawozdanie->dodatkowe_informacje,
                            )
                    );
                }

                return new ViewModel(array('mecz' => $dane, 'gospodarz' => $gospodarz, 'gosc' => $gosc, 'sedzia' => $sedzia_glowny, 'sedzia1' => $sedzia_liniowy_1, 'sedzia2' => $sedzia_liniowy_2, 'sprawozdanie' => $dane_spr));
            }
        }
    }

//funkcja sesja potrzebna do operacji w danym kontrolerze
    private function sesja() {
        session_start();
        if (!isset($_SESSION['id'])) {
            $_SESSION['id'] = 0;
        }
    }

//funkcja dostępu do tabeli z sprawozdaniami
    public function Tabela() {
        if (!$this->SprawozdanieTable) {
            $sm = $this->getServiceLocator();
            $this->SprawozdanieTable = $sm->get('Sprawozdanie\Model\SprawozdanieTable');
        }

        return $this->SprawozdanieTable;
    }

//funkcja dostępu do tabeli z meczami
    public function MeczTable() {
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

}
