<?php
session_start();

require_once('Controler/AccesControler.php');
require_once('Class/Acces.class.php');

if ($_SESSION['connecte'] != 'YES') {
    header('location: login.php');
}
echo "Bonjour, ".$_SESSION['prenom'];
?>
<a href="deconnexion.php"><img src="images/deconnexion.png" alt=""></a><br>
<?php

if (array_key_exists('prenom', $_POST) and isset($_POST['prenom']) and trim($_POST['prenom'])
    and array_key_exists('login', $_POST) and isset($_POST['login']) and trim($_POST['login'])
    and array_key_exists('password', $_POST) and isset($_POST['password']) and trim($_POST['password'])
    and array_key_exists('statut', $_POST) and isset($_POST['statut']) and trim($_POST['statut'])
    and array_key_exists('age', $_POST) and isset($_POST['age']) and trim($_POST['age'])) {
    $acces =  new Acces($_POST['login'], $_POST['password'], $_POST['prenom'], $_POST['statut'], $_POST['age']);
    AccesControler::insertAcces($acces);
}
?>
<form class="" action="ajoute.php" method="post">
    <label for="prenom">Prénom :</label><input id="prenom" type="text" name="prenom" value="" required="required"><br>
    <label for="login">Login :</label><input id="login" type="text" name="login" value="" required="required"><br>
    <label for="password">Password :</label><input id="password" type="password" name="password" value="" required="required"><br>
    <label for="statut">Statut :</label><input id="statut" type="text" name="statut" value="" required="required"><br>
    <label for="age">Age :</label><input id="age" type="number" name="age" value="" required="required"><br>
    <input type="submit" name="" value="Ajouter">
</form>
<br>
<a href="liste.php">retour a la liste</a>
