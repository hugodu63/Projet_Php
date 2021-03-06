<?php

require_once 'ListeTache.php';

class ListeTacheGateway
{
    private $connect;


    public function __construct($con)
    {
        $this->connect = $con;
    }

    public    function insertListe(ListeTache $listeTache)
    {
        $query = "INSERT INTO ListeTache VALUES(:IdL,:Nom,:privee,:mailU)";
        $this->connect->executeQuery($query, array(
            ":IdL" => array($listeTache->getIdL(), PDO::PARAM_STR),
            ":Nom" => array($listeTache->getNom(), PDO::PARAM_STR),
            ":privee" => array($listeTache->getPrivee(), PDO::PARAM_STR),
            ":mailU" => array($listeTache->getMailU(), PDO::PARAM_STR)
        ));
    }

    public function suppListe(ListeTache $listeTache)
    {
        $query = "DELETE FROM ListeTache where IdL=:IdL";
        $this->connect->executeQuery($query, array(
            ":IdL" => array($listeTache->getIdL(), PDO::PARAM_STR)
        ));
    }

    public function findById($IdL): array
    {

        $query = "SELECT * FROM ListeTache WHERE IdL=:IdL";
        $this->connect->executeQuery($query, array(
            ":IdL" => array($IdL, PDO::PARAM_STR)
        ));
        $results = $this->connect->getResults();
        foreach ($results as $row) {
            $tabListeTache[] = new ListeTache($row["IdL"], $row["Nom"], $row["privee"], $row["mailU"]);
        }
        return $tabListeTache;
    }

    public function findAll(): array
    {

        $query = "SELECT * FROM ListeTache";
        $this->connect->executeQuery($query, array());
        $results = $this->connect->getResults();
        $tabListeTache = array();
        foreach ($results as $row) {
            $tabListeTache[] = new ListeTache($row["IdL"], $row["Nom"], $row["privee"], $row["mailU"]);
        }
        return $tabListeTache;
    }
}
