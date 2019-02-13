<?php
require_once('./Class/Acces.class.php');
require_once('./Class/Connexion.DAO.php');

/**
 *
 */
class AccesControler
{
    public static function connectionDataAreValid($login, $password) {
        $bdd = new connexion();
        $acces = $bdd->getAccesByLoginAndPassword($login, $password);
        if ($acces) {
            return $acces;
        } else {
            return false;
        }
    }

    public static function deleteUser($id) {
        $bdd = new connexion();
        $request = $bdd->deleteAcces($id);
        $bdd->destruct();
        return $request;
    }

    public static function insertAcces($acces) {
        $bdd = new connexion();
        $bdd->insertAcces($acces->getLogin(), $acces->getPassword(), $acces->getPrenom(), $acces->getStatut(), $acces->getAge());
        $bdd->destruct();
    }

    public static function getAllStatut() {
        $bdd = new connexion();
        $statuts = $bdd->getAllStatut();
        $bdd->destruct();
        return $statuts;
    }

    public static function getAccesById($id)
    {
        $bdd = new connexion();
        $result = $bdd->getAccesById($id);
        $acces = new Acces($result[0]['login'], $result[0]['password'], $result[0]['prenom'], $result[0]['statut'], $result[0]['age']);
        $bdd->destruct();
        return $acces;
    }

    public static function updateAcces($acces, $id) {
        $bdd = new connexion();
        $bdd->updateAcces($acces->getLogin(), $acces->getPassword(), $acces->getPrenom(), $acces->getStatut(), $acces->getAge(), $id);
        $bdd->destruct();
    }

    public static function getAllAcces() {
        $bdd = new connexion();
        $acces = $bdd->getAllAcces();
        $bdd->destruct();
        return $acces;
    }

    public static function research($prenom=null, $statut=null, $ageDebut=null, $ageFin=null) {
        $parameters = [];
        $bdd = new connexion();
        if ($prenom != null) {
            $parameters['prenom'] = $prenom;
        } else {
            $parameters['prenom'] = '';
        }

        if ($statut != null) {
            $parameters['statut'] = $statut;
        } else {
            $parameters['statut'] = '';
        }

        if ($ageDebut != null) {
            $parameters['ageDebut'] = $ageDebut;
        } else {
            $parameters['ageDebut'] = '';
        }

        if ($ageFin != null) {
            $parameters['ageFin'] = $ageFin;
        } else {
            $parameters['ageFin'] = '';
        }
        $acces = $bdd->getAccesByParameters($parameters);
        $bdd->destruct();
        return $acces;
    }
}
?>
