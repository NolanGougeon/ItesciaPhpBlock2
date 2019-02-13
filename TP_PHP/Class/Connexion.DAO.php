<?php
class connexion{
    private $sgbd = 'mysql';
    private $host = 'localhost';
    private $dbname = 'tp_php';
    private $user = 'root';
    private $pass = '';

    public function __construct(){
        try{
            $this->db = new PDO($this->sgbd.':host='.$this->host.';dbname='.$this->dbname,$this->user,$this->pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);/* désactive les requêtes émulées - permet de typer les valeurs retournées */
        } catch(exception $e) {
            $this->destruct();
            return $e->getMessage();
        }
    }

    public function destruct() {
        $this->db  = null;
    }

    public function getAllAcces() {
        $requete = $this->db->prepare('SELECT * FROM acces');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAccesById($id) {
    $request = $this->db->prepare('SELECT * FROM acces where id=:id');
    $request->bindValue(':id', $id);
    $request->execute();
    return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAccesByParameters($parameters) {
        $requestString = 'SELECT * FROM acces';
        if ($parameters['prenom'] || $parameters['statut'] || $parameters['ageFin'] || $parameters['ageDebut']) {
            $requestString .= ' WHERE ';
            $notTheFisrtLoop = false;
            foreach ($parameters as $key => $value) {
                if ($value == '') {
                    continue;
                }
                if ($notTheFisrtLoop) {
                    $requestString .= ' and ';
                }
                if ($key != 'ageFin' && $key != 'ageDebut') {
                    $requestString .= $key.'="'.$value.'"';
                } else {
                    if ($key == 'ageDebut') {
                        $requestString .= 'age<='.$value;
                    }
                    if ($key == 'ageFin') {
                        $requestString .= 'age>='.$value;
                    }
                }
                $notTheFisrtLoop = true;
            }
        }
        $requete = $this->db->prepare($requestString);
        $requete->execute();
        $acces = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $acces;
    }

    public function getAccesByLoginAndPassword($login, $password) {
        $requete = $this->db->prepare('SELECT * FROM acces WHERE login=:login and password=:password');
        $requete->bindValue(':login', $login);
        $requete->bindValue(':password', $password);
        $requete->execute();
        $acces = $requete->fetchAll(PDO::FETCH_ASSOC);
        return $acces;
    }

    public function updateAcces($login, $password, $prenom, $statut, $age, $id) {
        $request = $this->db->prepare("UPDATE acces SET  prenom=:prenom, login=:login, password=:password, statut=:statut, age=:age WHERE id=:id");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->bindValue(':prenom', $prenom);
        $request->bindValue(':login', $login);
        $request->bindValue(':password', $password);
        $request->bindValue(':statut', $statut);
        $request->bindValue(':age', $age);
        $request->bindValue(':id', $id);
        $request->execute();
    }

    public function deleteAcces($id) {
        $request = $this->db->prepare('Delete FROM acces WHERE id=:id');
        $request->bindValue(':id', $_GET['id']);
        $request->execute();
        return $deleteUser = $request->setFetchMode(PDO::FETCH_ASSOC);
    }

    public function insertAcces($login, $password, $prenom, $statut, $age)
    {
        $request = $this->db->prepare("INSERT INTO acces (prenom,login,password,statut,age) VALUES (:prenom,:login,:password,:statut,:age)");
        $request->setFetchMode(PDO::FETCH_ASSOC);
        $request->bindValue(':prenom', $prenom);
        $request->bindValue(':login', $login);
        $request->bindValue(':password', $password);
        $request->bindValue(':statut', $statut);
        $request->bindValue(':age', $age);
        $request->execute();
    }

    public function getAllStatut() {
        $requete = $this->db->prepare('SELECT * FROM statut');
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatutById($id) {
        $request = $this->db->prepare('SELECT * FROM statut where id=:id');
        $request->bindValue(':id', $id);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }
}
