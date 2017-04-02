<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;

class UzytkownikTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function zlicz($tablica = array()) {
        return $this->tableGateway->select($tablica)->count();
    }

    public function wszystko($tablica = array()) {
        $wynik = $this->tableGateway->select($tablica);
        return $wynik;
    }

    public function id_klub($id_uzytkownik) {
        return $this->tableGateway->select(array('id_zespol' => (int) $id_zespol));
    }

    public function dodaj(Uzytkownik $uzytkownik) {
        $data = array(
            'id_uzytkownik' => $uzytkownik->id_uzytkownik,
            'u_imie' => $uzytkownik->u_imie,
            'u_nazwisko' => $uzytkownik->u_nazwisko,
            'u_funkcja' => $uzytkownik->u_funkcja,
            'id_zespol' => $uzytkownik->id_zespol,
            'u_login' => $uzytkownik->u_login,
            'u_haslo' => $uzytkownik->u_haslo,
            'u_mail' => $uzytkownik->u_mail,
        );

        $this->tableGateway->insert($data);
    }

    public function edytuj(Uzytkownik $uzytkownik, $id_uzytkownik) {
        $data = array(
            'id_uzytkownik' => $uzytkownik->id_uzytkownik,
            'u_imie' => $uzytkownik->u_imie,
            'u_nazwisko' => $uzytkownik->u_nazwisko,
            'u_funkcja' => $uzytkownik->u_funkcja,
            'id_zespol' => $uzytkownik->id_zespol,
            'u_login' => $uzytkownik->u_login,
            'u_haslo' => $uzytkownik->u_haslo,
            'u_mail' => $uzytkownik->u_mail,
        );



        $id = (int) $data['id_uzytkownik'];
        if ($this->wszystko(array('id_uzytkownik' => $id_uzytkownik))->Count()) {
            $this->tableGateway->update($data, array('id_uzytkownik' => $id_uzytkownik));
        } else {
            throw new \Exception('Użytkownik o tym id nie istnieje');
        }
    }

    public function usun($id_uzytkownik) {
        $this->tableGateway->delete(array('id_uzytkownik' => (int) $id_uzytkownik));
    }
    
//funkcja zwracająca nazwisko i imię sędziego
    public function dane_sedziego($id_uzytkownik) {
        $nazwisko = $this->tableGateway->select(array('id_uzytkownik' => (int) $id_uzytkownik))->current()->u_nazwisko;
        $imie = $this->tableGateway->select(array('id_uzytkownik' => (int) $id_uzytkownik))->current()->u_imie;
        $nazwisko_imie = $nazwisko . ' ' . $imie;
        return $nazwisko_imie;
    }

}
