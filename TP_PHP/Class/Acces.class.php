<?php
/**
 *
 */
class Acces
{
    private $login;
    private $password;
    private $prenom;
    private $statut;
    private $age;

    function __construct($login, $password, $prenom, $statut, $age)
    {
        $this->login = $login;
        $this->password = $password;
        $this->prenom = $prenom;
        $this->statut = $statut;
        $this->age = $age;
    }

    public function getLogin() {
        return $this->login;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getPrenom() {
        return $this->prenom;
    }
    public function getStatut() {
        return $this->statut;
    }
    public function getAge() {
        return $this->age;
    }
    public function setLogin($login) {
        return $this->login = $login;
    }
    public function setPassword($password) {
        return $this->password = $password;
    }
    public function setPrenom($prenom) {
        return $this->prenom = $prenom;
    }
    public function setStatut($statut) {
        return $this->statut = $statut;
    }
    public function setAge($age) {
        return $this->age = $age;
    }
}

?>
