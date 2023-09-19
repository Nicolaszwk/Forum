<?php

$users = $result['data']['users'];

?>

<h1>Liste des users</h1>

<?php
foreach ($users as $user) {
?>
    <p><?= $user->getPseudo() ?></p>
    <a href="index.php?ctrl=security&action=ban&id=<?= $user->getId() ?>"><button>Bannir</button></a>
    <a href="index.php?ctrl=security&action=unban&id=<?= $user->getId() ?>"><button>Débannir</button></a>
<?php
}