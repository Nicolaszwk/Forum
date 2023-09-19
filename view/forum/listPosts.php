<?php

$posts = $result['data']['posts'];
$topic = $result['data']['topic'];
?>

<?php
foreach ($posts as $key => $post) {
?>
    <div class="messageBox">
        <div class="messageInfos">
            blablabla
        </div>
        <div class="messageText">
            <p><?= $post->getMessage() ?></p>
            <?php
            if (App\Session::isAdmin() || App\Session::getUser() == $post->getUser()) {
                if ($key != 0 && !$topic->getIsLocked()){
            ?>
                <div class="deleteButton">
                    <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>"><i class="fa-solid fa-square-minus fa-lg"></i></a>
                </div>
            <?php
            }
        }
            ?>
        </div>
    </div>
<?php
}
?>
<?php
if (!$topic->getIsLocked()) {
?>
    <button><a href="index.php?ctrl=forum&action=addPostForm&id=<?= $topic->getId() ?>">Add a post</a></button>
<?php
}
?>