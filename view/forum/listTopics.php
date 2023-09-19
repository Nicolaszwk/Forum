<?php

$topics = $result['data']['topics'];
$category = $result['data']['category'];
?>

<h1>Liste des topics</h1>

<?php
foreach ($topics as $topic) {
?>
    <a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>">
        <p><?= $topic->getTitle() ?></p>
    </a>
    <?php
    if (App\Session::isAdmin()) {
    ?>
        <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>"><i class="fa-solid fa-square-minus fa-lg"></i></a>
    <?php
    }
    ?>


    <?php
    if (App\Session::isAdmin() || App\Session::getUser() == $topic->getUser()) {
        if (!$topic->getIsLocked()) {
    ?>
            <a href="index.php?ctrl=forum&action=lockTopic&id=<?= $topic->getId() ?>"><i class="fa-solid fa-lock-open fa-lg"></i></a>
        <?php
        } else {
        ?>
            <a href="index.php?ctrl=forum&action=unlockTopic&id=<?= $topic->getId() ?>"><i class="fa-solid fa-lock fa-lg"></i></a>

    <?php
        }
    }
}
if (App\Session::isAdmin() || App\Session::getUser()) {
    ?>

    <a href="index.php?ctrl=forum&action=addTopicForm&id=<?= $category->getId() ?>"><button>Add a topic</a>
<?php
}
?>