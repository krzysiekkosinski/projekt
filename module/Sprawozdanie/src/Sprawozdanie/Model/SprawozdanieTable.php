<?php

namespace Sprawozdanie\Model;

use Zend\Db\TableGateway\TableGateway;

class SprawozdanieTable {

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

    public function dodaj(Sprawozdanie $sprawozdanie) {
        $data = array(
            'id_sprawozdanie' => $sprawozdanie->id_sprawozdanie,
            'id_mecz' => $sprawozdanie->id_mecz,
            'wynik' => $sprawozdanie->wynik,
            'bramki' => $sprawozdanie->bramki,
            'sklad_gospodarze' => $sprawozdanie->sklad_gospodarze,
            'sklad_goscie' => $sprawozdanie->sklad_goscie,
            'zolta_kartka' => $sprawozdanie->zolta_kartka,
            'czerwona_kartka' => $sprawozdanie->czerwona_kartka,
            'dodatkowe_informacje' => $sprawozdanie->dodatkowe_informacje,
        );

        $this->tableGateway->insert($data);
    }

    public function edytuj(Sprawozdanie $sprawozdanie, $id_sprawozdanie) {
        $data = array(
            'id_sprawozdanie' => $sprawozdanie->id_sprawozdanie,
            'id_mecz' => $sprawozdanie->id_mecz,
            'wynik' => $sprawozdanie->wynik,
            'bramki' => $sprawozdanie->bramki,
            'sklad_gospodarze' => $sprawozdanie->sklad_gospodarze,
            'sklad_goscie' => $sprawozdanie->sklad_goscie,
            'zolta_kartka' => $sprawozdanie->zolta_kartka,
            'czerwona_kartka' => $sprawozdanie->czerwona_kartka,
            'dodatkowe_informacje' => $sprawozdanie->dodatkowe_informacje,
        );

        $id = (int) $data['id_sprawozdanie'];
        if ($this->wszystko(array('id_sprawozdanie' => $id_sprawozdanie))->Count()) {
            $this->tableGateway->update($data, array('id_sprawozdanie' => $id_sprawozdanie));
        } else {
            throw new \Exception('Sprawozdanie o tym id nie istnieje');
        }
    }

    public function usun($id_sprawozdanie) {
        $this->tableGateway->delete(array('id_sprawozdanie' => (int) $id_sprawozdanie));
    }

//funkcja zwracająca nazwę zespołu
    public function nazwa_zespolu($id_zespol) {
        return $this->tableGateway->select(array('id_zespol' => (int) $id_zespol))->current()->nazwa_zespolu;
    }

}
