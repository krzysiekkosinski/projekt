<?php

namespace Mecz\Model;

use Zend\Db\TableGateway\TableGateway;

class MeczTable {

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

    public function dodaj(Mecz $mecz) {
        $data = array(
            'id_mecz' => $mecz->id_mecz,
            'data' => $mecz->data,
            'godzina' => $mecz->godzina,
            'miejsce' => $mecz->miejsce,
            'gospodarze' => $mecz->gospodarze,
            'goscie' => $mecz->goscie,
            'sedzia_glowny' => $mecz->sedzia_glowny,
            'sedzia_liniowy_1' => $mecz->sedzia_liniowy_1,
            'sedzia_liniowy_2' => $mecz->sedzia_liniowy_2,
            'protokol' => 'nie',
        );

        $this->tableGateway->insert($data);
    }

//funkcja sprawdzająca czy dany mecz ma już sprawozdanie
    public function sprawko($id_mecz) {
        $data = array(
            'protokol' => 'tak',
        );

        $this->tableGateway->update($data, array('id_mecz' => $id_mecz));
    }

    public function edytuj(Mecz $mecz, $id_mecz) {
        $data = array(
            'id_mecz' => $mecz->id_mecz,
            'data' => $mecz->data,
            'godzina' => $mecz->godzina,
            'miejsce' => $mecz->miejsce,
            'gospodarze' => $mecz->gospodarze,
            'goscie' => $mecz->goscie,
            'sedzia_glowny' => $mecz->sedzia_glowny,
            'sedzia_liniowy_1' => $mecz->sedzia_liniowy_1,
            'sedzia_liniowy_2' => $mecz->sedzia_liniowy_2,
            'protokol' => 'nie',
        );

        $id = (int) $data['id_mecz'];
        if ($this->wszystko(array('id_mecz' => $id_mecz))->Count()) {
            $this->tableGateway->update($data, array('id_mecz' => $id_mecz));
        } else {
            throw new \Exception('Termin o tym id nie istnieje');
        }
    }

    public function usun($id_mecz) {
        $this->tableGateway->delete(array('id_mecz' => (int) $id_mecz));
    }

//funkcja zwracająca nazwę zespołu
    public function nazwa_zespolu($id_zespol) {
        return $this->tableGateway->select(array('id_zespol' => (int) $id_zespol))->current()->nazwa_zespolu;
    }

}
