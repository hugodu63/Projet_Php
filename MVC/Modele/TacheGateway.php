<?php

require_once 'Tache.php';

class TacheGateway
{
    private $connect;


    public function __construct($con)
    {
        $this->connect = $con;
    }

    public    function insertTache(Tache $tache)
    {
        $query = "INSERT INTO tache VALUES(:IdT,:Nom,:Texte,:DateFin,:IdL,:Checked)";
        $this->connect->executeQuery($query, array(
            ":IdT" => array($tache->getIdT(), PDO::PARAM_STR),
            ":Nom" => array($tache->getNom(), PDO::PARAM_STR),
            ":Texte" => array($tache->getTexte(), PDO::PARAM_STR),
            ":DateFin" => array($tache->getDateFin(), PDO::PARAM_STR),
            ":IdL" => array($tache->getIdL(), PDO::PARAM_STR),
            ":Checked" => array($tache->getChecked(), PDO::PARAM_STR)
        ));
    }
    public    function updateChecked(Tache $tache, int $Checked)
    {
        $query = "update tache set checked=:Checked where IdT=:IdT";
        $this->connect->executeQuery($query, array(
            ":IdT" => array($tache->getIdT(), PDO::PARAM_STR),
            ":Checked" => array($Checked, PDO::PARAM_STR)
        ));
    }

    public function suppTache(Tache $tache)
    {
        $query = "DELETE FROM Tache where IdT=:IdT";
        $this->connect->executeQuery($query, array(
            ":IdT" => array($tache->getIdT(), PDO::PARAM_STR)
        ));
    }

    public function findById($IdT): array
    {

        $query = "SELECT * FROM tache WHERE IdT=:IdT";
        $this->connect->executeQuery($query, array(
            ":IdT" => array($IdT, PDO::PARAM_STR)
        ));
        $results = $this->connect->getResults();
        foreach ($results as $row) {
            $tabTache[] = new Tache($row["IdT"], $row["Nom"], $row["Texte"], $row["DateFin"], $row["IdL"], $row["Checked"]);
        }
        return $tabTache;
    }

    public function findAll(): array
    {

        $query = "SELECT * FROM tache";
        $this->connect->executeQuery($query, array());
        $results = $this->connect->getResults();
        foreach ($results as $row) {
            $tabTache[] = new Tache($row["IdT"], $row["Nom"], $row["Texte"], $row["DateFin"], $row["IdL"], $row["Checked"]);
        }
        return $tabTache;
    }

    public function findByIdL($IdL): array
    {

        $query = "SELECT * FROM tache WHERE IdL=:IdL";
        $this->connect->executeQuery($query, array(
            ":IdL" => array($IdL, PDO::PARAM_STR)
        ));
        $results = $this->connect->getResults();
        $tabTache = array();
        foreach ($results as $row) {
            $tabTache[] = new Tache($row["IdT"], $row["Nom"], $row["Texte"], $row["DateFin"], $row["IdL"], $row["Checked"]);
        }
        return $tabTache;
    }
}
