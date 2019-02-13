<?php
session_start();

require_once('Controler/AccesControler.php');

if ($_SESSION['connecte'] != 'YES') {
    header('location: login.php');
}

if ((array_key_exists('prenom', $_POST) and isset($_POST['prenom']) and trim($_POST['prenom']))
    || (array_key_exists('ageDebut', $_POST) and isset($_POST['ageDebut']) and trim($_POST['ageDebut']))
    || (array_key_exists('ageFin', $_POST) and isset($_POST['ageFin']) and trim($_POST['ageFin']))
    || (array_key_exists('statut', $_POST) and isset($_POST['statut']) and trim($_POST['statut']))) {
    $acces = AccesControler::research($_POST['prenom'], $_POST['statut'], $_POST['ageDebut'], $_POST['ageFin']);
}

$statuts = AccesControler::getAllStatut();
echo('<form action="'.$_SERVER['PHP_SELF'].'" method="post">');
echo('Prenom :<input type="text" name ="prenom"">');
echo('</br>');
echo('Statut :<SELECT name="statut">');
    echo('<OPTION value='.null.'></OPTION>');
foreach($statuts as $statut)
{
    echo('<OPTION value='.$statut['nom'].'>'.$statut['nom'].'</OPTION>');
}
echo('</SELECT>');
echo('</br>');
echo('AgeDebut :<input type="text" name ="ageDebut">');
echo('</br>');
echo('AgeFin :<input type="text" name ="ageFin">');
echo('</br>');
echo('<button type="submit">Valider</button>');
echo('</form>');

if (isset($acces)) {
?>
<table border="1">
    <tr>
        <td>Id</td><td>Prénom</td><td>Login</td><td>Password</td><td>Statut</td><td>Age</td>
    </tr>
<?php
foreach ($acces as $user) {
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
<?php
}
?>
