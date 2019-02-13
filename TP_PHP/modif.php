<?php
session_start();

require_once('Controler/AccesControler.php');

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
    and array_key_exists('age', $_POST) and isset($_POST['age']) and trim($_POST['age'])
    and array_key_exists('id', $_GET) and isset($_GET['id']) and trim($_GET['id'])) {

    $acces =  new Acces($_POST['login'], $_POST['password'], $_POST['prenom'], $_POST['statut'], $_POST['age']);
    AccesControler::updateAcces($acces, $_GET['id']);
}

if (array_key_exists('id', $_GET) and isset($_GET['id']) and trim($_GET['id'])) {
    $acces = AccesControler::getAccesById($_GET['id']);
    $getStatutList = AccesControler::getAllStatut();
?>
<form class="" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <label for="prenom">Prénom :</label><input id="prenom" type="text" name="prenom" value="<?php echo $acces->getPrenom() ?>" required="required"><br>
    <label for="login">Login :</label><input id="login" type="text" name="login" value="<?php echo $acces->getLogin() ?>" required="required"><br>
    <label for="password">Password :</label><input id="password" type="password" name="password" value="<?php echo $acces->getPassword() ?>" required="required"><br>
    <label for="">Statut :</label>
    <select class="" name="statut" required="required">
        <?php
        foreach ($getStatutList as $statut) {
            foreach ($statut as $key => $value) {
                if ($key === 'nom') {
                    ?>
                    <option value="<?php echo $value; ?>" <?php if ($value == $acces->getStatut()) { echo 'selected="selected"';} ?>><?php echo $value; ?></option>
                    <?php
                }
            }
        }
        ?>
    </select><br>
    <label for="age">Age :</label><input id="age" type="number" name="age" value="<?php echo $acces->getAge() ?>" required="required"><br>
    <input type="submit" name="" value="Modifier">
</form>
<?php
}
?>
<br>
<a href="liste.php">retour a la liste</a>
