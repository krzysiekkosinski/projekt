<?php

namespace Kadra\Model;

use Zend\Db\TableGateway\TableGateway;

class KadraTable {

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

    public function dodaj(Kadra $kadra) {
        $data = array(
            'id_zespol' => $kadra->id_zespol,
            'nazwa_zespolu' => $kadra->nazwa_zespolu,
        );

        $this->tableGateway->insert($data);
    }

    public function edytuj(Kadra $kadra, $id_zespol) {
        $data = array(
            'id_zespol' => $kadra->id_zespol,
            'nazwa_zespolu' => $kadra->nazwa_zespolu,
        );

        $id = (int) $data['id_zespol'];
        if ($this->wszystko(array('id_zespol' => $id_zespol))->Count()) {
            $this->tableGateway->update($data, array('id_zespol' => $id_zespol));
        } else {
            throw new \Exception('Zespół o tym id nie istnieje');
        }
    }

    public function usun($id_zespol) {
        $this->tableGateway->delete(array('id_zespol' => (int) $id_zespol));
    }

//funkcja zwracająca nazwę zespołu
    public function nazwa_zespolu($id_zespol) {
        return $this->tableGateway->select(array('id_zespol' => (int) $id_zespol))->current()->nazwa_zespolu;
    }

}
