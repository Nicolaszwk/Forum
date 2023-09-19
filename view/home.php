<link rel="stylesheet" href="./public/css/style.css">

<h1 id="welcome_message">BIENVENUE SUR LE FORUM</h1>

<?php
$categories = $result['data']['categories'];
$topicManager = $result['data']['topics'];
$title = $result['data']['title'];
?>

<?php
foreach ($categories as $category) {
    $topics = $topicManager->findTopicsByCatagoryId($category->getId());

?>
    <div class="section">
        <div class="categories">
            <a href="index.php?ctrl=forum&action=listTopics&id=<?= $category->getId() ?>">
                <p><?= $category->getCategoryName() ?></p>
            </a>
            <div class="crud">

                <?php
                if (App\Session::isAdmin()) {
                ?>
                    <a href="index.php?ctrl=forum&action=deleteCategory&id=<?= $category->getId() ?>"><i class="fa-solid fa-square-minus fa-lg"></i></a>
                    <a href="index.php?ctrl=forum&action=updateCategoryForm&id=<?= $category->getId() ?>"><i class="fa-sharp fa-regular fa-pen-to-square fa-lg"></i></a>
                <?php
                }
                ?>
            </div>
        </div>

        <?php
        foreach ($topics as $topic) {
        ?>
            <div class="topics">
                <a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>">
                    <p><?= $topic->getTitle() ?></p>
                </a>
            </div>
        <?php
        }
        ?>
    </div>
<?php
}
?>