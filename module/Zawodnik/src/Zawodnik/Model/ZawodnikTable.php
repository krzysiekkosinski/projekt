<?php

namespace Zawodnik\Model;

use Zend\Db\TableGateway\TableGateway;

class ZawodnikTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function zlicz() {
        return $this->tableGateway->select()->count();
    }

    public function wszystko($tablica = array()) {
        $wynik = $this->tableGateway->select($tablica);
        return $wynik;
    }

//funkcja zwracająca zawodników z danego klubu
    public function listadzialacza($tablica = array()) {
        $wynik = $this->tableGateway->select($tablica);
        return $wynik;
    }

    public function dodaj(Zawodnik $zawodnik) {

        $data = array(
            'id_zawodnik' => $zawodnik->id_zawodnik,
            'z_imie' => $zawodnik->z_imie,
            'z_nazwisko' => $zawodnik->z_nazwisko,
            'z_data_ur' => $zawodnik->z_data_ur,
            'id_zespol' => $zawodnik->id_zespol,
        );

        $this->tableGateway->insert($data);
    }

    public function edytuj(Zawodnik $zawodnik, $id_zawodnik) {
        $data = array(
            'id_zawodnik' => $zawodnik->id_zawodnik,
            'z_imie' => $zawodnik->z_imie,
            'z_nazwisko' => $zawodnik->z_nazwisko,
            'z_data_ur' => $zawodnik->z_data_ur,
            'id_zespol' => $zawodnik->id_zespol,
        );

        $id = (int) $data['id_zawodnik'];
        if ($this->wszystko(array('id_zawodnik' => $id_zawodnik))->Count()) {
            $this->tableGateway->update($data, array('id_zawodnik' => $id_zawodnik));
        } else {
            throw new \Exception('Osoba o tym id nie istnieje');
        }
    }

    public function usun($id_zawodnik) {
        $this->tableGateway->delete(array('id_zawodnik' => (int) $id_zawodnik));
    }

}
