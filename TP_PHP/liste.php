<?php
session_start();

require_once('Controler/AccesControler.php');

if ($_SESSION['connecte'] != 'YES') {
    header('location: login.php');
}

$getAllAcces = AccesControler::getAllAcces();

echo "Bonjour, ".$_SESSION['prenom'];
?>
<a href="deconnexion.php"><img src="images/deconnexion.png" alt=""></a><br>
<?php
if (array_key_exists('message', $_GET) and isset($_GET['message']) and trim($_GET['message'])) {
    if ($_GET['message'] == 'Reussi') {
        ?>
        <p>Suppression réussi</p>
        <?php
    } else {
        ?>
        <p>Suppression échoué</p>
        <?php
    }
}
?>
Ajouter un utilisateur <a href="ajoute.php"><img src="images/ajoute.png" alt=""></a><a href="recherche.php"><button type="button" name="button">Recherche</button></a></br>
<table border="1">
    <tr>
        <td>Id</td><td>Prénom</td><td>Login</td><td>Password</td><td>Statut</td><td>Age</td>
    </tr>
<?php
foreach ($getAllAcces as $user) {
    ?>
    <tr>
        <?php
        foreach ($user as $key => $value) {
            if ($key === 'id') {
                $id = $value;
            }
            ?>
            <td><?php echo $value; ?></td>
            <?php
        }
        ?>
        <td><a href="efface.php?id=<?php echo $id ?>"><img src="images/croix.png" alt=""></a></td>
        <td><a href="modif.php?id=<?php echo $id ?>"><img src="images/modif.png" alt=""></a></td>
        <?php
        ?>
    </tr>
    <?php
}
?>
</table>
