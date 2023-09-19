<?php

$categories = $result['data']['categories'];

?>

<h1>Liste des categories</h1>

<?php
foreach ($categories as $category) {
?>
    <div>
        <a href="index.php?ctrl=forum&action=listTopics&id=<?= $category->getId() ?>"><p><?= $category->getCategoryName() ?></p></a>
        <a href="index.php?ctrl=forum&action=deleteCategory&id=<?= $category->getId() ?>"><i class="fa-solid fa-square-minus fa-lg"></i></a>
        <a href="index.php?ctrl=forum&action=updateCategoryForm&id=<?= $category->getId() ?>"><i class="fa-sharp fa-regular fa-pen-to-square fa-lg"></i></a>
    </div>
<?php
}
?>
<button><a href="index.php?ctrl=forum&action=addCategoryForm">Add a category</a></button>


