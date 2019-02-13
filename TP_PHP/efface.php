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
if (array_key_exists('id', $_GET) and isset($_GET['id']) and trim($_GET['id'])) {
    $deleteUser = AccesControler::deleteUser($_GET['id']);
    if ($deleteUser) {
        header('location: liste.php?message=Reussi');
    } else {
        header('lolcation: liste.php?message=Erreur');
    }
} else {
    header('lolcation: liste.php?message=Erreur');
}

?>
